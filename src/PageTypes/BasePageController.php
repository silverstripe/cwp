<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\Assets\Filesystem;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Environment;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\Versioned\Versioned;

class BasePageController extends ContentController
{
    private static $allowed_actions = [
        'downloadpdf',
    ];

    /**
     * Serve the page rendered as PDF.
     */
    public function downloadpdf()
    {
        if (!Config::inst()->get(BasePage::class, 'pdf_export')) {
            return false;
        }

        // We only allow producing live pdf. There is no way to secure the draft files.
        Versioned::set_stage(Versioned::LIVE);

        $path = $this->dataRecord->getPdfFilename();
        if (!file_exists($path)) {
            $this->generatePDF();
        }

        return HTTPRequest::send_file(file_get_contents($path), basename($path), 'application/pdf');
    }

    /*
    * This will return either pdf_base_url from YML, CWP_SECURE_DOMAIN
    * from _ss_environment, or blank. In that order of importance.
    */
    public function getPDFBaseURL()
    {
        //if base url YML is defined in YML, use that
        if (Config::inst()->get(BasePage::class, 'pdf_base_url')) {
            $pdfBaseUrl = Config::inst()->get(BasePage::class, 'pdf_base_url').'/';
            //otherwise, if we are CWP use the secure domain
        } elseif (Environment::getEnv('CWP_SECURE_DOMAIN')) {
            $pdfBaseUrl = Environment::getEnv('CWP_SECURE_DOMAIN') . '/';
            //or if neither, leave blank
        } else {
            $pdfBaseUrl = '';
        }
        return $pdfBaseUrl;
    }

    /*
    * Don't use the proxy if the pdf domain is the CWP secure domain
    * Or if we aren't on a CWP server
    */
    public function getPDFProxy($pdfBaseUrl)
    {
        if (!Environment::getEnv('CWP_SECURE_DOMAIN')
            || $pdfBaseUrl == Environment::getEnv('CWP_SECURE_DOMAIN') . '/'
        ) {
            $proxy = '';
        } else {
            $proxy = ' --proxy ' . Environment::getEnv('SS_OUTBOUND_PROXY')
                . ':' . Environment::getEnv('SS_OUTBOUND_PROXY_PORT');
        }
        return $proxy;
    }

    /**
     * Render the page as PDF using wkhtmltopdf.
     */
    public function generatePDF()
    {
        if (!Config::inst()->get(BasePage::class, 'pdf_export')) {
            return false;
        }

        $binaryPath = Config::inst()->get(BasePage::class, 'wkhtmltopdf_binary');
        if (!$binaryPath || !is_executable($binaryPath)) {
            if (Environment::getEnv('WKHTMLTOPDF_BINARY')
                && is_executable(Environment::getEnv('WKHTMLTOPDF_BINARY'))
            ) {
                $binaryPath = Environment::getEnv('WKHTMLTOPDF_BINARY');
            }
        }

        if (!$binaryPath) {
            user_error('Neither WKHTMLTOPDF_BINARY nor BasePage.wkhtmltopdf_binary are defined', E_USER_ERROR);
        }

        if (Versioned::get_reading_mode() == 'Stage.Stage') {
            user_error('Generating PDFs on draft is not supported', E_USER_ERROR);
        }

        set_time_limit(60);

        // prepare the paths
        $pdfFile = $this->dataRecord->getPdfFilename();
        $bodyFile = str_replace('.pdf', '_pdf.html', $pdfFile);
        $footerFile = str_replace('.pdf', '_pdffooter.html', $pdfFile);

        // make sure the work directory exists
        if (!file_exists(dirname($pdfFile))) {
            Filesystem::makeFolder(dirname($pdfFile));
        }

        //decide the domain to use in generation
        $pdfBaseUrl = $this->getPDFBaseURL();

        // Force http protocol on CWP - fetching from localhost without using the proxy, SSL terminates on gateway.
        if (Environment::getEnv('CWP_ENVIRONMENT')) {
            Config::modify()->set(Director::class, 'alternate_protocol', 'http');
            //only set alternate protocol if CWP_SECURE_DOMAIN is defined OR pdf_base_url is
            if ($pdfBaseUrl) {
                Config::modify()->set(Director::class, 'alternate_base_url', 'http://' . $pdfBaseUrl);
            }
        }

        $bodyViewer = $this->getViewer('pdf');

        // write the output of this page to HTML, ready for conversion to PDF
        file_put_contents($bodyFile, $bodyViewer->process($this));

        // get the viewer for the current template with _pdffooter
        $footerViewer = $this->getViewer('pdffooter');

        // write the output of the footer template to HTML, ready for conversion to PDF
        file_put_contents($footerFile, $footerViewer->process($this));

        //decide what the proxy should look like
        $proxy = $this->getPDFProxy($pdfBaseUrl);

        // finally, generate the PDF
        $command = $binaryPath . $proxy . ' --outline -B 40pt -L 20pt -R 20pt -T 20pt --encoding utf-8 '
            . '--orientation Portrait --disable-javascript --quiet --print-media-type ';
        $retVal = 0;
        $output = array();
        exec(
            $command . " --footer-html \"$footerFile\" \"$bodyFile\" \"$pdfFile\" &> /dev/stdout",
            $output,
            $retVal
        );

        // remove temporary file
        unlink($bodyFile);
        unlink($footerFile);

        // output any errors
        if ($retVal != 0) {
            user_error('wkhtmltopdf failed: ' . implode("\n", $output), E_USER_ERROR);
        }

        // serve the generated file
        return HTTPRequest::send_file(file_get_contents($pdfFile), basename($pdfFile), 'application/pdf');
    }

    /**
     * Provide current year.
     */
    public function CurrentDatetime()
    {
        return DBDatetime::now();
    }

    public function getRSSLink()
    {
    }
}

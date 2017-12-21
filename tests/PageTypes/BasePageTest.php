<?php

namespace CWP\CWP\Tests\PageTypes;

use CWP\CWP\PageTypes\BasePage;
use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\SapphireTest;

class BasePageTest extends SapphireTest
{
    protected static $fixture_file = 'BasePageTest.yml';

    protected function setUp()
    {
        parent::setUp();

        Config::modify()->set(BasePage::class, 'pdf_export', true);
        Config::modify()->set(BasePage::class, 'generated_pdf_path', 'assets/_generated_pdfs');
    }

    public function testPdfFilename()
    {
        $page = $this->objFromFixture(BasePage::class, 'test-page-one');
        $this->assertContains(
            'assets/_generated_pdfs/test-page-one-1.pdf',
            $page->getPdfFilename(),
            'Generated filename for PDF'
        );
    }

    public function testPdfLink()
    {
        $page = $this->objFromFixture(BasePage::class, 'test-page-one');
        $this->assertContains('test-page-one/downloadpdf', $page->PdfLink(), 'Link to download PDF');
    }

    public function testHomePagePdfLink()
    {
        $page = $this->objFromFixture(BasePage::class, 'home-page');
        $this->assertContains('home/downloadpdf', $page->PdfLink(), 'Link to download PDF');
    }

    public function testPdfLinkDisabled()
    {
        Config::modify()->set(BasePage::class, 'pdf_export', false);
        $page = $this->objFromFixture(BasePage::class, 'test-page-one');
        $this->assertFalse($page->PdfLink(), 'No PDF link as the functionality is disabled');
    }
}

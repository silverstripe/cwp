<?php

namespace CWP\CWP\Tests\PageTypes;

use Translatable;
use SilverStripe\Core\Config\Config;
use CWP\CWP\PageTypes\BasePage;
use SilverStripe\Dev\SapphireTest;

class BasePageTest extends SapphireTest
{
    public static $fixture_file = 'BasePageTest.yml';

    public function setUp()
    {
        parent::setUp();

        Config::nest();
        Config::inst()->update(BasePage::class, 'pdf_export', true);
        Config::inst()->update(BasePage::class, 'generated_pdf_path', 'assets/_generated_pdfs');
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
        Config::inst()->update(BasePage::class, 'pdf_export', false);
        $page = $this->objFromFixture(BasePage::class, 'test-page-one');
        $this->assertFalse($page->PdfLink(), 'No PDF link as the functionality is disabled');
    }

    /**
     * Test that the native language name can be returned for the current locale
     *
     * @see i18n
     * @param string $locale
     * @param string $expected
     * @dataProvider localeProvider
     */
    public function testGetSelectedLanguage($locale, $expected)
    {
        if (!class_exists('Translatable')) {
            $this->markTestSkipped('Language tests require Translatable module.');
        }

        Translatable::set_current_locale($locale);
        $page = $this->objFromFixture(BasePage::class, 'test-page-one');
        $this->assertSame($expected, $page->getSelectedLanguage());
    }

    /**
     * @return array[]
     */
    public function localeProvider()
    {
        return array(
            array('en_NZ', 'English'),
            array('af_ZA', 'Afrikaans'),
            array('es_ES', 'espa&ntilde;ol')
        );
    }

    public function tearDown()
    {
        Config::unnest();
        parent::tearDown();
    }
}

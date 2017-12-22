<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\TreeMultiselectField;
use SilverStripe\i18n\i18n;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Taxonomy\TaxonomyTerm;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\ArrayData;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

/**
 * **BasePage** is the foundation which can be used for constructing your own pages.
 * By default it is hidden from the CMS - we rely on developers creating their own
 * `Page` class in the `mysite/code` which will extend from the **BasePage**.
 */

class BasePage extends SiteTree
{
    private static $icon = 'cwp/cwp:images/icons/sitetree_images/page.png';

    /**
     * Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
     *
     * {@inheritDoc}
     */
    private static $hide_ancestor = BasePage::class;

    private static $pdf_export = false;

    /*
    *Domain to generate PDF's from, DOES not include protocol
    *i.e. google.com not http://google.com
    */
    private static $pdf_base_url = "";

    /**
     * Allow custom overriding of the path to the WKHTMLTOPDF binary, in cases
     * where multiple versions of the binary are available to choose from. This
     * should be the full path to the binary (e.g. /usr/local/bin/wkhtmltopdf)
     * @see BasePage_Controller::generatePDF();
     */
    private static $wkhtmltopdf_binary = null;

    private static $generated_pdf_path = 'assets/_generated_pdfs';

    private static $api_access = [
        'view' => [
            'Locale', 'URLSegment', 'Title', 'MenuTitle', 'Content', 'MetaDescription',
            'ExtraMenu', 'Sort', 'Version', 'ParentID', 'ID'
        ],
        'edit' => [
            'Locale', 'URLSegment', 'Title', 'MenuTitle', 'Content', 'MetaDescription',
            'ExtraMenu', 'Sort', 'Version', 'ParentID', 'ID'
        ],
    ];

    private static $table_name = 'BasePage';

    public static $related_pages_title = 'Related pages';

    private static $many_many = [
        'Terms' => TaxonomyTerm::class,
        'RelatedPages' => BasePage::class,
    ];

    private static $many_many_extraFields = [
        'RelatedPages' => [
            'SortOrder' => 'Int',
        ],
    ];

    private static $plural_name = 'Base Pages';

    public $pageIcon = 'images/icons/sitetree_images/page.png';

    /**
     * Get the footer holder.
     */
    public function getFooter()
    {
        return FooterHolder::get_one(FooterHolder::class);
    }

    /**
     * Return the full filename of the pdf file, including path & extension
     */
    public function getPdfFilename()
    {
        $baseName = sprintf('%s-%s', $this->URLSegment, $this->ID);

        $folderPath = Config::inst()->get(BasePage::class, 'generated_pdf_path');
        if ($folderPath[0] != '/') {
            $folderPath = BASE_PATH . '/' . $folderPath;
        }

        return sprintf('%s/%s.pdf', $folderPath, $baseName);
    }

    /**
     * Build pdf link for template.
     */
    public function PdfLink()
    {
        if (!Config::inst()->get(BasePage::class, 'pdf_export')) {
            return false;
        }

        $path = $this->getPdfFilename();

        if ((Versioned::get_stage() === Versioned::LIVE) && file_exists($path)) {
            return Director::baseURL() . preg_replace('#^/#', '', Director::makeRelative($path));
        }
        return $this->Link('downloadpdf');
    }

    public function RelatedPages()
    {
        return $this->getManyManyComponents('RelatedPages')->sort('SortOrder');
    }

    public function RelatedPagesTitle()
    {
        return $this->stat('related_pages_title');
    }

    /**
     * Remove linked pdf when publishing the page,
     * as it would be out of date.
     */
    public function onAfterPublish()
    {
        $filepath = $this->getPdfFilename();
        if (file_exists($filepath)) {
            unlink($filepath);
        }
    }

    /**
     * Remove linked pdf when unpublishing the page,
     * so it's no longer valid.
     *
     * @return boolean
     */
    public function doUnpublish()
    {
        if (!parent::doUnpublish()) {
            return false;
        }

        $filepath = $this->getPdfFilename();
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        return true;
    }

    /**
     * @deprecated 2.0.0 remove with other deprecations
     * @todo Remove once CWP moves to 3.3 core (which includes this in SiteTree)
     * @return self
     */
    public function doRestoreToStage()
    {
        $this->invokeWithExtensions('onBeforeRestoreToStage', $this);
        $result = parent::doRestoreToStage();
        $this->invokeWithExtensions('onAfterRestoreToStage', $this);

        return $result;
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            // Related Pages
            $components = GridFieldConfig_RelationEditor::create();
            $components->removeComponentsByType(GridFieldAddNewButton::class);
            $components->removeComponentsByType(GridFieldEditButton::class);
            $components->removeComponentsByType(GridFieldFilterHeader::class);
            $components->addComponent(new GridFieldSortableRows('SortOrder'));

            $dataColumns = $components->getComponentByType(GridFieldDataColumns::class);
            $dataColumns->setDisplayFields([
                'Title' => _t('BasePage.ColumnTitle', 'Title'),
                'ClassName' => _t('BasePage.ColumnPageType', 'Page Type')
            ]);

            $fields->findOrMakeTab(
                'Root.RelatedPages',
                _t('BasePage.RelatedPages', 'Related pages')
            );
            $fields->addFieldToTab(
                'Root.RelatedPages',
                GridField::create(
                    'RelatedPages',
                    _t('BasePage.RelatedPages', 'Related pages'),
                    $this->RelatedPages(),
                    $components
                )
            );

            // Taxonomies - Unless they have their own 'Tags' field (such as in Blog, etc)
            $hasMany = $this->hasMany();
            $manyMany = $this->manyMany();
            if (!isset($hasMany['Tags']) && !isset($manyMany['Tags'])) {
                $components = GridFieldConfig_RelationEditor::create();
                $components->removeComponentsByType(GridFieldAddNewButton::class);
                $components->removeComponentsByType(GridFieldEditButton::class);

                $autoCompleter = $components->getComponentByType(GridFieldAddExistingAutocompleter::class);
                $autoCompleter->setResultsFormat('$Name ($TaxonomyName)');

                $dataColumns = $components->getComponentByType(GridFieldDataColumns::class);
                $dataColumns->setDisplayFields([
                    'Name' => _t('BasePage.Term', 'Term'),
                    'TaxonomyName' => _t('BasePage.Taxonomy', 'Taxonomy')
                ]);

                $fields->findOrMakeTab('Root.Tags', _t('BasePage.TagsTabTitle', 'Tags'));
                $fields->addFieldToTab(
                    'Root.Tags',
                    TreeMultiselectField::create(
                        'Terms',
                        _t('BasePage.Terms', 'Terms'),
                        TaxonomyTerm::class
                    )->setDescription(_t('BasePage.TermsDescription', 'Click to search for additional terms'))
                );
            }
        });
        return parent::getCMSFields();
    }

    /**
     * Provides data for translation navigation.
     * Collects all site translations, marks the current one, and redirects
     * to the translated home page if a. there is a translated homepage and b. the
     * translation of the specific page is not available.
     * @todo re-implement with Fluent
     */
    public function getAvailableTranslations()
    {
        if (!class_exists('Translatable')) {
            return false;
        }

        $translations = new ArrayList();
        $globalTranslations = Translatable::get_existing_content_languages();

        foreach ($globalTranslations as $loc => $langName) {
            // Find out the language name in native language.
            $nativeLangName = i18n::get_language_name($loc, true);
            if (!$nativeLangName) {
                $nativeLangName = i18n::get_language_name(i18n::get_lang_from_locale($loc), true);
            }
            if (!$nativeLangName) {
                // Fall back to the locale name.
                $nativeLangName = $langName;
            }

            // Eliminate the part in brackets (e.g. [mandarin])
            $nativeLangName = preg_replace('/ *[\(\[].*$/', '', $nativeLangName);

            // Find out the link to the translated page.
            $link = null;
            $page = $this->getTranslation($loc);
            if ($page) {
                $link = $page->Link();
            }
            if (!$link) {
                // Fall back to the home page
                $link = Translatable::get_homepage_link_by_locale($loc);
            }
            if (!$link) {
                continue;
            }

            // Assemble the table for the switcher.
            $translations->push(new ArrayData(array(
                'Locale' => i18n::convert_rfc1766($loc),
                'LangName' => $nativeLangName,
                'Link' => $link,
                'Current' => (Translatable::get_current_locale()==$loc)
            )));
        }

        if ($translations->count()>1) {
            return $translations;
        } else {
            return null;
        }
    }

    /**
     * Returns the native language name for the selected locale/language, empty string if Translatable is not available
     *
     * @return string
     * @todo re-implement with Fluent
     */
    public function getSelectedLanguage()
    {
        if (!class_exists('Translatable')) {
            return '';
        }

        $language = explode('_', Translatable::get_current_locale());
        $languageCode = array_shift($language);
        $nativeName = i18n::get_language_name($languageCode, true);

        return $nativeName;
    }
}

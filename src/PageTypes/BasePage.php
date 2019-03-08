<?php

namespace CWP\CWP\PageTypes;

use CWP\CWP\Model\RelatedPageLink;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\TreeMultiselectField;
use SilverStripe\Taxonomy\TaxonomyTerm;
use SilverStripe\View\ArrayData;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TractorCow\Fluent\Model\Locale;
use TractorCow\Fluent\State\FluentState;

/**
 * `BasePage` is a foundation page class which can be used for constructing your own page types. By default it is
 * hidden from the CMS - we rely on developers creating their own `Page` class in `mysite/code` which will extend
 * from `BasePage`.
 *
 * Please note: you should generally always extend `Page` with your custom page types. Refrain from subclassing
 * `BasePage` directly. Doing so will omit `Page` from your custom class's hierarchy, and this can have unintended
 * side effects where modules rely on modifying things on the `Page` class, as well as with templates and themes.
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

    /**
     * @config
     * @var string
     */
    private static $related_pages_title = 'Related pages';

    private static $many_many = [
        'Terms' => TaxonomyTerm::class,
        'RelatedPagesThrough' => [
            'through' => RelatedPageLink::class,
            'from' => 'BasePage',
            'to' => 'Child',
        ]
    ];

    private static $belongs_many_many = [
        'SimilarPages' => BasePage::class
    ];

    /**
     * @var array
     * @config
     */
    private static $many_many_extraFields = [
        'RelatedPages' => [
            'SortOrder' => 'Int',
        ],
    ];

    private static $plural_name = 'Base Pages';

    /**
     * Get the footer holder.
     */
    public function getFooter()
    {
        return FooterHolder::get_one(FooterHolder::class);
    }

    /**
     * @deprecated 2.2.0:3.0.0 Please use RelatedPagesThrough() instead
     */
    public function RelatedPages()
    {
        return $this->getManyManyComponents('RelatedPagesThrough');
    }

    public function RelatedPagesTitle()
    {
        return $this->config()->get('related_pages_title');
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            // Related Pages
            $components = GridFieldConfig_RelationEditor::create();
            $components->removeComponentsByType(GridFieldAddNewButton::class);
            $components->removeComponentsByType(GridFieldEditButton::class);
            $components->removeComponentsByType(GridFieldFilterHeader::class);
            $components->addComponent(new GridFieldOrderableRows('SortOrder'));

            /** @var GridFieldDataColumns $dataColumns */
            $dataColumns = $components->getComponentByType(GridFieldDataColumns::class);
            $dataColumns->setDisplayFields([
                'Title' => _t(__CLASS__ . '.ColumnTitle', 'Title'),
                'ClassName' => _t(__CLASS__ . '.ColumnPageType', 'Page Type')
            ]);

            $fields->findOrMakeTab(
                'Root.RelatedPages',
                _t(__CLASS__ . '.RelatedPages', 'Related pages')
            );
            $fields->addFieldToTab(
                'Root.RelatedPages',
                GridField::create(
                    'RelatedPages',
                    _t(__CLASS__ . '.RelatedPages', 'Related pages'),
                    $this->RelatedPagesThrough(),
                    $components
                )
            );

            // Taxonomies - Unless they have their own 'Tags' field (such as in Blog, etc)
            $hasMany = $this->hasMany();
            $manyMany = $this->manyMany();
            if (!isset($hasMany['Tags']) && !isset($manyMany['Tags'])) {
                $fields->findOrMakeTab('Root.Tags', _t(__CLASS__ . '.TagsTabTitle', 'Tags'));
                $fields->addFieldToTab(
                    'Root.Tags',
                    TreeMultiselectField::create(
                        'Terms',
                        _t(__CLASS__ . '.Terms', 'Terms'),
                        TaxonomyTerm::class
                    )->setDescription(_t(__CLASS__ . '.TermsDescription', 'Click to search for additional terms'))
                );
            }
        });
        return parent::getCMSFields();
    }

    /**
     * Returns the native language name for the selected locale/language, empty string if Fluent is not available
     *
     * @return string
     */
    public function getSelectedLanguage()
    {
        if (!class_exists(Locale::class) || !$this->hasMethod('Locales')) {
            return '';
        }

        /** @var ArrayData $information */
        $information = $this->LocaleInformation(FluentState::singleton()->getLocale());

        return $information->LanguageNative;
    }
}

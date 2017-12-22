<?php

namespace CWP\CWP\PageTypes;

use CWP\CWP\Model\Quicklink;
use Page;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Forms\TreeDropdownField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

/**
 * **BaseHomePage** is the basic home page.
 * By default it is hidden from the CMS - we rely on developers creating their own
 * `HomePage` class in the `mysite/code` which will extend from the **BaseHomePage**.
 */
class BaseHomePage extends Page
{
    private static $icon = 'cwp/cwp:images/icons/sitetree_images/home.png';

    private static $hide_ancestor = BaseHomePage::class;

    private static $singular_name = 'Home Page';

    private static $plural_name = 'Home Pages';

    private static $table_name = 'BaseHomePage';

    private static $db = array(
        'FeatureOneTitle' => 'Varchar(255)',
        'FeatureOneCategory' => "Enum('bell,comments,film,flag,globe,group,list,phone,rss,time,user','comments')",
        'FeatureOneContent' => 'HTMLText',
        'FeatureOneButtonText' => 'Varchar(255)',
        'FeatureTwoTitle' => 'Varchar(255)',
        'FeatureTwoCategory' => "Enum('bell,comments,film,flag,globe,group,list,phone,rss,time,user','comments')",
        'FeatureTwoContent' => 'HTMLText',
        'FeatureTwoButtonText' => 'Varchar(255)'
    );

    private static $has_one = array(
        'LearnMorePage' => SiteTree::class,
        'FeatureOneLink' => SiteTree::class,
        'FeatureTwoLink' => SiteTree::class
    );

    private static $has_many = array(
        'Quicklinks' => 'Quicklink.Parent'
    );

    public $pageIcon = 'images/icons/sitetree_images/home.png';

    public function Quicklinks()
    {
        return $this->getComponents('Quicklinks')->sort('SortOrder');
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            // Main Content tab
            $fields->addFieldToTab(
                'Root.Main',
                TreeDropdownField::create(
                    'LearnMorePageID',
                    _t('BaseHomePage.LearnMoreLink', 'Page to link the "Learn More" button to:'),
                    SiteTree::class
                ),
                'Metadata'
            );

            $gridField = GridField::create(
                'Quicklinks',
                'Quicklinks',
                $this->Quicklinks(),
                GridFieldConfig_RelationEditor::create()
            );
            $gridConfig = $gridField->getConfig();
            $gridConfig->getComponentByType(GridFieldAddNewButton::class)->setButtonName(
                _t('BaseHomePage.AddNewButton', 'Add new')
            );

            $injector = Injector::inst();

            $gridConfig->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
            $gridConfig->removeComponentsByType(GridFieldDeleteAction::class);
            $gridConfig->addComponent($injector->create(GridFieldDeleteAction::class));
            $gridConfig->addComponent($injector->create(GridFieldSortableRows::class, 'SortOrder'));
            $gridField->setModelClass(Quicklink::class);

            $fields->addFieldToTab('Root.Quicklinks', $gridField);

            $fields->removeByName('Import');

            $fields->addFieldToTab(
                'Root.Features',
                ToggleCompositeField::create(
                    'FeatureOne',
                    _t('SiteTree.FeatureOne', 'Feature One'),
                    array(
                        TextField::create('FeatureOneTitle', _t('BaseHomePage.Title', 'Title')),
                        $dropdownField = DropdownField::create(
                            'FeatureOneCategory',
                            _t('BaseHomePage.FeatureCategoryDropdown', 'Category icon'),
                            singleton(BaseHomePage::class)->dbObject('FeatureOneCategory')->enumValues()
                        ),
                        HTMLEditorField::create(
                            'FeatureOneContent',
                            _t('BaseHomePage.FeatureContentFieldLabel', 'Content')
                        ),
                        TextField::create(
                            'FeatureOneButtonText',
                            _t('BaseHomePage.FeatureButtonText', 'Button text')
                        ),
                        TreeDropdownField::create(
                            'FeatureOneLinkID',
                            _t('BaseHomePage.FeatureLink', 'Page to link to'),
                            SiteTree::class
                        )->setDescription(_t('BaseHomePage.ButtonTextRequired', 'Button text must be filled in'))
                    )
                )->setHeadingLevel(3)
            );
            $dropdownField->setEmptyString('none');

            $fields->addFieldToTab('Root.Features', ToggleCompositeField::create(
                'FeatureTwo',
                _t('SiteTree.FeatureTwo', 'Feature Two'),
                array(
                    TextField::create('FeatureTwoTitle', _t('BaseHomePage.Title', 'Title')),
                    $dropdownField = DropdownField::create(
                        'FeatureTwoCategory',
                        _t('BaseHomePage.FeatureCategoryDropdown', 'Category icon'),
                        singleton(BaseHomePage::class)->dbObject('FeatureTwoCategory')->enumValues()
                    ),
                    HTMLEditorField::create(
                        'FeatureTwoContent',
                        _t('BaseHomePage.FeatureContentFieldLabel', 'Content')
                    ),
                    TextField::create(
                        'FeatureTwoButtonText',
                        _t('BaseHomePage.FeatureButtonText', 'Button text')
                    ),
                    TreeDropdownField::create(
                        'FeatureTwoLinkID',
                        _t('BaseHomePage.FeatureLink', 'Page to link to'),
                        SiteTree::class
                    )->setDescription(_t('BaseHomePage.ButtonTextRequired', 'Button text must be filled in'))
                )
            )->setHeadingLevel(3));
            $dropdownField->setEmptyString('none');
        });

        return parent::getCMSFields();
    }
}

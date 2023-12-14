<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * @method Image FeaturedImage()
 */
class NewsPage extends DatedUpdatePage
{
    private static $description = 'Describes an item of news';

    private static $default_parent = 'NewsHolderPage';

    private static $can_be_root = false;

    private static $icon_class = 'font-icon-p-news-item';

    private static $singular_name = 'News Page';

    private static $plural_name = 'News Pages';

    private static $db = [
        'Author' => 'Varchar(255)',
    ];

    private static $has_one = [
        'FeaturedImage' => Image::class,
    ];

    private static $owns = [
        'FeaturedImage',
    ];

    private static $table_name = 'NewsPage';

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Author'] = _t('CWP\\CWP\\PageTypes\\DateUpdatePage.AuthorFieldLabel', 'Author');
        $labels['FeaturedImageID'] = _t(
            'CWP\\CWP\\PageTypes\\DateUpdatePage.FeaturedImageFieldLabel',
            'Featured Image'
        );

        return $labels;
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab(
                'Root.Main',
                TextField::create('Author', $this->fieldLabel('Author')),
                'Abstract'
            );

            $fields->addFieldToTab(
                'Root.Main',
                UploadField::create('FeaturedImage', $this->fieldLabel('FeaturedImageID')),
                'Abstract'
            );
        });
        return parent::getCMSFields();
    }

    /**
     * Returns the Author DB field for this page type.
     *
     * Used to avoid conflicts with `Versioned::Author()`
     *
     * @return DBField
     */
    public function getNewsPageAuthor()
    {
        return $this->dbObject('Author');
    }
}

<?php

namespace CWP\CWP\Tests\PageTypes;

use CWP\CWP\PageTypes\NewsHolder;
use CWP\CWP\PageTypes\NewsPage;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\FieldType\DBField;

class NewsPageTest extends SapphireTest
{
    protected $usesDatabase = true;

    public function testGetNewsPageAuthor()
    {
        $holder = new NewsHolder();
        $holder->Title = 'Holder';
        $holder->write();

        $page = new NewsPage();
        $page->Author = 'Leslie Lawless';
        $page->ParentID = $holder->ID;
        $page->write();

        $field = $page->getNewsPageAuthor();
        $this->assertInstanceOf(DBField::class, $field);
        $this->assertSame('Leslie Lawless', $field->getValue());
    }
}

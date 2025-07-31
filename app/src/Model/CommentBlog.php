<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\DropdownField;

class CommentBlog extends DataObject
{
    private static $table_name = 'CommentBlog';

    private static $db = [
        'Name' => 'Varchar(255)',
        'Comment' => 'Text',
    ];

    private static $has_one = [
        'Blog' => Blog::class,
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'Comment.Summary' => 'Comment',
        'Blog.Title' => 'Blog',
        'Created' => 'Created',
    ];

    private static $searchable_fields = [
        'Name',
        'Comment',
        'Blog.Title'
    ];

    private static $default_sort = 'Created DESC';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Name', 'Name'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Comment', 'Comment'));
        $fields->addFieldToTab('Root.Main', DropdownField::create(
            'BlogID',
            'Blog',
            Blog::get()->map('ID', 'Title')
        )->setEmptyString('-- Select Blog --'));

        return $fields;
    }

    public function getCreatedNice()
    {
        return $this->dbObject('Created')->Nice();
    }

    public function getCommentSummary()
    {
        return substr($this->Comment, 0, 100) . (strlen($this->Comment) > 100 ? '...' : '');
    }
}
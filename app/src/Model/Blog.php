<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;

class Blog extends DataObject
{
    private static $table_name = "Blog";

    private static $db = [
        'Title' => 'Varchar(255)',
        'Date' => 'Date',
        'Description' => 'HTMLText',
    ];

    private static $has_one = [
        'Image' => Image::class,
        'KategoriBlog' => KategoriBlog::class,
        'BlogPage' => BlogPage::class,
    ];

    private static $has_many = [
        'CommentBlog' => CommentBlog::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'KategoriBlog.Kategori' => 'Category',
        'Date' => 'Date',
        'Description.Summary' => 'Description',
        'CommentCount' => 'Comments',
    ];

    private static $searchable_fields = [
        'Title',
        'Description',
        'KategoriBlog.ID' => [
            'title' => 'Category',
            'filter' => 'ExactMatchFilter'
        ],
        'Date'
    ];

    private static $default_sort = 'Date DESC';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));
        $fields->addFieldToTab('Root.Main', DateField::create('Date', 'Date')
            ->setHTML5(true)
            ->setValue(date('Y-m-d')));
        $fields->addFieldToTab('Root.Main', HTMLEditorField::create('Description', 'Description')
            ->setRows(10));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Image')
            ->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif'])
            ->setAllowedMaxFileNumber(1));
        $fields->addFieldToTab('Root.Main', DropdownField::create(
            'KategoriBlogID',
            'Category',
            KategoriBlog::get()->map('ID', 'Kategori')
        )->setEmptyString('-- Select Category --'));

        // Add comments tab if blog exists
        if ($this->exists()) {
            $commentsField = $fields->dataFieldByName('CommentBlog');
            if ($commentsField) {
                $fields->removeByName('CommentBlog');
                $fields->addFieldToTab('Root.Comments', $commentsField);
            }
        }

        return $fields;
    }

    public function getCommentCount()
    {
        return $this->CommentBlog()->Count();
    }

    public function getDescriptionSummary($words = 20)
    {
        return $this->dbObject('Description')->Summary($words);
    }

    public function getDateNice()
    {
        return $this->dbObject('Date')->Nice();
    }

    public function getLink()
    {
        if ($this->BlogPage() && $this->BlogPage()->exists()) {
            return $this->BlogPage()->Link('view/' . $this->ID);
        }
        return '/blog/view/' . $this->ID;
    }

    public function getMetaDescription()
    {
        return strip_tags($this->getDescriptionSummary(30));
    }

    public function validate()
    {
        $result = parent::validate();

        if (!$this->Title) {
            $result->addError('Title is required');
        }

        if (!$this->Description) {
            $result->addError('Description is required');
        }

        if (!$this->Date) {
            $result->addError('Date is required');
        }

        return $result;
    }

    public function populateDefaults()
    {
        parent::populateDefaults();
        $this->Date = date('Y-m-d');
    }
}
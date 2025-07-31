<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Hero extends DataObject
{
    private static $table_name = "Hero";
    private static $db = [
        'Title' => 'Varchar(255)',
        'Description' => 'Text',
    ];
    private static $has_one = [
        'Image' => Image::class,
        'CompanyPage' => CompanyPage::class,
    ];
    private static $owns = [
        'Image',
    ];
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'Description' => 'Description',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Hero Title'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Description', 'Hero Description'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Hero Image'));
        return $fields;
    }
}
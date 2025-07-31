<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CurrencyField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Packages extends DataObject
{
    private static $table_name = "Packages";
    private static $db = [
        'Title' => 'Varchar(255)',
        'Description' => 'Text',
        'Price' => 'Currency',
    ];
    private static $has_one = [
        'Image' => Image::class,
        "CompanyPage" => CompanyPage::class,
    ];
    private static $owns = [
        'Image',
    ];
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'Description' => 'Description',
        'Price' => 'Price',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Package Title'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Description', 'Package Description'));
        $fields->addFieldToTab('Root.Main', CurrencyField::create('Price', 'Package Price'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Package Image'));
        return $fields;
    }
}
<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Treatments extends DataObject
{
    private static $table_name = "Treatments";
    private static $db = [
        'Title' => 'Varchar(255)',
        'SubTitle' => 'Varchar(255)',
        'Description' => 'Text',
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
        'SubTitle'=> 'Sub Title',
        'Description' => 'Description',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Treatment Title'));
        $fields->addFieldToTab('Root.Main', TextField::create('SubTitle', 'Treatment Sub Title'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Description', 'Treatment Description'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Treatment Image'));
        return $fields;
    }
}
<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Testimonial extends DataObject
{
    private static $table_name = "Testimonial";
    private static $db = [
        'ClientName' => 'Varchar(255)',
        'Proffesion' => 'Varchar(255)',
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
        'ClientName' => 'Client Name',
        'Proffesion' => 'Profession',
        'Description' => 'Testimonial Description',
        'Image.CMSThumbnail' => 'Image',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('ClientName', 'Client Name'));
        $fields->addFieldToTab('Root.Main', TextField::create('Proffesion', 'Client Profession'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Description', 'Testimonial Description'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image','Client Image'));
        return $fields;
    }
}
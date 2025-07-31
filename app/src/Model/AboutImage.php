<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;

class AboutImage extends DataObject
{
    private static $table_name = "AboutImage";
    private static $has_one = [
        "Image" => Image::class,
        "CompanyPage" => CompanyPage::class,
    ];
    private static $owns = [
        "Image",
    ];
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'About Image'));
        return $fields;
    }
}
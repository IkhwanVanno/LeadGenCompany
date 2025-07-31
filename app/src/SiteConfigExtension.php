<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class SiteConfigExtension extends DataExtension
{

    private static $table_name = "CompanyExtension";
    private static $db = [
        'CompanyFirstName' => 'Varchar(255)',
        'CompanyLastName' => 'Varchar(255)',
        'About' => 'Varchar(255)',
        'SubAbout' => 'Varchar(255)',
        'Description' => 'Text',
        'Address' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'WorkTime' => 'Varchar(255)',
        'FooterCredit' => 'Varchar(255)',
        'SectionTreatmentsT' => 'Varchar(255)',
        'SectionTreatmentsD' => 'Text',
        'SectionPackagesT' => 'Varchar(255)',
        'SectionPackagesD' => 'Text',
        'SectionGalleryT' => 'Varchar(255)',
        'SectionGalleryD' => 'Text',
        'SectionTestimonialT' => 'Varchar(255)',
        'SectionTestimonialD' => 'Text',
        'SectionContactT' => 'Varchar(255)',
        'SectionContactD' => 'Text',
    ];
    private static $has_one = [
        'Logo' => Image::class,
        'Favicon' => Image::class,
    ];
    private static $owns = [
        'Logo',
        'Favicon',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('CompanyFirstName', 'Company First Name'),
            TextField::create('CompanyLastName', 'Company Last Name'),
            TextField::create('About', 'About Company'),
            TextField::create('SubAbout', 'Sub About Company'),
            TextareaField::create('Description', 'Company Description'),
            TextField::create('Address', 'Company Address'),
            TextField::create('Email', 'Company Email'),
            TextField::create('Phone', 'Company Phone'),
            TextareaField::create('WorkTime', 'Company Work Time'),
            TextField::create('FooterCredit', 'Company Footer Creadit'),
            TextField::create('SectionTreatmentsT', 'Section Treatment Title'),
            TextareaField::create('SectionTreatmentsD', 'Section Treatment Description'),
            TextField::create('SectionPackagesT', 'Section Packages Title'),
            TextareaField::create('SectionPackagesD', 'Section Packages Description'),
            TextField::create('SectionGalleryT', 'Section Gallery Title'),
            TextareaField::create('SectionGalleryD', 'Section Gallery Description'),
            TextField::create('SectionTestimonialT', 'Section Testimonial Title'),
            TextareaField::create('SectionTestimonialD', 'Section Testimonial Description'),
            TextField::create('SectionContactT', 'Section Contact Title'),
            TextareaField::create('SectionContactD', 'Section Contact Description'),
            UploadField::create('Logo', 'Company Logo'),
            UploadField::create('Favicon', 'Company Favicon'),
        ]);
    }

}
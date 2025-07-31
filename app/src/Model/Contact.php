<?php

use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class Contact extends DataObject
{
    private static $table_name = "Contact";
    private static $db = [
        'UserName' => 'Varchar(255)',
        'UserEmail' => 'Varchar(255)',
        'Message' => 'Text',
    ];
    private static $has_one = [
        'CompanyPage' => CompanyPage::class,
    ];
    private static $summary_fields = [
        'UserName' => 'Name',
        'UserEmail' => 'Email',
        'Message' => 'Message',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('UserName', 'Your Name'));
        $fields->addFieldToTab('Root.Main', TextField::create('UserEmail', 'Your Email'));
        $fields->addFieldToTab('Root.Main', TextareaField::create('Message', 'Your Message'));
        return $fields;
    }
}
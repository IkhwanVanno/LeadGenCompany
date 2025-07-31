<?php

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class KategoriBlog extends DataObject
{
    private static $table_name = "KategoriBlog";
    private static $db = [
        "Kategori" => "Varchar(255)",
    ];
    private static $has_many = [
        'Blogs' => Blog::class,
    ];
    private static $summary_fields = [
        'Kategori' => 'Category Name',
    ];
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Kategori', 'Category Name'));
        return $fields;
    }
}
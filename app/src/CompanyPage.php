<?php

class CompanyPage extends Page {
    
    private static $table_name = 'CompanyPage';
    private static $has_many =[
        'AboutImages' => AboutImage::class,
        'Hero' => Hero::class,      
        'Testimonials' => Testimonial::class,
        'Gallery' => Gallery::class,
        'Contact' => Contact::class,
        'Packages' => Packages::class,
        'Treatments' => Treatments::class,  
    ];
}
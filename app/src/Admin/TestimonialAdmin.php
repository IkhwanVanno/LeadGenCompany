<?php

use SilverStripe\Admin\ModelAdmin;

class TestimonialAdmin extends ModelAdmin
{
    private static $menu_title = 'Testimonials';
    private static $url_segment = 'testimonials';
    private static $menu_icon_class = 'font-icon-torsos-all';
    private static $managed_models = [
        Testimonial::class,
    ];
}
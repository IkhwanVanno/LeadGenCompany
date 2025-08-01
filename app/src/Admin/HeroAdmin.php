<?php

use SilverStripe\Admin\ModelAdmin;

class HeroAdmin extends ModelAdmin
{
    private static $menu_title = 'Hero Images';
    private static $url_segment = 'hero-images';
    private static $menu_icon_class = 'font-icon-picture';
    private static $managed_models = [
        Hero::class,
    ];
}
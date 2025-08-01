<?php

use SilverStripe\Admin\ModelAdmin;

class AboutImageAdmin extends ModelAdmin
{
    private static $menu_title = "About Images";
    private static $url_segment = "about-images";
    private static $menu_icon_class = 'font-icon-image';
    private static $managed_models = [
        AboutImage::class,
    ];
}
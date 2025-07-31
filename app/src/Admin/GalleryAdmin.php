<?php

use SilverStripe\Admin\ModelAdmin;

class GalleryAdmin extends ModelAdmin
{
    private static $menu_title = 'Gallery';
    private static $url_segment = 'gallery';
    private static $menu_icon = '';
    private static $managed_models = [
        Gallery::class,
    ];
}
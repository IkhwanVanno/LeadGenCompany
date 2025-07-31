<?php

use SilverStripe\Admin\ModelAdmin;

class PackagesAdmin extends ModelAdmin
{
    private static $menu_title = 'Packages';
    private static $url_segment = 'packages';
    private static $menu_icon = '';
    private static $managed_models = [
        Packages::class,
    ];
}
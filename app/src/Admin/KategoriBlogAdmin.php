<?php

use SilverStripe\Admin\ModelAdmin;

class KategoriBlogAdmin extends ModelAdmin
{
    private static $menu_title = "Blog Categories";
    private static $url_segment = "blog-categories";
    private static $menu_icon = "";
    private static $managed_models = [
        KategoriBlog::class,
    ];
}
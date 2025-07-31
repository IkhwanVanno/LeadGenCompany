<?php

use SilverStripe\Admin\ModelAdmin;

class BlogAdmin extends ModelAdmin
{
    private static $menu_title = "Blogs";
    private static $url_segment = "blogs";
    private static $menu_icon = "";
    private static $managed_models = [
        Blog::class,
    ];
}
<?php

use SilverStripe\Admin\ModelAdmin;

class ContactAdmin extends ModelAdmin
{
    private static $menu_title = 'Contact';
    private static $url_segment = 'contact';
    private static $menu_icon_class = 'font-icon-p-mail';
    private static $managed_models = [
        Contact::class,
    ];
}
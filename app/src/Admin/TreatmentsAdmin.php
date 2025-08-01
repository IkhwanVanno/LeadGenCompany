<?php

use SilverStripe\Admin\ModelAdmin;

class TreatmentsAdmin extends ModelAdmin
{
    private static $menu_title = 'Treatments';
    private static $url_segment = 'treatments';
    private static $menu_icon_class = 'font-icon-happy';
    private static $managed_models = [
        Treatments::class,
    ];
}
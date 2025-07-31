<?php

use silverstripe\SiteConfig\SiteConfig;

if (class_exists("SiteConfigExtension")) {
    SiteConfig::add_extension(SiteConfigExtension::class);
}
<?php

class BlogPage extends Page
{
    private static $table_name = 'BlogPage';
    private static $has_many =[
        'Blog'=> Blog::class,
    ];
}
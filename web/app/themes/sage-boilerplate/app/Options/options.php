<?php
if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'Website Einstellungen',
    'menu_title' => 'Website Einstellungen',
    'menu_slug'  => 'site-options',
    'capability' => 'edit_posts',
    'redirect'   => false,
  ]);
}

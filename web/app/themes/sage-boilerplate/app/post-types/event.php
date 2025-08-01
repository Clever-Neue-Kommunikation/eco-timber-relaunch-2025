<?php

namespace App;

add_action('init', function () {
    register_post_type('event', [
        'labels' => [
            'name' => 'Veranstaltungen',
            'singular_name' => 'Veranstaltung',
            'add_new_item' => 'Neue Veranstaltung hinzufügen',
            'edit_item' => 'Veranstaltung bearbeiten',
            'new_item' => 'Neue Veranstaltung',
            'view_item' => 'Veranstaltung ansehen',
            'search_items' => 'Veranstaltungen durchsuchen',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_position' => 22,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'veranstaltungen'],
    ]);
});

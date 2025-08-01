<?php

namespace App;

add_action('init', function () {
    register_post_type('mitarbeiter', [
        'labels' => [
            'name' => 'Mitarbeitende',
            'singular_name' => 'Mitarbeiter',
            'add_new_item' => 'Neuen Mitarbeiter hinzufügen',
            'edit_item' => 'Mitarbeiter bearbeiten',
            'new_item' => 'Neuer Mitarbeiter',
            'view_item' => 'Mitarbeiter ansehen',
            'search_items' => 'Mitarbeitende durchsuchen',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-businessperson',
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'mitarbeiter'],
    ]);
});

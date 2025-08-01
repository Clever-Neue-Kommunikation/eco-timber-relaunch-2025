<?php

namespace App;

add_action('acf/init', function () {
    acf_register_block_type([
        'name' => 'mitarbeiter-uebersicht',
        'title' => __('Mitarbeiter Übersicht', 'sage'),
        'description' => __('Zeigt alle Mitarbeitenden, Geschäftsführer einzeln', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'groups',
        'mode' => 'preview',
        'align' => 'wide',
        'keywords' => ['mitarbeiter', 'team', 'übersicht'],
        'render_callback' => __NAMESPACE__ . '\\render_mitarbeiter_uebersicht',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_mitarbeiter_uebersicht($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.mitarbeiter-uebersicht', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

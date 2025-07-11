<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_reference_preview',
        'title' => 'Referenz-Vorschau Einstellungen',
        'fields' => [
            [
                'key' => 'field_preview_title',
                'label' => 'Titel',
                'name' => 'preview_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_preview_category',
                'label' => 'Referenz-Kategorie',
                'name' => 'preview_category',
                'type' => 'taxonomy',
                'taxonomy' => 'reference_category',
                'field_type' => 'select',
                'return_format' => 'id',
                'allow_null' => 0,
                'add_term' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/reference-preview',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'reference-preview',
        'title' => __('Referenz-Vorschau', 'sage'),
        'description' => __('Zeigt maximal 3 Referenzen aus einer Kategorie', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'grid-view',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['referenz', 'projekte', 'vorschau'],
        'render_callback' => __NAMESPACE__ . '\\render_reference_preview',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_reference_preview($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.reference-preview', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}


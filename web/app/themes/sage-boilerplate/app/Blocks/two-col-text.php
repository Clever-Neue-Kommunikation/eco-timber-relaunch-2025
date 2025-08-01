<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_two_col_text',
        'title' => 'Two-Column Text – Einstellungen',
        'fields' => [
            [
                'key' => 'field_tct_left_title',
                'label' => 'Linke Spalte: Titel',
                'name' => 'tct_left_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_tct_left_subtitle',
                'label' => 'Linke Spalte: SubTitel',
                'name' => 'tct_left_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_tct_left_text',
                'label' => 'Linke Spalte: Text / Hinweis',
                'name' => 'tct_left_text',
                'type' => 'wysiwyg',
                'tabs' => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key' => 'field_tct_right_title',
                'label' => 'Rechte Spalte: Überschrift',
                'name' => 'tct_right_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_tct_right_text',
                'label' => 'Rechte Spalte: Text',
                'name' => 'tct_right_text',
                'type' => 'wysiwyg',
                'tabs' => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key' => 'field_tct_show_buttons',
                'label' => 'Buttons anzeigen',
                'name' => 'tct_show_buttons',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/two-col-text',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'two-col-text',
        'title' => __('Two-Column Text', 'sage'),
        'description' => __('Zweispaltiges Text-Layout', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_two_col_text',
        'category' => 'flowbite-blocks',
        'icon' => 'editor-alignleft',
        'keywords' => ['two-col', 'text', 'layout'],
        'mode' => 'preview',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

/**
 * Callback zum Rendern des Blocks.
 */
function render_two_col_text($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.two-col-text', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

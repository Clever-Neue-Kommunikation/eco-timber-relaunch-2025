<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_split_info_quote',
        'title'  => 'Split Info & Quote – Einstellungen',
        'fields' => [
            // Linke Spalte: Freier Text
            [
                'key'   => 'field_si_left_content',
                'label' => 'Linke Spalte: Inhalt',
                'name'  => 'si_left_content',
                'type'  => 'wysiwyg',
                'tabs'  => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            // Linke Spalte: Buttons
            [
                'key'   => 'field_si_buttons',
                'label' => 'Show Contact Buttons',
                'name'  => 'si_buttons',
                'type'  => 'true_false',
            ],

            // Rechte Spalte: Icon oben
            [
                'key'   => 'field_si_icon_class',
                'label' => 'Icon-Klasse',
                'name'  => 'si_icon_class',
                'type'  => 'text',
                'instructions' => 'Z.B. "fa-solid fa-lightbulb"',
            ],
            // Rechte Spalte: Zitat
            [
                'key'   => 'field_si_quote',
                'label' => 'Zitat',
                'name'  => 'si_quote',
                'type'  => 'textarea',
                'rows'  => 4,
            ],
            // Rechte Spalte: Quelle/Cite
            [
                'key'   => 'field_si_quote_source',
                'label' => 'Zitatquelle',
                'name'  => 'si_quote_source',
                'type'  => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/split-info-quote',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'split-info-quote',
        'title'           => __('Split Info & Quote', 'sage'),
        'description'     => __('Zweispaltiges Layout: Info links, Zitat rechts', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_split_info_quote',
        'category'        => 'flowbite-blocks',
        'icon'            => 'columns',
        'keywords'        => ['split','quote','info'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => true,
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_split_info_quote($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.split-info-quote', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}

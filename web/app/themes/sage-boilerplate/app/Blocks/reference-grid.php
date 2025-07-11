<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_reference_grid',
        'title' => 'Referenz-Grid Einstellungen',
        'fields' => [
            [
                'key' => 'field_reference_limit',
                'label' => 'Anzahl der Referenzen',
                'name' => 'reference_limit',
                'type' => 'number',
                'default_value' => -1,
            ],
            [
                'key' => 'field_reference_show_filter',
                'label' => 'Filter anzeigen',
                'name' => 'reference_show_filter',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ],
            [
                'key' => 'field_reference_title',
                'label' => 'Titel',
                'name' => 'reference_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_reference_subtitle',
                'label' => 'Subtitel',
                'name' => 'reference_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_reference_intro_text',
                'label' => 'Einleitungstext',
                'name' => 'reference_intro_text',
                'type' => 'wysiwyg',
                'tabs' => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key' => 'field_reference_text_align',
                'label' => 'Textausrichtung',
                'name' => 'reference_text_align',
                'type' => 'button_group',
                'choices' => [
                    'text-left' => 'Links',
                    'text-center' => 'Zentriert',
                    'text-right' => 'Rechts',
                ],
                'default_value' => 'text-left',
                'layout' => 'horizontal',
            ],
            [
                'key' => 'field_reference_show_buttons',
                'label' => 'Kontakt-Buttons anzeigen',
                'name' => 'reference_show_buttons',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],
            [
                'key' => 'field_show_reference_summary',
                'label' => 'Projekt-Übersichtskarte anzeigen',
                'name' => 'show_reference_summary',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],


        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/reference-grid',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'reference-grid',
        'title' => __('Referenzübersicht', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'grid-view',
        'keywords' => ['referenz', 'projekte', 'grid'],
        'mode' => 'preview',
        'align' => 'full',
        'render_callback' => __NAMESPACE__ . '\\render_reference_grid',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_reference_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.reference-grid', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

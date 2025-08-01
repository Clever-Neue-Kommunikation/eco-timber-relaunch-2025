<?php

namespace App;

add_action('acf/init', function () {
    // Feldgruppe registrieren
    acf_add_local_field_group([
        'key'   => 'group_project_sizes',
        'title' => 'Projektgrößen – Einstellungen',
        'fields'=> [
            [
                'key'   => 'field_ps_section_title',
                'label' => 'Sektionstitel',
                'name'  => 'ps_section_title',
                'type'  => 'text',
            ],
            [
                'key'     => 'field_ps_items',
                'label'   => 'Größen-Karten',
                'name'    => 'ps_items',
                'type'    => 'repeater',
                'layout'  => 'block',
                'button_label' => 'Karte hinzufügen',
                'sub_fields'   => [
                    [
                        'key'    => 'field_ps_item_image',
                        'label'  => 'Hintergrundbild',
                        'name'   => 'image',
                        'type'   => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                    ],
                    [
                        'key'    => 'field_ps_item_title',
                        'label'  => 'Karten-Titel',
                        'name'   => 'title',
                        'type'   => 'text',
                    ],
                    [
                        'key'    => 'field_ps_item_url',
                        'label'  => 'Link URL',
                        'name'   => 'url',
                        'type'   => 'url',
                    ],
                    [
                        'key'    => 'field_ps_item_label',
                        'label'  => 'Link-Text',
                        'name'   => 'label',
                        'type'   => 'text',
                        'default_value' => 'mehr erfahren',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/project-sizes',
                ],
            ],
        ],
    ]);

    // Block registrieren
    acf_register_block_type([
        'name'            => 'project-sizes',
        'title'           => __('Projektgrößen', 'sage'),
        'description'     => __('Übersicht unterschiedlicher Projektgrößen als Karten', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_project_sizes',
        'category'        => 'flowbite-blocks',
        'icon'            => 'grid-view',
        'keywords'        => ['projekt','größe','karte'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => true,
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

/**
 * Render-Callback.
 */
function render_project_sizes($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.project-sizes', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}

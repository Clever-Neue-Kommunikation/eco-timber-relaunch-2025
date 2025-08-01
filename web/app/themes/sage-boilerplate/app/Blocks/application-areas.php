<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_application_areas',
        'title'  => 'Anwendungsbereiche – Einstellungen',
        'fields' => [
            [
                'key'   => 'field_aa_title',
                'label' => 'Überschrift',
                'name'  => 'aa_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_aa_intro_left',
                'label' => 'Einleitung links',
                'name'  => 'aa_intro_left',
                'type'  => 'wysiwyg',
                'tabs'  => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key'   => 'field_aa_intro_right',
                'label' => 'Einleitung rechts',
                'name'  => 'aa_intro_right',
                'type'  => 'wysiwyg',
                'tabs'  => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key'         => 'field_aa_items',
                'label'       => 'Bereiche',
                'name'        => 'aa_items',
                'type'        => 'repeater',
                'layout'      => 'block',
                'button_label'=> 'Bereich hinzufügen',
                'sub_fields'  => [
                    [
                        'key'           => 'field_aa_item_image',
                        'label'         => 'Bild',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                    ],
                    [
                        'key'   => 'field_aa_item_label',
                        'label' => 'Beschriftung',
                        'name'  => 'label',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_aa_item_desc',
                        'label' => 'Beschreibung',
                        'name'  => 'desc',
                        'type'  => 'text',
                    ],
                ],
            ],
            [
                'key'           => 'field_aa_show_contact',
                'label'         => 'Kontaktbereich anzeigen',
                'name'          => 'aa_show_contact',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ],
            [
                'key'           => 'field_aa_show_contact_btns',
                'label'         => 'Kontaktbuttons anzeigen',
                'name'          => 'aa_show_contact_btns',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/application-areas',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'application-areas',
        'title'           => __('Anwendungsbereiche', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_application_areas',
        'category'        => 'flowbite-blocks',
        'icon'            => 'editor-ul',
        'keywords'        => ['anwendung','grid','icons'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => ['wide','full'],
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_application_areas($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.application-areas', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}

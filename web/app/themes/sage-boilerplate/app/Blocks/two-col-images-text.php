<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_two_col_images_text',
        'title'  => 'Two-Column Images & Text – Einstellungen',
        'fields' => [
            [
                'key' => 'field_tc_image_position',
                'label' => 'Bildposition',
                'name' => 'tc_image_position',
                'type' => 'select',
                'choices' => [
                    'left' => 'Links',
                    'right' => 'Rechts',
                ]

            ],
            [
                'key'   => 'field_tc_title',
                'label' => 'Titel Rechts',
                'name'  => 'tc_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_tc_text2',
                'label' => 'Text',
                'name'  => 'tc_text',
                'type'  => 'wysiwyg',
                'tabs'  => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key'         => 'field_tc_images',
                'label'       => 'Bilder',
                'name'        => 'tc_images',
                'type'        => 'repeater',
                'layout'      => 'block',
                'button_label'=> 'Bild hinzufügen',
                'sub_fields'  => [
                    [
                        'key'   => 'field_tc_image',
                        'label' => 'Bild auswählen',
                        'name'  => 'image',
                        'type'  => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/two-col-images-text',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'two-col-images-text',
        'title'           => __('Two-Column Images & Text', 'sage'),
        'description'     => __('Links mehrere Bilder, rechts Text + Kontakt', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_two_col_images_text',
        'category'        => 'flowbite-blocks',
        'icon'            => 'format-image',
        'keywords'        => ['images','text','columns'],
        'mode'            => 'preview',
        'supports'        => [
            'align'     => ['wide','full'],
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_two_col_images_text($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.two-col-images-text', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}

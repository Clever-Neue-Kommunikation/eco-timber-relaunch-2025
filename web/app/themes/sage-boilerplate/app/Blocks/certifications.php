<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_certifications',
        'title' => 'Zertifizierte Qualität – Einstellungen',
        'fields' => [
            [
                'key'   => 'field_cert_section_title',
                'label' => 'Sektionstitel',
                'name'  => 'cert_section_title',
                'type'  => 'text',
            ],
            [
                'key' => 'field_cert_subtitle',
                'label' => 'Untertitel',
                'name' => 'cert_section_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_cert_items',
                'label' => 'Zertifizierungs-Siegel',
                'name' => 'cert_items',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'Siegel hinzufügen',
                'sub_fields' => [
                    // Bild, Titel, Beschreibung …
                    [
                        'key' => 'field_cert_item_image',
                        'label' => 'Siegel-Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                    ],
                    [
                        'key' => 'field_cert_item_title',
                        'label' => 'Überschrift',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_cert_item_description',
                        'label' => 'Beschreibung',
                        'name' => 'description',
                        'type' => 'wysiwyg',
                        'tabs' => 'visual',
                        'media_upload' => 0,
                        'delay' => 1,
                    ],
                    [
                        'key' => 'field_cert_item_videos',
                        'label' => 'Video',
                        'name' => 'videos',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'button_label' => 'Video hinzufügen',
                        'sub_fields' => [
                            [
                                'key' => 'field_cert_video_thumb',
                                'label' => 'Vorschaubild (URL)',
                                'name' => 'thumb',
                                'type' => 'url',
                            ],
                            [
                                'key' => 'field_cert_video_url',
                                'label' => 'Video-URL',
                                'name' => 'video_url',
                                'type' => 'url',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/certifications',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'certifications',
        'title' => __('Zertifizierte Qualität', 'sage'),
        'description' => __('Liste Ihrer Güte-Siegel mit Text & optionalem Video', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_certifications',
        'category' => 'flowbite-blocks',
        'icon' => 'award',
        'keywords' => ['zertifikat', 'qualität', 'siegel'],
        'mode' => 'auto',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_certifications($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.certifications', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

<?php

namespace App;

add_action('acf/init', function () {
    // 1) Feldgruppe anlegen
    acf_add_local_field_group([
        'key'    => 'group_partner_slider',
        'title'  => 'Partner Slider – Einstellungen',
        'fields' => [
            [
                'key' => 'field_ps_title',
                'label' => 'Titel',
                'name' => 'ps_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_ps_description',
                'label' => 'Beschreibung',
                'name' => 'ps_description',
                'type' => 'wysiwyg',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key'          => 'field_ps_partners',
                'label'        => 'Partner-Logos',
                'name'         => 'ps_partners',
                'type'         => 'repeater',
                'min'          => 1,
                'layout'       => 'row',
                'button_label' => 'Partner hinzufügen',
                'sub_fields'   => [
                    [
                        'key'      => 'field_ps_logo',
                        'label'    => 'Logo (URL)',
                        'name'     => 'logo',
                        'type'     => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                        'library'       => 'all',
                    ],
                    [
                        'key'   => 'field_ps_name',
                        'label' => 'Name (alt‑Text)',
                        'name'  => 'name',
                        'type'  => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/partner-slider',
                ],
            ],
        ],
    ]);

    // 2) Block-Typ registrieren
    acf_register_block_type([
        'name'            => 'partner-slider',
        'title'           => __('Partner Slider', 'sage'),
        'description'     => __('Karussell mit Partner‑Logos (Swiper)', 'sage'),
        'render_callback' => __NAMESPACE__ . '\\render_partner_slider',
        'category'        => 'flowbite-blocks',
        'icon'            => 'images-alt2',
        'keywords'        => ['slider', 'partner', 'logos'],
        'mode'            => 'edit',
        'supports'        => [
            'align'     => true,
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

/**
 * Render-Callback: lädt das Blade‑Template `blocks.partner-slider`
 */
function render_partner_slider($block, $content = '', $is_preview = false, $post_id = 0)
{

    echo \Roots\view('blocks.partner-slider', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}

<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_company_insight_grid',
        'title' => 'Company Insight Grid',
        'fields' => [
            [
                'key' => 'field_cig_headline',
                'label' => 'Überschrift',
                'name' => 'cig_headline',
                'type' => 'text',
            ],
            [
                'key' => 'field_cig_subline',
                'label' => 'Subheadline',
                'name' => 'cig_subline',
                'type' => 'text',
            ],
            [
                'key' => 'field_cig_description',
                'label' => 'Beschreibung',
                'name' => 'cig_description',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_cig_images',
                'label' => 'Bilder (max. 8)',
                'name' => 'cig_images',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'table',
                'button_label' => 'Bild hinzufügen',
                'sub_fields' => [
                    [
                        'key' => 'field_cig_image',
                        'label' => 'Bild',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ]
                ],
            ],
            [
                'key' => 'field_cig_show_buttons',
                'label' => 'Kontaktbuttons anzeigen?',
                'name' => 'cig_show_buttons',
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
                    'value' => 'acf/company-insight-grid',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'company-insight-grid',
        'title' => __('Hinter den Kulissen Grid', 'sage'),
        'description' => __('Textbereich mit Kontakt und umfließendem 3x4-Bilder-Grid', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'images-alt2',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['hinter', 'kulissen', 'unternehmen', 'bilder', 'grid'],
        'render_callback' => __NAMESPACE__ . '\\render_company_insight_grid',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_company_insight_grid($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.company-insight-grid', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

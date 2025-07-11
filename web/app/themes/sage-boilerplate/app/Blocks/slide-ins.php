<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key' => 'group_slide_ins',
        'title' => 'Slide-Ins Einstellungen',
        'fields' => [
            [
                'key' => 'field_slide_ins_title',
                'label' => 'Titel',
                'name' => 'slide_ins_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_slide_ins_title2',
                'label' => 'Titel 2',
                'name' => 'slide_ins_title2',
                'type' => 'text',
            ],
            [
                'key' => 'field_slide_ins_subtitle',
                'label' => 'Untertitel',
                'name' => 'slide_ins_subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_slide_ins_text',
                'label' => 'Text',
                'name' => 'slide_ins_text',
                'type' => 'wysiwyg',
                'tabs' => 'visual',
                'media_upload' => 0,
                'delay' => 1,
            ],
            [
                'key' => 'field_slide_ins_margin_top',
                'label' => 'Abstand oben',
                'name' => 'slide_ins_margin_top',
                'type' => 'select',
                'choices' => [
                    '!-mt-0' => 'Kein Abstand',
                    '!-mt-4' => 'mt-4 (1rem)',
                    '!-mt-8' => 'mt-8 (2rem)',
                    '!-mt-12' => 'mt-12 (3rem)',
                    '!-mt-16' => 'mt-16 (4rem)',
                    '!-mt-20' => 'mt-20 (5rem)',
                ],
                'default_value' => '!-mt-0',
            ],
            [
                'key' => 'field_slide_ins_button_text',
                'label' => 'Button-Text',
                'name' => 'slide_ins_button_text',
                'type' => 'text',
            ],
            [
                'key' => 'field_slide_ins_button_url',
                'label' => 'Button-URL',
                'name' => 'slide_ins_button_url',
                'type' => 'url',
            ],
            [
                'key' => 'field_slide_ins_bg_class',
                'label' => 'Hintergrundfarbe',
                'name' => 'slide_ins_bg_class',
                'type' => 'select',
                'choices' => [
                    'slide-in-primary-left' => 'Primary',
                    'slide-in-secondary-left' => 'Secondary',
                ],
                'default_value' => 'slide-in-primary-left',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/slide-ins',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name' => 'slide-ins',
        'title' => __('Slide-Ins Callout', 'sage'),
        'description' => __('Ein Callout mit schrägem Hintergrund und Slide-In-Animation', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'megaphone',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['slide', 'callout', 'animation'],
        'render_callback' => __NAMESPACE__ . '\\render_slide_ins',
        'supports' => [
            'align' => ['full'],
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_slide_ins($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.slide-ins', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

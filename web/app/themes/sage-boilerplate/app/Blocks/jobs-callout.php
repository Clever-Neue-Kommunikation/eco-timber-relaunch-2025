<?php

namespace App;

add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'group_jobs_callout',
        'title'  => 'Jobs & Team Callout',
        'fields' => [
            // Erster Callout (Slanted Background + Bild)
            [
                'key'   => 'field_jobs_heading',
                'label' => 'Haupttitel',
                'name'  => 'jobs_heading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_jobs_subheading',
                'label' => 'Subtitel',
                'name'  => 'jobs_subheading',
                'type'  => 'textarea',
                'rows'  => 2,
            ],
            [
                'key'   => 'field_jobs_cta_text',
                'label' => 'Button-Text (oben)',
                'name'  => 'jobs_cta_text',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_jobs_cta_url',
                'label' => 'Button-URL (oben)',
                'name'  => 'jobs_cta_url',
                'type'  => 'url',
            ],
            [
                'key'   => 'field_jobs_image',
                'label' => 'Rechts Bild',
                'name'  => 'jobs_image',
                'type'  => 'image',
                'return_format' => 'url',
            ],

            // Zweiter Callout (Text + Kontakt)
            [
                'key'   => 'field_team_heading',
                'label' => 'Team-Titel',
                'name'  => 'team_heading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_team_text',
                'label' => 'Team-Text',
                'name'  => 'team_text',
                'type'  => 'wysiwyg',
                'tabs'  => 'visual',
                'media_upload' => 0,
            ],
            [
                'key'   => 'field_team_image',
                'label' => 'Ansprechpartner-Bild',
                'name'  => 'team_image',
                'type'  => 'image',
                'return_format' => 'url',
            ],
            [
                'key'   => 'field_contact_name',
                'label' => 'Ansprechpartner',
                'name'  => 'contact_name',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_phone',
                'label' => 'Telefonnummer',
                'name'  => 'contact_phone',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_email_text',
                'label' => 'E-Mail-Button-Text',
                'name'  => 'contact_email_text',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_email_url',
                'label' => 'E-Mail-URL (mailto:)',
                'name'  => 'contact_email_url',
                'type'  => 'url',
            ],

            // Video-Grid
            [
                'key'          => 'field_videos',
                'label'        => 'Meet-Videos',
                'name'         => 'videos',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Video hinzufügen',
                'sub_fields'   => [
                    [
                        'key'   => 'field_video_thumb',
                        'label' => 'Vorschaubild (URL)',
                        'name'  => 'thumb',
                        'type'  => 'url',
                    ],
                    [
                        'key'   => 'field_video_url',
                        'label' => 'Video-URL',
                        'name'  => 'video_url',
                        'type'  => 'url',
                    ],
                    [
                        'key'   => 'field_video_title',
                        'label' => 'Titel',
                        'name'  => 'video_title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_video_text',
                        'label' => 'Beschreibung',
                        'name'  => 'video_text',
                        'type'  => 'textarea',
                        'rows'  => 2,
                    ],
                ],
            ],

            // Abschluss-Buttons
            [
                'key'   => 'field_footer_cta_primary_text',
                'label' => 'Button-Text „Zu den Jobs“',
                'name'  => 'footer_cta_primary_text',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_footer_cta_primary_url',
                'label' => 'Button-URL „Zu den Jobs“',
                'name'  => 'footer_cta_primary_url',
                'type'  => 'url',
            ],
            [
                'key'   => 'field_footer_cta_secondary_text',
                'label' => 'Button-Text „Zum Team“',
                'name'  => 'footer_cta_secondary_text',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_footer_cta_secondary_url',
                'label' => 'Button-URL „Zum Team“',
                'name'  => 'footer_cta_secondary_url',
                'type'  => 'url',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/jobs-callout',
                ],
            ],
        ],
    ]);

    acf_register_block_type([
        'name'            => 'jobs-callout',
        'title'           => __('Jobs & Team', 'sage'),
        'description'     => __('Callout für Jobs mit Team-Sektion und Video-Grid', 'sage'),
        'category'        => 'flowbite-blocks',
        'icon'            => 'groups',
        'mode'            => 'preview',
        'align'           => 'full',
        'keywords'        => ['jobs','team','video'],
        'render_callback' => __NAMESPACE__ . '\\render_jobs_callout',
        'supports'        => [
            'align'     => ['full'],
            'mode'      => true,
            'jsx'       => true,
            'className' => true,
        ],
    ]);
});

function render_jobs_callout($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.jobs-callout', [
        'block'      => $block,
        'is_preview' => $is_preview,
    ]);
}

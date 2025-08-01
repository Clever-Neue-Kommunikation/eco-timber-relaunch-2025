<?php

namespace App;

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_event_fields',
        'title' => 'Veranstaltungsdaten',
        'fields' => [
            [
                'key' => 'field_event_link',
                'label' => 'Link zur Veranstaltungsseite',
                'name' => 'event_link',
                'type' => 'url',
            ],
            [
                'key' => 'field_event_start',
                'label' => 'Beginn (Datum)',
                'name' => 'event_start',
                'type' => 'date_picker',
                'display_format' => 'd.m.Y',
                'return_format' => 'Y-m-d',
                'required' => 1,
            ],
            [
                'key' => 'field_event_end',
                'label' => 'Ende (Datum, optional)',
                'name' => 'event_end',
                'type' => 'date_picker',
                'display_format' => 'd.m.Y',
                'return_format' => 'Y-m-d',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ],
            ],
        ],
    ]);
}

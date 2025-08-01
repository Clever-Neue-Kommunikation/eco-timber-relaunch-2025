<?php

namespace App;

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_mitarbeiter_fields',
        'title' => 'Mitarbeiter',
        'fields' => [
            [
                'key' => 'field_position',
                'label' => 'Position',
                'name' => 'position',
                'type' => 'text',
            ],
            [
                'key' => 'field_telefonnummer',
                'label' => 'Telefonnummer',
                'name' => 'telefonnummer',
                'type' => 'text',
            ],
            [
                'key' => 'field_email',
                'label' => 'E-Mail',
                'name' => 'email',
                'type' => 'email',
            ],
             [
                'key' => 'field_is_chef',
                'label' => 'Ist Geschäftsführer?',
                'name' => 'is_chef',
                'type' => 'true_false',
                'message' => 'Dieser Mitarbeiter ist Geschäftsführer',
                'ui' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'mitarbeiter',
                ],
            ],
        ],
    ]);
}

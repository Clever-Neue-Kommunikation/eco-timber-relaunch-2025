<?php

namespace App;

add_action('acf/init', function () {
    acf_register_block_type([
        'name' => 'event-calendar',
        'title' => __('Event-Kalender', 'sage'),
        'description' => __('Zeigt alle Veranstaltungen in einer Monatsübersicht', 'sage'),
        'category' => 'flowbite-blocks',
        'icon' => 'calendar-alt',
        'mode' => 'preview',
        'align' => 'full',
        'keywords' => ['event', 'calendar', 'veranstaltungen', 'termin'],
        'render_callback' => __NAMESPACE__ . '\\render_event_calendar',
        'supports' => [
            'align' => true,
            'mode' => true,
            'jsx' => true,
            'className' => true,
        ],
    ]);
});

function render_event_calendar($block, $content = '', $is_preview = false, $post_id = 0)
{
    echo \Roots\view('blocks.event-calendar', [
        'block' => $block,
        'is_preview' => $is_preview,
    ]);
}

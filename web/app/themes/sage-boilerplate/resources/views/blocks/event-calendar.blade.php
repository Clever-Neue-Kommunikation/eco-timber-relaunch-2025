@php
    // Alle Events (für alle Monate/Jahre, z.B. bis +/- 2 Jahre, bei Bedarf anpassen)
    $allEvents = get_posts([
        'post_type' => 'event',
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'meta_key' => 'event_start',
        'order' => 'ASC',
    ]);
    $events = [];
    foreach($allEvents as $event) {
        $events[] = [
            'title' => $event->post_title,
            'link'  => get_field('event_link', $event->ID),
            'start' => get_field('event_start', $event->ID), // Y-m-d
            'end'   => get_field('event_end', $event->ID),   // Y-m-d (optional)
        ];
    }
    $today = now();
@endphp

<section class="px-8 xl:px-4" id="event-calendar-block"
         data-events='@json($events)'
         data-initial-month="{{ $today->month }}"
         data-initial-year="{{ $today->year }}">
    <div id="calendar-controls"></div>
    <div id="calendar-grid"></div>
</section>

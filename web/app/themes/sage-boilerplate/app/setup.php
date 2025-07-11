<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
        'css' => "@import url('{$style}')",
    ];

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

    $dependencies = json_decode(Vite::content('editor.deps.json'));

    foreach ($dependencies as $dependency) {
        if (! wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);


/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

// this removes a unwanted redirect with the devserver on the wordpress homepage redirecting to the non devserver URL
if (getenv('WP_ENV') === 'development') {
    remove_action('template_redirect', 'redirect_canonical');
}

require_once 'Options/contact-settings.php';
require_once 'Options/options.php';
require_once 'Blocks/project-benefits.php';
require_once 'Blocks/services-grid.php';
require_once 'Blocks/hero-split.php';
require_once 'Blocks/content-split.php';
require_once 'Blocks/hero-section.php';
require_once 'Blocks/text-content.php';
require_once 'Blocks/icon-grid.php';
require_once 'Blocks/contact-split.php';
require_once 'Blocks/preview-reference.php';
require_once 'Blocks/card-grid.php';
require_once 'Blocks/partner-grid.php';
require_once 'Blocks/layered-block.php';
require_once 'Blocks/serial-sani-block.php';
require_once 'Blocks/tilgung-table.php';
require_once 'Blocks/slide-ins.php';
require_once 'Blocks/jobs-callout.php';

// Custom Post Types
require_once get_theme_file_path('app/post-types/reference.php');

// Custom Taxonomies
require_once get_theme_file_path('app/taxonomies/reference-category.php');

// ACF-Felder
require_once get_theme_file_path('app/fields/reference-fields.php');

require_once 'Blocks/reference-grid.php';

//add Categorie to Gutenberg-Editor for Flowbite-Blocks
add_filter('block_categories_all', function ($categories) {
    // Neue Flowbite-Kategorie erstellen
    $flowbite_category = [
        'slug'  => 'flowbite-blocks',
        'title' => __('Flowbite Blöcke', 'sage'),
        'icon'  => 'layout'
    ];

    // Flowbite-Kategorie als ERSTE Kategorie im Array setzen
    array_unshift($categories, $flowbite_category);

    return $categories;
}, 10, 2);


add_action('template_redirect', function () {
    if (is_post_type_archive('reference')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
});


add_filter('wpseo_breadcrumb_links', function ($links) {
    if (is_singular('reference')) {
        // Entfernt ggf. automatisch eingefügte CPT-Archivseite („Referenzen“)
        $links = array_filter($links, function ($link) {
            return $link['text'] !== 'Referenzen';
        });

        // Elternseite manuell einfügen (nur wenn sie noch nicht da ist)
        $breadcrumb = [
            'url' => get_permalink(get_page_by_path('referenz-projekte')),
            'text' => 'Referenz-Projekte',
        ];

        // Einfügen direkt vor dem aktuellen Beitrag
        array_splice($links, -1, 0, [$breadcrumb]);
    }

    return array_values($links); // Indizes zurücksetzen
});


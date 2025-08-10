<?php

if (!defined('AGROLIA_VERSION')) {
    $theme = wp_get_theme();
    define('AGROLIA_VERSION', $theme ? $theme->get('Version') : '1.0.0');
}

function agrolia_setup() {
    load_theme_textdomain('agrolia', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'agrolia'),
        )
    );
}
add_action('after_setup_theme', 'agrolia_setup');

function agrolia_scripts() {
    $template_dir = get_template_directory();
    $stylesheet_dir = get_stylesheet_directory();

    $main_css_uri = get_template_directory_uri() . '/css/style.min.css';
    $app_js_uri = get_template_directory_uri() . '/js/app.min.js';
    $style_css_uri = get_stylesheet_uri();

    $main_css_path = $template_dir . '/css/style.min.css';
    $app_js_path = $template_dir . '/js/app.min.js';
    $style_css_path = $stylesheet_dir . '/style.css';

    $main_css_ver = file_exists($main_css_path) ? filemtime($main_css_path) : AGROLIA_VERSION;
    $app_js_ver = file_exists($app_js_path) ? filemtime($app_js_path) : AGROLIA_VERSION;
    $style_css_ver = file_exists($style_css_path) ? filemtime($style_css_path) : AGROLIA_VERSION;

    wp_enqueue_style('agrolia-main', $main_css_uri, array(), $main_css_ver);
    wp_enqueue_style('agrolia-style', $style_css_uri, array('agrolia-main'), $style_css_ver);
    wp_enqueue_script('agrolia-app', $app_js_uri, array('jquery'), $app_js_ver, true);
}
add_action('wp_enqueue_scripts', 'agrolia_scripts');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'  => 'Налаштування сайту',
        'menu_title'  => 'Site Settings',
        'menu_slug'   => 'site-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false,
    ));
}

add_action('template_redirect', function () {
    if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
        return;
    }
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $path = trim((string) $path, '/');
    $firstSegment = $path === '' ? '' : explode('/', $path, 2)[0];

    if ($path === '' || $path === 'en') {
        return;
    }

    $systemSegments = array('wp-json', 'wp-content', 'wp-includes', 'wp-admin');
    if (in_array($firstSegment, $systemSegments, true)) {
        return;
    }
    if ($path === 'robots.txt' || $path === 'favicon.ico' || substr($path, 0, 7) === 'sitemap') {
        return;
    }

    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
    include get_query_template('404');
    exit;
});

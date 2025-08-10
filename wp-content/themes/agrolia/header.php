<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/favicon.ico'); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
    <?php
    if (function_exists('get_field')) {
        $header_top_line_group = get_field('header_top_line_group');
        $top_title = is_array($header_top_line_group) ? ($header_top_line_group['title'] ?? '') : '';
        $top_subtitle = is_array($header_top_line_group) ? ($header_top_line_group['subtitle'] ?? '') : '';

        if (!empty($top_title) || !empty($top_subtitle)) : ?>
            <div class="header-line-text">
                <div class="header-line-text__container">
                    <div class="header-line-text__text">
                        <?php if ($top_title) { echo '<p>' . wp_kses_post($top_title) . '</p>'; } ?>
                        <?php if ($top_subtitle) { echo '<span>' . wp_kses_post($top_subtitle) . '</span>'; } ?>
                    </div>
                </div>
            </div>
        <?php endif;
    }
    ?>
    <header class="header">
        <div class="header__container">
            <div class="header__content">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo">
                    <?php 
                    $logo = function_exists('get_field') ? get_field('header_logo', 'option') : '';
                    if (!$logo) { $logo = get_template_directory_uri() . '/img/logo.webp'; }
                    ?>
                    <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>">
                </a>

                <button type="button" data-menu class="menu__icon icon-menu" aria-label="<?php echo esc_attr__('Toggle menu', 'agrolia'); ?>">
                    <span></span>
                </button>

                <div class="header__menu menu" data-da=".header-menu--mob, 999.98">
                    <nav class="menu__body">
                        <?php
                        $locations = get_nav_menu_locations();
                        $menu_location = 'menu-1';
                        if (!empty($locations[$menu_location])) {
                            $menu_items = wp_get_nav_menu_items($locations[$menu_location]);
                            
                            if ($menu_items && !is_wp_error($menu_items)) {
                                echo '<ul id="primary-menu-' . esc_attr($menu_location) . '" class="menu__list">';
                                foreach ($menu_items as $item) {
                                    if ((int) $item->menu_item_parent === 0) {
                                        echo '<li class="menu-item">';
                                        echo '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                                        
                                        $children = array_filter($menu_items, function($child) use ($item) {
                                            return (int) $child->menu_item_parent === (int) $item->ID;
                                        });
                                        
                                        if (!empty($children)) {
                                            echo '<ul class="sub-menu">';
                                            foreach ($children as $child) {
                                                echo '<li class="menu-item">';
                                                echo '<a href="' . esc_url($child->url) . '">' . esc_html($child->title) . '</a>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                        
                                        echo '</li>';
                                    }
                                }
                                echo '</ul>';
                            }
                        } else {
                            wp_page_menu(array(
                                'menu_class' => 'menu__list'
                            ));
                        }
                        ?>
                        
                        <div class="menu-footer"></div>
                    </nav>
                </div>

                <div class="header__side">
                    <div class="header__phone phone-block" data-da=".menu-footer, 767.98, 1">
                        <?php 
                        $phone = function_exists('get_field') ? get_field('header_phone_number', 'option') : '';
                        if (!$phone) { $phone = '+380(95)4665970'; }
                        if ($phone) : ?>
                            <a class="phone-block__tel gradient-border" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>">
                                <span><?php echo esc_html($phone); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="header__language language-block" data-da=".menu-footer, 767.98, 2">
                        <?php
                        if (function_exists('pll_the_languages')) {
                            $languages = pll_the_languages(array(
                                'show_flags' => 0,
                                'show_names' => 1,
                                'display_names_as' => 'name',
                                'hide_if_empty' => 0,
                                'hide_current' => 0,
                                'raw' => 1,
                            ));
                            
                            if ($languages) {
                                echo '<ul>';
                                foreach ($languages as $lang) {
                                    $display_name = ($lang['slug'] === 'en') ? 'Eng' : 'Ua';
                                    $active_class = !empty($lang['current_lang']) ? ' class="active"' : '';
                                    echo '<li>';
                                    echo '<a href="' . esc_url($lang['url']) . '"' . $active_class . '>';
                                    echo esc_html($display_name);
                                    echo '</a>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="header-menu--mob"></div>
        </div>
    </header>
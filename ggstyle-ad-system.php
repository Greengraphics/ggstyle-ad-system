<?php
/*
 * Plugin Name: Ggstyle Ad System
 * Plugin URI:  https://greengraphics.com.au/ggstyle-ad-system/
 * Description: Custom Ad System
 * Version:     0.0.1
 * Author:      Nathan
 * Author URI:  https://greengraphics.com.au
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ggstyleas
 * Domain Path: /languages
 */
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


/**
 * Init the required stuff.
 */
function ggstyle_ad_system_init()
{
    /*
     * Setup the Image Sizes
     */
    add_image_size('ad-standard', 468, 60, true);
    add_image_size('ad-premium', 350, 50, true);

    /*
     * Setup Theme Options Page
     */
    if (function_exists('acf_add_options_page')) {
        $parent = acf_add_options_page(array(
            'page_title'    => 'Ad Spaces',
            'menu_title'    => 'Ad Spaces',
            'icon_url'      => 'dashicons-money',
            'capability'    => 'manage_options',
            'redirect'      => false,
        ));
        // acf_add_options_sub_page(array(
        //     'page_title'    => 'Ad Stats',
        //     'menu_title'    => 'Ad Stats',
        //     'parent_slug'   => $parent['menu_slug'],
        // ));
    }
}
add_action('init', 'ggstyle_ad_system_init');

//
function ggstyle_ad_system_meta_boxes()
{
    add_meta_box(
        'ggstyle_ad_system_stats_render_box',   // Unique ID
        __('Stats Render', 'ggstyleas'),        // Box title
        'ggstyle_ad_system_render_stats',       // Content callback, must be of type callable
        'ad-spaces_page_acf-options-ad-stats',  // Screen
        'normal',
        'low'
    );
}
//add_action('add_meta_boxes', 'ggstyle_ad_system_meta_boxes');

//
function ggstyle_ad_system_render_stats()
{
    echo "stats";
}

/**
 * enqueue styles and scripts.
 */
function ggstyle_ad_system_scripts()
{
    wp_enqueue_style('ggstyleas-css', plugins_url('css/main.css', __FILE__));

    wp_register_script('ggstyleas-js', plugins_url('js/main.js', __FILE__), array(), '0.0.99', true);
    wp_localize_script(
        'ggstyleas-js',
        'pluginData',
        array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'homeUrl' => home_url(),
        )
    );
    wp_enqueue_script('ggstyleas-js');
}
add_action('wp_enqueue_scripts', 'ggstyle_ad_system_scripts');

/**
 * enqueue ADMIN styles and scripts.
 */
function ggstyle_ad_system_admin_scripts()
{
    global $current_screen;

    if ($current_screen->base == 'toplevel_page_acf-options-ad-spaces') {
        wp_enqueue_style('ggstyleas-admin-css', plugins_url('inc/css/admin.css', __FILE__));
        wp_enqueue_script('ggstyleas-admin-js', plugins_url('inc/js/admin.js', __FILE__), array(), '0.0.1', true);
    }
}
add_action('admin_enqueue_scripts', 'ggstyle_ad_system_admin_scripts');

/*
 * Setup the Custom Fields
 */
if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
    'key' => 'group_57f485e6449ce',
    'title' => 'Ad Spaces',
    'fields' => array(
        array(
            'key' => 'field_57f48602c1bb5',
            'label' => 'Standard Ads',
            'name' => 'standard_ads',
            'type' => 'repeater',
            'instructions' => 'Desktop / Tablet - 468 x 60 px',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => '',
            'min' => 5,
            'max' => 5,
            'layout' => 'block',
            'button_label' => 'Add Ad',
            'sub_fields' => array(
                array(
                    'key' => 'field_57f48691c1bb6',
                    'label' => 'Ad Image',
                    'name' => 'ad_image',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'ad-standard',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_57f5d755c1c74',
                    'label' => 'Ad Link',
                    'name' => 'ad_link',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
        ),
        array(
            'key' => 'field_57f486fc4f900',
            'label' => 'Premium Ads',
            'name' => 'premium_ads',
            'type' => 'repeater',
            'instructions' => 'Mobile Ads - 350 x 50 px',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => '',
            'min' => 1,
            'max' => 1,
            'layout' => 'block',
            'button_label' => 'Add Ad',
            'sub_fields' => array(
                array(
                    'key' => 'field_57f487174f901',
                    'label' => 'Ad Image',
                    'name' => 'ad_image',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'ad-premium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_57f5d764c1c75',
                    'label' => 'Ad Link',
                    'name' => 'ad_link',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-ad-spaces',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'seamless',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
    ));
endif;

/**
 * Output the container to display our content.
 */
function ggstyle_ad_system_output()
{
    $html = "<div id='ad_box'></div>";
    echo $html;
}

/**
 * Gets the required ad to display.
 */
function ggstyle_ad_system_get_ads()
{
    // standard or premium
    $ad_type = $_POST['type'];

    $ad_field = get_field($ad_type.'_ads', 'option');

    // Get a random ad
    shuffle($ad_field);

    // Then go through them until we find one that has required information.
    foreach ($ad_field as $ad) {
        $img = $ad['ad_image'];
        $link = $ad['ad_link'];
        if (!empty($img) && !empty($link)) {
            break;
        }
    }
    $imgId = $img['ID'];

    // Get ad_views
    $ad_views = get_post_meta($imgId, 'ad_views', true);
    $ad_clicks = get_post_meta($imgId, 'ad_clicks', true);

    // Add ad_views if it does not exist
    $meta_added = false;
    if (empty($ad_views)) {
        $meta_added = add_post_meta($imgId, 'ad_views', 1, true);
    }

    // Update ad_views if it does exist
    if ($ad_views) {
        $ad_views_current = $ad_views;
        $ad_views_current++;
        // Update ad views
        $meta_updated = update_post_meta($imgId, 'ad_views', $ad_views_current, $ad_views);
    }

    $imgSrc = $img['sizes']['ad-'.$ad_type];
    $imgHeight = $img['sizes']['ad-'.$ad_type.'-height'];
    $imgWidth = $img['sizes']['ad-'.$ad_type.'-width'];
    if ($img['mime_type'] == 'image/gif') {
        $imgSrc = $img['url'];
        $imgHeight = $img['height'];
        $imgWidth = $img['width'];
    }

    // Setup the data to return
    $html = "<a id='id-$imgId' class='ad-link ad-$ad_type' href='$link' target='_blank' data-views='$ad_views_current' data-clicks='$ad_clicks'><img alt='".$img['title']."' class='ad-img' src='$imgSrc' height='$imgHeight' width='$imgWidth'></a>";
    $html = apply_filters('ggstyle_ad_system_ad_output', $html);
    
    echo $html;

    wp_die();
}
add_action('wp_ajax_get_ads', 'ggstyle_ad_system_get_ads');
add_action('wp_ajax_nopriv_get_ads', 'ggstyle_ad_system_get_ads');

/**
 * Updates the ad clicks
 */
function ggstyle_ad_system_ads_click()
{
    $ad_id = $_POST['id'];

    // Get ad_clicks
    $ad_clicks = get_post_meta($ad_id, 'ad_clicks', true);

    // Add ad_clicks if it does not exist
    $meta_added = false;
    if (empty($ad_clicks)) {
        $meta_added = add_post_meta($ad_id, 'ad_clicks', 1, true);
    }

    // Update ad_clicks if it does exist
    if ($ad_clicks) {
        $ad_clicks_current = $ad_clicks;
        $ad_clicks_current++;
        // Update ad views
        $meta_updated = update_post_meta($ad_id, 'ad_clicks', $ad_clicks_current, $ad_clicks);
    }

    wp_die();
}
add_action('wp_ajax_ads_click', 'ggstyle_ad_system_ads_click');
add_action('wp_ajax_nopriv_ads_click', 'ggstyle_ad_system_ads_click');

/**
 * Get meta values to show on backend
 */
function ggstyle_ad_system_get_values()
{
    $ad_id = $_POST['post_id'];

    $ad_views = get_post_meta($ad_id, 'ad_views', true);
    $ad_clicks = get_post_meta($ad_id, 'ad_clicks', true);

    echo "<span class='ad-views'><b>views:</b> $ad_views</span><span class='ad-clicks'><b>clicks:</b> $ad_clicks</span>";

    wp_die();
}
add_action('wp_ajax_get_values', 'ggstyle_ad_system_get_values');

/**
 * Handles the updates for this plugin.
 */
require plugins_url('inc/updates.php', __FILE__);

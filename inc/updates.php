<?php
/*
 * This file handles updates function for this plugin.
 *
 * @src https://xparkmedia.com/blog/add-update-notification-selfhosted-premium-themes-plugins/
 */
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


function plugin_pre_set_transient_update_plugin($transient)
{
    if (empty($transient->checked['theme-name'])) {
        return $transient;
    }

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://greengraphics.com.au/ggstyle-ad-system/');

    // 3 second timeout to avoid issue on the server
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    // make sure that we received the data in the response is not empty
    if (empty($result)) {
        return $transient;
    }

    //check server version against current installed version
    if ($data = json_decode($result)) {
        if (version_compare($transient->checked['theme-name'], $data->new_version, '<')) {
            $transient->response['theme-name'] = (array) $data;
        }
    }

    return $transient;
}
add_filter('pre_set_site_transient_update_plugins', 'plugin_pre_set_transient_update_plugin');

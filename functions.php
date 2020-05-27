<?php

require_once get_template_directory() . '/includes/functions.php';

/**
 * Integrate UpdaterCloud automatic updates.
 */
require_once get_template_directory() . '/wp-updatercloud/wp-updatercloud.php';

/**
 * Your UpdaterCloud update channel url.
 *
 * You may want to use different update channel urls for
 * dev and stable releases and offer an option to your customer
 * to select what channel to use for updates.
 */
$url = 'http://sandbox.updatercloud.vagrant/api/v1/update-channels/hello-world-wordpress-theme-updates.json';

/**
 * Download key.
 *
 * In this example theme, we`ve stored the download key
 * as an option named wp_helloworld_theme_downloadkey
 */
$downloadKey = get_option('wp_helloworld_theme_downloadkey');

/**
 * UpdaterCloud can gather some analytics data about customers
 * WP version, blog language, PHP version, installed theme version, etc.
 * You must ask your customer for permission to gather and store
 * analytics data from their website. For this example,
 * we'll just set this to true, but you'll probably want to store
 * the user preference in an option.
 */
$canGatherAnalyticsData = true;

// Create new updater instance.
$updaterCloud = UpdaterCloud_v1_Factory::buildUpdateChecker(
    $url, // Your UpdaterCloud update server url for this theme
    __FILE__, // Full path to the main theme file or functions.php
    'wp-helloworld-theme', // Theme slug
    $checkPeriod = 12, // Scheduled task frequency in hours
    $optionName = '', // Where to store book-keeping info about update checks
    $downloadKey, // Download key
    $canGatherAnalyticsData
);

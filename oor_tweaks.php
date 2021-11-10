<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              buhvi.co
 * @since             1.0.0
 * @package           Oor_tweaks
 *
 * @wordpress-plugin
 * Plugin Name:       OutOfReach tweaks
 * Plugin URI:        https://github.com/goodhoko/oor_tweaks
 * Description:       Responsible for the card-like effect on project thumbnails and some other styling tweaks.
 * Version:           1.0.0
 * Author:            Jen Tak
 * Author URI:        buhvi.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       oor_tweaks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('OOR_TWEAKS_VERSION', '1.0.0');

add_action('wp_enqueue_scripts', function () {
    if (get_the_ID() == 969) {
        wp_enqueue_style('oor_tweaks_asfarasicanremember', plugin_dir_url(__FILE__) . 'css/asfarasicanremember.css', array(), time(), 'all');
    }
});

// Randomize order of project thumbnails on the asfarasicanremember page.
// Hack around absence of hooks in the lay theme by hooking into the get_term_metadata filter
// which the theme uses to get the order of projects.
add_filter('get_term_metadata', function($_, $object_id = null, $meta_key = null) {
    // Try to minimize the scope of this filter to only the asfarasicanremember and only the thumbnail grid.
    if (get_the_ID() != 969 || $meta_key != 'project_order') {
        return null;
    }
    // Get the ids with the same query as the Lay theme does.
    $query = new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'post',
        'cat' => $object_id,
        'fields' => 'ids'
    ]);
    $ids = $query->posts;
    shuffle($ids);
    return json_encode($ids);
}, 10, 3);

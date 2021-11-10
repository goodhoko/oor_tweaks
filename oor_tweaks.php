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

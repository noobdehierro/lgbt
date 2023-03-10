<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.leancommerce.mx
 * @since             1.0.0
 * @package           Figou_Integrations
 *
 * @wordpress-plugin
 * Plugin Name:       Figou Integrations
 * Plugin URI:        http://www.figou.mx
 * Description:       Figou External Integrations
 * Version:           2.1.16
 * Author:            LeanCommerce
 * Author URI:        https://www.leancommerce.mx
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       figou-integrations
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
define('FIGOU_INTEGRATIONS_VERSION', '2.1.16');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-figou-integrations-activator.php
 */
function activate_figou_integrations()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-figou-integrations-activator.php';
	Figou_Integrations_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-figou-integrations-deactivator.php
 */
function deactivate_figou_integrations()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-figou-integrations-deactivator.php';
	Figou_Integrations_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_figou_integrations');
register_deactivation_hook(__FILE__, 'deactivate_figou_integrations');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-figou-integrations.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_figou_integrations()
{

	$plugin = new Figou_Integrations();
	$plugin->run();
}
run_figou_integrations();
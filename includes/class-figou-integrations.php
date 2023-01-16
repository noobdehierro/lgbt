<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/includes
 * @author     Raul Silva <raul.silva@leancommerce.com.mx>
 */
class Figou_Integrations
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Figou_Integrations_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('FIGOU_INTEGRATIONS_VERSION')) {
			$this->version = FIGOU_INTEGRATIONS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'figou-integrations';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Figou_Integrations_Loader. Orchestrates the hooks of the plugin.
	 * - Figou_Integrations_i18n. Defines internationalization functionality.
	 * - Figou_Integrations_Admin. Defines all hooks for the admin area.
	 * - Figou_Integrations_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-figou-integrations-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-figou-integrations-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-figou-integrations-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-figou-integrations-public.php';

		/**
		 * The class responsible for autolad composer Classes.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'vendor/autoload.php';

		$this->loader = new Figou_Integrations_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Figou_Integrations_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Figou_Integrations_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Figou_Integrations_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('admin_menu', $plugin_admin, 'figou_integrations_menu');
		$this->loader->add_action('admin_init', $plugin_admin, 'figou_register_settings');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Figou_Integrations_Public($this->get_plugin_name(), $this->get_version());

		// Add Shortcodes
		$this->loader->add_shortcode('qvantel-offering', $plugin_public, 'onboarding_process_shortcode');
		$this->loader->add_shortcode('qvantel-recharging', $plugin_public, 'recharging_shortcode');
		$this->loader->add_shortcode('qvantel-activation', $plugin_public, 'activation_shortcode');
		$this->loader->add_shortcode('qvantel-imei', $plugin_public, 'imei_shortcode');
		$this->loader->add_shortcode('igou-map', $plugin_public, 'map_shortcode');
		$this->loader->add_shortcode('lgbt-registro', $plugin_public, 'registro_shortcode');


		// Enqueue scripts
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		// Ajax calls
		$this->loader->add_action('wp_ajax_imei_validation', $plugin_public, 'qvantel_offerings');
		$this->loader->add_action('wp_ajax_nopriv_imei_validation', $plugin_public, 'qvantel_offerings');

		$this->loader->add_action('wp_ajax_didi_code_validation', $plugin_public, 'didi_validation');
		$this->loader->add_action('wp_ajax_nopriv_didi_code_validation', $plugin_public, 'didi_validation');

		$this->loader->add_action('wp_ajax_payment_register', $plugin_public, 'qvantel_payment_intent');
		$this->loader->add_action('wp_ajax_nopriv_payment_register', $plugin_public, 'qvantel_payment_intent');

		$this->loader->add_action('wp_ajax_payment_recharge', $plugin_public, 'qvantel_payment_intent');
		$this->loader->add_action('wp_ajax_nopriv_payment_recharge', $plugin_public, 'qvantel_payment_intent');

		$this->loader->add_action('wp_ajax_msisdn_validation', $plugin_public, 'qvantel_offerings');
		$this->loader->add_action('wp_ajax_nopriv_msisdn_validation', $plugin_public, 'qvantel_offerings');

		$this->loader->add_action('wp_ajax_conekta_pay', $plugin_public, 'conektaPay');
		$this->loader->add_action('wp_ajax_nopriv_conekta_pay', $plugin_public, 'conektaPay');

		$this->loader->add_action('wp_ajax_nomina_pay', $plugin_public, 'nominaPay');
		$this->loader->add_action('wp_ajax_nopriv_nomina_pay', $plugin_public, 'nominaPay');

		$this->loader->add_action('wp_ajax_send_email', $plugin_public, 'ajaxNotification');
		$this->loader->add_action('wp_ajax_nopriv_send_email', $plugin_public, 'ajaxNotification');

		$this->loader->add_action('wp_ajax_cp_validator', $plugin_public, 'copomex');
		$this->loader->add_action('wp_ajax_nopriv_cp_validator', $plugin_public, 'copomex');

		$this->loader->add_action('wp_ajax_firstPass', $plugin_public, 'authentication');
		$this->loader->add_action('wp_ajax_nopriv_firstPass', $plugin_public, 'authentication');

		$this->loader->add_action('wp_ajax_conektaOrder', $plugin_public, 'conektaOrder');
		$this->loader->add_action('wp_ajax_nopriv_conektaOrder', $plugin_public, 'conektaOrder');

		$this->loader->add_action('wp_ajax_sim_activate', $plugin_public, 'sim_activate');
		$this->loader->add_action('wp_ajax_nopriv_sim_activate', $plugin_public, 'sim_activate');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Figou_Integrations_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
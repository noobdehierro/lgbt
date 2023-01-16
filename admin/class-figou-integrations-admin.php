<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/admin
 * @author     Raul Silva <raul.silva@leancommerce.com.mx>
 */
class Figou_Integrations_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_admin_partials_path    Path of admin partials folder.
	 */
	private $plugin_admin_partials_path;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_admin_partials_path = plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Figou_Integrations_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Figou_Integrations_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/figou-integrations-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Figou_Integrations_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Figou_Integrations_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/figou-integrations-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Figou main menu and submenus
     *
     * @since    1.0.0
	 */
	public function figou_integrations_menu() {
		add_menu_page(
			__( 'Integraciones Figou', 'figou-integrations' ),
			__( 'Figou', 'figou-integrations' ),
			'manage_options',
			'figou'
		);

		add_submenu_page(
			'figou',
			__( 'Configuración general', 'figou-integrations' ),
			__( 'Generales', 'figou-integrations' ),
			'manage_options',
			'figou',
			function() {
				$this->display_settings_page( 'general' );
			}
		);

		add_submenu_page(
			'figou',
			__( 'Altan Integration', 'figou-integrations' ),
			__( 'Altan', 'figou-integrations' ),
			'manage_options',
			'figou-altan',
			function() {
				$this->display_settings_page( 'altan' );
			}
		);

		add_submenu_page(
			'figou',
			__( 'Figou Integrations', 'figou-integrations' ),
			__( 'Qvantel', 'figou-integrations' ),
			'manage_options',
			'figou-qvantel',
			function() {
				$this->display_settings_page( 'qvantel' );
			}
		);

		add_submenu_page(
			'figou',
			__( 'Payment Methods', 'figou-integrations' ),
			__( 'Payment Methods', 'figou-integrations' ),
			'manage_options',
			'figou-payment',
			function() {
				$this->display_settings_page( 'payment' );
			}
		);
	}

	/**
	 * Display the settings page content for the page we have created.
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page( $slug = 'general' ) {

		require_once $this->plugin_admin_partials_path . 'figou-integrations-' . $slug . '-settings.php';

	}

	/**
	 * Register settings set and include fields for individual pages.
     *
     * @since   1.0.0
	 */
	public function figou_register_settings() {
		$this->figou_genearl_settings();
		$this->figou_altan_settings();
		$this->figou_qvantel_settings();
		$this->figou_payment_settings();
	}

	/**
	 * Register General settings group and fields
     *
	 * @since    1.0.0
	 */
	public function figou_genearl_settings()
	{
	    $group = 'general';
		register_setting(
			$this->plugin_name . '-' . $group . '-settings',
			$this->plugin_name . '-' . $group . '-settings',
			array($this, 'sandbox_register_setting')
		);

		$secction = '-general';
		$page = 'figou';
		$args = array(
            'description' => 'Configuración general de operaciones.'
        );
		add_settings_section(
			$this->plugin_name . $secction . '-settings-section',
			__( 'Configuraciones generales', 'figou-integrations' ),
			function() use ( $args ) {
				$this->sandbox_add_settings_section( $args );
				},
			'figou'
		);

		add_settings_field(
			'sandbox',
			__( 'Sandbox', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_single_checkbox' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
                'group' => $group,
				'label_for' => 'sandbox',
				'description' => __( 'Ambiente de pruebas Sandbox.', 'figou-integrations' )
			)
		);

        add_settings_field(
            'integrated_payments',
            __( 'Pagos con integración propia', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_single_checkbox' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'integrated_payments',
                'description' => __( 'Al seleccionar esta casilla se usaran métodos de pago implementados localmente fuera de la integración con Qvantel.', 'figou-integrations' )
            )
        );

        add_settings_field(
            'copomex_token',
            __( 'Copomex token', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'copomex_token',
                'description' => '',
                'default' => ''
            )
        );

		$secction = '-general-general';
		$page = 'figou';
		$args = array(
			'description' => ''
		);
		add_settings_section(
			$this->plugin_name . $secction . '-settings-section',
			__( 'Notificaciones', 'figou-integrations' ),
			function() use ( $args ) {
				$this->sandbox_add_settings_section( $args );
			},
			'figou'
		);

		add_settings_field(
			'notifications_email',
			__( 'Email de notificaciones', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'notifications_email',
				'description' => '',
                'default' => ''
			)
		);
	}

	/**
	 * Register Altan settings group and fields
	 *
	 * @since    1.0.0
	 */
	public function figou_altan_settings()
	{
		$group = 'altan';
		register_setting(
			$this->plugin_name . '-' . $group . '-settings',
			$this->plugin_name . '-' . $group . '-settings',
			array($this, 'sandbox_register_setting')
		);

		$page = 'figou-altan';
		$secction = '-altan-auth';
		$args = array(
			'description' => 'Ajustes de autenticación para el consumo de APIs.'
		);
		add_settings_section(
			$this->plugin_name . $secction . '-settings-section',
			__( 'Autenticación', 'figou-integrations' ),
			function() use ( $args ) {
				$this->sandbox_add_settings_section( $args );
			},
			$page
		);

		add_settings_field(
			'altan_auth_url',
			__( 'URL del API de autenticación', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'altan_auth_url',
				'description'   => '',
                'default' => ''
			)
		);

		add_settings_field(
			'altan_token',
			__( 'Token de autenticación', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'altan_token',
				'description'   => '',
				'default' => ''
			)
		);

		$secction = '-altan-suscribers';
		$args = array(
			'description' => 'Ajustes para la consulta de equipos por IMEI.'
		);
		add_settings_section(
			$this->plugin_name . $secction . '-settings-section',
			__( 'API de consulta de IMEI', 'figou-integrations' ),
			function() use ( $args ) {
				$this->sandbox_add_settings_section( $args );
			},
			$page
		);

		add_settings_field(
			'altan_suscribers_url',
			__( 'URL del API de búsqueda de equipo', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'altan_suscribers_url',
				'description'   => '',
				'default' => ''
			)
		);

		add_settings_field(
			'altan_identifier_type',
			__( 'Tipo de identificador', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'altan_identifier_type',
				'description'   => '',
				'default' => 'imei',
                'readonly' => true
			)
		);

	}

	/**
	 * Register Qvantel settings group and fields
	 *
	 * @since    1.0.0
	 */
	public function figou_qvantel_settings()
	{
		$group = 'qvantel';
		register_setting(
			$this->plugin_name . '-' . $group . '-settings',
			$this->plugin_name . '-' . $group . '-settings',
			array($this, 'sandbox_register_setting')
		);

        $page = 'figou-qvantel';
        $secction = '-qvantel-general';
        $args = array(
            'description' => 'Ajustes generales para el consumo de las API de Qvantel.'
        );
        add_settings_section(
            $this->plugin_name . $secction . '-settings-section',
            __( 'General', 'figou-integrations' ),
            function() use ( $args ) {
                $this->sandbox_add_settings_section( $args );
            },
            $page
        );

        add_settings_field(
            'qvantel_offerings_category',
            __( 'Tipo de plan', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_offerings_category',
                'description'   => '',
                'default' => 'prepaid',
            )
        );

        add_settings_field(
            'qvantel_channel',
            __( 'x-channel', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_channel',
                'description'   => '',
                'default' => 'self-service'
            )
        );

        add_settings_field(
            'qvantel_activation',
            __( 'Tipo de activación', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_activation',
                'description'   => '',
                'default' => 'Pre-registration'
            )
        );

        add_settings_field(
            'qvantel_offerings_backup_banda28',
            __( 'Backup Banda 28', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_text_area' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_offerings_backup_banda28',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'qvantel_offerings_backup_no_banda28',
            __( 'Backup No banda 28', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_text_area' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_offerings_backup_no_banda28',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'qvantel_inclusion',
            __( 'Patrón de inclusión', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_inclusion',
                'description'   => 'Palabras utilizadas para mostrar ofertas, separadas por coma.',
                'default' => ''
            )
        );

        add_settings_field(
            'qvantel_exclusion',
            __( 'Patrón de exclusión', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'qvantel_exclusion',
                'description'   => 'Palabras utilizadas para no mostrar ofertas, separadas por coma.',
                'default' => ''
            )
        );

		$page = 'figou-qvantel';
		$secction = '-qvantel-sandbox';
		$args = array(
			'description' => 'Ajustes de para el consumo de las API de Qvantel en ambiente de pruebas.'
		);
		add_settings_section(
			$this->plugin_name . $secction . '-settings-section',
			__( 'Qvantel Sandbox', 'figou-integrations' ),
			function() use ( $args ) {
				$this->sandbox_add_settings_section( $args );
			},
			$page
		);

		add_settings_field(
			'qvantel_offerings_url_sandbox',
			__( 'URL del API de ofertas', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'qvantel_offerings_url_sandbox',
				'description'   => '',
				'default' => ''
			)
		);

		add_settings_field(
			'qvantel_pos_url_sandbox',
			__( 'URL del API POS', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'qvantel_pos_url_sandbox',
				'description'   => '',
				'default' => ''
			)
		);

		$page = 'figou-qvantel';
		$secction = '-qvantel-production';
		$args = array(
			'description' => 'Ajustes de para el consumo de las API de Qvantel en ambiente productivo.'
		);
		add_settings_section(
			$this->plugin_name . $secction . '-settings-section',
			__( 'Qvantel Producción', 'figou-integrations' ),
			function() use ( $args ) {
				$this->sandbox_add_settings_section( $args );
			},
			$page
		);

		add_settings_field(
			'qvantel_offerings_url',
			__( 'URL del API de ofertas', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'qvantel_offerings_url',
				'description'   => '',
				'default' => ''
			)
		);

		add_settings_field(
			'qvantel_pos_url',
			__( 'URL del API POS', 'figou-integrations' ),
			array( $this, 'sandbox_add_settings_field_input_text' ),
			$page,
			$this->plugin_name . $secction . '-settings-section',
			array(
				'group' => $group,
				'label_for' => 'qvantel_pos_url',
				'description'   => '',
				'default' => ''
			)
		);
	}

	/**
	 * Register Payment settings group and fields
	 *
	 * @since    1.0.0
	 */
	public function figou_payment_settings()
	{
		$group = 'payment';
		register_setting(
			$this->plugin_name . '-' . $group . '-settings',
			$this->plugin_name . '-' . $group . '-settings',
			array($this, 'sandbox_register_setting')
		);


        $page = 'figou-payment';
        $secction = '-payment-general';
        $args = array(
            'description' => 'Ajustes de métodos de pago.'
        );
        add_settings_section(
            $this->plugin_name . $secction . '-settings-section',
            __( 'General', 'figou-integrations' ),
            function() use ( $args ) {
                $this->sandbox_add_settings_section( $args );
            },
            $page
        );

        add_settings_field(
            'conekta',
            __( 'Método de pago primario', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_single_checkbox' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'conekta',
                'description' => __( '¿Conekta es el método de pago primario?.', 'figou-integrations' )
            )
        );



        $page = 'figou-payment';
        $secction = '-payment-conekta-sandbox';
        $args = array(
            'description' => 'Ajustes Conekta para cobro con tarjeta de crédito y OXXO.'
        );
        add_settings_section(
            $this->plugin_name . $secction . '-settings-section',
            __( 'Conekta', 'figou-integrations' ),
            function() use ( $args ) {
                $this->sandbox_add_settings_section( $args );
            },
            $page
        );

        add_settings_field(
            'conekta_public_api_key_sandbox',
            __( 'Public Api Key - Sandbox', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'conekta_public_api_key_sandbox',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'conekta_private_api_key_sandbox',
            __( 'Private Api Key - Sandbox', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'conekta_private_api_key_sandbox',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'conekta_public_api_key',
            __( 'Public Api Key - Live', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'conekta_public_api_key',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'conekta_private_api_key',
            __( 'Private Api Key - Live', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'conekta_private_api_key',
                'description'   => '',
                'default' => ''
            )
        );

        $secction = '-payment-openpay';
        $args = array(
            'description' => 'Ajustes Openpay para cobro con tarjetas de crédito y débito.'
        );
        add_settings_section(
            $this->plugin_name . $secction . '-settings-section',
            __( 'Openpay', 'figou-integrations' ),
            function() use ( $args ) {
                $this->sandbox_add_settings_section( $args );
            },
            $page
        );

        add_settings_field(
            'openpay_merchant_id_sandbox',
            __( 'Merchant ID - Sandbox', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'openpay_merchant_id_sandbox',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'openpay_private_api_key_sandbox',
            __( 'Private Api Key - Sandbox', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'openpay_private_api_key_sandbox',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'openpay_public_api_key_sandbox',
            __( 'Public Api Key - Sandbox', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'openpay_public_api_key_sandbox',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'openpay_merchant_id',
            __( 'Merchant ID - Live', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'openpay_merchant_id',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'openpay_private_api_key',
            __( 'Private Api Key - Live', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'openpay_private_api_key',
                'description'   => '',
                'default' => ''
            )
        );

        add_settings_field(
            'openpay_public_api_key',
            __( 'Public Api Key - Live', 'figou-integrations' ),
            array( $this, 'sandbox_add_settings_field_input_text' ),
            $page,
            $this->plugin_name . $secction . '-settings-section',
            array(
                'group' => $group,
                'label_for' => 'openpay_public_api_key',
                'description'   => '',
                'default' => ''
            )
        );
	}

	/**
	 * Sandbox our settings.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_register_setting( $input ) {

		$new_input = array();

		if ( isset( $input ) ) {
			// Loop trough each input and sanitize the value if the input id isn't post-types
			foreach ( $input as $key => $value ) {
				if ( $key == 'post-types' ) {
					$new_input[ $key ] = $value;
				} else {
					$new_input[ $key ] = sanitize_text_field( $value );
				}
			}
		}

		return $new_input;

	}

	/**
	 * Sandbox our section for the settings.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_add_settings_section( $args ) {

		if ( $args['description']) {
		    echo '<p>' . $args['description'] . '</p>';
        }

	}

	/**
	 * Sandbox our single checkboxes.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_add_settings_field_single_checkbox( $args ) {

		$field_id = $args['label_for'];
		$field_description = $args['description'];
		$group = $args['group'];

		$options = get_option( $this->plugin_name . '-' . $group . '-settings' );
		$option = 0;

		if ( ! empty( $options[ $field_id ] ) ) {

			$option = $options[ $field_id ];

		}

		?>

		<label for="<?php echo $this->plugin_name . '-settings[' . $field_id . ']'; ?>">
			<input type="checkbox" name="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . ']'; ?>" id="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . ']'; ?>" <?php checked( $option, true, 1 ); ?> value="1" />
			<span class="description"><?php echo esc_html( $field_description ); ?></span>
		</label>

		<?php

	}

	/**
	 * Sandbox our multiple checkboxes
	 *
	 * @since    1.0.0
	 */
	public function sandbox_add_settings_field_multiple_checkbox( $args ) {

		$field_id = $args['label_for'];
		$field_description = $args['description'];
		$group = $args['group'];

		$options = get_option( $this->plugin_name . '-' . $group . '-settings' );
		$option = array();

		if ( ! empty( $options[ $field_id ] ) ) {
			$option = $options[ $field_id ];
		}

		if ( $field_id == 'post-types' ) {

			$args = array(
				'public' => true
			);
			$post_types = get_post_types( $args, 'objects' );

			foreach ( $post_types as $post_type ) {

				if ( $post_type->name != 'attachment' ) {

					if ( in_array( $post_type->name, $option ) ) {
						$checked = 'checked="checked"';
					} else {
						$checked = '';
					}

					?>

					<fieldset>
						<label for="<?php echo $this->plugin_name . '-settings[' . $field_id . '][' . $post_type->name . ']'; ?>">
							<input type="checkbox" name="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . '][]'; ?>" id="<?php echo $this->plugin_name . '-' . $group .'-settings[' . $field_id . '][' . $post_type->name . ']'; ?>" value="<?php echo esc_attr( $post_type->name ); ?>" <?php echo $checked; ?> />
							<span class="description"><?php echo esc_html( $post_type->label ); ?></span>
						</label>
					</fieldset>

					<?php

				}

			}

		} else {

			$field_args = $args['options'];

			foreach ( $field_args as $field_arg_key => $field_arg_value ) {

				if ( in_array( $field_arg_key, $option ) ) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}

				?>

				<fieldset>
					<label for="<?php echo $this->plugin_name . '-settings[' . $field_id . '][' . $field_arg_key . ']'; ?>">
						<input type="checkbox" name="<?php echo $this->plugin_name . '-settings[' . $field_id . '][]'; ?>" id="<?php echo $this->plugin_name . '-settings[' . $field_id . '][' . $field_arg_key . ']'; ?>" value="<?php echo esc_attr( $field_arg_key ); ?>" <?php echo $checked; ?> />
						<span class="description"><?php echo esc_html( $field_arg_value ); ?></span>
					</label>
				</fieldset>

				<?php

			}

		}

		?>

		<p class="description"><?php echo esc_html( $field_description ); ?></p>

		<?php

	}

	/**
	 * Sandbox our inputs with text
	 *
	 * @since    1.0.0
	 */
	public function sandbox_add_settings_field_input_text( $args ) {

		$field_id = $args['label_for'];
		$field_default = $args['default'];
		$group = $args['group'];

		$options = get_option( $this->plugin_name . '-' . $group . '-settings' );
		$option = $field_default;

		if ( ! empty( $options[ $field_id ] ) ) {

			$option = $options[ $field_id ];

		}

		?>

		<input type="text" name="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . ']'; ?>" id="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . ']'; ?>" value="<?php echo esc_attr( $option ); ?>" class="regular-text" />

		<?php

	}

    /**
     * Sandbox our inputs with text
     *
     * @since    1.0.0
     */
    public function sandbox_add_settings_field_text_area( $args ) {

        $field_id = $args['label_for'];
        $field_default = $args['default'];
        $group = $args['group'];

        $options = get_option( $this->plugin_name . '-' . $group . '-settings' );
        $option = $field_default;

        if ( ! empty( $options[ $field_id ] ) ) {

            $option = $options[ $field_id ];

        }

        ?>
            <textarea name="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . ']'; ?>" id="<?php echo $this->plugin_name . '-' . $group . '-settings[' . $field_id . ']'; ?>" class="regular-text"><?php echo esc_attr( $option ); ?></textarea>

        <?php

    }

}

<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/public
 * @author     Raul Silva <raul.silva@leancommerce.com.mx>
 */
class Figou_Integrations_Public
{

    /**
     * This value is used in email templates
     * when payment method is stripe-credit-card and the payment is complete in
     * contratation process.
     */
    const STRIPE_ACTIVATION = 1;

    /**
     * This constant is used in email templates
     * when payment method is oxxo-cash in contratation process.
     */
    const OXXO_ACTIVATION = 2;

    /**
     * This value is used in email templates
     * when payment method is stripe-credit-card and the payment is complete in
     * rechargin process.
     */
    const STRIPE_RECHARGE = 3;

    /**
     * This constant is used in email templates
     * when payment method is oxxo-cash in recharging process.
     */
    const OXXO_RECHARGE = 4;

    /**
     * This constant is used in email templates
     * for de admin user in contratation process.
     */
    const ADMIN_ACTIVATION = 5;

    /**
     * This constant is used in email templates
     * for de admin user in recharging process.
     */
    const ADMIN_RECHARGE = 6;

    /**
     * This constant is used in email templates
     * for admin user when a connection error
     * occurs in the qvantel integration
     */
    const ADMIN_STRIPE_CONFIRMATION = 7;

    /**
     * This constant is used in email templates
     * for admin user when a connection error
     * occurs in the qvantel integration
     */
    const ADMIN_OXXO_CONFIRMATION = 8;

    /**
     * This value is used in email templates
     * when payment method is descuento en nomina in
     * contratation process.
     */
    const NOMINA_ACTIVATION = 9;

    /**
     * This value is used in email templates
     * when payment method is descuento en nomina in
     * contratation process - admin confirmation.
     */
    const ADMIN_NOMINA_CONFIRMATION = 10;

    /**
     * This value is used in email templates
     * activation process - admin confirmation.
     */
    const ADMIN_SIM = 11;

    const ACTIVATE_SIM = 13;

    const ADMIN_ACTIVATE_SIM = 14;

    const ACTIVATE_SIM_WITH_PORTABILITY = 15;

    const ADMIN_ACTIVATE_SIM_WITH_PORTABILITY = 16;

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
     * @var      string    $plugin_public_partials_path    Path of admin partials folder.
     */
    private $plugin_public_partials_path;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->plugin_public_partials_path = plugin_dir_path(dirname(__FILE__)) . 'public/partials/';
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/figou-integrations-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/figou-integrations-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-vendor-validate', plugin_dir_url(__FILE__) . 'js/vendor/jquery.validate.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-vendor-mask', plugin_dir_url(__FILE__) . 'js/vendor/jquery.mask.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-vendor-print', plugin_dir_url(__FILE__) . 'js/vendor/jquery.print.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-openpay', 'https://openpay.s3.amazonaws.com/openpay.v1.min.js', array(), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-openpay-data', 'https://openpay.s3.amazonaws.com/openpay-data.v1.min.js', array(), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-conekta', 'https://cdn.conekta.io/js/latest/conekta.js', array(), $this->version, false);

        wp_localize_script(
            $this->plugin_name,
            'figou_ajax',
            array(
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );
    }

    /**
     * This function get device information from Altan by IMEI
     *
     * @param $imei
     * @return bool[]|mixed
     */
    public function altan($imei)
    {
        $altan_options = get_option($this->plugin_name . '-altan-settings');
        $res_token = $this->getAuthToken($altan_options);
        $altan = $this->getAltanResponse($res_token['accessToken'], $imei, $altan_options);

        return $altan;
    }


    /**
     * This function validate DiDi code.
     *
     * @param void
     * @return string
     */
    public function didi_validation()
    {
        // Check the nonce, if ok, proceed.
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }

        $didi_code = $_REQUEST['didi_code'];
        $valido = true;
        $error = '';

        $didi = substr($didi_code, 0, 5);

        if ($didi == 'FOOD-') {
            $valido = true;
            $error = '';
        } else {
            $valido = false;
            $error = 'error';
        }

        $return = array(
            'valido' => $valido,
            'error' => $error
        );
        return wp_send_json($return);
    }



    /**
     * This function get offerings from Qvantel depends on imei filter.
     *
     * @param void
     * @return string
     */
    public function qvantel_offerings()
    {
        // Check the nonce, if ok, proceed.
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }

        $imei = $_REQUEST['imei'];
        $msisdn = $_REQUEST['msisdn'];
        $qvantel_options = get_option($this->plugin_name . '-qvantel-settings');
        $global_options = get_option($this->plugin_name . '-general-settings');
        $sandbox = $global_options['sandbox'];
        $qry_array = [
            'category=' . $qvantel_options['qvantel_offerings_category'] => 1,
        ];
        if ($imei) {
            $qry_array['imei=' . $imei] = 1;
        } elseif ($msisdn) {
            $qry_array['msisdn=' . '52' . $msisdn] = 1;
        }
        if ($sandbox == '1') {
            $url = $qvantel_options['qvantel_offerings_url_sandbox'] . '?' . implode('&', array_keys($qry_array));
        } else {
            $url = $qvantel_options['qvantel_offerings_url'] . '?' . implode('&', array_keys($qry_array));
        }
        $headers = [
            'x-channel: ' . $qvantel_options['qvantel_channel'],
        ];

        $offers = $this->curl_request($url, $headers, 'GET');
        $offerings = [];
        if (!empty($offers) && !empty($offers['offerings'])) {
            foreach ($offers['offerings'] as $offer) {

                if ($msisdn) {
                    if ($offer['subscriptionOffering'] == null) {
                        array_push($offerings, $this->fill_offering_data($offer));
                    }
                } else {
                    // Restriccion de ofertas por canal
                    if (strpos($offer['productId'], $qvantel_options['qvantel_inclusion']) !== false && strpos($offer['productId'], $qvantel_options['qvantel_exclusion']) == false) {
                        array_push($offerings, $this->fill_offering_data($offer));
                    }
                }
            }
        } elseif (!empty($offers['error']) || empty($offers['offerings'])) {
            $altan = $this->altan($imei);

            // Flujo para NO banda28.
            if (!isset($altan['deviceFeatures']['band28']) || $altan['deviceFeatures']['band28'] == 'NO' || $altan['deviceFeatures']['band28'] == 'Información no encontrada') {
                $backup_no_28 = $qvantel_options['qvantel_offerings_backup_no_banda28'];
                $offer_no_28 = explode(';', $backup_no_28);
                foreach ($offer_no_28 as $item) {
                    $itemValues = explode(',', $item);
                    $newOffer = [
                        'productId' => $itemValues[0],
                        'name' => $itemValues[1],
                        'price' => $itemValues[2],
                        'description' => $itemValues[3],
                        'shortDescription' => $itemValues[4],
                    ];

                    array_push($offerings, $newOffer);
                }
            }

            //Flujo para banda 28.
            else {
                $backup_28 = $qvantel_options['qvantel_offerings_backup_banda28'];
                $offer_28 = explode(';', $backup_28);
                foreach ($offer_28 as $item) {
                    $itemValues = explode(',', $item);
                    $newOffer = [
                        'productId' => $itemValues[0],
                        'name' => $itemValues[1],
                        'price' => $itemValues[2],
                        'description' => $itemValues[3],
                        'shortDescription' => $itemValues[4],
                    ];

                    array_push($offerings, $newOffer);
                }
            }
        }

        $payment_options = get_option($this->plugin_name . '-payment-settings');

        $return = array(
            'valido' => $imei,
            'offerings' => $offerings,
            'paymentMethodDefault' => $payment_options['conekta'] == 0 ? 'stripe' : 'conekta',
        );
        return wp_send_json($return);
    }

    /**
     * This function crate a Qvantel basquet, create a payment intent on Stripe and returns clientSecret
     * When oxxo-cash is selected returns a barcode url from Conekta
     *
     * @param void
     * @return string[]|mixed
     */
    public function qvantel_payment_intent()
    {
        // Check the nonce, if ok, proceed.
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }

        $msisdn = $_REQUEST['msisdn'] ?? false;
        $nip = $_REQUEST['nip'] ?? false;
        $paymentMethod = $_REQUEST['paymentMethod'] ?? false;
        $productId = $_REQUEST['product_id'] ?? false;
        $recurrente = $_REQUEST['recurrente'] ?? false;
        $active_sim = $_REQUEST['active_sim'] ?? '';

        if ($active_sim == 1 && $paymentMethod == 'oxxo-cash') {
            self::sim_activate();
        }

        if ($productId && $paymentMethod) {
            $qvantel_options = get_option($this->plugin_name . '-qvantel-settings');
            $global_options = get_option($this->plugin_name . '-general-settings');
            $sandbox = $global_options['sandbox'];
            $integrated_payments = $global_options['integrated_payments'];
            $stripe = '';
            $error = false;
            $headers = [
                'x-channel: ' . $qvantel_options['qvantel_channel'],
            ];

            if ($sandbox == '1') {
                $urlBasket = $qvantel_options['qvantel_pos_url_sandbox'];
                $urlPayments = $qvantel_options['qvantel_payments_url_sandbox'];
            } else {
                $urlBasket = $qvantel_options['qvantel_pos_url'];
                $urlPayments = $qvantel_options['qvantel_payments_url'];
            }

            /** Nuevo flujo */
            if ($paymentMethod == 'register') {

                $result = $this->register($_REQUEST);
            } elseif ($paymentMethod == 'nomina') {
                /**
                 * Descuento en nomina
                 */

                $result = $this->register($_REQUEST);

                $result = [
                    'id' => $_REQUEST['product_id'],
                    'name' => $_REQUEST['product_name'],
                    'total' => $_REQUEST['product_price'],
                    'paymentType' => 'nomina',
                ];
            } elseif ($paymentMethod == 'didipay-card') {
                /**
                 * DiDi Pay
                 */

                $result = $this->register($_REQUEST);

                $productPrice = $_REQUEST['product_price'];
                $productDesc = 0;

                switch ($productId) {
                        /** 50GB */
                    case 'PO_SAYDiDi_RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30':
                        $productId = 'PO_SAYDiDiPAYRM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T';
                        $productDesc = (int)$productPrice - 400;
                        $productPrice = 400;
                        break;

                        /** 20GB Plus */
                    case 'PO_SAYDiDiRMCT_750_750Mi_1500Mi_15000_5000M_500_500SMS_20000T_30':
                        $productId = 'PO_SAYDiDiPAYCT_750_750Mi_1500Mi_15000_5000M_500_500SMS_20000T30';
                        $productDesc = (int)$productPrice - 280;
                        $productPrice = 280;
                        break;

                        /** 20GB */
                    case 'PO_SAYDiDiRMST_750_750Mi_1500Mi_15000_5000M_500_500SMS_20000T_30':
                        $productId = 'PO_SAYDiDiPAYST750_750Mi_1500Mi_15000_5000M_500_500SMS_20000T_30';
                        $productDesc = (int)$productPrice - 200;
                        $productPrice = 200;
                        break;

                        /** 10GB */
                    case 'PO_SAYDiDi-RMST_500_500Mi_1000Mi_7500_2500M_250_250SMS_10000T15D':
                        $productId = 'PO_SAYDiDiPAYST_500_500Mi_1000Mi_7500_2500M_250_250SMS_10000T15D';
                        $productDesc = (int)$productPrice - 100;
                        $productPrice = 100;
                        break;

                        /** 8GB */
                    case 'PO_SAYDiDi_RM_CT_750_750Mi_1500Mi_3000_5000M_250_250SMS_30D_NR':
                        $productId = 'PO_SAYDiDiPAYRM_CT_750_750Mi_1500Mi_3000_5000M_250_250SMS_30D_NR';
                        $productDesc = (int)$productPrice - 145;
                        $productPrice = 145;
                        break;

                        /** 5GB 30 días */
                    case 'PO_SAYDiDiRMCT_750_750Mi_1500Mi_5000M_250_250SMS_30D_NR':
                        $productId = 'PO_SAYDiDiPAYRM_CT_750_750Mi_1500Mi_5000M_250_250SMS_30D_NR';
                        $productDesc = (int)$productPrice - 120;
                        $productPrice = 120;
                        break;

                        /** 5GB 7 días */
                    case 'PO_SAYDiDi-RM_ST_250_250Mi_500Mi_3750_1250M_125_125SMS_5000T_7D_':
                        $productId = 'PO_SAYDiDiPAYRMST_250_250Mi_500Mi_3750_1250M_125_125SMS_5000T7D';
                        $productDesc = (int)$productPrice - 60;
                        $productPrice = 60;
                        break;
                }

                $payment_options = get_option($this->plugin_name . '-payment-settings');
                if ($sandbox == '1') {
                    $conekta_public_key = $payment_options['conekta_public_api_key_sandbox'];
                } else {
                    $conekta_public_key = $payment_options['conekta_public_api_key'];
                }

                $result = [
                    'conekta' => $conekta_public_key,
                    'paymentType' => $paymentMethod,
                    'product_id' => $productId,
                    'product_price' => $productPrice,
                    'product_desc' => $productDesc,
                ];
            } elseif ($paymentMethod == 'conekta-credit-card') {
                /**
                 * Conekta credit card
                 */

                $payment_options = get_option($this->plugin_name . '-payment-settings');
                if ($sandbox == '1') {
                    $conekta_public_key = $payment_options['conekta_public_api_key_sandbox'];
                } else {
                    $conekta_public_key = $payment_options['conekta_public_api_key'];
                }

                if (!$msisdn) {
                    /** Flujo de contratación - envío de notificaciones */
                    $result = $this->register($_REQUEST);
                }

                $result = [
                    'conekta' => $conekta_public_key,
                ];

                if ($msisdn && $nip != '') {
                    /**
                     * Envio de correos SOLO PARA RECARGAS
                     */

                    // return wp_send_json(json_encode('aqui'));

                    $nombre_completo = $_REQUEST['nombre'] . ' ' . $_REQUEST['apellidos'];
                    $telefono = (isset($_REQUEST['contacto']) && $_REQUEST['contacto'] != '') ? $_REQUEST['contacto'] : '';
                    $identificacion = (isset($_REQUEST['identificacion']) && $_REQUEST['identificacion'] != '') ? $_REQUEST['identificacion'] : '';
                    $tipo_identificacion = (isset($_REQUEST['tipo_documento']) && $_REQUEST['tipo_documento'] != '') ? $_REQUEST['tipo_documento'] : '';

                    $direccion = $_REQUEST['direccion'] . ', ' . $_REQUEST['exterior'] . ' ' . $_REQUEST['interior'] . ', ' . $_REQUEST['colonia'] . ', ' . $_REQUEST['municipio']
                        . ', ' . $_REQUEST['estado'] . ', ' . $_REQUEST['cp'] . ', ' . $_REQUEST['referencias'];

                    $typeAdmin = ($msisdn) ? self::ADMIN_RECHARGE : self::ADMIN_ACTIVATION;
                    $toAdmin = $global_options['notifications_email'];
                    $dataAdmin = [
                        'error' => '',
                        'totalPlan' => $_REQUEST['product_price'] ?? '',
                        'paymentMethod' => $paymentMethod ?? '',
                        'referenceNumber' => 'Not set',
                        'productName' => $_REQUEST['product_name'] ?? '',
                        'nombre' => $nombre_completo ?? '',
                        'email' => $_REQUEST['email'] ?? '',
                        'direccion' => $direccion ?? '',
                        'tipoIdentificacion' => $identificacion ?? '',
                        'noIdentificacion' => $tipo_identificacion ?? '',
                        'telefonoContacto' => $telefono,
                        'msisdn' => $_REQUEST['msisdn'] ?? '',
                    ];

                    if ($toAdmin != '') {
                        $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
                    }
                }
            } elseif ($paymentMethod == 'openpay-credit-card') {
                /**
                 * Openpay credit card
                 */

                $payment_options = get_option($this->plugin_name . '-payment-settings');
                if ($sandbox == '1') {
                    $merchant_id = $payment_options['openpay_merchant_id_sandbox'];
                    $openpay_public_key = $payment_options['openpay_public_api_key_sandbox'];
                    $sandbox = true;
                } else {
                    $merchant_id = $payment_options['openpay_merchant_id'];
                    $openpay_public_key = $payment_options['openpay_public_api_key'];
                    $sandox = false;
                }

                $result = [
                    'merchantId' => $merchant_id,
                    'publicKey' => $openpay_public_key,
                    'sandbox' => $sandbox,
                    'paymentType' => 'openpay-credit-card'
                ];
            } elseif ($paymentMethod == 'oxxo-cash') {

                /**
                 * Flujo recargas
                 */
                if ($msisdn) {

                    /** Recurrente */
                    if ($recurrente == 'SI') {
                    }
                    /** Sencillo */
                    else {
                        $json = $this->getJsonRechargeTemplate($_REQUEST);
                        $basket = $this->curl_request($urlBasket, $headers, 'POST', $json);
                        $error = (isset($basket['errors']) || !isset($basket['basketsPaymentIntent']));
                    }
                }
                /**
                 * Flujo contratación
                 */
                else {

                    $result = $this->register($_REQUEST);

                    if ($integrated_payments == '1') {
                        $oxxo = $this->oxxoPay($_REQUEST);
                        $error = $oxxo['error'];
                        $oxxoTotal = $oxxo['total'];
                        $oxxoOrderId = $oxxo['orderId'];
                        $oxxoReferenceNumber = $oxxo['reference'];
                    } else {
                        $json = $this->getJsonTemplate($_REQUEST, $qvantel_options);
                        $basket = $this->curl_request($urlBasket, $headers, 'POST', $json);
                        $error = (isset($basket['errors']) || !isset($basket['basketsPaymentIntent']));
                    }
                }

                // Preparación de respuesta
                if ($error) {
                    // Sucedio un error y se envía correo al administrador

                    $errorMsg = '';

                    if ($integrated_payments == '1') {
                        $errorMsg = $error;
                    } else {
                        if (isset($basket['errors']['message'])) {
                            $errorMsg = $basket['errors']['message'];
                            $errorMsg = str_replace(array('\\', '\'', '"', ',', ';', '<', '>'), '', $errorMsg);
                        } else {
                            $errorMsg = json_encode($basket);
                        }
                    }

                    $result = 'error';

                    /**
                     * Envio de correo de error
                     */
                    $nombre_completo = $_REQUEST['nombre'] . ' ' . $_REQUEST['apellidos'];
                    $telefono = (isset($_REQUEST['contacto']) && $_REQUEST['contacto'] != '') ? $_REQUEST['contacto'] : '';
                    $identificacion = (isset($_REQUEST['identificacion']) && $_REQUEST['identificacion'] != '') ? $_REQUEST['identificacion'] : '';
                    $tipo_identificacion = (isset($_REQUEST['tipo_documento']) && $_REQUEST['tipo_documento'] != '') ? $_REQUEST['tipo_documento'] : '';

                    $direccion = $_REQUEST['direccion'] . ', ' . $_REQUEST['exterior'] . ' ' . $_REQUEST['interior'] . ', ' . $_REQUEST['colonia'] . ', ' . $_REQUEST['municipio']
                        . ', ' . $_REQUEST['estado'] . ', ' . $_REQUEST['cp'] . ', ' . $_REQUEST['referencias'];

                    $typeAdmin = ($msisdn) ? self::ADMIN_RECHARGE : self::ADMIN_ACTIVATION;
                    $toAdmin = $global_options['notifications_email'];
                    $dataAdmin = [
                        'error' => $result,
                        'errorMsg' => $errorMsg,
                        'totalPlan' => '0',
                        'paymentMethod' => $paymentMethod ?? '',
                        'referenceNumber' => 'N/A',
                        'productName' => $_REQUEST['product_name'] ?? '',
                        'nombre' => $nombre_completo ?? '',
                        'email' => $_REQUEST['email'] ?? '',
                        'direccion' => $direccion ?? '',
                        'tipoIdentificacion' => $identificacion ?? '',
                        'noIdentificacion' => $tipo_identificacion ?? '',
                        'telefonoContacto' => $telefono,
                        'msisdn' => $_REQUEST['msisdn'] ?? '',
                    ];

                    if ($toAdmin != '') {
                        $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
                    }
                } else {

                    $payment_options = get_option($this->plugin_name . '-payment-settings');

                    if ($paymentMethod == 'stripe-credit-card') {

                        if ($sandbox == '1') {
                            $stripe = $payment_options['stripe_api_key_sandbox'];
                        } else {
                            $stripe = $payment_options['stripe_api_key'];
                        }
                    }

                    $price = $simPrice = 0;

                    if ($integrated_payments == '1' && !$msisdn) {
                        $result = [
                            'name' => $_REQUEST['product_name'],
                            'desc' => $_REQUEST['product_desc'],
                            'sim' => $simPrice,
                            'total' => $oxxoTotal,
                            'referenceNumber' => $oxxoOrderId,
                            'paymentType' => 'oxxo-cash',
                            'barcode' => '',
                            'refcode' => $oxxoReferenceNumber,
                        ];

                        $typeAdmin = self::ADMIN_OXXO_CONFIRMATION;
                        $toAdmin = $global_options['notifications_email'];
                        $dataAdmin = [
                            'nombre' => $_REQUEST['nombre'] . ' ' . $_REQUEST['apellidos'] ?? '',
                            'referenceNumber' => $oxxoOrderId ?? '',
                            'reference' => $oxxoReferenceNumber ?? '',
                            'plan' => $_REQUEST['product_name'] ?? '',
                            'totalTotal' => $oxxoTotal ?? '',
                            'msisdn' => $_REQUEST['msisdn'] ?? '',
                        ];

                        if ($toAdmin != '') {
                            $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
                        } else {
                            $result = false;
                        }
                    } else {
                        foreach ($basket['basketsPaymentIntent']['basketSummary']['basketItems'] as $item) {
                            if ($item['productId'] == 'PO_SIM') {
                                $simPrice = $item['prices'][0]['taxIncludedAmount'];
                            } elseif ($item['productId'] == $_REQUEST['product_id']) {
                                $price = $item['prices'][0]['taxIncludedAmount'];
                            }
                        }

                        $result = [
                            'name' => $_REQUEST['product_name'],
                            'desc' => $_REQUEST['product_desc'],
                            'price' => $basket['basketsPaymentIntent']['basketSummary']['basketPrices'][0]['taxIncludedAmount'],
                            'sim' => $simPrice,
                            'total' => $basket['basketsPaymentIntent']['basketSummary']['basketPrices'][0]['taxIncludedAmount'],
                            'referenceNumber' => $basket['basketsPaymentIntent']['basketSummary']['referenceNumber'],
                            'basketId' => $basket['basketsPaymentIntent']['basketSummary']['basketId'],
                            'clientSecret' => $basket['basketsPaymentIntent']['paymentIntent']['clientSecret'],
                            'paymentType' => $basket['basketsPaymentIntent']['paymentIntent']['paymentType'],
                            'barcode' => $basket['basketsPaymentIntent']['paymentIntent']['barcodeUrl'],
                            'refcode' => $basket['basketsPaymentIntent']['paymentIntent']['reference'],
                            'stripe' => $stripe,
                        ];
                    }

                    if ($msisdn) {
                        /**
                         * Envio de correos SOLO PARA RECARGAS
                         */
                        $nombre_completo = $_REQUEST['nombre'] . ' ' . $_REQUEST['apellidos'];
                        $telefono = (isset($_REQUEST['contacto']) && $_REQUEST['contacto'] != '') ? $_REQUEST['contacto'] : '';
                        $identificacion = (isset($_REQUEST['identificacion']) && $_REQUEST['identificacion'] != '') ? $_REQUEST['identificacion'] : '';
                        $tipo_identificacion = (isset($_REQUEST['tipo_documento']) && $_REQUEST['tipo_documento'] != '') ? $_REQUEST['tipo_documento'] : '';

                        $direccion = $_REQUEST['direccion'] . ', ' . $_REQUEST['exterior'] . ' ' . $_REQUEST['interior'] . ', ' . $_REQUEST['colonia'] . ', ' . $_REQUEST['municipio']
                            . ', ' . $_REQUEST['estado'] . ', ' . $_REQUEST['cp'] . ', ' . $_REQUEST['referencias'];

                        // Solo se envía esta notificación para cliente con oxxo-cash para stripe se envía posterior al pago
                        if ($paymentMethod == 'oxxo-cash') {
                            $type = ($msisdn) ? self::OXXO_RECHARGE : self::OXXO_ACTIVATION;
                            $to = $_REQUEST['email'] ?? '';
                            $data = array(
                                'nombre' => $_REQUEST['nombre'] ?? '',
                                'plan' => $result['name'] ?? '',
                                'reference' => $result['refcode'] ?? '',
                                'barcodeUrl' => $result['barcode'] ?? '',
                                'totalPlan' => $result['total'] ?? '',
                            );

                            if ($to != '') {
                                $this->sendNotification($to, $type, $data);
                            }
                        }

                        $typeAdmin = ($msisdn) ? self::ADMIN_RECHARGE : self::ADMIN_ACTIVATION;
                        $toAdmin = $global_options['notifications_email'];
                        $dataAdmin = [
                            'error' => $result,
                            'totalPlan' => $result['total'] ?? '',
                            'paymentMethod' => $paymentMethod ?? '',
                            'referenceNumber' => $result['referenceNumber'] ?? '',
                            'productName' => $result['name'] ?? '',
                            'nombre' => $nombre_completo ?? '',
                            'email' => $_REQUEST['email'] ?? '',
                            'direccion' => $direccion ?? '',
                            'tipoIdentificacion' => $identificacion ?? '',
                            'noIdentificacion' => $tipo_identificacion ?? '',
                            'telefonoContacto' => $telefono,
                            'msisdn' => $_REQUEST['msisdn'] ?? '',
                        ];

                        if ($toAdmin != '') {
                            $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
                        }
                    }
                }
            }
        } else {
            $result = 'null';
        }

        // Return the data.
        return wp_send_json(json_encode($result));
    }


    /**
     * This function process a nomina payment intent
     */
    public function nominaPay()
    {
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }

        $global_options = get_option($this->plugin_name . '-general-settings');

        $error = '';
        $idPlan = $_REQUEST['idProduct'] ?? '';
        $name = $_REQUEST['nombreEmpleado'] ?? '';
        $company = $_REQUEST['empresaEmpleado'] ?? '';
        $employee = $_REQUEST['matriculaEmpleado'] ?? '';
        $phone = $_REQUEST['telefonoEmpleado'] ?? '';
        $email = $_REQUEST['emailEmpleado'] ?? '';

        global $wpdb;

        $wpdb->insert(
            'wp_figou_nomina',
            array(
                'plan' => $idPlan,
                'name' => $name,
                'company' => $company,
                'employee' => $employee,
                'phone' => $phone,
                'email' => $email
            )
        );

        $folio = 'NOM00000' . $wpdb->insert_id;

        /* Envio de notificaciones */
        $type = self::NOMINA_ACTIVATION;
        $to = $_REQUEST['email'] ?? '';
        $data = array(
            'nombre' => $_REQUEST['nombre'] ?? '',
            'pedido' => $folio ?? '',
            'direccion' => $_REQUEST['direccion'] ?? '',
            'plan' => $_REQUEST['plan'] ?? '',
            'totalPlan' => $_REQUEST['totalPlan'] ?? '',
            'totalSim' => $_REQUEST['totalSim'] ?? '',
            'descuento' => $_REQUEST['descuento'] ?? '$0 MXN',
            'totalTotal' => $_REQUEST['totalTotal'] ?? '',
            'paymentMethod' => 'Descuento en nómina',
        );

        if ($to != '') {
            $this->sendNotification($to, $type, $data);
        }

        $typeAdmin = self::ADMIN_NOMINA_CONFIRMATION;
        $toAdmin = $global_options['notifications_email'];
        $dataAdmin = [
            'nombre' => $_REQUEST['nombre'] ?? '',
            'empresa' => $company ?? '',
            'matricula' => $employee ?? '',
            'telefono' => $phone ?? '',
            'email' => $email ?? '',
            'referenceNumber' => $folio ?? '',
            'plan' => $_REQUEST['plan'] ?? '',
            'totalTotal' => $_REQUEST['totalTotal'] ?? '',
            'msisdn' => $_REQUEST['msisdn'] ?? '',
        ];

        if ($toAdmin != '') {
            $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
        } else {
            $result = false;
        }

        $result = [
            "error" => $error,
            "orderId" => $folio
        ];

        return wp_send_json(json_encode($result));
    }

    /**
     * This function process a conekta payment intent
     */
    public function conektaPay()
    {
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }


        $global_options = get_option($this->plugin_name . '-general-settings');
        $payment_options = get_option($this->plugin_name . '-payment-settings');
        $sandbox = $global_options['sandbox'];

        if ($sandbox == '1') {
            $conekta_api_key = $payment_options['conekta_private_api_key_sandbox'];
        } else {
            $conekta_api_key = $payment_options['conekta_private_api_key'];
        }


        \Conekta\Conekta::setApiKey($conekta_api_key);
        \Conekta\Conekta::setApiVersion("2.0.0");

        $conektaError = "";

        $customerInfo = [
            "name" => $_REQUEST['nombre'],
            "email" => $_REQUEST['email'] ?? 'cliente@lgbtmasmobile.com',
            "phone" => $_REQUEST['contacto'] ?? $_REQUEST['msisdn']
        ];

        try {
            $order = \Conekta\Order::create(
                [
                    "line_items" => [
                        [
                            "name" => $_REQUEST['plan'],
                            "unit_price" => $_REQUEST['price'] * 100,
                            "quantity" => 1
                        ]
                    ],
                    "currency" => "MXN",
                    "customer_info" => $customerInfo,
                    "metadata" => [
                        "productId" => $_REQUEST['productId'],
                        "tipo" => $_REQUEST['msisdn'] != '' ? 'Recarga' : 'Contratación'
                    ],
                    "charges" => [
                        [
                            "payment_method" => [
                                "type" => "card",
                                "token_id" => $_REQUEST['token']
                            ]
                        ]
                    ]
                ]
            );
        } catch (\Conekta\ProcessingError $error) {
            $conektaError = $error->getMessage();
        } catch (\Conekta\ParameterValidationError $error) {
            $conektaError = $error->getMessage();
        } catch (\Conekta\Handler $error) {
            $conektaError = $error->getMessage();
        }

        if ($conektaError == '') {
            $result = [
                'orderId' => $order->id,
                'error' => ''
            ];

            $type = isset($_REQUEST['recarga']) ? self::STRIPE_RECHARGE : self::STRIPE_ACTIVATION;
            $to = $_REQUEST['email'] ?? '';
            $data = array(
                'nombre' => $_REQUEST['nombre'] ?? '',
                'pedido' => $order->id ?? '',
                'direccion' => $_REQUEST['direccion'] ?? '',
                'plan' => $_REQUEST['plan'] ?? '',
                'totalPlan' => $_REQUEST['totalPlan'] ?? '',
                'totalSim' => $_REQUEST['totalSim'] ?? '',
                'descuento' => $_REQUEST['descuento'] ?? '$0 MXN',
                'totalTotal' => $_REQUEST['totalTotal'] ?? '',
            );

            if ($to != '') {
                $this->sendNotification($to, $type, $data);
            }

            $typeAdmin = self::ADMIN_STRIPE_CONFIRMATION;
            $toAdmin = $global_options['notifications_email'];
            $dataAdmin = [
                'nombre' => $_REQUEST['nombre'] ?? '',
                'referenceNumber' => $order->id ?? '',
                'plan' => $_REQUEST['plan'] ?? '',
                'totalTotal' => $_REQUEST['totalTotal'] ?? '',
                'msisdn' => $_REQUEST['msisdn'] ?? '',
            ];

            if ($toAdmin != '') {
                $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
            } else {
                $result = false;
            }

            $active_sim = $_REQUEST['sim_active'] ?? '';

            if ($active_sim == 1) {
                self::sim_activate();
                self::qvantel_webhook($_REQUEST);
            }
        } else {
            $result = [
                'orderId' => '',
                'error' => $conektaError
            ];
        }

        return wp_send_json(json_encode($result));
    }


    /**
     * This function process a conekta oxxo payment intent
     * @return array
     */
    public function oxxoPay($request)
    {

        $global_options = get_option($this->plugin_name . '-general-settings');
        $payment_options = get_option($this->plugin_name . '-payment-settings');
        $sandbox = $global_options['sandbox'];

        if ($sandbox == '1') {
            $conekta_api_key = $payment_options['conekta_private_api_key_sandbox'];
        } else {
            $conekta_api_key = $payment_options['conekta_private_api_key'];
        }


        \Conekta\Conekta::setApiKey($conekta_api_key);
        \Conekta\Conekta::setApiVersion("2.0.0");

        $conektaError = false;

        $customerInfo = [
            "name" => $request['nombre'] . ' ' . $request['apellidos'],
            "email" => $request['email'] ?? 'cliente@lgbtmasmobile.com',
            "phone" => $request['contacto'] ?? $request['msisdn']
        ];

        $customerAddress = [
            "address" => [
                "street1" => $request['direccion'] . ' ' . $request['exterior'] . ' ' . $request['interior'],
                "postal_code" => $_REQUEST['cp'],
                "country" => "MX"
            ]
        ];

        try {
            $thirty_days_from_now = (new DateTime())->add(new DateInterval('P30D'))->getTimestamp();

            $order = \Conekta\Order::create(
                [
                    "line_items" => [
                        [
                            "name" => $request['product_name'],
                            "unit_price" => $request['product_price'] * 100,
                            "quantity" => 1
                        ]
                    ],
                    "currency" => "MXN",
                    "customer_info" => $customerInfo,
                    "metadata" => [
                        "productId" => $request['product_id'],
                        "tipo" => 'Contratación'
                    ],
                    "shipping_contact" => $customerAddress,
                    "charges" => [
                        [
                            "payment_method" => [
                                "type" => "oxxo_cash",
                                "expires_at" => $thirty_days_from_now
                            ]
                        ]
                    ]
                ]
            );
        } catch (\Conekta\ProcessingError $error) {
            $conektaError = $error->getMessage();
        } catch (\Conekta\ParameterValidationError $error) {
            $conektaError = $error->getMessage();
        } catch (\Conekta\Handler $error) {
            $conektaError = $error->getMessage();
        }

        return [
            'error' => $conektaError,
            'orderId' => $order->id,
            'reference' => $order->charges[0]->payment_method->reference,
            'total' => $order->amount / 100
        ];
    }

    /**
     * Fill offering template
     *
     * @param $offering
     * @return array
     */
    public function fill_offering_data($offering)
    {
        $productId = $offering['productId'];
        $specialPrice = $offering['prices'][0]['taxIncludedAmount'] . ' ' . $offering['prices'][0]['currency'];
        $price = $specialPrice;
        $superOferta = '';
        $origDescription = $offering['longDescription'];
        $descLines = preg_split("/\r\n|\r|\n/", $origDescription);
        $description = '<ul>';

        foreach ($descLines as $descLine) {
            $description .= '<li><span class="figou-list-icon"><i aria-hidden="true" class="fas fa-check-circle"></i></span><span class="figou-list-text">' . $descLine . '</span></li>';
        }

        $description .= '</ul>';

        return [
            'productId' => $productId,
            'superOferta' => $superOferta,
            'name' => $offering['productName'],
            'price' => $price,
            'specialPrice' => $specialPrice,
            'description' => $description,
            'shortDescription' => $offering['shortDescription'],
        ];
    }

    /**
     * @return string
     */
    public function onboarding_process_shortcode()
    {

        //$content = '';
        //return $this->getEmailBody($content, $white = false);

        require_once $this->plugin_public_partials_path . 'figou-integrations-public-display.php';
        return '<input type="hidden" id="nonce" value="' . wp_create_nonce('figou_save_nonce') . '" />';
    }

    /**
     * @return string
     */
    public function recharging_shortcode()
    {
        require_once $this->plugin_public_partials_path . 'figou-integrations-recharging-display.php';
        return '<input type="hidden" id="nonce" value="' . wp_create_nonce('figou_save_nonce') . '" />';
    }

    /**
     * @return string
     */
    public function activation_shortcode()
    {
        require_once $this->plugin_public_partials_path . 'figou-integrations-activation-display.php';
        return '<input type="hidden" id="nonce" value="' . wp_create_nonce('figou_save_nonce') . '" />';
    }

    /**
     * @return string
     */
    public function imei_shortcode()
    {
        require_once $this->plugin_public_partials_path . 'figou-integrations-imei-display.php';
        return '<input type="hidden" id="nonce" value="' . wp_create_nonce('figou_save_nonce') . '" />';
    }

    /**
     * @return string
     */
    public function map_shortcode()
    {
        require_once $this->plugin_public_partials_path . 'figou-integrations-map-display.php';
        return '<input type="hidden" id="nonce" value="' . wp_create_nonce('figou_save_nonce') . '" />';
    }

    public function registro_shortcode()
    {
        require_once $this->plugin_public_partials_path . 'figou-integrations-registro-display.php';
        return '<input type="hidden" id="nonce" value="' . wp_create_nonce('figou_save_nonce') . '" />';
    }

    /**
     * Get Altan authentication token
     *
     * @param $options
     * @return bool[]|mixed
     */
    public function getAuthToken($options)
    {
        $url = $options['altan_auth_url'] . '?grant-type=client_credentials';
        $token = 'Basic ' . trim($options['altan_token']);
        $headers = [
            'Authorization: ' . $token,
            'Content-length: 0',
        ];
        $res_token = $this->curl_request($url, $headers, 'POST');

        return $res_token;
    }

    /**
     * Get device information from Altan
     *
     * @param $token
     * @param $imei
     * @param $options
     * @return bool[]|mixed
     */
    public function getAltanResponse($token, $imei, $options)
    {

        $url = $options['altan_suscribers_url'] . '?identifierValue=' . $imei . '&identifierType=' . $options['altan_identifier_type'];
        $token = 'Bearer ' . $token;
        $headers = [
            'Authorization: ' . $token,
            'Content-length: 0',
        ];
        $resultado_altan = $this->curl_request($url, $headers, 'GET');
        return $resultado_altan;
    }

    /**
     * Helper function for curl request
     *
     * @param $url
     * @param $headers
     * @param $http_method
     * @param null $payload
     * @return bool[]|mixed
     */
    public function curl_request($url, $headers, $http_method, $payload = null, $params = null)
    {
        $curl = curl_init();
        $curl_options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $http_method,
            CURLOPT_HTTPHEADER => $headers,
        ];

        curl_setopt_array($curl, $curl_options);

        if (!empty($payload)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        }

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpcode = 0 || $httpcode != 200) {
            return array(
                'error' => $httpcode
            );
        }
        $message = json_decode($response, true);
        return $message;
    }

    /**
     * Transform $_REQUEST into json format Qvantel payload baskets
     *
     * @param $data
     * @return false|string
     */
    public function getJsonTemplate($data, $qvantel_options)
    {
        $jsonTemplate = <<<JSONTEMPALTE
    {
        "customer": {
            "individual": {
                "nationality": "MX",
                "gender": "other",
                "familyName": ":apellidos",
                "givenName": ":nombre"
            },
            "contactMedia": [
                {
                    "role": "primary",
                    "medium": {
                        "telephoneNumber": {
                            "number": ":contacto",
                            "numberType": "fixedLine"
                        }
                    }
                },
                {
                    "role": "primary",
                    "medium": {
                        "emailAddress": {
                            "email": ":email"
                        }
                    }
                },
                {
                    "role": "primary",
                    "medium": {
                        "postalAddress": {
                            "city": ":colonia",
                            "apartment": ":interior",
                            "country": "MX",
                            "building": ":exterior",
                            "postalCode": ":cp",
                            "street": ":direccion",
                            "coAddress": ":referencias",
                            "stateOrProvince": ":estado",
                            "county": ":municipio"
                        }
                    }
                }
            ],
            "identifications": [
                {
                    "identificationId": ":identificacion",
                    "identificationType": ":tipo_documento"
                }
            ]
        },
        "basket": {
            "paymentMethod": {
                "paymentMethodType": ":paymentMethod"
            },
            "basketItems": [
                {
                    "quantity": 1,
                    "characteristics": [
                        {
                            "key": "CH_ServiceActivationType",
                            "value": ":activation_value"
                        }
                    ],
                    "productId": ":product_id"
                }
            ]
        }
    }
JSONTEMPALTE;
        $search = [
            ':nombre' => $data['nombre'],
            ':apellidos' => $data['apellidos'],
            ':contacto' => (isset($data['contacto']) && $data['contacto'] != '') ? $data['contacto'] : '5555555555',
            ':email' => $data['email'],
            ':direccion' => $data['direccion'],
            ':exterior' => $data['exterior'],
            ':interior' => (isset($data['interior']) && $data['interior'] != '') ? $data['interior'] : '0',
            ':referencias' => (isset($data['referencias']) && $data['referencias'] != '') ? $data['referencias'] : '--',
            ':cp' => $data['cp'],
            ':colonia' => $data['colonia'],
            ':municipio' => $data['municipio'],
            ':estado' => $data['estado'],
            ':activation_value' => $qvantel_options['qvantel_activation'],
            ':paymentMethod' => $data['paymentMethod'],
            ':product_id' => $data['product_id'],
            ':identificacion' => (isset($data['identificacion']) && $data['identificacion'] != '') ? $data['identificacion'] : '0000000000',
            ':tipo_documento' => (isset($data['tipo_documento']) && $data['tipo_documento'] != '') ? $data['tipo_documento'] : 'personalIdentityCode'
        ];
        $json = json_encode(json_decode(str_replace(array_keys($search), array_values($search), $jsonTemplate), true));
        return $json;
    }

    /**
     * Transform $_REQUEST into json format Qvantel payload recharge baskets
     *
     * @param $data
     * @return false|string
     */
    public function getJsonRechargeTemplate($data)
    {
        $jsonTemplate = <<<JSONTEMPALTE
 {
  "basket": {
      "paymentMethod": {
          "paymentMethodType": ":paymentMethod"
      },
    "basketItems": [
      {
        "quantity": 1,
        "msisdn": ":msisdn",
        "productId": ":product_id"
      }
    ]
  }
}
JSONTEMPALTE;
        // $data['product_id'] = 'PO_SAY_RM_CT_5000_5000Mi_30000_20000M_5000_5000SMS_50000T_30D_FI';
        $search = [
            ':msisdn' => '52' . $data['msisdn'],
            ':paymentMethod' => $data['paymentMethod'],
            ':product_id' => $data['product_id'],
        ];
        $json = json_encode(json_decode(str_replace(array_keys($search), array_values($search), $jsonTemplate), true));
        return $json;
    }

    /**
     * This function execute email sending when stripe payment is complete
     *
     * @return string true or false on a JSON encoded string.
     */
    public function ajaxNotification()
    {
        // Check the nonce, if ok, proceed.
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }
        $global_options = get_option($this->plugin_name . '-general-settings');

        $type = isset($_REQUEST['recarga']) ? self::STRIPE_RECHARGE : self::STRIPE_ACTIVATION;
        $to = $_REQUEST['email'] ?? '';
        $data = array(
            'nombre' => $_REQUEST['nombre'] ?? '',
            'pedido' => $_REQUEST['pedido'] ?? '',
            'direccion' => $_REQUEST['direccion'] ?? '',
            'plan' => $_REQUEST['plan'] ?? '',
            'totalPlan' => $_REQUEST['totalPlan'] ?? '',
            'totalSim' => $_REQUEST['totalSim'] ?? '',
            'totalTotal' => $_REQUEST['totalTotal'] ?? '',
        );

        if ($to != '') {
            $this->sendNotification($to, $type, $data);
        }

        $typeAdmin = self::ADMIN_STRIPE_CONFIRMATION;
        $toAdmin = $global_options['notifications_email'];
        $dataAdmin = [
            'nombre' => $_REQUEST['nombre'] ?? '',
            'referenceNumber' => $_REQUEST['pedido'] ?? '',
            'plan' => $_REQUEST['plan'] ?? '',
            'totalTotal' => $_REQUEST['totalTotal'] ?? '',
            'msisdn' => $_REQUEST['msisdn'] ?? '',
        ];

        if ($toAdmin != '') {
            $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
        } else {
            $result = false;
        }

        return wp_send_json(json_encode($result));
    }

    public function register($data)
    {

        $global_options = get_option($this->plugin_name . '-general-settings');
        $msisdn = $data['msisdn'] ?? false;

        /**
         * Envio de correos y guardado en base de datos
         */
        $nombre_completo = $data['nombre'] . ' ' . $data['apellidos'];
        $telefono = (isset($data['contacto']) && $data['contacto'] != '') ? $data['contacto'] : '';
        $identificacion = (isset($data['identificacion']) && $data['identificacion'] != '') ? $data['identificacion'] : '';
        $tipo_identificacion = (isset($data['tipo_documento']) && $data['tipo_documento'] != '') ? $data['tipo_documento'] : '';

        $direccion = $data['direccion'] . ', ' . $data['exterior'] . ' ' . $data['interior'] . ', ' . $data['colonia'] . ', ' . $data['municipio']
            . ', ' . $data['estado'] . ', ' . $data['cp'] . ', ' . $data['referencias'];

        $typeAdmin = ($msisdn) ? self::ADMIN_RECHARGE : self::ADMIN_ACTIVATION;

        $toAdmin = $global_options['notifications_email'];
        $dataAdmin = [
            'error' => '',
            'totalPlan' => $data['product_price'] ?? '',
            'paymentMethod' => $paymentMethod ?? '',
            'referenceNumber' => 'Not set',
            'productName' => $data['product_name'] ?? '',
            'nombre' => $nombre_completo ?? '',
            'email' => $data['email'] ?? '',
            'direccion' => $direccion ?? '',
            'tipoIdentificacion' => $identificacion ?? '',
            'noIdentificacion' => $tipo_identificacion ?? '',
            'telefonoContacto' => $telefono,
            'nacimiento' => $data['nacimiento'] ?? '',
            'msisdn' => $data['msisdn'] ?? '',
            'referido' => $data['referido'] ?? '',
        ];

        if ($toAdmin != '') {
            $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
        }

        $result = [
            'register' => 'ok',
        ];

        return $result;
    }

    public function sendNotification($to, $type, $data = null)
    {
        $subject = 'Gracias por tu pago';
        $content = '';
        $white = false;
        $fecha_actual = date('m/d/y');
        $fecha_entrega = date("m/d/y", strtotime($fecha_actual . "+4 days"));
        switch ($type) {
            case 1:
                $content = file_get_contents($this->plugin_public_partials_path . 'email/stripe_activation.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':pedido' => $data['pedido'],
                    ':fecha_orden' => $fecha_actual,
                    ':fecha_entrega' => $fecha_entrega,
                    ':direccion' => $data['direccion'],
                    ':plan' => $data['plan'],
                    ':totalPlan' => $data['totalPlan'],
                    ':totalSim' => $data['totalSim'],
                    ':descuento' => $data['descuento'],
                    ':totalTotal' => $data['totalTotal'],
                    ':paymentMethod' => $data['paymentMethod']  ?? 'Tarjeta'
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 2:
                $white = true;
                $content = file_get_contents($this->plugin_public_partials_path . 'email/oxxo_activation.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':plan' => $data['plan'],
                    ':totalPlan' => '$' . $data['totalPlan'] . 'MXN',
                    ':reference' => $data['reference'],
                    ':barcodeUrl' => $data['barcodeUrl']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 3:
                $content = file_get_contents($this->plugin_public_partials_path . 'email/stripe_recharge.html');
                break;
            case 4:
                $white = true;
                $content = file_get_contents($this->plugin_public_partials_path . 'email/oxxo_recharge.html');
                $search = [
                    ':plan' => $data['plan'],
                    ':monto' => $data['monto'],
                    ':reference' => $data['reference'],
                    ':barcodeUrl' => $data['barcodeUrl']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 5:
                if ($data['error'] == 'error') {
                    $subject = 'Intento fallido de venta - LGBTMASMOBILE';
                } else {
                    $subject = 'Se realizo una venta desde - LGBTMASMOBILE';
                }
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_activation.html');
                $search = [
                    ':error' => $data['errorMsg'],
                    ':totalPlan' => '$' . $data['totalPlan'] . 'MXN',
                    ':paymentMethod' => $data['paymentMethod'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':productName' => $data['productName'],
                    ':nombre' => $data['nombre'],
                    ':email' => $data['email'],
                    ':direccion' => $data['direccion'],
                    ':tipoIdentificacion' => $data['tipoIdentificacion'],
                    ':noIdentificacion' => $data['noIdentificacion'],
                    ':telefonoContacto' => $data['telefonoContacto'],
                    ':nacimiento' => $data['nacimiento'],
                    ':referido' => $data['referido']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 6:
                if ($data['error'] == 'error') {
                    $subject = 'Intento fallido de recarga - LGBTMASMOBILE';
                } else {
                    $subject = 'Se realizo una recarga desde - LGBTMASMOBILE';
                }
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_recharge.html');
                $search = [
                    ':error' => $data['errorMsg'],
                    ':totalPlan' => '$' . $data['totalPlan'] . 'MXN',
                    ':paymentMethod' => $data['paymentMethod'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':productName' => $data['productName'],
                    ':email' => $data['email'],
                    ':msisdn' => $data['msisdn']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 7:
                $subject = 'Confirmación de pago por tarjeta - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_stripe_confirmation.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':plan' => $data['plan'],
                    ':totalTotal' => $data['totalTotal'],
                    ':msisdn' => $data['msisdn']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 8:
                $subject = 'Confirmación de pedido OXXO PAY - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_oxxo_confirmation.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':reference' => $data['reference'],
                    ':plan' => $data['plan'],
                    ':totalTotal' => $data['totalTotal'],
                    ':msisdn' => $data['msisdn']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 9:
                $content = file_get_contents($this->plugin_public_partials_path . 'email/nomina_activation.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':pedido' => $data['pedido'],
                    ':fecha_orden' => $fecha_actual,
                    ':fecha_entrega' => $fecha_entrega,
                    ':direccion' => $data['direccion'],
                    ':plan' => $data['plan'],
                    ':totalPlan' => $data['totalPlan'],
                    ':totalSim' => $data['totalSim'],
                    ':descuento' => $data['descuento'],
                    ':totalTotal' => $data['totalTotal'],
                    ':paymentMethod' => $data['paymentMethod']  ?? 'Descuento en nómina'
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 10:
                $subject = 'Solicitud descuento en nómina - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_nomina_confirmation.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':empresa' => $data['empresa'],
                    ':matricula' => $data['matricula'],
                    ':telefono' => $data['telefono'],
                    ':email' => $data['email'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':plan' => $data['plan'],
                    ':totalTotal' => $data['totalTotal']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 11:
                if ($data['error'] == 'error') {
                    $subject = 'Intento fallido de activación de SIM - LGBTMASMOBILE';
                } else {
                    $subject = 'Solicitud de activación de SIM - LGBTMASMOBILE';
                }
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_sim.html');
                $search = [
                    ':error' => $data['errorMsg'],
                    ':totalPlan' => '$' . $data['totalPlan'] . 'MXN',
                    ':paymentMethod' => $data['paymentMethod'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':productName' => $data['productName'],
                    ':nombre' => $data['nombre'],
                    ':email' => $data['email'],
                    ':direccion' => $data['direccion'],
                    ':tipoIdentificacion' => $data['tipoIdentificacion'],
                    ':noIdentificacion' => $data['noIdentificacion'],
                    ':telefonoContacto' => $data['telefonoContacto'],
                    ':nacimiento' => $data['nacimiento'],
                    ':referido' => $data['referido']
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
            case 12:
                $subject = 'Confirmación de pago por tarjeta - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_conekta_pay.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':referenceNumber' => $data['referenceNumber'],
                    ':plan' => $data['plan'],
                    ':totalTotal' => $data['totalTotal'],
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;

            case 13:
                $subject = 'Confirmación de activación de SIM - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/activate_sim.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':email' => $data['email'],
                ];

                $content = str_replace(array_keys($search), array_values($search), $content);
                break;

            case 14:
                $subject = 'Solicitud de activación de SIM - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_activate_sim.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':email' => $data['email'],
                    ':direccion' => $data['direccion'],
                    ':colonia' => $data['colonia'],
                    ':ciudad' => $data['ciudad'],
                    ':municipio' => $data['municipio'],
                    ':cp' => $data['cp'],
                    ':estado' => $data['estado'],
                    ':pais' => $data['pais'],
                    ':telefonoContacto' => $data['telefonoContacto'],
                    ':nacimiento' => $data['nacimiento'],
                    ':msisdn_to_port' => $data['msisdn_to_port'],
                    ':iccid' => $data['iccid'],
                    ':nip' => $data['nip'],

                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;

            case 15:
                $subject = 'Confirmación de activación de SIM y la Portabilidad - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/activate_sim_with_portability.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':email' => $data['email'],
                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;

            case 16:
                $subject = 'Confirmación de activación de SIM y la Portabilidad - LGBTMASMOBILE';
                $content = file_get_contents($this->plugin_public_partials_path . 'email/admin_activate_sim_with_portability.html');
                $search = [
                    ':nombre' => $data['nombre'],
                    ':email' => $data['email'],
                    ':direccion' => $data['direccion'],
                    ':colonia' => $data['colonia'],
                    ':ciudad' => $data['ciudad'],
                    ':municipio' => $data['municipio'],
                    ':cp' => $data['cp'],
                    ':estado' => $data['estado'],
                    ':pais' => $data['pais'],
                    ':telefonoContacto' => $data['telefonoContacto'],
                    ':nacimiento' => $data['nacimiento'],
                    ':msisdn_to_port' => $data['msisdn_to_port'],
                    ':iccid' => $data['iccid'],
                    ':nip' => $data['nip'],

                ];
                $content = str_replace(array_keys($search), array_values($search), $content);
                break;
        }
        $body = $this->getEmailBody($content, $white);
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Notificaciones LGBTMASMOBILE <no-replay@lgbtmasmobile.com>');
        $mail = wp_mail($to, $subject, $body, $headers);

        return $mail;
    }

    /**
     * This function format email body according defined templates
     *
     * @param $content
     * @param false $white
     * @return string
     */
    public function getEmailBody($content, $white = false)
    {
        $header = file_get_contents($this->plugin_public_partials_path . 'email/header.html');
        $footer = file_get_contents($this->plugin_public_partials_path . 'email/footer.html');

        if ($white) {
            $header = str_replace(':figou_color', 'figou_body_white', $header);
        }

        $resourcesDir = wp_upload_dir();
        $resourceUrl = $resourcesDir['baseurl'] . '/figou';

        $header = str_replace(':resource_url', $resourceUrl, $header);
        $footer = str_replace(':resource_url', $resourceUrl, $footer);

        return $header . $content . $footer;
    }

    /**
     * This function return an address by postzip
     *
     * @param $codigo_postal
     * @return string
     */
    public function copomex()
    {
        // Check the nonce, if ok, proceed.
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }

        $global_options = get_option($this->plugin_name . '-general-settings');
        $sandbox = $global_options['sandbox'];
        $integrated_payments = ($sandbox == '1') ? 'pruebas' : $global_options['integrated_payments'];
        $token = $global_options['copomex_token'];

        $codigo_postal = $_REQUEST['cp'];

        $ch = curl_init();
        $url = "https://api.copomex.com/query/info_cp/" . $codigo_postal;

        $dataArray = [
            'type' => 'simplified',
            'token' => $token
        ];

        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);

        $ch_result = curl_exec($ch);

        if (curl_error($ch)) {
            $result = [
                'error' => 'Error:' . curl_error($ch)
            ];
        } else {
            $result = json_decode($ch_result);
            $response = [
                'error' => $result->error,
                'colonia' => $result->response->asentamiento,
                'municipio' => $result->response->municipio,
                'estado' => $result->response->estado,
            ];
        }

        curl_close($ch);

        return wp_send_json(json_encode($response));
    }

    public function authentication()
    {

        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }

        $global_options = get_option($this->plugin_name . '-general-settings');
        $payment_options = get_option($this->plugin_name . '-payment-settings');
        $sandbox = $global_options['sandbox'];

        if ($sandbox == '1') {
            $conekta_api_key = $payment_options['conekta_private_api_key_sandbox'];
            $conekta_api_key_public = $payment_options['conekta_public_api_key_sandbox'];
        } else {
            $conekta_api_key = $payment_options['conekta_private_api_key'];
            $conekta_api_key_public = $payment_options['conekta_public_api_key'];
        }

        $credentials = base64_encode($conekta_api_key);


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.conekta.io/tokens",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"checkout\":{\"returns_control_on\":\"Token\"}}",
            CURLOPT_HTTPHEADER => [
                "Accept: application/vnd.conekta-v2.0.0+json",
                "Authorization: Basic " . $credentials,
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return wp_send_json(json_encode($err));
        } else {
            $respuesta = json_decode($response);
            return wp_send_json(json_encode([$conekta_api_key_public, $respuesta]));
        }
    }

    public function conektaOrder()
    {

        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }
        $global_options = get_option($this->plugin_name . '-general-settings');
        $payment_options = get_option($this->plugin_name . '-payment-settings');
        $sandbox = $global_options['sandbox'];

        if ($sandbox == '1') {
            $conekta_api_key = $payment_options['conekta_private_api_key_sandbox'];
        } else {
            $conekta_api_key = $payment_options['conekta_private_api_key'];
        }

        \Conekta\Conekta::setApiKey($conekta_api_key);
        \Conekta\Conekta::setApiVersion("2.0.0");

        $conektaError = "";

        $customerInfo = [
            "name" => $_REQUEST['name'],
            "phone" => $_REQUEST['tel'],
            "wa" => $_REQUEST['wa'],
            "email" => $_REQUEST['email'],
        ];

        try {
            $order = \Conekta\Order::create(
                [
                    "line_items" => [
                        [
                            "name" => 'Plan 5GB',
                            "unit_price" => 260 * 100,
                            "quantity" => 1
                        ]
                    ],
                    "currency" => "MXN",
                    "customer_info" => $customerInfo,
                    "metadata" => [
                        "productId" => 'contratacion',
                        "tipo" => 'contratacion'
                    ],
                    "charges" => [
                        [
                            "payment_method" => [
                                "type" => "card",
                                "token_id" => $_REQUEST['token']
                            ]
                        ]
                    ]
                ]
            );
        } catch (\Conekta\ProcessingError $error) {
            $conektaError = $error->getMessage();
        } catch (\Conekta\ParameterValidationError $error) {
            $conektaError = $error->getMessage();
        } catch (\Conekta\Handler $error) {
            $conektaError = $error->getMessage();
        }




        if ($conektaError == '') {
            $result = [
                'orderId' => $order->id,
                'error' => ''
            ];

            $type = 12;
            $to = $_REQUEST['email'] ?? '';
            $data = array(
                'nombre' => $_REQUEST['name'] ?? '',
                'referenceNumber' => $order->id ?? '',
                'plan' => '5gb',
                'totalTotal' => 260,

            );

            if ($to != '') {
                $this->sendNotification($to, $type, $data);
            }

            $typeAdmin = self::ADMIN_STRIPE_CONFIRMATION;
            $toAdmin = $global_options['notifications_email'];
            $dataAdmin = [
                'nombre' => $_REQUEST['name'] ?? '',
                'referenceNumber' => $order->id ?? '',
                'plan' => 'registro',
                'totalTotal' => 260,
            ];

            if ($toAdmin != '') {
                $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
            } else {
                $result = false;
            }
        } else {
            $result = [
                'orderId' => '',
                'error' => $conektaError
            ];
        }

        return wp_send_json(json_encode([$conektaError, $order, $result]));
    }


    public function sim_activate()
    {
        if (!wp_verify_nonce($_REQUEST['nonce'], 'figou_save_nonce')) {
            die;
        }
        $global_options = get_option($this->plugin_name . '-general-settings');

        $msisdn = $_REQUEST['msisdn'] ?? '';
        $nip = $_REQUEST['nip'] ?? '';

        if ($msisdn != '' && $nip != '') {
            /* Envio de notificaciones */
            $type = self::ACTIVATE_SIM_WITH_PORTABILITY;
            $to = $_REQUEST['email'] ?? '';
            $data = array(
                'nombre' => $_REQUEST['nombre'] ?? '',
                'email' => $_REQUEST['email'] ?? '',

            );

            if ($to != '') {
                $this->sendNotification($to, $type, $data);
            }
            $typeAdmin = self::ADMIN_ACTIVATE_SIM_WITH_PORTABILITY;
            $toAdmin = $global_options['notifications_email'];
            $dataAdmin = [
                'nombre' => $_REQUEST['nombre'] ?? '',
                'email' => $_REQUEST['email'] ?? '',
                'direccion' => $_REQUEST['direccion'] ?? '',
                'telefonoContacto' => $_REQUEST['contacto'] ?? '',
                'nacimiento' => $_REQUEST['nacimiento'] ?? '',
                'msisdn_to_port' => $_REQUEST['msisdn_to_port'] ?? '',
                'iccid' => $_REQUEST['iccid'] ?? '',
                'nip' => $_REQUEST['nip'] ?? '',
                'colonia' => $_REQUEST['colonia'] ?? '',
                'municipio' => $_REQUEST['municipio'] ?? '',
                'cp' => $_REQUEST['cp'] ?? '',
                'estado' => $_REQUEST['estado'] ?? '',
            ];

            if ($toAdmin != '') {
                $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
            }
        } else {
            /* Envio de notificaciones */
            $type = self::ACTIVATE_SIM;
            $to = $_REQUEST['email'] ?? '';
            $data = array(
                'nombre' => $_REQUEST['nombre'] ?? '',
                'email' => $_REQUEST['email'] ?? '',

            );

            if ($to != '') {
                $this->sendNotification($to, $type, $data);
            }
            $typeAdmin = self::ADMIN_ACTIVATE_SIM;
            $toAdmin = $global_options['notifications_email'];
            $dataAdmin = [
                'nombre' => $_REQUEST['nombre'] ?? '',
                'email' => $_REQUEST['email'] ?? '',
                'direccion' => $_REQUEST['direccion'] ?? '',
                'telefonoContacto' => $_REQUEST['contacto'] ?? '',
                'nacimiento' => $_REQUEST['nacimiento'] ?? '',
                'msisdn_to_port' => $_REQUEST['msisdn_to_port'] ?? '',
                'iccid' => $_REQUEST['iccid'] ?? '',
                'nip' => $_REQUEST['nip'] ?? '',
                'colonia' => $_REQUEST['colonia'] ?? '',
                'municipio' => $_REQUEST['municipio'] ?? '',
                'cp' => $_REQUEST['cp'] ?? '',
                'estado' => $_REQUEST['estado'] ?? '',
            ];

            if ($toAdmin != '') {
                $this->sendNotification($toAdmin, $typeAdmin, $dataAdmin);
            }
        }
    }
    public function qvantel_webhook($data)
    {



        $global_options = get_option($this->plugin_name . '-general-settings');

        $sandbox = $global_options['sandbox'];

        if ($sandbox == '1') {
            $webhook_endpoint = 'https://public-webhook-sayco-preprod.qvantel.systems/api/onboarding/customer';
            $webhook_key = 'Basic YWRtaW46YWRtaW4=';
        } else {
            $webhook_endpoint = 'https://public-webhook-figou-prod.qvantel.solutions/api/onboarding/customer';
            $webhook_key = 'Basic YWRtaW46YWRtaW4=';
        }

        $headers = [
            'x-channel: mApp',
            'Content-Type: application/json',
            'Authorization: ' . $webhook_key
        ];
        $json = self::getJsonWebhookTemplate($data);

        $res = $this->curl_request($webhook_endpoint, $headers, 'POST', $json);


        return $res;
    }
    public function getJsonWebhookTemplate($data)
    {
        $jsonTemplate = <<<JSONTEMPALTE
        {
            "basket": {
                "salesPersonId": "vendedor",
                "paymentMethod": {
                    "paymentMethodId": "openpay",
                    "paymentMethodType": "openpay-external-payment",
                    "params": []
                },
                "basketItems": [{
                    "quantity": 1,
                    "characteristics": [{
                        "value": "Activation",
                        "key": "CH_ServiceActivationType"
                    }],
                    "productId": ":productId",
                    "CH_ICC": "89521400617:iccid",
                    "useICC": true
                }]
            },
            "customer": {
                "individual": {
                    "nationality": "MX",
                    "gender": "other",
                    "familyName": ":firstname",
                    "givenName": ":lastname"
                },
                "contactMedia": [{
                    "role": "primary",
                    "validFor": {
                        "startDatetime": "2018-04-12T10:07:51.276Z",
                        "endDatetime": "2032-04-12T10:07:51.276Z"
                    },
                    "medium": {
                        "telephoneNumber": {
                            "number": "string",
                            "numberType": "fixed-line"
                        },
                        "emailAddress": {
                            "email": ":email"
                        },
                        "postalAddress": {
                            "city": ":colonia",
                            "coAddress": ":referencias",
                            "apartment": ":exterior",
                            "country": "MX",
                            "building": "0",
                            "postalCode": ":cp",
                            "street": ":dir",
                            "stateOrProvince": ":estado",
                            "county": ":municipio"
                        }
                    }
                }],
                "identifications": [{
                    "expirationDate": "2024-11-25",
                    "identificationId": "12345678901",
                    "issuingAuthority": {
                        "city": ":colonia",
                        "name": ":firstname",
                        "country": "MX",
                        "county": ":municipio",
                        "stateOrProvince": ":estado"
                    },
                    "issuingDate": "2018-04-12T10:07:51.276Z",
                    "identificationType": "personal-identity-code",
                    "validFor": {
                        "startDatetime": "2018-04-12T10:07:51.276Z",
                        "endDatetime": "2032-04-12T10:07:51.276Z"
                    }
                }]
            }
        
        }
JSONTEMPALTE;
        $search = [
            ':productId' => $data['productId'],
            ':iccid' => $data['iccid'],
            ':firstname' => $data['firstname'],
            ':lastname' => $data['lastname'],
            ':email' => $data['email'],
            ':colonia' => $data['colonia'],
            ':referencias' => $data['referencias'],
            ':exterior' => $data['exterior'],
            ':cp' => $data['cp'],
            ':dir' => $data['dir'],
            ':estado' => $data['estado'],
            ':municipio' => $data['municipio'],

        ];
        $json = json_encode(json_decode(str_replace(array_keys($search), array_values($search), $jsonTemplate), true));
        return $json;
    }
}
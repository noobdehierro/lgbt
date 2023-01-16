<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/includes
 * @author     Raul Silva <raul.silva@leancommerce.com.mx>
 */
class Figou_Integrations_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$offering_page_args = array(
			'post_title'   => __( 'Contrata', 'contrata-plan' ),
			'post_content' => '[qvantel-offering]',
			'post_status'  => 'publish',
			'post_type'    => 'page'
		);


		$offering_page_id = wp_insert_post( $offering_page_args );

		add_option( 'figou_integrations_offering_page_id', $offering_page_id );

        $recharge_page_args = array(
            'post_title'   => __( 'Recarga', 'recarga' ),
            'post_content' => '[qvantel-recharging]',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        );

        $recharge_page_id = wp_insert_post( $recharge_page_args );

        add_option( 'figou_integrations_recharge_page_id', $recharge_page_id );

        $activation_page_args = array(
            'post_title'   => __( 'Activa tu SIM', 'activa-tu-sim' ),
            'post_content' => '[qvantel-activation]',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        );

        $activation_page_id = wp_insert_post( $activation_page_args );

        add_option( 'figou_integrations_activation_page_id', $activation_page_id );

        $imei_page_args = array(
            'post_title'   => __( 'Compatibilidad', 'compatibilidad' ),
            'post_content' => '[qvantel-imei]',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        );

        $imei_page_id = wp_insert_post( $imei_page_args );

        add_option( 'figou_integrations_imei_page_id', $imei_page_id );

        $map_page_args = array(
            'post_title'   => __( 'Cobertura', 'cobertura' ),
            'post_content' => '[igou-map]',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        );

        $map_page_id = wp_insert_post( $map_page_args );

        add_option( 'figou_integrations_map_page_id', $map_page_id );




	}

}

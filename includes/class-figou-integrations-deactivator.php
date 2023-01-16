<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/includes
 * @author     Raul Silva <raul.silva@leancommerce.com.mx>
 */
class Figou_Integrations_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		$offering_page_id = get_option( 'figou_integrations_offering_page_id' );
        $recharge_page_id = get_option('figou_integrations_recharge_page_id');
        $activation_page_id = get_option('figou_integrations_activation_page_id');
        $imei_page_id = get_option('figou_integrations_imei_page_id');
        $map_page_id = get_option('figou_integrations_map_page_id');

		if ( $offering_page_id ) {

			wp_delete_post( $offering_page_id, true );

			delete_option( 'figou_integrations_offering_page_id' );

		}

        if ( $recharge_page_id ) {

            wp_delete_post( $recharge_page_id, true );

            delete_option( 'figou_integrations_recharge_page_id' );

        }

        if ( $activation_page_id ) {

            wp_delete_post( $activation_page_id, true );

            delete_option( 'figou_integrations_activation_page_id' );

        }

        if ( $imei_page_id ) {

            wp_delete_post( $imei_page_id, true );

            delete_option( 'figou_integrations_imei_page_id' );

        }

        if ( $map_page_id ) {

            wp_delete_post( $map_page_id, true );

            delete_option( 'figou_integrations_map_page_id' );

        }
	}

}

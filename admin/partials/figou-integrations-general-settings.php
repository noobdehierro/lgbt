<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.leancommerce.mx
 * @since      1.0.0
 *
 * @package    Figou_Integrations
 * @subpackage Figou_Integrations/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1><?= esc_html( __( 'Configuración general', 'figou-integrations' ) ); ?></h1>
<hr class="wp-header-end">
<?php settings_errors(); ?>
<div class="notice notice-warning">
    <p>
        <?= esc_html( __( 'El cambio de estos parámetros afectaran la operación del sitio.') )?>
    </p>
</div>
<div id="wrap">
    <form action="options.php" method="post">
		<?php
		settings_fields( 'figou-integrations-general-settings' );
		do_settings_sections( 'figou' );
		submit_button();
		?>
    </form>
</div>
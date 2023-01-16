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
<h2>Figou Settings Page</h2>
<div id="wrap">
    <form action="options.php" method="post">
        <?php
        settings_fields( 'figou_settings' );
        do_settings_sections( 'figou' );
        submit_button();
        ?>
    </form>
</div>
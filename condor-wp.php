<?php
/**
 * Plugin Name: Condor Portal
 * Plugin URI:  http://www.condor.nl/developers/condor-portal-plugin
 * Description: Condor portal functions
 * Version:     1.0
 * Author:      Condor B.V. 
 * Author URI:  https://www.condor.nl
 * Copyright:   2020 Condor B.V.
 */

//  Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

function condor_portal_menu() {
	add_options_page('Condor Portal Options','Condor Portal','manage_options','condor_portal','condor_portal_options_page');
}
add_action('admin_menu', 'condor_portal_menu');

function condor_portal_register() {
	add_option('condor_portal_url', '');
	register_setting('condor_portal_settings', 'condor_portal_url');
	register_setting('condor_portal_settings', 'condor_portal_user');
	register_setting('condor_portal_settings', 'condor_portal_pwd');
}
add_action('admin_init', 'condor_portal_register');

?>

<?php
function condor_portal_options_page() { 
?>
  <div class-"wrap">
  <h1>Condor Settings</h1>
  <form method="post" action="options.php">
  <?php settings_fields( 'condor_portal_settings' ); ?>
  <?php do_settings_sections( 'condor_portal_settings' ); ?>
	<table class="form-table">
        <tr valign="top">
	        <th scope="row">Condor URL</th>
    	    <td><input type="text" name="condor_portal_url" value="<?php echo esc_attr( get_option('condor_portal_url') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        	<th scope="row">OData User</th>
        	<td><input type="text" name="condor_portal_user" value="<?php echo esc_attr( get_option('condor_portal_user') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">OData Password</th>
        <td><input type="text" name="condor_portal_pwd" value="<?php echo esc_attr( get_option('condor_portal_pwd') ); ?>" /></td>
        </tr>
    </table>  
  
  <?php submit_button(); ?>
  
  </form>
  </div>
<?php } ?>




<?php
/**
 * Plugin Name: Condor WP plugin
 * Plugin URI:  https://github.com/condor-software/condor-wp
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

function condor_menu() {
	add_options_page('Condor Options','Condor','manage_options','condor','condor_options_page');
}
add_action('admin_menu', 'condor_menu');

function condor_register() {
	add_option('condor_url', '');
	register_setting('condor_settings', 'condor_url');
	register_setting('condor_settings', 'condor_user');
	register_setting('condor_settings', 'condor_pwd');
}
add_action('admin_init', 'condor_register');

?>

<?php
function condor_options_page() { 
?>
  <div class-"wrap">
  <h1>Condor Settings</h1>
  <form method="post" action="options.php">
  <?php settings_fields( 'condor_settings' ); ?>
  <?php do_settings_sections( 'condor_settings' ); ?>
	<table class="form-table">
        <tr valign="top">
	        <th scope="row">Condor URL</th>
    	    <td><input type="text" name="condor_url" value="<?php echo esc_attr( get_option('condor_url') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        	<th scope="row">OData User</th>
        	<td><input type="text" name="condor_user" value="<?php echo esc_attr( get_option('condor_user') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">OData Password</th>
        <td><input type="text" name="condor_pwd" value="<?php echo esc_attr( get_option('condor_pwd') ); ?>" /></td>
        </tr>
    </table>  
  
  <?php submit_button(); ?>
  
  </form>
  </div>
<?php } ?>




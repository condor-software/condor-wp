<?php
function condor_menu() {
    add_options_page('Condor Options','Condor','manage_options','condor','condor_options_page');
}
add_action('admin_menu', 'condor_menu');

function condor_register() {
	register_setting('condor_settings', 'condor_url');
	register_setting('condor_settings', 'condor_user');
	register_setting('condor_settings', 'condor_pwd');
}
add_action('admin_init', 'condor_register');


function condor_test_connection(){

    //"Authorization": "Basic " + base64.encode(username + ":" + password)

    $url = 'https://demo.condor.nl/odata/WorkflowDefinitions?$filter=Category eq \'Meldingen\' and IsActive';

    $args = array(
      'headers' => array(
      'Authorization' => 'Basic Q29uZG9yOk1NTnU5N3dYNXpGYQ=='
      ));

    return wp_remote_get( $url, $args);

}
//add_action('settings_updated', 'condor_test_connection');

function condor_options_page() {

    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {

        $response = condor_test_connection();

        if ( is_array( $response ) && ! is_wp_error( $response ) ) {
            $headers = $response['headers']; // array of http header lines
            $body    = $response['body']; // use the content

            // add settings saved message with the class of "updated"
            add_settings_error( 'condor_messages', 'condor_connection_success', $body, 'success' );
        }


    }

    settings_errors('condor_messages');


?>
<div class-"wrap">
    <h1>Condor Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'condor_settings' );?>
        <?php do_settings_sections( 'condor_settings' );?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Condor URL</th>
                <td>
                    <input type="text" name="condor_url" value="<?php echo esc_attr( get_option('condor_url') );?>" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">OData User</th>
                <td>
                    <input type="text" name="condor_user" value="<?php echo esc_attr( get_option('condor_user') );?>" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">OData Password</th>
                <td>
                    <input type="password" name="condor_pwd" value="<?php echo esc_attr( get_option('condor_pwd') );?>" />
                </td>
            </tr>
            <tr valign="top">
                <td>
                    <input type="button" value="TEST" onclick="condor_test_connection();" />
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>

<script>
        function condor_test_connection() {
        jQuery.ajax(
          {
            url: '<?php echo plugins_url(); ?>/condor-wp/odata.php',
            type: 'post',
            data: {"funcNo":"1"}
          }
        ).done(function (response) { console.log(response); });
}
</script>

<?php }?>
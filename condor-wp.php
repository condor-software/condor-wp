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

/*
function condor_enqueue($hook) {
    wp_enqueue_script('condor-script', plugin_dir_url(__FILE__) . '/condor.js', array ('jquery'));
}
add_action('admin_enqueue_scripts', 'condor_enqueue');
*/

//  Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {exit;}

include 'options.php';



?>
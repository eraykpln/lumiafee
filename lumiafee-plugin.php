<?php
/**
 * Plugin Name:       LumiaFee Plugin
 * Plugin URI:        http://lumiasoft.com/lumiafee
 * Description:       Adds a fee to selected payment methods.
 * Version:           1.0.0
 * Author:            Lumiasoft
 * Author URI:        http://lumiasoft.com/
 * License:           GPL v2 or later
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'LUMIAFEE_VERSION', '1.0.0' );

function run_lumiafee() {
    require plugin_dir_path( __FILE__ ) . 'includes/class-lumiafee.php';
    $plugin = new LumiaFee();
    $plugin->run();
}

run_lumiafee();

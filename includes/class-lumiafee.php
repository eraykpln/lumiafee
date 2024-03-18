<?php

class LumiaFee {

    private $loader;
    private $plugin_name;
    private $version;

    public function __construct() {
        if ( defined( 'LUMIAFEE_VERSION' ) ) {
            $this->version = LUMIAFEE_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'lumiafee';

        $this->load_dependencies();
        $this->define_admin_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lumiafee-loader.php';
        $this->loader = new LumiaFeeLoader();
    }

    private function define_admin_hooks() {
        // Admin hooks
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_loader() {
        return $this->loader;
    }

    public function get_version() {
        return $this->version;
    }
}

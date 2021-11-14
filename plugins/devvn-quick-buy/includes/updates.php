<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if(!class_exists('quickbuy_auto_update')) {
    class quickbuy_auto_update
    {
        /**
         * The plugin current version
         * @var string
         */
        public $current_version;

        /**
         * The plugin remote update path
         * @var string
         */
        public $update_path;

        /**
         * Plugin Slug (plugin_directory/plugin_file.php)
         * @var string
         */
        public $plugin_slug;

        /**
         * Plugin name (plugin_file)
         * @var string
         */
        public $slug;

        /**
         * Initialize a new instance of the WordPress Auto-Update class
         * @param string $current_version
         * @param string $update_path
         * @param string $plugin_slug
         */
        function __construct($current_version, $update_path, $plugin_slug)
        {
            // Set the class public variables
            $this->current_version = $current_version;
            $this->update_path = $update_path;
            $this->plugin_slug = $plugin_slug;

            list ($t1, $t2) = explode('/', $plugin_slug);
            $this->slug = str_replace('.php', '', $t2);

            // define the alternative API for updating checking
            add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_update'));

            // Define the alternative response for information checking
            add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
        }

        /**
         * Add our self-hosted autoupdate plugin to the filter transient
         *
         * @param $transient
         * @return object $ transient
         */
        public function check_update($transient)
        {
            if (empty($transient->checked)) {
                return $transient;
            }

            // Get the remote version
            $remote_version = $this->getRemote_version();
            $remote_infor = $this->getRemote_information();

            // If a newer version is available, add the update
            if (version_compare($this->current_version, $remote_version, '<')) {
                $obj = new stdClass();
                $obj->slug = $this->slug;
                $obj->new_version = $remote_version;
                $obj->url = $remote_infor->download_link;
                $obj->package = $remote_infor->download_link;
                $transient->response[$this->plugin_slug] = $obj;
            }
            return $transient;
        }

        /**
         * Add our self-hosted description to the filter
         *
         * @param boolean $false
         * @param array $action
         * @param object $arg
         * @return bool|object
         */
        public function check_info($false, $action, $arg)
        {
            if( $action !== 'plugin_information' ) return false;
            if ($arg->slug == $this->slug) {
                $information = $this->getRemote_information();
                return $information;
            }
            return false;
        }

        /**
         * Return the remote version
         * @return string $remote_version
         */
        public function getRemote_version()
        {
            $request = wp_remote_post($this->update_path, array('body' => array('getremote' => 'version')));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return $request['body'];
            }
            return false;
        }

        /**
         * Get information about the remote version
         * @return bool|object
         */
        public function getRemote_information()
        {
            $request = wp_remote_post($this->update_path, array('body' => array('getremote' => 'info', 'slug'   =>  $this->slug)));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return unserialize($request['body']);
            }
            return false;
        }

        /**
         * Return the status of the plugin licensing
         * @return boolean $remote_license
         */
        public function getRemote_license()
        {
            $request = wp_remote_post($this->update_path, array('body' => array('getremote' => 'license')));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return $request['body'];
            }
            return false;
        }
    }

    add_action('init', 'devvn_quickbuy_auto_update' );
    function devvn_quickbuy_auto_update()
    {
        global $quickbuy_settings;
        $license_key = isset($quickbuy_settings['license_key']) ? sanitize_text_field($quickbuy_settings['license_key']) : '';
        $devvn_plugin_current_version = DEVVN_QB_VERSION_NUM;
        $devvn_plugin_remote_path = 'http://license.levantoan.com/wp-admin/admin-ajax.php?action=devvn_update&slug=devvn-quick-buy&getremote=update&license='.$license_key;
        $devvn_plugin_slug = DEVVN_QB_BASENAME;
        new quickbuy_auto_update ($devvn_plugin_current_version, $devvn_plugin_remote_path, $devvn_plugin_slug);
    }
}
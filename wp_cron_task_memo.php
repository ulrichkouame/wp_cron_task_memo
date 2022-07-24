<?php

/**
 * Plugin Name: WP cron task Memo
 * Description: Memo pour créer des taches cron dans WP
 * Version: 1.0
 * Author: Loïc Laurent
 * Author URI: https://www.loiclaurent.com
*/

class demoCron {

    protected $adminEmail;

    public function __construct() {

        // cron task
        add_action('my_cron_task', array($this, 'cronTask'));

        // activation du plugin
        register_activation_hook(__FILE__, array($this, 'activation'));

        // désactivation du plugin
        register_deactivation_hook(__FILE__, array($this, 'desactivation'));

        $this->adminEmail = get_option( 'admin_email', '' );
    }

    public function activation() {
        // register cron task
        wp_mail( $this->adminEmail, 'Activation du cron', 'Activation du cron' );
        if (!wp_next_scheduled('my_cron_task')) {
            wp_schedule_event( time(), 'hourly', 'my_cron_task' );
        }
    }
    public function desactivation() {
        // de-register cron task
        wp_mail( $this->adminemail, 'Déctivation du cron', 'Déctivation du cron' );
        if (wp_next_scheduled('my_cron_task')) {
            $timeStamp = wp_next_scheduled('my_cron_task');
            wp_unschedule_event( $timeStamp, 'my_cron_task');
        }
    }

    public function cronTask() {

        // Do something
        wp_mail( $this->adminEmail, 'Passage du cron', 'Passage du cron' );
    }
}

new demoCron;

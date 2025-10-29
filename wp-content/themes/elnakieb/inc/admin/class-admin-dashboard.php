<?php

/**
 * [Elnakieb_Admin description]
 */
if (!class_exists('Elnakieb_Admin')) {
    class Elnakieb_Admin{

        private static $instance = null;

        /**
         * register instance
         *
         * @return void
         */
        public static function init(){
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * init Construct
         */
        public function __construct(){
            add_action('init', [$this, 'elnakieb_tgm_dashboard'], 1);
            add_action('admin_menu', [$this, 'Elnakieb_Admin_dashboard'], 1);
            add_action('admin_menu', [$this, 'elnakieb_template_dashboard'], 20);
            add_action('ocdi/plugin_page_setup', [$this, 'elnakieb_import_dsb'], 20);
            add_action('admin_enqueue_scripts', array($this, 'elnakieb_admin_enqueue_scripts'));
        }

        /**
         * Admin Dashboard
         *
         * @return void
         */
        public function Elnakieb_Admin_dashboard(){
            add_menu_page(
                esc_html__('Elnakieb', 'elnakieb'),
                esc_html__('Elnakieb', 'elnakieb'),
                'manage_options',
                'elnakieb',
                [$this, 'display_elnakieb_admin_dashboard'],
                get_template_directory_uri() . '/inc/admin/assets/img/favicon.png',
                2
            );


        }

        /**
         * Template Dashboard
         *
         * @return void
         */
        public function elnakieb_template_dashboard() {
            add_submenu_page(
                'elnakieb',
                esc_html__('Templates', 'elnakieb'),
                esc_html__('Templates', 'elnakieb'),
                'manage_options',
                'edit.php?post_type=eergx_template',
                false
            );
        }

        /**
         * admin style Add
         */
        public function elnakieb_admin_enqueue_scripts()
        {
            wp_enqueue_style('elnakieb-admin', get_theme_file_uri('inc/admin/assets/css/admin.css'), array(), null, 'all');
        }

        public function display_elnakieb_admin_dashboard()
        {
            require_once ELNAKIEB_INC_DRI . 'admin/admin-page.php';
        }

        public function elnakieb_tgm_dashboard()
        {
            require_once ELNAKIEB_INC_DRI . 'admin/class-tgm-plugin-activation.php';
            require_once ELNAKIEB_INC_DRI . 'admin/plugin-activation.php';
        }

        public function elnakieb_import_dsb($default)
        {
            $default['parent_slug'] = 'elnakieb';
            $default['page_title'] = esc_html__('One Click Demo Import', 'elnakieb');
            $default['menu_title'] = esc_html__('Import Demo Data', 'elnakieb');
            $default['capability'] = 'import';
            $default['menu_slug'] = 'one-click-demo-import';

            return $default;
        }
    }
    Elnakieb_Admin::init();
}

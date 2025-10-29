<?php 

if(!function_exists('elnakieb_register_custom_icon_library')){
    add_filter('elementor/icons_manager/additional_tabs', 'elnakieb_register_custom_icon_library');
    function elnakieb_register_custom_icon_library($tabs){
        $custom_tabs = [
            'extra_icon2' => [
                'name' => 'elnakieb-flat-icon',
                'label' => esc_html__( 'Flaticon', 'elnakieb-plugin' ),
                'url' => get_template_directory_uri() . '/assets/css/flaticon_fd-icon.css',
                'enqueue' => [ get_template_directory_uri() . '/assets/css/flaticon_fd-icon.css' ],
                'prefix' => 'flaticon-',
                'displayPrefix' => 'flaticon',
                'labelIcon' => 'family-insurance',
                'ver' => ELNAKIEB_VERSION,
                'fetchJson' => get_template_directory_uri() . '/assets/js/flaticon.js?v='.ELNAKIEB_VERSION,
                'native' => true,
            ]
           

        ];

        $tabs = array_merge($custom_tabs, $tabs);

        return $tabs;
    }
}
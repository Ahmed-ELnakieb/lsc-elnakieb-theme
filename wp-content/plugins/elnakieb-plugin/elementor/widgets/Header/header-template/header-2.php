<div class="egx-header-2-area txa_sticky_header">
    <div class="container egx-header-2-container">
        <div class="egx-header-2-wrap">
            <div class="egx-header-2-row" >

                <a href="<?php echo esc_url(home_url());?>" aria-label="name" class="egx-header-2-logo d-block">
                    <img class="logo_site-size" src="<?php echo esc_url($settings['rzlogo']['url']);?>" alt="<?php if(!empty($settings['rzlogo']['alt'])){ echo esc_attr($settings['rzlogo']['alt']);}?>">
                </a>
                
                <!-- menu -->
                <nav class="main-navigation has-menu-2 d-none d-lg-block">
                    <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'], wp_nav_menu( array(
                            'echo'           => false,
                            'menu' => !empty($settings['choose-menu']) ? $settings['choose-menu'] : 'menu-1',
                            'menu_id'        =>'main-nav',
                            'menu_class'        =>'nav navbar-nav clearfix',
                            'container'=>false,
                            'fallback_cb'    => 'Navwalker_Class::fallback',
                            'walker'         => class_exists( 'Rs_Mega_Menu_Walker' ) ? new \Rs_Mega_Menu_Walker : '',
                        )) );
                    ?>
                </nav>

                
            </div>

            <!-- actions -->
            <div class="egx-header-2-action">

                <?php if(!empty($settings['btn_label'])):?>
                    <a <?php echo $this->get_render_attribute_string( 'btn_link' ); ?> class="egx-btn-2 header-btn">
                        <span class="btn-text"><?php echo eergx_wp_kses($settings['btn_label']);?></span>
                    </a>
                <?php endif;?>
                <?php if($settings['cart_count'] === 'yes' && class_exists('Woocommerce') ):?>
                <a href="#" class="cart-btn">
                    <span class="icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                    <span class="number"><?php
							if (class_exists('WooCommerce') && WC()->cart) {
								$count = WC()->cart->cart_contents_count;
							} else {
								$count = 0;
							}

							if ( $count == 0 ) {
								echo '0';
							} else {
								echo '' . esc_html( $count ) . '';
							}
						?></span>
                </a>

                <?php endif;?>

                <button class="egx-header-2-search-btn search_btn_toggle">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

            </div>

            <!-- menu btn -->
            <button class="egx-menu-btn-1 d-lg-none open_menu open_mobile_menu" id="menuToggle">
                <svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 24 24"
                    style="enable-background:new 0 0 24 24;" xml:space="preserve">
                    <path class="svg-path" d="M1,12h22 M1,4.7h22 M8.3,19.3H23"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
<?php $this->mobile_menu(); $this->___search_body();?>
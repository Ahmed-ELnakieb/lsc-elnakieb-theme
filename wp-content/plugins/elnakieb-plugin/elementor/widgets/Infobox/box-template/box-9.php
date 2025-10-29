<div class="egx-team-details-wrap">
    <div class="feature">
        <?php foreach($settings['infos'] as $item):?>
            <div class="item">
                <div class="top">
                    <span class="icon">
                        <?php if ($item['type'] === 'image' && ($item['icon_img']['url'])) :?>
                            <img src="<?php echo esc_url($item['icon_img']['url']);?>" alt="<?php if(!empty($item['icon_img']['alt'])){ echo esc_attr($item['icon_img']['alt']);}else{esc_attr_e('List', 'goyto-plugin');}?>">
                        <?php else:?>
                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php endif;?>
                    </span>
                    <?php if(!empty($item['title'])):?>
                        <h5 class="egx-heading-1 title"><?php echo eergx_wp_kses($item['title'])?></h5>
                    <?php endif;?>
                </div>
                <?php if(!empty($item['description'])):?>
                <p class="egx-para-1 disc"><?php echo eergx_wp_kses($item['description'])?></p><?php endif;?>
            </div>
        <?php endforeach;?>
    </div>
</div>
<?php
global $set;
wp_footer();
if ($set['code']['footcode'] != null) {
    echo $set['code']['footcode'];
}
?>
<div class="footer-plane">
    <div class="footer-container">
        <div>
            <?php dynamic_sidebar('footer_widget'); ?>
        </div>
        <div>
            <?php
            get_template_part('component/nav-footer');
            ?>
            <div class="footer-info">
                Copyright © 2020 <?php bloginfo('name');?> · <a href="https://www.lovestu.com">CorePress主题</a> · <?php echo $set['routine']['icp'] ?>
            </div>
        </div>
        <div class="footer-details">
            <div><?php
                if ($set['routine']['footer_1_imgurl'] != null) {
                    ?>
                    <img src="<?php echo $set['routine']['footer_1_imgurl'] ?>" alt="">
                    <?
                } else {
                    ?>
                    <img src="<?php echo THEME_IMG_PATH . '/ewm.png' ?>" alt="">
                    <?
                }
                ?>
                <p><?php echo $set['routine']['footer_1_imgname'] ?></p>
            </div>
            <div>
                <?php
                if ($set['routine']['footer_2_imgurl'] != null) {
                    ?>
                    <img src="<?php echo $set['routine']['footer_2_imgurl'] ?>" alt="">
                    <?
                } else {
                    ?>
                    <img src="<?php echo THEME_IMG_PATH . '/ewm.png' ?>" alt="">
                    <?
                }
                ?>
                <p><?php echo $set['routine']['footer_2_imgname'] ?></p>
            </div>
        </div>
    </div>
</div>


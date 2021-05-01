<?php
global $paged;
if (!$paged) {
    $paged = 1;
}

if (is_home() && $paged == 1) {
    global $set;

    if (wp_is_mobile()) {
        if ($set['ad']['index_1_phone'] != null) {
            ?>
            <div class="swiper-container carousel">
                <?php echo base64_decode($set['ad']['index_1_phone']); ?>
            </div>
            <?php
        }
    } else {
        if ($set['ad']['index_1'] != null) {
            ?>
            <div class="swiper-container carousel">
                <?php echo base64_decode($set['ad']['index_1']); ?>
            </div>
            <?php
        }
    }

    if ($set['index']['swiperlist'] != null || count($set['index']['swiperlist']) > 0) {
        ?>
        <?php if ($set['index']['swiperlist'] !== null && count($set['index']['swiperlist'])) {
            ?>
            <div>
                <div class="swiper-container carousel">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($set['index']['swiperlist'] as $item) {
                            $target = '_blank';
                            if ($item['url'] == null) {
                                $item['url'] = 'javascript:void(0);';
                                $target = '';
                            }
                            echo '<div class="swiper-slide"><a href="' . $item['url'] . '" target="' . $target . '"><img src="' . $item['imgurl'] . '" alt=""></a>';
                            if ($item['title'] != null) {
                                echo '<h3 class="slide-title">' . $item['title'] . '</h3>';
                            }
                            echo '</div>'
                            ?>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        <?php } ?>
        <script>
            window.onload = function () {
                var mySwiper = new Swiper('.swiper-container', {
                    loop: true,
                    autoplay: true,
                    delay: 3000,
                    pagination: {
                        el: '.swiper-pagination',
                    },
                    // 如果需要前进后退按钮
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                })
            }
        </script>
        <?php
    }
    if ($set['index']['postcard'] != null || count($set['index']['postcard']) > 0) {
        $item_percent = 100 / $set['index']['postcardlinenumber'] - 1;
        ?>
        <style>
            .index-top-postcard-item {
                flex-basis: <?php echo $item_percent.'%';?>;
            }
        </style>
        <div class="index-top-postcard-plane">
            <div class="index-top-postcard-body">
                <?php
                foreach ($set['index']['postcard'] as $item) {
                    ?>
                    <div class="index-top-postcard-item">
                        <div class="index-top-postcard-main">
                            <div class="post-item-thumbnail">
                                <a href="<?php echo $item['url'] ?>"><img src="<?php echo $item['imgurl'] ?>"
                                                                          alt=""></a>
                            </div>
                            <?php if ($item['url'] != null) {
                                ?>
                                <div class="index-top-postcard-title">
                                    <a href="<?php echo $item['url'] ?>"><?php echo $item['title'] ?></a>
                                </div>
                                <?php
                            } ?>
                        </div>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

}

if (wp_is_mobile()) {
    if ($set['ad']['index_2_phone'] != null) {
        ?>
        <div class="swiper-container carousel">
            <?php echo base64_decode($set['ad']['index_2_phone']); ?>
        </div>
        <?php
    }
} else {
    if ($set['ad']['index_2'] != null) {
        ?>
        <div class="swiper-container carousel">
            <?php echo base64_decode($set['ad']['index_2']); ?>
        </div>
        <?php
    }
}
?>

<div class="post-list-page-plane">
    <div class="list-plane-title">
        <?php
        if (is_category()) {
            echo ' <div>' . single_cat_title('', false) . '</div>';
        } elseif (is_home()) {
            ?>
            <div class="index-tab-plane">
                <div class="<?php if ($set['index']['tab_ids'] != null && $set['theme']['paging'] == 'ajax') echo 'index-tab-item index-tab-item-active' ?>"
                     catid="0">最新文章
                </div>
                <?php
                if ($set['index']['tab_ids'] != null && $set['theme']['paging'] == 'ajax') {
                    $tabids_arr = explode(',', $set['index']['tab_ids']);
                    foreach ($tabids_arr as $catid) {
                        if (!is_numeric($catid)) {
                            echo '<div>ID填写错误</div>';
                            break;
                        }
                        $cat_name = get_cat_name($catid);
                        echo '<div class="index-tab-item" catid="' . $catid . '">' . $cat_name . '</div>';
                    }
                }
                ?>
            </div>
        <?php

        if ($set['index']['tab_ids'] != null && $set['theme']['paging'] == 'ajax') {
        ?>
            <script>
                var nowid = $('.index-tab-item-active').attr('catid');
                $('.index-tab-item').click(function () {
                    if (nowid == $(this).attr('catid')) {
                        return;
                    }
                    nowid = $(this).attr('catid');
                    paged = 2;
                    $('.index-tab-item').removeClass('index-tab-item-active');
                    $(this).addClass('index-tab-item-active');
                    $('.post-list').html('<div class="post-item post-loading"><i class="far fa-circle-notch fa-spin"></i> 加载中</div>');
                    $.post('<?php echo AJAX_URL?>', {
                        action: 'corepress_load_post_by_tabs',
                        cat: $(this).attr('catid')
                    }, function (data) {
                        $('.post-list').html(data);
                        <?php
                        if ($set['module']['imglazyload'] == 1) {
                            echo ' $("img").lazyload({effect: "fadeIn"});';
                        }
                        ?>
                    })
                });
            </script>
            <?php
        }
            ?>
            <?php
        } elseif (is_author()) {
            echo '<div>' . get_the_author() . ' 的文章</div>';
        } elseif (is_tag()) {
            $term = get_queried_object();
            echo ' <div>包含标签：' . $term->name . ' 的文章</div>';
        } else {
            echo ' <div>最新文章</div>';
        }
        ?>
    </div>
    <ul class="post-list">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('component/post-list-item');
            }
        }
        ?>
    </ul>
    <div class="pages">
        <?php
        if ($set['theme']['paging'] == 'ajax') {
            get_template_part('component/pageobj-ajax');

        } else {
            get_template_part('component/pageobj');

        }
        ?>
    </div>
</div>


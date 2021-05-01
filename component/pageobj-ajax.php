<?php
global $paged, $wp_query, $set;
if (!isset($max_page)) {
    $max_page = null;
}
if (!$max_page) {
    $max_page = $wp_query->max_num_pages;
}

if ($max_page > 1) {
    ?>
    <button class="index-load-more-btn"><i class="far fa-circle-notch"></i> 加载更多</button>
    <?php
}
?>

<script>
    var paged =<?php echo $paged + 1;?>;
    var max_page =<?php echo $max_page ?>;
    $('.index-load-more-btn').click(() => {
        var btn_cloass = '.index-load-more-btn';
        if (paged >= max_page) {
            $(btn_cloass).text('到底啦');
            return;
        }
        $(btn_cloass).html('<i class="far fa-circle-notch fa-spin"></i> 加载中');
        $.post('<?php echo AJAX_URL?>', {
            action: 'corepress_load_post',
            page: paged,
            cat: $('.index-tab-item-active').attr('catid')
        }, (data) => {

            if (data.length == 0) {
                $(btn_cloass).html('<i class="far fa-circle-notch"></i> 到底啦');
            } else {
                $(btn_cloass).html('<i class="far fa-circle-notch"></i> 加载更多');
            }
            $('.post-list').append(data);
            <?php
            if ($set['module']['imglazyload'] == 1) {
                echo ' $("img").lazyload({effect: "fadeIn"});';
            }
            ?>
            paged++;
        })
    })

</script>

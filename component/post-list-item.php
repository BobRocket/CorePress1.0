<?php
global $set;
if (has_excerpt()) {
    $postitem['content'] = get_the_excerpt();
    if (strlen(preg_replace("/[\s]{2,}/","", $postitem['content'])) == 0) {
        $postitem['content'] = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, $set['routine']['summary_lenth'], "……");
    }
} else {
    $postitem['content'] = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, $set['routine']['summary_lenth'], "……");
}
$postitem['thumbnail'] = null;
if (has_post_thumbnail()) {
    $postitem['thumbnail'] = get_the_post_thumbnail_url($post, 'large');

} else {
    $postitem['thumbnail'] = THEME_IMG_PATH . '/thumbnail.png';
}
if ($postitem['thumbnail'] == null) {
    $postitem['thumbnail'] = $set['routine']['defaultthumbnail'];
}
$postitem['views'] = null;
if (function_exists('the_views')) {
    $postitem['views'] = intval(get_post_meta($post->ID, 'views', true));
}
$postitem['url'] = get_the_permalink();
$postitem['author'] = get_the_author();
$postitem['time'] = get_the_time('Y-m-d');
$postitem['commentsnum'] = get_comments_number();
$postitem['title'] = get_the_title();
$postitem['category'] = get_the_category();
//print_r($postitem['category']);
foreach ($postitem['category'] as $item) {
    $item->url = get_category_link($item->cat_ID);
}
?>
<li class="post-item">
    <div class="post-item-container">
        <div class="post-item-thumbnail">
            <img src="<?php echo $postitem['thumbnail'];
            ?>" alt="">
        </div>
        <div class="post-item-main">
            <h2>
                <a href="<?php echo $postitem['url'] ?>" target=""><?php echo $postitem['title']; ?></a>
            </h2>
            <div class="post-item-content">
                <?php echo $postitem['content'] ?>
            </div>
            <div class="post-item-info">
                <div class="post-item-tags">
                    <?php
                    foreach ($postitem['category'] as $catite) {
                        ?>
                        <i class="cat-item-mark"></i><span class="cat-item"><a
                                    href="<?php echo $catite->url ?>"><?php echo $catite->name ?></a></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="post-item-meta">
                    <div class="post-item-meta-time">
                        <?php echo $postitem['author'] ?>
                        <span class="post-item-time"><?php echo diffBetweenTwoDay($postitem['time']); ?></span>
                    </div>
                    <div class="item-post-meta-other">

                        <?php
                        if ($postitem['views'] != null) {
                            echo '<span><i class="fa fa-eye"
                                 aria-hidden="true"></i>';
                            echo $postitem['views'] . '</span>';
                        }
                        ?>
                        <span><i class="fa fa-comments"
                                 aria-hidden="true"></i><?php echo $postitem['commentsnum'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>

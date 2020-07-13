<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Referrer" content="origin"/>

<?php
global $set;
if ($set['code']['headcode'] != null) {
    echo $set['code']['headcode'];
}
if ($set['code']['css'] != null) {
    echo "<style>{$set['code']['css']}</style>";
}

if ($set['routine']['favicon'] != null) {
    ?>
    <link rel="icon" href="<?php echo $set['routine']['favicon'] ?>" type="image/x-icon"/>
    <?php
}
?>
<style>
    :root {
        --Maincolor: <?php echo $set['theme']['themeColor']?> !important;
        --MaincolorHover: #66b1ff;
    }
</style>
<?php
wp_head();
file_load_css('main-mobile.min.css');
file_load_css('main.min.css');
file_load_lib('fontawesome/css/font-awesome.min.css', 'css');
file_load_js('jquery.min.js');
if (is_home()) {
    file_load_lib('swiper/swiper.min.css', 'css');
    file_load_lib('swiper/swiper.min.js', 'js');
}

global $set;
if (is_home()) {
    if ($set['seo']['openseo'] == 1) {
        if ($set['seo']['indextitle'] != '') {
            $title = $set['seo']['indextitle'];

        } else {
            $title = get_bloginfo('name');
        }
    } else {
        $title = get_bloginfo('name');
    }
} elseif (is_single() || is_page()) {
    if ($set['seo']['openseo'] == 1) {
        $delimiter = $set['seo']['title_delimiter'];
        if ($set['seo']['titlestyle'] == 'site_title') {
            $title = get_bloginfo('name') . $delimiter . get_the_title();
        } elseif ($set['seo']['titlestyle'] == 'title_site') {
            $title = get_the_title() . $delimiter . get_bloginfo('name');
        } else {
            $title = get_the_title();
        }
    } else {
        $title = get_the_title();
    }

} elseif (is_category()) {
    $delimiter = $set['seo']['title_delimiter'];
    if ($set['seo']['openseo'] == 1) {
        if ($set['seo']['titlestyle'] == 'site_title') {
            $title = get_bloginfo('name') . $delimiter . single_cat_title('', false);
        } elseif ($set['seo']['titlestyle'] == 'title_site') {
            $title = single_cat_title('', false) . $delimiter . get_bloginfo('name');
        } else {
            $title = single_cat_title('', false);
        }
    } else {
        $title = single_cat_title('', false);
    }

} else {

    if ($set['seo']['openseo'] == 1) {
        $delimiter = $set['seo']['title_delimiter'];
        $title = wp_title($delimiter, false, 'right');
    } else {
        $title = wp_title('&raquo;', false, 'right');
    }
}
echo "<title>{$title}</title>";
$keywords = '';
$description = '';
if (is_home()) {
    if ($set['seo']['description'] != null) {
        $description = $set['seo']['description'];
    } else {
        $description = get_bloginfo('description');
    }

    if ($set['seo']['keyword'] != null) {
        $keywords = $set['seo']['keyword'];
    }

} else if (is_single() || is_page()) {
    global $post;
    $description = str_replace("\n", "", mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag) {
        $keywords = $keywords . $tag->name . ", ";
    }
    $keywords = rtrim($keywords, ', ');
} elseif (is_tag()) {
    // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
    $description = tag_description();
    $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
if ($set['seo']['openseo'] == 1) {
    ?>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <meta name="description" content="<?php echo $description; ?>"/>
    <?php
}
?>





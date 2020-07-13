<?php
define('THEME_NAME', 'CorePress');
define('THEME_VERSION', 1);
define('THEME_DOWNURL', 'https://www.lovestu.com');
define('THEME_VERSIONNAME', '1.0');
define('THEME_PATH', get_template_directory());
define('THEME_STATIC_PATH', '//'.$_SERVER['HTTP_HOST'].'/wp-content/themes/CorePress/static');
define('THEME_CSS_PATH', THEME_STATIC_PATH . '/css');
define('THEME_JS_PATH', THEME_STATIC_PATH . '/js');
define('THEME_LIB_PATH', THEME_STATIC_PATH . '/lib');
define('THEME_IMG_PATH', THEME_STATIC_PATH . '/img');
define('FRAMEWORK_PATH', THEME_PATH . '/geekframe');
require_once(FRAMEWORK_PATH . '/options.encrypt.php');
$set = options::getInstance()->getdata();
require_once(FRAMEWORK_PATH . '/utils.php');
require_once(FRAMEWORK_PATH . '/support.php');
require_once(FRAMEWORK_PATH . '/ajax.php');
require_once(THEME_PATH . '/widgets/comments.php');
add_editor_style('static/css/editor-style.css');
//自定义评论
function my_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    $reply = '';
    if ($depth > 0 && $comment->comment_parent) {
        $reply = get_comment_author($comment->comment_parent);

        if ($reply) {
            $reply = '<span class="comment-from">@<a href="#comment-' . $comment->comment_parent . '">' . $reply . '</a></span>';
        } else {
            $reply = '';
        }

    }
    ?>
    <li class="comment">
    <div class="comment-item" id="li-comment-<?php comment_ID(); ?>">
        <div class="comment-media">
            <div class="avatar-img">
                <?php if (function_exists('get_avatar') && get_option('show_avatars')) {
                    echo get_avatar($comment, 48);
                } ?>
            </div>
        </div>
        <div class="comment-metadata">
            <div class="media-body">
                <?php echo __('<p class="author_name">') . get_comment_author_link() . $reply . '</p>'; ?>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em>评论等待审核...</em><br/>
                <?php endif; ?>
                <div class="comment-text">
                    <?php echo comment_text(); ?>
                </div>

            </div>
            <span class="comment-pub-time">
   				<?php echo get_comment_time('Y-m-d H:i'); ?>
   			</span>
            <span class="comment-btn-reply">
 				<i class="fa fa-reply"></i> <?php comment_reply_link(array_merge($args, array('reply_text' => '回复', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
   			</span>
        </div>
    </div>

    <?php
}
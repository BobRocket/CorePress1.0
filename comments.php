<?php
if (post_password_required())
    return;
?>


<div id="comments" class="responsesWrapper">
    <div class="reply-title">
        发布评论
    </div>
    <?php
    /* if (islogin()) {
         $title_reply = '发表看法';
     } else {
         $title_reply = '发表看法<a href="'.loginAndBack().'"><button class="button login-btn">立即登录</button></a>';
     }*/
    $title_reply = '';
    ?>
    <?php if (comments_open()) {
        $comment_form_args = array(
            'submit_button' => '<div style="text-align: right"><input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" /></div>',
            'comment_notes_before' => '',
            'title_reply' => $title_reply,
            'class_submit' => 'button primary-btn',
            'label_submit' => __('提交评论', 'corePress'),
            'comment_notes_after' => '',
            'id_form' => 'form_comment',
            'cancel_reply_link' => __('取消回复', 'corePress'),
            'comment_field' => '<div class="comment_form_textarea_box"><textarea class="comment_form_textarea" name="comment" id="comment" placeholder="发表你的看法" rows="8"></textarea></div>',
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<div class="comment_userinput"><div class="comment-form-author"><input id="author" name="author" placeholder="昵称(*)" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . ($req ? ' class="required"' : '') . '></div>',
                'email' => '<div class="comment-form-email"><input id="email" name="email" type="text" placeholder="邮箱(*)" value="' . esc_attr($commenter['comment_author_email']) . '"' . ($req ? ' class="required"' : '') . '></div>',
                'url' => '<div class="comment-form-url"><input id="url" placeholder="网址"name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30"></div></div>',
                'cookies' => '<div class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . (empty($commenter['comment_author_email']) ? '' : ' checked="checked"') . '>记住用户信息</div>'
            )),
            'logged_in_as' => '<p class="logged-in-as">已登录用户：<a href="' . admin_url('profile.php') . '">' . $user_identity . '</a></p>'

        );
        comment_form($comment_form_args);

    } ?>
    <meta content="UserComments:<?php echo number_format_i18n(get_comments_number()); ?>" itemprop="interactionCount">
    <h3 class="comments-title">共有 <span
                class="commentCount"><?php echo number_format_i18n(get_comments_number()); ?></span> 条评论</h3>
    <ol class="commentlist">
        <?php
        wp_list_comments(array(
            'style' => 'ol',
            'short_ping' => true,
            'avatar_size' => 48,
            'type' => 'comment',
            'callback' => 'my_comment',
        ));
        ?>
    </ol>
    <script type='text/javascript' src='/wp-includes/js/comment-reply.min.js?ver=5.1.1'></script>
    <script type='text/javascript'>
        $('body').on('click', '.comment-reply-link', function () {
            addComment.moveForm("li-comment-" + $(this).attr('data-commentid'), $(this).attr('data-commentid'), "respond", $(this).attr('data-postid'));
            console.log("li-comment-" + $(this).attr('data-commentid'), $(this).attr('data-commentid'), "respond", $(this).attr('data-postid'));
            return false; // 阻止 a tag 跳转，这句千万别漏了
        });
    </script>
    <nav class="comment-navigation pages">
        <?php paginate_comments_links(array('prev_next' => true)); ?>
    </nav>
</div>
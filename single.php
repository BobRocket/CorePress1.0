<?php
the_post();
?>
    <!doctype html>
    <html lang="zh">
    <head>
        <?php get_header(); ?>
    </head>
    <body>
    <div id="app">
        <header>
            <div class="header-main container">
                <?php
                get_template_part('component/nav-header');
                ?>
            </div>
        </header>
        <main class="container">
            <div class="html-main">
                <?php
                global $set;
                if ($set['theme']['sidebar_position'] == 1) {
                    ?>
                    <div class="post-main">
                        <div class="post-content">
                            <h1 class="post-title">
                                <?php the_title() ?>
                            </h1>
                            <div class="post-info">
                                <?php
                                $author = get_the_author_meta('ID');
                                $author_url = get_author_posts_url($author);
                                $author_name = get_the_author();
                                ?>
                                <a class="nickname url fn j-user-card" data-user="<?php echo $author; ?>"
                                   href="<?php echo $author_url; ?>"><i class="fa fa-user"
                                                                        aria-hidden="true"></i><?php echo $author_name; ?>
                                </a>
                                <span class="dot">•</span>
                                <time class="entry-date published"
                                      datetime="<?php echo get_post_time('c', false, $post); ?>>" pubdate><i
                                            class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <?php echo format_date(get_post_time('U', false, $post)); ?>
                                </time>
                                <span class="dot">•</span><i class="fa fa-folder-o" aria-hidden="true"></i>
                                <?php the_category(', ', '', false); ?>
                                <?php if (function_exists('the_views')) {
                                    $views = intval(get_post_meta($post->ID, 'views', true));
                                    ?>
                                    <span class="dot">•</span>
                                    <span><i class="fa fa-eye"
                                             aria-hidden="true"></i><?php echo sprintf('%s 阅读', $views); ?></span>
                                <?php }
                                if (get_edit_post_link() != null) {

                                    ?>
                                    <span class="dot">•</span>
                                    <a href="<?php echo get_edit_post_link(); ?>"><i class="fa fa-pencil-square-o"
                                                                                     aria-hidden="true"></i>编辑</a>
                                    <?php
                                }

                                ?>


                            </div>
                            <div class="post-content-post">
                                <?php
                                the_content();
                                ?>
                            </div>

                        </div>
                        <?php
                        comments_template();
                        ?>
                    </div>

                    <div class="sidebar">
                        <?php dynamic_sidebar('post_sidebar'); ?>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="sidebar">
                        <?php dynamic_sidebar('post_sidebar'); ?>
                    </div>
                    <div class="post-main">
                        <div class="post-content">
                            <h1 class="post-title">
                                <?php the_title() ?>
                            </h1>
                            <div class="post-info">
                                <?php
                                $author = get_the_author_meta('ID');
                                $author_url = get_author_posts_url($author);
                                $author_name = get_the_author();
                                ?>
                                <a class="nickname url fn j-user-card" data-user="<?php echo $author; ?>"
                                   href="<?php echo $author_url; ?>"><i class="fa fa-user"
                                                                        aria-hidden="true"></i><?php echo $author_name; ?>
                                </a>
                                <span class="dot">•</span>
                                <time class="entry-date published"
                                      datetime="<?php echo get_post_time('c', false, $post); ?>>" pubdate><i
                                            class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <?php echo format_date(get_post_time('U', false, $post)); ?>
                                </time>
                                <span class="dot">•</span><i class="fa fa-folder-o" aria-hidden="true"></i>
                                <?php the_category(', ', '', false); ?>
                                <?php if (function_exists('the_views')) {
                                    $views = intval(get_post_meta($post->ID, 'views', true));
                                    ?>
                                    <span class="dot">•</span>
                                    <span><i class="fa fa-eye"
                                             aria-hidden="true"></i><?php echo sprintf('%s 阅读', $views); ?></span>
                                <?php }
                                if (get_edit_post_link() != null) {

                                    ?>
                                    <span class="dot">•</span>
                                    <a href="<?php echo get_edit_post_link(); ?>"><i class="fa fa-pencil-square-o"
                                                                                     aria-hidden="true"></i>编辑</a>
                                    <?php
                                }

                                ?>


                            </div>
                            <div class="post-content-post">
                                <?php
                                the_content();
                                ?>
                            </div>

                        </div>
                        <?php
                        comments_template();
                        ?>
                    </div>
                    <?php
                }

                ?>

            </div>
        </main>
        <footer>
            <?php get_footer(); ?>
        </footer>
    </div>
    </body>
    </html>
<?php

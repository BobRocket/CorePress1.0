
    <!doctype html>
    <html lang="zh">
    <head>
        <?php get_header(); ?>
    </head>
    <body>

    <div id="app">
        <header>
            <div class="header-main-plane">
                <div class="header-main container">
                    <?php
                    get_template_part('component/nav-header');
                    ?>
                </div>
            </div>
        </header>
        <style>
            .container-404 {
                padding: 20px;
                font-size: 20px;
            }
            .container-404 img {
                width: 60%;
                cursor: default;
                pointer-events: none;
            }
        </style>
        <main class="container container-404" style="text-align: center;margin-top: 100px">
            <div><?php file_load_img('404.svg'); ?></div>
            <div>哎呀，您访问的页面不存在<br> <a href="<?php echo home_url()?>">返回首页</a></div>
        </main>
        <footer>
            <?php
            wp_footer();
            get_footer(); ?>
        </footer>
    </div>
    </body>
    </html>
<?php

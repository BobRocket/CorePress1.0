<?php
// TEMPLATE NAME: CorrPress自定义用户设置页面
if (!islogin()) {
    header("Location: " . get_bloginfo('url'));
    exit();
}
global $set;
?>
<!doctype html>
<html lang="zh">
<head>
    <?php get_header(); ?>
</head>
<body>
<?php
file_load_css('login-plane.css');
file_load_css('cropper.min.css');
file_load_js('cropper.min.js');
file_load_js('jquery-cropper.min.js');
file_load_lib('layer/layer.js', 'js');
?>
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
    <div class="header-zhanwei" style="min-height: 80px;width: 100%;"></div>

    <main class="container">
        <div class="usercenter-plane">
            <div class="usercenter-left">
                <div class="usercenter-userinfo post-list-page-plane">
                    <div style="position: relative" class="avatar-plane">
                        <?php

                        if ($set['user']['upload_avatar'] == 1) {
                            ?>
                            <img class="user-avatar" title="更换头像" id="update-avatar" width="60" height="60"
                                 src="<?php echo corepress_get_avatar_url() ?>" alt="">
                            <?php
                        } else {
                            ?>
                            <img class="user-avatar" width="60" height="60"
                                 src="<?php echo corepress_get_avatar_url() ?>" alt="">
                            <?php
                        }
                        ?>

                        <br>
                        <br>
                    </div>

                    <div> <?php echo corepress_get_user_nickname() ?></div>
                </div>

                <div class="usercenter-menu post-list-page-plane">
                    <div class="usercenter-menu-item usercenter-menu-info usercenter-menu-item-active">
                        账号设置
                    </div>
                    <div class="usercenter-menu-item usercenter-menu-pwd">
                        密码设置
                    </div>
                    <div class="usercenter-menu-item usercenter-menu-bind">
                        账号绑定
                    </div>
                </div>
            </div>

            <?php
            $currentUser = wp_get_current_user();
            ?>
            <div class="usercenter-right post-list-page-plane">
                <div class="plane-info">
                    <h3 class="usercenter-info-h3">账号设置</h3>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">
                            登录用户名
                        </div>
                        <div class="usercenter-info-body usercenter-info-login">
                            <span><?php echo $currentUser->user_login ?></span>
                            <p style="font-size: 14px;margin: 10px 0">登录用户名无法修改，可以使用本用户名登录网站</p>
                        </div>
                    </div>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">
                            显示用户名
                        </div>
                        <div class="usercenter-info-body">
                            <input type="text" id="input-user" class="usercenter-form-input usercenter-form-username"
                                   value="<?php echo $currentUser->display_name ?>">
                        </div>
                    </div>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">
                            我的签名
                        </div>
                        <div class="usercenter-info-body">
                            <input type="text" id="input-description"
                                   class="usercenter-form-input usercenter-form-description"
                                   value="<?php echo get_user_meta($currentUser->ID, 'description')[0] ?>">
                        </div>
                    </div>
                    <div class="usercenter-info-item usercenter-info-description">
                        <div class="usercenter-info-title">
                        </div>
                        <div class="usercenter-info-body">
                            可选，签名超过200个字符，不能包含特殊字符
                        </div>
                    </div>

                    <div class="usercenter-info-item usercenter-control-plane">
                        <div class="usercenter-info-title">

                        </div>
                        <div class="usercenter-info-body">
                            <button class="search-submit usercenter-info-save-btn" id="btn-save-info">
                                保存
                            </button>
                        </div>
                    </div>
                </div>
                <div class="plane-pwd" style="display: none">
                    <h3 class="usercenter-info-h3">密码管理</h3>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">
                            原始密码
                        </div>
                        <div class="usercenter-info-body">
                            <input id="input-oldpwd" type="text"
                                   class="usercenter-form-input usercenter-form-description"
                                   value="">
                        </div>
                    </div>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">
                            新密码
                        </div>
                        <div class="usercenter-info-body">
                            <input id="input-newpwd" type="text"
                                   class="usercenter-form-input usercenter-form-description"
                                   value="">
                        </div>
                    </div>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">

                        </div>
                        <div class="usercenter-info-body usercenter-info-text">
                            密码不能包含中文，长度8位以上，并且必须包含中英文和数字
                        </div>
                    </div>
                    <div class="usercenter-info-item">
                        <div class="usercenter-info-title">
                            邮箱验证码
                        </div>
                        <div class="usercenter-info-body">
                            <input id="input-pwd-mail-code" type="text" class="usercenter-form-input"
                                   value="">
                            <button class="search-submit usercenter-pwd-getcode send-mail-btn"
                                    id="btn-pwd-get-mail-code">
                                获取
                            </button>
                        </div>
                    </div>
                    <div class="usercenter-info-item usercenter-control-plane">
                        <div class="usercenter-info-title">

                        </div>
                        <div class="usercenter-info-body">
                            <button class="search-submit usercenter-info-save-btn" id="btn-change-pwd">
                                修改密码
                            </button>
                        </div>

                    </div>
                </div>
                <div class="plane-bind" style="display: none">
                    <h3 class="usercenter-info-h3">账号绑定</h3>
                    <div class="usercenter-info-item" style="font-size: 14px">
                        <div class="usercenter-info-title">
                            绑定的邮箱
                        </div>
                        <div class="usercenter-info-body">
                            <span id="usercenter-bind-plane-mail"><?php echo $currentUser->user_email ?></span>
                            <span class="usercenter-a usercenter-editmail-a">修改</span>
                        </div>
                    </div>
                    <?php
                    if ($set['user']['thirdparty_login'] == 1) {
                        ?>
                        <h3 class="usercenter-info-h3">第三方账号</h3>
                        <?php
                        if ($set['user']['thirdparty_login_qq']['open'] == 1) {
                            ?>
                            <div class="usercenter-info-item" style="font-size: 14px">
                                <div class="usercenter-info-title">
                                    QQ账号
                                </div>
                                <div class="usercenter-info-body">
                                    <?php

                                    $openid = get_user_meta($currentUser->ID, 'corepress_thirdparty_qq', true);
                                    $bindurl = combineURL($set['user']['lgoinpageurl'], array('redirect_to' => home_url(add_query_arg(array())), 'bind' => 'qq','thirdparty'=>'qq'));

                                    if ($openid != null) {
                                        echo '<span id="usercenter-bind-plane-qq">已绑定用户</span> <span class="usercenter-a unset-qq">取消绑定</span>';
                                    } else {
                                        echo '<span id="usercenter-bind-plane-qq">未绑定</span> <span class="usercenter-a bind-qq"><a href="' . $bindurl. '">绑定</a></span>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                    }

                    ?>
                    <div class="plane-bind-editemail-plane" style="display: none">
                        <div class="usercenter-info-item">
                            <div class="usercenter-info-title">
                                原始邮箱验证码
                            </div>
                            <div class="usercenter-info-body">
                                <input type="text" class="usercenter-form-input"
                                       value="" id="changebind-old-mail-code-input">
                                <button class="search-submit usercenter-pwd-getcode send-mail-btn"
                                        id="changebind-get-old-mail-code-btn">
                                    获取
                                </button>
                            </div>
                        </div>
                        <div class="usercenter-info-item">
                            <div class="usercenter-info-title">
                                新邮箱地址
                            </div>
                            <div class="usercenter-info-body">
                                <input type="text" class="usercenter-form-input"
                                       value="" id="changebind-new-mail-input">
                            </div>
                        </div>
                        <div class="usercenter-info-item">
                            <div class="usercenter-info-title">
                                新邮箱验证码
                            </div>
                            <div class="usercenter-info-body">
                                <input type="text" class="usercenter-form-input"
                                       value="" id="changebind-new-mail-code-input">
                                <button class="search-submit usercenter-pwd-getcode send-mail-btn"
                                        id="changebind-get-new-mail-code-btn">
                                    获取
                                </button>
                            </div>
                        </div>
                        <div class="usercenter-info-item usercenter-control-plane" style="font-size: 14px">
                            <div class="usercenter-info-title"></div>
                            <div class="usercenter-info-body">
                                <button class="search-submit usercenter-info-save-btn" id="btn-change-bind-mail">
                                    提交修改
                                </button>
                                <span class="usercenter-a usercenter-closeeditmail-a">取消修改</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <div id="avatar-plane" style="display: none;min-height: 380px;position: relative">
        <input type="file" name="file" id="avatar-input" accept="image/gif,image/jpeg,image/jpg,image/png"
               style="display: none" onchange="selectImg(this)">
        <div style="margin-bottom: 10px">
            <button onclick="$('#avatar-input').click()" class="search-submit">选择头像</button>
        </div>
        <div style="width: 100%;max-height: 300px;text-align: center;position: relative">
            <img id="avatar-view" style="visibility: hidden;" src="" alt="">
            <div style="font-size: 80px;position: absolute;width: 100%;top: 60px;color: #7f7f7f" id="avatar-view-logo">
                <i class="fas fa-camera-retro"></i></div>
        </div>
        <div style="position: absolute;bottom: 0;text-align: right;width: 100%;">
            <button class="login-btn-header reg-btn-header" onclick="updateavatar()">上传头像</button>
            <button class="login-btn-header" onclick="layer.closeAll();">取消</button>
        </div>
    </div>
    <script>
        $('.unset-qq').click(function () {
            var res = confirm("是否取消绑定QQ?");
            if (res == true) {
                $.post('<?php echo AJAX_URL?>', {
                    action: 'corepress_unset_thirdparty',
                    type: 'qq'
                }, function (data) {
                    var obj = JSON.parse(data);
                    if (obj.code === 1) {
                        addarelt(obj.msg, 'succ');
                        $('#usercenter-bind-plane-qq').text('未绑定');
                        $('.unset-qq').replaceWith('<span class="usercenter-a bind-qq"><a href="<?php echo $bindurl;?>">绑定</a></span>');
                    } else {
                        addarelt(obj.msg, 'erro');
                    }
                });
            }
        });


        $('#btn-change-bind-mail').click(function () {
            var btn_name = '#btn-change-bind-mail';
            var old_mail_code = $('#changebind-old-mail-code-input').val();
            var new_mail_code = $('#changebind-new-mail-code-input').val();
            var bind_mail = $('#changebind-new-mail-input').val();
            if (old_mail_code == '' || new_mail_code == '' || bind_mail == '') {
                addarelt('请补全全部参数再提交', 'erro');
                return;
            }
            if (!isEmail(bind_mail)) {
                addarelt('请输入正确的新邮箱地址', 'erro');
                return;
            }
            $(btn_name).text('提交中');
            $.post('<?php echo AJAX_URL?>', {
                action: 'corepress_changebind',
                type: 'bindemail',
                old_mail_code, new_mail_code, bind_mail
            }, function (data) {
                var obj = JSON.parse(data);
                if (obj.code === 1) {
                    addarelt(obj.msg, 'succ');
                    $('#usercenter-bind-plane-mail').text(bind_mail);
                    $(btn_name).text('提交修改');
                } else {
                    addarelt(obj.msg, 'erro');
                    $(btn_name).text('提交修改');
                }
            });

        });

        $('#changebind-get-old-mail-code-btn').click(function () {
            var clickbtn = '#changebind-get-old-mail-code-btn';
            $(clickbtn).text('发送中');
            $.post('<?php echo AJAX_URL?>', {
                action: 'corepress_getpwdmailcode',
                type: 'changemail'
            }, function (data) {
                var obj = JSON.parse(data);
                if (obj.code === 1) {
                    addarelt(obj.msg, 'succ');
                    countdown(clickbtn);
                } else {
                    addarelt(obj.msg, 'erro');
                    $(clickbtn).text('发送');
                }
            });
        });

        $('#changebind-get-new-mail-code-btn').click(function () {
            var old_mail_code = $('#changebind-old-mail-code-input').val();
            var bind_mail = $('#changebind-new-mail-input').val();
            var clickbtn = '#changebind-get-new-mail-code-btn';
            if (old_mail_code == '') {
                addarelt('请先获取原始邮箱验证码', 'erro');
                return;
            }
            if (bind_mail == '' || !isEmail(bind_mail)) {
                addarelt('请输入正确的新邮箱地址', 'erro');
                return;
            }

            $(clickbtn).text('发送中');
            $.post('<?php echo AJAX_URL?>', {
                action: 'corepress_getpwdmailcode',
                type: 'bindemail',
                mail: bind_mail,
                oldcode: old_mail_code
            }, function (data) {
                var obj = JSON.parse(data);
                if (obj.code === 1) {
                    addarelt(obj.msg, 'succ');
                    countdown(clickbtn);
                } else {
                    addarelt(obj.msg, 'erro');
                    $(clickbtn).text('发送');
                }
            });
        });

        $('#btn-change-pwd').click(function () {
            var oldpwd = $('#input-oldpwd').val();
            var newpwd = $('#input-newpwd').val();
            var mailcode = $('#input-pwd-mail-code').val();
            if (oldpwd == '' || newpwd == '' || mailcode == '') {
                addarelt('请输入内容', 'erro');
                return;
            }
            if (oldpwd == newpwd) {
                addarelt('老密码和新密码一样', 'erro');
                return;
            }
            if (isChinese(newpwd)) {
                addarelt('密码不支持中文', 'erro');
                return;
            }
            if (!haveNumandLetter(newpwd)) {
                addarelt('密码必须包含字母和数字', 'erro');
                return;
            }
            if (newpwd.length < 8) {
                addarelt('密码必须大于8位', 'erro');
                return;
            }

            $(this).text('提交中');
            $.post('<?php echo AJAX_URL?>', {
                action: 'corepress_changepwd',
                oldpwd: oldpwd,
                newpwd: newpwd,
                mailcode: mailcode
            }, (data) => {
                var obj = JSON.parse(data);
                $(this).text('修改密码');
                if (obj.code === 1) {
                    addarelt(obj.msg, 'succ');
                } else {
                    addarelt(obj.msg, 'erro');
                }
            });
        })

        $('#btn-pwd-get-mail-code').click(function (data) {
            $('#btn-pwd-get-mail-code').text('发送中');
            $.post('<?php echo AJAX_URL?>', {
                action: 'corepress_getpwdmailcode',
                type: 'changepwd'
            }, function (data) {
                var obj = JSON.parse(data);
                if (obj.code === 1) {
                    addarelt(obj.msg, 'succ');
                    countdown('#btn-pwd-get-mail-code');
                } else {
                    addarelt(obj.msg, 'erro');
                    $('#btn-pwd-get-mail-code').text('发送');
                }
            });
        });

        function countdown(obj) {
            $(obj).attr("disabled", "true");
            var i = 60;
            var timer = setInterval(function () {
                i--;
                $(obj).text('已发送(' + i + ')')
                if (i <= 0) {
                    clearInterval(timer);
                    $(obj).text('发送');
                    $(obj).removeAttr("disabled");
                }
            }, 1000);
        }

        $('.usercenter-menu-info').click(function () {
            $('.usercenter-menu-item').removeClass('usercenter-menu-item-active');
            $(this).addClass('usercenter-menu-item-active');
            $('.plane-info').show();
            $('.plane-pwd').hide();
            $('.plane-bind').hide();

        });
        $('.usercenter-menu-pwd').click(function () {
            $('.usercenter-menu-item').removeClass('usercenter-menu-item-active');
            $(this).addClass('usercenter-menu-item-active');
            $('.plane-info').hide();
            $('.plane-pwd').show();
            $('.plane-bind').hide();


        });
        $('.usercenter-menu-bind').click(function () {
            $('.usercenter-menu-item').removeClass('usercenter-menu-item-active');
            $(this).addClass('usercenter-menu-item-active');
            $('.plane-info').hide();
            $('.plane-pwd').hide();
            $('.plane-bind').show();

        });
        $('.usercenter-closeeditmail-a').click(function () {
            $(this).hide();
            $('.usercenter-editmail-a').show();
            $('.plane-bind-editemail-plane').hide();
        });
        $('.usercenter-editmail-a').click(function () {
            $(this).hide();
            $('.usercenter-closeeditmail-a').show();
            $('.plane-bind-editemail-plane').show();

        });
        $('#btn-save-info').click(function () {
            var user = $('#input-user').val();
            var description = $('#input-description').val();
            $.post('<?php echo AJAX_URL?>', {
                action: 'corepress_updateuserinfo',
                user: user,
                description: description
            }, function (data) {
                var obj = JSON.parse(data);
                if (obj.code === 1) {
                    addarelt(obj.msg, 'succ');
                } else {
                    addarelt('修改失败', 'erro');
                }
            });
        });


        function selectImg(file) {
            if (!file.files || !file.files[0]) {
                return;
            }
            $('#avatar-view-logo').css('display', 'none');
            var reader = new FileReader();
            reader.onload = function (evt) {
                var replaceSrc = evt.target.result;
                $('#avatar-view').cropper('replace', replaceSrc, false);//默认false，适应高度，不失真
            }
            reader.readAsDataURL(file.files[0]);
        }

        var $cropper = $('#avatar-view');
        $cropper.cropper({
            aspectRatio: 1 / 1,//默认比例
            preview: '.previewImg',//预览视图
            guides: false,  //裁剪框的虚线(九宫格)
            autoCropArea: 0.5,  //0-1之间的数值，定义自动剪裁区域的大小，默认0.8
            movable: false, //是否允许移动图片
            dragCrop: true,  //是否允许移除当前的剪裁框，并通过拖动来新建一个剪裁框区域
            movable: true,  //是否允许移动剪裁框
            resizable: true,  //是否允许改变裁剪框的大小
            zoomable: false,  //是否允许缩放图片大小
            mouseWheelZoom: false,  //是否允许通过鼠标滚轮来缩放图片
            touchDragZoom: true,  //是否允许通过触摸移动来缩放图片
            rotatable: false,  //是否允许旋转图片
            crop: function (e) {
                // 输出结果数据裁剪图像。
            }
        });

        <?php
        if ($set['user']['upload_avatar'] == 1) {
        ?>
        $('#update-avatar').click(function () {
            if ($(window).width() < 620) {
                return;
            }

            layer.open({
                type: 1,
                title: '上传头像',
                shadeClose: true,
                area: ['600px', '450px'],
                content: $('#avatar-plane')
            });
        })
        <?php
        }
        ?>


        layer.config({
            extend: 'corepress/style.css?v=<?php echo THEME_VERSION?>', //加载您的扩展样式,它自动从theme目录下加载这个文件
            skin: 'corepress-layer'
        });


        function updateavatar() {
            if ($("#avatar-view").attr("src") == null) {
                return;
            } else {
                addarelt('上传中，请稍后');
                var cas = $('#avatar-view').cropper('getCroppedCanvas');//获取被裁剪后的canvas
                var base64data = cas.toDataURL('image/png'); //转换为base64地址形式
                base64data = base64data.substring(base64data.indexOf(",") + 1);
                if (base64data.length > 130000) {
                    addarelt('图片文件太大，请重新选择');
                    return;
                }

                $.ajax({
                    url: '<?php echo AJAX_URL?>',
                    type: 'POST',
                    cache: false, //上传文件不需要缓存
                    data: {'img': base64data, 'action': 'corepress_update_avatar'},
                    success: function (data) {
                        var obj = JSON.parse(data);
                        if (obj.code === 1) {
                            addarelt(obj.msg, 'succ');
                            setTimeout(function () {
                                location.reload();
                            }, 2000)
                        } else {
                            addarelt(obj.msg, 'erro');
                        }
                    },
                    error: function (data) {
                        addarelt('上传失败', 'erro');
                    }
                });
            }
        }

    </script>

    <footer>
        <?php
        wp_footer();
        get_footer(); ?>
    </footer>
</div>
</body>
</html>


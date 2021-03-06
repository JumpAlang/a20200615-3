<?php /*a:1:{s:68:"/www/wwwroot/77q73.cn/application/index/view/market/transaction.html";i:1552623948;}*/ ?>
﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>BTE</title>
    <link rel="stylesheet" type="text/css" href="/static/jycss/iconfont.css">
    <link rel="shortcut icon" href="favicon.ico"/>
    <link href="/static/jycss/mui.min.css" rel="stylesheet"/>

    <link href="/static/jycss/base.css" rel="stylesheet"/>
    <link href="/static/jycss/style.css" rel="stylesheet"/>
    <link href="/static/jycss/public.css" rel="stylesheet"/>
    <style>
        .btn-proof input[type="file"] {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            opacity: 0;
        }
    </style>
</head>

<body>
<!-- title -->
<header class="mui-bar mui-bar-nav mui_header mui_list_header">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">交易详情</h1>
</header>
<div class="mui-content">
    <div class="mui_jiaoyi">双方已达成交易匹配，数量<?php echo htmlentities(money($data['trade']['number'])); ?>个，总价<?php echo htmlentities(money($data['trade']['total'])); ?>人民币。</div>
    <div>
        <div class="mui_tiv">卖入</div>
        <form class="mui-input-group mui_inp_rou">
            <div class="mui-input-row">
                <label>姓名</label>
                <span><?php echo htmlentities($data['target']['realname']); ?></span>
            </div>
            <div class="mui-input-row">
                <label>手机号</label>
                <span><?php echo htmlentities($data['target']['username']); ?></span>
            </div>
            <div class="mui-input-row">
                <label>支付宝</label>
                <input type="text" value="<?php echo htmlentities($data['target']['alipay']); ?>"/>

            </div>
            <div class="mui-input-row">
                <label>支付宝收款码</label>
                <span class="er"><img src="<?php echo htmlentities($data['target']['alipay_image']); ?>"></span>
            </div>
        </form>
    </div>
    <div class="mui_transa">
        <div class="mui_tiv">买方</div>
        <form class="mui-input-group mui_inp_rou">
            <div class="mui-input-row">
                <label>姓名</label>
                <span><?php echo htmlentities($data['owner']['realname']); ?></span>
            </div>
            <div class="mui-input-row">
                <label>手机号</label>
                <span><?php echo htmlentities($data['owner']['username']); ?></span>
            </div>
            <?php if($data['trade']['status'] == 2 && $data['role'][1] == 'buyer'): ?>
            <div class="mui-input-row tjbutton">
                <label>付款证明</label>
                <span class="webuploader-container">
                    <button class="btn btn-secondary btn-proof" data-option="5" data-type="image" style="margin-top: 2px;background: dodgerblue;color: white;">请上传付款截图<input type="file" accept="image/*" /></button>
                </span>
            </div>
            <div class="mui-input-row" id="paycode">
                <label>凭证</label>
                <div>
                    <img src="static/picture/6633034dc24ff41cf6d10f5d0ecb41cb.png" class="headicon" width="128"/>
                </div>
            </div>
            <?php else: ?>
            <div class="mui-input-row" id="paycode">
                <label>凭证</label>
                <div>
                    <img src="<?php echo htmlentities($data['trade']['pzimg']); ?>" class="headicon" width="128"/>
                </div>
            </div>
            <?php endif; ?>
        </form>
    </div>
    <div class="mui_bot1">
        <?php if($data['trade']['status'] == 3 && $data['role'][1] == 'seller'): ?>
        <a class="bt1  sk">确认收款</a>
        <a class="bt2  ju">举报该单</a>
        <?php endif; ?>
    </div>

</div>
<script src="/static/jyjs/mui.min.js"></script>
<script type="text/javascript" src="/static/jyjs/jquery-2.1.1.js"></script>
<script src="/static/jyjs/layer.js"></script>
<script src="/static/jyjs/bootstrap.min.js"></script>
<script src="/static/jyjs/frontend.js"></script>
<script type="text/javascript" src="/assets/js/require.min.js"></script>
<script type="text/javascript" src="/static/js/global.js?3"></script>
<script>
    $(function () {
        $('.webuploader-container').on('change', 'input[type=file]', function(){
            if ($(this)[0].files.length) {
                ajax(api.transaction, {id:"<?php echo htmlentities($data['trade']['tid']); ?>",image: $(this)[0].files[0]}, function(res){
                    if (res.code == 200) {
                        $('.tjbutton').hide();
                        $(".headicon").attr('src',res.image)
                    } else {
                        alert(res.message);
                    }
                }, 'file');
            }
        });
        $("#main-menu li.dropdown").hover(function () {
            $(this).addClass("open");
        }, function () {
            $(this).removeClass("open");
        });

        $("#main-menu a").each(function () {
            if ($(this)[0].href == String(window.location)) {
                $(this).parentsUntil("#main-menu>ul>li").addClass("active");
            }
        });


        (function ($) {
            $.fn.totop = function (opt) {
                var scrolling = false;
                return this.each(function () {
                    var $this = $(this);
                    $(window).scroll(function () {
                        if (!scrolling) {
                            var sd = $(window).scrollTop();
                            if (sd > 100) {
                                $this.fadeIn();
                            } else {
                                $this.fadeOut();
                            }
                        }
                    });

                    $this.click(function () {
                        scrolling = true;
                        $('html, body').animate({
                            scrollTop: 0
                        }, 500, function () {
                            scrolling = false;
                            $this.fadeOut();
                        });
                    });
                });
            };
        })(jQuery);

        $("#backtotop").totop();


    });
</script>


<script>

    $('.ju').click(function () {
        layer.confirm('确定举报该笔订单？', {icon: 3, title: '提示'}, function (index) {

            layer.prompt({title: '请填写举报原因', formType: 2}, function (text, index) {
                layer.close(index);
                var orderid = "<?php echo htmlentities($data['trade']['tid']); ?>";
                var load = layer.load(0);
                $.ajax({
                    url: "/trade/action",
                    type: 'post',
                    data: {
                        id: orderid,
                        command: 4,
                        text: text

                    },
                    success: function (e) {
                        layer.close(load);
                        if (e.code == 200) {
                            layer.msg(e.message, {time: 1500}, function () {
                                window.location.href = "/market/selling.html"
                            })
                        } else {
                            layer.msg(e.message)
                        }


                    }, error: function (e) {
                        layer.close(load);
                        layer.msg('网络不给力');
                    }


                })
            });
        })
    });

    $('.sk').click(function () {
        layer.confirm('确定已经收到款项？', {icon: 3, title: '提示'}, function (index) {
            var orderid = "<?php echo htmlentities($data['trade']['tid']); ?>";
            var load = layer.load(0);
            $.ajax({
                url: "/trade/action",
                type: 'post',
                data: {
                    id: orderid,
                    command : 8
                },
                success: function (e) {
                    layer.close(load);
                    if (e.code == 200) {
                        layer.msg(e.message, {time: 1500}, function () {
                            window.location.href = "/market/selling.html"
                        })
                    } else {
                        layer.msg(e.message)
                    }


                }, error: function (e) {
                    layer.close(load);
                    layer.msg('网络不给力');
                }


            })
        })
    })

</script>
</body>

</html>
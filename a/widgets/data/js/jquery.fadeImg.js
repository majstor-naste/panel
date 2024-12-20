(function($) {
    $.fn.fadeImages = function(options) {
        var opt = $.extend({
            time: 2000, //动画间隔时间
            fade: 1000, //淡入淡出的动画时间
            dots: true, //是否启用图片按钮
            arrows: false, //上一张，下一张
            complete: function() {} //淡入完成后的回调函数
        }, options);
        var t = parseInt(opt.time),
            f = parseInt(opt.fade),
            d = opt.dots,
            i = 0,
            j = 0,
            l, m, set, me, cb = opt.complete,
            a = opt.arrows;
        m = $(this).find("ul li");
        mu = $(this).find("ul");
        me = $(this);
        m.hide();
        l = m.length;

        // 如果没有一张图片
        if (l <= 0) {
            return false;
        }
        // 如果开启底部按钮
        if (d) {
            $(this).append("<div id='dots'></div>");
            for (j = 0; j < l; j++) {
                $(this).find("#dots").append("<a>" + (j + 1) + "</a>");
            }
            $(this).find("#dots a").eq(0).addClass("active");
            // 底部按钮点击切换
            $(this).on("click", "#dots a", function(event) {
                event.preventDefault();
                clearTimeout(set);
                i = $(this).index();
                dots(i);
                show(i);
            });
        }
        // 如果开启ARROW
		// LEFT SVG
		// <svg viewBox='0 0 13 20' xmlns='http://www.w3.org/2000/svg' aria-labelledby='title'><title>Previous</title><polyline points='10,3 3,10 10,17'></polyline></svg>
		// RIGHT SVG
		// <svg viewBox='0 0 13 20' xmlns='http://www.w3.org/2000/svg' aria-labelledby='title'><title>Next</title><polyline points='10,3 3,10 10,17' transform='rotate(180 6.5,10)'></polyline></svg>
        if (a) {
            $(this).append("<a href='#' class='arrow prev'> <img src='widgets/data/img/arrow-left.png'> </a><a href='#' class='arrow next'>  <img src='widgets/data/img/arrow-right.png'>  </a>");
            $(this).on("click", ".arrow.prev", function(event) {
                event.preventDefault();
                clearTimeout(set);
                i = me.find(".curr").index() - 1;
                if (i <= -1) {
                    i = l - 1;
                }
                dots(i);
                show(i);

            });
            $(this).on("click", ".arrow.next", function(event) {
                event.preventDefault();
                clearTimeout(set);
                i = me.find(".curr").index() + 1;
                if (i >= l) {
                    i = 0;
                }
                dots(i);
                show(i);
            });
        }
        // 初始化
        show(0);
        play(0);
        // 图片切换
        function show(i) {
            m.eq(i).addClass("curr").css("z-index", 2).stop(true, true).fadeIn(f, cb);
            m.eq(i).siblings().css("z-index", 1).removeClass("curr").stop(true, true).fadeOut(f);
        }

        //逗点切换
        function dots(i) {
            me.find("#dots a").eq(i).addClass("active").siblings().removeClass();
        }

        //图片自动播放函数
        function play(i) {
            if (i >= l - 1) {
                i = -1;
            }
            set = setTimeout(function() {
                show(i);
                dots(i);
                play(i)
            }, t + f);
            i++;
            return i;
        }
        //鼠标经过停止与播放
        me.hover(function() {
            i = me.find(".curr").index();
            clearTimeout(set);
        }, function() {
            i = me.find(".curr").index();
            play(i);
        });

        //鼠标手势
        var _a, _b;
        var touchFun = function(event) {
            i = me.find(".curr").index();
            var et = event.type;
            if (et == 'mousedown' || et == 'touchstart') {
                _a = event.offsetX || event.touches[0].pageX;
            }
            if (et == 'mousemove' || et == 'touchmove') {
                _b = event.offsetX || event.touches[0].pageX;
                _b = _b - _a;
                if (et == 'touchmove') {
                    clearTimeout(set);
                }
            }
            if (et == 'mouseup' || et == 'touchend') {
                if (_b > 0) {
                    i <= 0 ? i = 3 : --i
                    show(i);
                    dots(i);
                }
                if (_b < 0) {
                    (i >= (l - 1)) ? i = 0: ++i;
                    show(i);
                    dots(i);
                }
                if (et == 'touchend') {
                    play(i);
                }
            }
        }
        mu.on('mousedown', touchFun);
        mu.on('mousemove', touchFun)
        mu.on('mouseup', touchFun);
        mu[0].addEventListener('touchstart', touchFun);
        mu[0].addEventListener('touchmove', touchFun);
        mu[0].addEventListener('touchend', touchFun);
        return this;
    }
}(jQuery));

///////////////////////////////////////////////
// ggContentMenu Cell JS/CSS PlugIn V1.0     //
//  Developed by: Ing.Gerardo Garita J.      //
//                FullStack Developer        //
//  email:  info@ggaritaj.com                //
//  date:       friday, 2018-09-01           //
//  last date:  friday, 2018-09-01           //
///////////////////////////////////////////////

; (function ($) {
    var _opts;
    jQuery.fn.ContentMenu = function () {
        return this;
    };
    jQuery.fn.ggContentMenu = function (options) {
        try {
            var _menu = this;
            var _height = $(window).height();
            $(_menu).find("a").each(function (p, atag) {
                $(atag).on("click", function (e) {
                    if ($(this).hasClass("active")) {
                        $(this).removeClass("active");
                    } else {
                        $(this).addClass("active");
                    }
                });
            });
            $('html').unbind("click").on('click', function (event) {
                if ($(_menu).find($(event.target)).length <= 0) {
                    $(".ggContentMenu div.contentMenu.first").animate({ width: "0px" }, 700);
                    setTimeout(function () {
                        $(".ggContentMenu a.active").removeClass("active");
                        $(".ggContentMenu div.contentMenu.first").css("width", "260px");
                    }, 700);
                } else {
                    $(".ggContentMenu div.contentMenu.first").css("width", "260px");
                }
            });
            _opts = options;
            console.log("gg:content menu ready!");
        }
        catch (err) {
            console.log("Error: " + err + ".");
        }
        finally {
            setTimeout(function () {
                window.dispatchEvent(new Event('resize'));
            }, 1000);
        }
    };
    jQuery.fn.ContentMenu().Refresh = function (options) {
        try {
            var _height = $(window).height();
            var _menuContainer = $(this).find("div.contentMenu.first");
            _opts = ((options == undefined || options === null || options === "") ? _opts : options);
            if ((_opts != undefined) && (_opts !== null) && (_opts !== "")) {
                if (_opts.hasOwnProperty("top")) {
                    $(_menuContainer).css("top", _opts.top);
                    _height -= (_opts.top);
                } else {
                    $(_menuContainer).css("top", 0).css("border-top", "0px");
                }
                if (_opts.hasOwnProperty("bottom")) {
                    $(_menuContainer).css("bottom", _opts.bottom);
                    _height -= (_opts.bottom);
                } else {
                    $(_menuContainer).css("bottom", 0).css("border-bottom", "0px");
                }
                if (_opts.hasOwnProperty("left")) {
                    $(_menuContainer).css("left", _opts.left).css("border-left", "0px");
                } else {
                    $(_menuContainer).css("left", 0);
                }
                if (_opts.hasOwnProperty("right")) {
                    $(_menuContainer).css("right", _opts.right).css("border-right", "0px");
                }
                if (_opts.hasOwnProperty("height")) {
                    $(_menuContainer).css("max-height", _opts.height);
                } else {
                    $(_menuContainer).css("max-height", _height);
                }
            } else {
                $(_menuContainer).css("top", 0);
                $(_menuContainer).css("left", 0);
                $(_menuContainer).css("bottom", 0);
                $(_menuContainer).css("max-height", _height);
                $(_menuContainer).css("z-index", 100);
            }
        }
        catch (err) {
            console.log("Error: " + err + ".");
        }
    };
    $(window).bind('resize', function () {
        $(".ggContentMenu").ContentMenu().Refresh(_opts);
    });
})(jQuery);
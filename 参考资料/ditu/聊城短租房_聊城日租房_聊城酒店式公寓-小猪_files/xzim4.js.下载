var xiaozhuIMBootstrap= {
    userInfoCookie:'',
    loginUserIsLandlord: '',
    loadCSS: function () {
        LazyLoad.css(xzimCssPath + xiaozhuWebimCSS);
    },
    loadJS: function () {
        var self = this;
        var url = XZWebUrlWriter.getWebIm_DrawIframeUrl(currentUser);
        webimIO.httpget(url,{jsonp:'xiaozhuIMBootstrap.drawcallback'});

        LazyLoad.js(loadURLSrc + '?k=core');
        LazyLoad.js(loadURLSrc + '?k=icomet');
        LazyLoad.js(loadURLSrc + '?k=base');
        LazyLoad.js(loadURLSrc + '?k=plugins');
        LazyLoad.js(loadURLSrc + '?k=container');
    },
    drawcallback : function(data) {
        $('body').prepend(data);
        this.loginUserIsLandlord = $('#loginUserIsLandlord').val();
    },
    webIMInit: function() {
        if (common.isEmpty(XZWebUrlWriter)) {
            LazyLoad.js(loadURLSrc + '?k=urlwrite');
        }
        this.userInfoCookie= common.getCookie('xzuinfo');
        var loginUserId = $('#loginUserId').val();
        currentUser = loginUserId;

        this.bindNavigatePart();
        if (this.userInfoCookie && loginUserId) {
            this.loginWebIMInit();
        } else {
            this.noLoginWebIMInit();
        }
    },
    noLoginWebIMInit: function() {
        this.bindSwitchNoticeNotification();
        $('.im_base_btn').on('click',function() {
            if($(this).hasClass('sus_on')) {
                $(this).removeClass('sus_on');
            } else {
                $('.im_base_btn').removeClass('sus_on');
                $(this).addClass('sus_on');
            }

            var type = $(this).attr('btn_type');
            $('#im_nologin_'+type).toggle();
            $('.nologin').each(function() {
                var id = $(this).attr('id');
                if(id != 'im_nologin_'+type) {
                    $(this).hide();
                }
            });
        });
        $(document).on('click','.rt_btn',function() {
            $('.im_base_btn').removeClass('sus_on');
            $(this).parent().parent().hide(); 
        });
    },
    loginWebIMInit: function() {
        this.bindLogOut();
        this.reBindFeedBackAndQrCode();
        var self = this;

        $('body').prepend($('<iframe/>', {
            id: 'XZIM_storage_dom',
            name: 'XZIM_storage_dom',
            src: XZWebUrlWriter.getWebIm_IframeUrl(currentUser),
            style: 'display: none'
        }).bind('load',function() {
            var belongUserId = window.frames['XZIM_storage_dom'].cl.getItem('IMBelongUserId');
            if(belongUserId && currentUser != belongUserId) {
                var iframe = document.getElementById('XZIM_storage_dom').contentWindow;
                iframe.localStorage.clear();
                iframe.cl.clear();
                iframe.cl.setItem('IMBelongUserId',currentUser);
            }
            self.loadCSS();
            self.loadJS();
            var containerTimer = setInterval(function() {
                if ("undefined" != typeof container) {
                    container.load();
                    clearInterval(containerTimer);
                }
            },1000);
        }));
        $(document).on('click','.im_base_btn_chat',function() {
            if($(this).hasClass('sus_on')) {
                $(this).removeClass('sus_on');
            } else {
                $(this).addClass('sus_on');
            }
        });
        $(document).on('click','.im_has_login_base_btn',function() {
            if($(this).hasClass('sus_on')) {
                $(this).removeClass('sus_on');
            } else {
                $('.im_has_login_base_btn').removeClass('sus_on');
                $(this).addClass('sus_on');
            }
            var btnType = $(this).attr('btn_type');
            $('.im_has_login').each(function() {
                var pageType = $(this).attr('pagetype'); 
                if(pageType != btnType) {
                    $(this).hide();
                }
            });
        });
        $(document).on('click','.rt_btn',function() {
            $('.im_has_login_base_btn').removeClass('sus_on');
            $(this).parent().parent().hide(); 
        });
    },
    bindSwitchNoticeNotification: function() {
        $('#noLoginNotificationBtn').on('click',function() {
            $(this).addClass('underL');
            $('#noLoginNoticeBtn').removeClass('underL');
            $('#im_nologin_notice').find('.tab_content0').show(); 
            $('#im_nologin_notice').find('.tab_content1').hide(); 
        }); 
        $('#noLoginNoticeBtn').on('click',function() {
            $(this).addClass('underL');
            $('#noLoginNotificationBtn').removeClass('underL');
            $('#im_nologin_notice').find('.tab_content1').show(); 
            $('#im_nologin_notice').find('.tab_content0').hide(); 
        }); 
    },
    bindNavigatePart: function() {
        this.drawBaseBtn();
        this.bindFeedBack();
        this.bindWindowScroll();
    },
    drawBaseBtn: function() {
        var baseBtnDom = webimIO.getIMBaseBtnDom();
        $('body').append(baseBtnDom);
    },
    bindFeedBack: function() {
        if(typeof String.prototype.trim !== 'function') {
            String.prototype.trim = function() {
                return this.replace(/^\s+|\s+$/g, ''); 
            }
        }
        $('#im_feedback_submitBtn').on('click',function() {
            var problem = $('#im_feedback_problem').val();
            var contact = $('#im_feedback_contact').val();
            if(!problem.trim()) {
                return false;
            }
            problem = encodeURIComponent(problem);
            var data = webimIO.addFeedBack(problem,contact);
            if(data.status == 1){
                $('#im_feedback_success').show(); 
                $('#im_nologin_feedback').hide();
                $('#im_feedback_problem').val('');
                $('#im_feedback_contact').val('');
            } else {
                alert(data.errmsg); 
                return false;
            }
        });
        $('#im_feedback_knowed').on('click',function() {
            $('#im_feedback_success').hide(); 
            $('#im_feedBack_btn').removeClass('sus_on');
        });
    },
    bindWindowScroll: function() {
        if ($(window).scrollTop()>600){
            $("#to_go").fadeIn("fast");
        }
        $(window).scroll(function(){  
            if ($(window).scrollTop()>600){
                $("#to_go").fadeIn("fast");
            } else{ 
                $("#to_go").fadeOut("fast");
            }
        });
        $("#to_go").click(function(){  
            $('body,html').animate({scrollTop:0},600);  
            return false;  
        }); 
    },
    reBindFeedBackAndQrCode: function() {
        $('.loginReBind').on('click',function() {
            var type = $(this).attr('btn_type');
            $('#im_nologin_'+type).toggle();
            $('.nologin').each(function() {
                var id = $(this).attr('id');
                if(id != 'im_nologin_'+type) {
                    $(this).hide();
                }
            });
        });
    },
    bindLogOut: function() {
        $('#IM-Logout').on('click',function() {
            icomet.leave();
            XZStorageHandle.clearCurrentUserStorage(); 
        });
    }
};

for (var i in loadIMJS) {
    LazyLoad.js(loadURLSrc + '?k=' + loadIMJS[i]);
}

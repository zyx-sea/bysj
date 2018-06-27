var webimIO = {
    get: function(url) {
        var response = $.ajax({
            type: "GET",
            dataType: "JSON",
            url: url, 
            async: false
        });
        return response.responseText;
    },
    post: function(url,data) {
        var response = $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            data: data,
            async: false
        });
        return response.responseText
    },
    httpget: function (url, data, complete) {
        var req = $.ajax({
            type: 'GET',
            url: url ,
            data : data,
            timeout : 60000,
            dataType: 'jsonp',
            async: true
        });
        if(complete) req.complete(complete);
    },
    getLodgeUnitData: function(roomid) {
        var url = XZWebUrlWriter.getWebIm_LodgeUnitData(roomid); 
        var data = this.get(url);
        return JSON.parse(data);
    },
    getChatRecordUrl: function (landlordid, tenantid, objid) {
        if (!landlordid || !tenantid || !objid) return null;

        var url = XZWebUrlWriter.getWebIm_TalkHisUrl(landlordid, tenantid, objid, currentUser);
        var data = this.get(url);
        return data;
    },
    getIMBaseBtnDom: function() {
        var url = XZWebUrlWriter.getWebIm_DrawBaseBtnUrl(window.location.href);
        var data = this.get(url);
        return data;
    },
    getFavoriteList: function(userid) {
        var url = XZWebUrlWriter.getWebIm_FavoriteList(userid);
        var data = this.get(url);
        return data;
    },
    getFavoriteGroupDetail: function(groupId) {
        var url = XZWebUrlWriter.getWebIm_FavoriteGroupDetail(groupId);
        var data = this.get(url);
        return data;
    },

    getNoticeList: function(userid) {
        var url = XZWebUrlWriter.getWebIm_RequestNotificationUrl(userid);
        var data = this.get(url);
        if(!data) {
            var data = XZStorageHandle.getNotification();
        } else {
            data = JSON.parse(data);
        }
        return data;
    },
    getDealActionUrl: function (dealaction, objid, objtype, receiverid, displaystrategy) {
        if (!dealaction) return null;
        var url = XZWebUrlWriter.getInfoEventDealActionUrl(dealaction, objid, objtype, receiverid, displaystrategy);
        var dealAction = this.get(url);
        return dealAction;
    },
    getUserSysNoticeCnt: function (userrole) {
        var url = XZWebUrlWriter.getWebIm_RequestUserSysNoticeCnt(currentUser, userrole);
        var data = this.get(url)
        return data;
    },
    getUserSysNotice: function (userrole) {
        var url = XZWebUrlWriter.getWebIm_RequestUserSysNotice(currentUser, userrole);
        var data = this.get(url);
        return data;
    },
    getUserState: function (userid,imuserrole) {
        var url = XZWebUrlWriter.getWebIm_RequestUserStateUrl(userid,imuserrole);
        var data = this.get(url);
        return JSON.parse(data);
    },
    getUserData: function(id) {
        var url = XZWebUrlWriter.getWebIm_UserData(id); 
        var data = this.get(url);
        return data;
    },
    getFastReply: function () {
        var url = XZWebUrlWriter.getWebIm_RequestFastReplyUrl(currentUser);
        var data = this.get(url);
        return data;
    },
    getRecommendLuList: function (userid) {
        if (!userid) return null;
        var url = XZWebUrlWriter.getWebIm_RequestRecommendLuUrl(userid);
        var data = this.get(url);
        return JSON.parse(data);
    },
    getSynTalkMsg: function(userid,synMinTime,synMaxTime) {
        var url = XZWebUrlWriter.getWebIm_RequestSynTalkMsgUrl(userid,synMinTime,synMaxTime);
        var data = this.get(url);
        return JSON.parse(data); 
    },
    addFeedBack: function (problem,contact) {
        var url = XZWebUrlWriter.getAjax_AddFeedbackUrl(problem,contact,'');
        var data = this.get(url);
        return JSON.parse(data);
    },
    talkMsgSetRead: function(tenantId,luId,isTenant) {
        var url = XZWebUrlWriter.getWebIm_RequestTalkMsgSetRead(tenantId,luId,isTenant);
        var data = this.get(url);
        return data;
    },
    noticeReachedFeedback: function (timerid, operate, receiverid) {
        if (!timerid) return null;
        var url = XZWebUrlWriter.getWeb_InfoEventReachUrl(timerid, operate, receiverid);
        var data = this.get(url);
    },
    getShowLetterUrl: function(loginUserIsLandlord) {
        var url = loginUserIsLandlord ? XZWebUrlWriter.getWeb_FangDong_FangDong_ShowLetter() : XZWebUrlWriter.getWeb_FangKe_FangKe_ShowLetter();
        return url;
    },
    getSpecialIndexUrl: function(userRole,userId) {
        if(userRole == 'landlord') {
            var url = XZWebUrlWriter.getWeb_FangDong_Special_Index(userId);
        } else {
            var url = XZWebUrlWriter.getWeb_FangKe_Special_Index(userId);
        }
        return url;
    },
    getIMServerUrl: function() {
        var url = XZWebUrlWriter.getWebIm_ServerUrl(); 
        var data = this.get(url);
        return JSON.parse(data);
    },
    getAllFriendAndLuData: function(allfriendid,allluid) {
        var url = XZWebUrlWriter.getWebIm_AllFriendAndLuData(allfriendid,allluid);
        var data = this.get(url);
        return JSON.parse(data);
    },
    doOperateImScreen: function(toUserId,operate) {
        var url = XZWebUrlWriter.getOperateScreen(toUserId,operate);
        var data = this.get(url);
        return JSON.parse(data);
    },
    checkIsInScreenList : function(toUserId) {
        var url = XZWebUrlWriter.checkIsInScreenList(toUserId);
        var data = this.get(url);
        return data;
    },
    getLodgeUnitState : function(luId) {
        var url = XZWebUrlWriter.getLodgeUnitState(luId);
        var data = this.get(url);
        return JSON.parse(data);
    },
};
var common = {
    checkIfIE6Browser: function () {
        /*{{{*/
        if ($.browser.msie && $.browser.version === "6.0") {
            isIE6 = true;
        } else {
            isIE6 = false;
        }
        /*}}}*/
    },
    checkIfIE11Browser: function () {
        /*{{{*/
        if ($.browser.msie && $.browser.version === "11.0") {
            var isIE11 = true;
        } else {
            var isIE11 = false;
        }
        return isIE11;
        /*}}}*/
    },
    isIe: function(){
        return ("ActiveXObject" in window);
    },
    setCookie: function (name, value, expires) {
        /*{{{*/
        var LargeExpDate = new Date();
        if (expires != null) {
            LargeExpDate.setTime(LargeExpDate.getTime() + (expires * 1000 * 3600 * 24));
        }
        document.cookie = name + "=" + escape(value) + ";domain=" + topLevelDomain + ((expires == null) ? "" : ("; expires=" + LargeExpDate.toGMTString())) + "; path=" + "/";
        /*}}}*/
    },
    getCookie: function (name) {
        /*get cookie{{{*/
        var offset = '',
            end = '';
        var search = name + "=";
        if (document.cookie.length > 0) {
            offset = document.cookie.indexOf(search);
            if (offset != -1) {
                offset += search.length;
                end = document.cookie.indexOf(";", offset);
                if (end == -1) end = document.cookie.length;
                return unescape(document.cookie.substring(offset, end));
            } else return "";
        }
        /*}}}*/
    },
    /*
    analyseURLRequestSource: function () {
        var includeImURL = $('#webimSource').attr('src');
        if (includeImURL.indexOf('?') > 0) {
            var URLParamKeyValues = this.explode('?', includeImURL);
            var splitedURLParamsKeyValues = this.explode('&', URLParamKeyValues[1]);
            for (var i = 0; i < splitedURLParamsKeyValues.length; i++) {
                var result = this.explode('=', splitedURLParamsKeyValues[i]);
                if (xiaozhuIM.hasOwnProperty(result[0])) {
                    xiaozhuIM[result[0]] = result[1];
                }
            }
        }
        var URLObjLength = xiaozhuIM.dm.split('.').length;
        xiaozhuIM.topdomain = xiaozhuIM.dm.split('.')[URLObjLength - 2] + '.' + xiaozhuIM.dm.split('.')[URLObjLength - 1];
    },
    */
    explode: function (delimiter, string, limit) {
        /*{{{*/
        var emptyArray = {
            0: ''
        };

        if (arguments.length < 2 || typeof arguments[0] === 'undefined' || typeof arguments[1] === 'undefined') {
            return null;
        }

        if (delimiter == '' || delimiter == false || delimiter == null) {
            return false;
        }

        if (typeof delimiter === 'function' || typeof delimiter === 'object' || typeof string === 'function' || typeof string === 'object') {
            return emptyArray;
        }

        if (delimiter == true) {
            delimiter = '1';
        }

        if (!limit) {
            return string.toString().split(delimiter.toString());
        } else {
            var splitted = string.toString().split(delimiter.toString());
            var partA = splitted.splice(0, limit - 1);
            var partB = splitted.join(delimiter.toString());
            partA.push(partB);
            return partA;
        }
        /*}}}*/
    },
    getOs: function () {   
        var explorer = window.navigator.userAgent ;
        if (explorer.indexOf("MSIE") >= 0) {
            return "Safari";
        } else if (explorer.indexOf("Firefox") >= 0) {
            return "Firefox";
        } else if(explorer.indexOf("Chrome") >= 0){
            return "Chrome";
        } else if(explorer.indexOf("Opera") >= 0){
            return "Opera";
        } else if(explorer.indexOf("Safari") >= 0){
            return "Safari";
        } else {
            return 'Safari';
        }
    }, 
    isEmpty: function (value) {
        /*{{{*/
        if (!value) return true;
        if (value.length === 0) return true;
        if ('undefined' == typeof value) return true;
        return false;
        /*}}}*/
    },
    insertAtCursor: function (myField, myValue) {
        /*{{{*/
        //IE support
        if (document.selection) {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = myValue;
            sel.select();
        }
        //MOZILLA/NETSCAPE support
        else if (myField.selectionStart || myField.selectionStart == '0') {
            var startPos = myField.selectionStart;
            var endPos = myField.selectionEnd;
            // save scrollTop before insert
            var restoreTop = myField.scrollTop;
            myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
            if (restoreTop > 0) {
                // restore previous scrollTop
                myField.scrollTop = restoreTop;
            }
            myField.focus();
            myField.selectionStart = startPos + myValue.length;
            myField.selectionEnd = startPos + myValue.length;
        } else {
            myField.value += myValue;
            myField.focus();
        }
        /*}}}*/
    },
    getCurrentTime: function() {
        /*获取当前时间戳{{{*/
        return Math.floor(new Date().getTime() / 1000); 
        /*}}}*/
    },
    html2Json4IM: function(content) {
        $('#im_html_decode_div').html(content); 
        return JSON.parse($('#im_html_decode_div').html());
    },
    mapContentToIcon: function (content) {
        var reg = new RegExp(/\[([^[]*?)\]/gi);
        var str = content.match(reg);
        var icon = content;
        if (str) {
            for (var i in str) {
                var matchVal = String(str[i]); //have [],by replace
                var matchIconVal = matchVal.replace(reg, "$1"); //no [],by getIcon()
                var myIcon = this.getIcon(matchIconVal);
                if (myIcon) {
                    icon = icon.replace(matchVal, myIcon);
                }
            }
        }
        icon = this.mapContentToIconV2(icon);
        var reg1 = new RegExp('\\n','g');
        var reg2 = new RegExp('\n','g');
        var reg3 = new RegExp('\\r','g');
        var reg4 = new RegExp('\r','g');
        icon = icon.replace(reg1,'<br/>');
        icon = icon.replace(reg2,'<br/>');
        icon = icon.replace(reg3,'<br/>');
        icon = icon.replace(reg4,'<br/>');
        return icon;
    },
    mapContentToIconV2: function (content) {
        content = encodeURI(content);
        var reg = new RegExp(/%F0%9F%98%83|%F0%9F%98%96|%F0%9F%98%8D|%F0%9F%98%B2|%F0%9F%98%8E|%F0%9F%98%AD|%F0%9F%98%B7|%F0%9F%98%B4|%F0%9F%98%98|%F0%9F%98%82|%F0%9F%98%A1|%F0%9F%98%9B|%F0%9F%98%86|%F0%9F%98%8F|%F0%9F%99%81|%F0%9F%98%93|%F0%9F%98%B5|%F0%9F%98%8A|%F0%9F%98%B3|%F0%9F%98%95|%F0%9F%98%94|%F0%9F%98%99|%F0%9F%98%87|%F0%9F%98%B1|%F0%9F%98%90|%F0%9F%90%B7|%F0%9F%90%BD|%F0%9F%91%8C|%E2%9C%8C|%F0%9F%99%8F|%F0%9F%91%8D|%F0%9F%91%8E|%F0%9F%91%8F|%E2%98%9D|%F0%9F%91%80|%F0%9F%92%8B|%E2%9D%A4|%F0%9F%92%94|%F0%9F%8C%B9|%F0%9F%8E%82|%F0%9F%8D%9A|%F0%9F%8D%BA|%E2%98%95|%E2%98%80|%F0%9F%8C%99|%E2%9A%A1|%F0%9F%8C%A7|%F0%9F%8E%89|%F0%9F%8E%81|%F0%9F%8C%88|%F0%9F%92%A3|%F0%9F%91%B6|%F0%9F%91%A8|%F0%9F%91%A9|%F0%9F%91%B4|%F0%9F%91%B5|%E2%9C%88|%F0%9F%9A%85|%F0%9F%9A%97|%F0%9F%9A%B2/gi);
        var str = content.match(reg);
        var icon = content;
        if (str) {
            for (var i in str) {
                var matchVal = String(str[i]);
                var myIcon = this.getIconV2(matchVal);
                if (myIcon) {
                    icon = icon.replace(str[i], myIcon);
                }
            }
        }
        return decodeURI(icon);
    },
    getIcon: function (val) {
        var keys = this.iconKey;
        for (var i in keys) {
            if (val == keys[i]) return '<img src="http://'+domain+'/images/webim/icon/' + this.iconList[i] + '.gif" title="' + val + '">';
        }
        return null;
    },
    getIconV2 : function(val) {
        var keys = this.emojiIconBytes;
        for (var i in keys) {
            if (val == keys[i]) return '<img src="http://'+domain+'/images/webim/iconV2/' + this.iconListV2[i] + '.png" />';
        }
        return null;

    },
    iconKey: ['给力', '威武', '熊猫', '兔子', '呵呵', '嘻嘻', '哈哈', '可爱', '可怜', '挖鼻屎', '吃惊', '害羞', '挤眼', '闭嘴', '鄙视', '爱你', '泪', '偷笑', '亲亲', '生病', '太开心', '懒得理你', '右哼哼', '左哼哼', '嘘', '衰', '委屈', '吐', '打哈欠', '抱抱', '怒', '疑问', '馋嘴', '拜拜', '思考', '汗', '困', '睡觉', '钱', '失望', '酷', '花心', '哼', '鼓掌', '晕', '悲伤', '抓狂', '黑线', '怒骂', '心', '伤心', '猪头', 'ok', '耶', 'good'],
    iconList: ['geili_thumb', 'vw_thumb', 'panda_thumb', 'rabbit_thumb', 'smilea_thumb', 'tootha_thumb', 'laugh', 'tza_thumb', 'kl_thumb', 'kbsa_thumb', 'cj_thumb', 'shamea_thumb', 'zy_thumb', 'bz_thumb', 'bs2_thumb', 'lovea_thumb', 'sada_thumb', 'heia_thumb', 'qq_thumb', 'sb_thumb', 'mb_thumb', 'ldln_thumb', 'yhh_thumb', 'zhh_thumb', 'x_thumb', 'cry', 'wq_thumb', 't_thumb', 'k_thumb', 'bba_thumb', 'angrya_thumb', 'yw_thumb', 'cza_thumb', '88_thumb', 'sk_thumb', 'sweata_thumb', 'sleepya_thumb', 'sleepa_thumb', 'money_thumb', 'sw_thumb', 'cool_thumb', 'hsa_thumb', 'hatea_thumb', 'gza_thumb', 'dizzya_thumb', 'bs_thumb', 'crazya_thumb', 'h_thumb', 'nm_thumb', 'hearta_thumb', 'unheart', 'pig', 'ok_thumb', 'ye_thumb', 'good_thumb'],
    iconKeyV2: ['😃','😖','😍','😲','😎','😭','😷','😴','😘','😂','😡','😛','😆','😏','🙁','😓','😵','😊','😳','😕','😔','😙','😇','😱','😐','🐷','🐽','👌','✌','🙏','👍','👎','👏','☝','👀','💋','❤','💔','🌹','🎂','🍚','🍺','☕','☀','🌙','⚡','🌧','🎉','🎁','🌈','💣','👶','👨','👩','👴','👵','✈','🚅','🚗','🚲'],
    iconListV2: ['PC_U+1F603','PC_U+1F616','PC_U+1F60D','PC_U+1F632','PC_U+1F60E','PC_U+1F62D','PC_U+1F637','PC_U+1F634','PC_U+1F618','PC_U+1F602','PC_U+1F621','PC_U+1F61B','PC_U+1F606','PC_U+1F60F','PC_U+1F641','PC_U+1F613','PC_U+1F635','PC_U+1F60A','PC_U+1F633','PC_U+1F615','PC_U+1F614','PC_U+1F619','PC_U+1F607','PC_U+1F631','PC_U+1F610','PC_U+1F437','PC_U+1F43D','PC_U+1F44C','PC_U+270C','PC_U+1F64F','PC_U+1F44D','PC_U+1F44E','PC_U+1F44F','PC_U+261D','PC_U+1F440','PC_U+1F48B','PC_U+2764','PC_U+1F494','PC_U+1F339','PC_U+1F382','PC_U+1F35A','PC_U+1F37A','PC_U+2615','PC_U+2600','PC_U+1F319','PC_U+26A1','PC_U+1F327','PC_U+1F389','PC_U+1F381','PC_U+1F308','PC_U+1F4A3','PC_U+1F476','PC_U+1F468','PC_U+1F469','PC_U+1F474','PC_U+1F475','PC_U+2708','PC_U+1F685','PC_U+1F697','PC_U+1F6B2'],
    emojiIconBytes: ['%F0%9F%98%83','%F0%9F%98%96','%F0%9F%98%8D','%F0%9F%98%B2','%F0%9F%98%8E','%F0%9F%98%AD','%F0%9F%98%B7','%F0%9F%98%B4','%F0%9F%98%98','%F0%9F%98%82','%F0%9F%98%A1','%F0%9F%98%9B','%F0%9F%98%86','%F0%9F%98%8F','%F0%9F%99%81','%F0%9F%98%93','%F0%9F%98%B5','%F0%9F%98%8A','%F0%9F%98%B3','%F0%9F%98%95','%F0%9F%98%94','%F0%9F%98%99','%F0%9F%98%87','%F0%9F%98%B1','%F0%9F%98%90','%F0%9F%90%B7','%F0%9F%90%BD','%F0%9F%91%8C','%E2%9C%8C','%F0%9F%99%8F','%F0%9F%91%8D','%F0%9F%91%8E','%F0%9F%91%8F','%E2%98%9D','%F0%9F%91%80','%F0%9F%92%8B','%E2%9D%A4','%F0%9F%92%94','%F0%9F%8C%B9','%F0%9F%8E%82','%F0%9F%8D%9A','%F0%9F%8D%BA','%E2%98%95','%E2%98%80','%F0%9F%8C%99','%E2%9A%A1','%F0%9F%8C%A7','%F0%9F%8E%89','%F0%9F%8E%81','%F0%9F%8C%88','%F0%9F%92%A3','%F0%9F%91%B6','%F0%9F%91%A8','%F0%9F%91%A9','%F0%9F%91%B4','%F0%9F%91%B5','%E2%9C%88','%F0%9F%9A%85','%F0%9F%9A%97','%F0%9F%9A%B2'],
    base64_decode: function(str){
        var c1, c2, c3, c4;
        var base64DecodeChars = new Array(
                -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
                -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
                -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 52, 53, 54, 55, 56, 57,
                58, 59, 60, 61, -1, -1, -1, -1, -1, -1, -1, 0,  1,  2,  3,  4,  5,  6,
                7,  8,  9,  10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
                25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36,
                37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1,
                -1, -1
                );
        var i=0, len = str.length, string = '';

        while (i < len){
            do{
                c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff]
            } while (
                    i < len && c1 == -1
                    );

            if (c1 == -1) break;

            do{
                c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff]
            } while (
                    i < len && c2 == -1
                    );

            if (c2 == -1) break;

            string += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));

            do{
                c3 = str.charCodeAt(i++) & 0xff;
                if (c3 == 61)
                    return string;

                c3 = base64DecodeChars[c3]
            } while (
                    i < len && c3 == -1
                    );

            if (c3 == -1) break;

            string += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));

            do{
                c4 = str.charCodeAt(i++) & 0xff;
                if (c4 == 61) return string;
                c4 = base64DecodeChars[c4]
            } while (
                    i < len && c4 == -1
                    );

            if (c4 == -1) break;

            string += String.fromCharCode(((c3 & 0x03) << 6) | c4)
        }
        return string;
    }
};
(function() {
    xiaozhuIMBootstrap.webIMInit();

    $('#webim-chat-user').on('click',function() {
        $('#im_chat_btn').click();
    });

})();
function fangdongtalktorent(friendid, luid, content) {
    XZStorageHandle.removeClosedFriendFromList(friendid,luid); 
    $('#im_chat_btn').click();
    XZStorageHandle.updateFriendList(friendid,luid);
    setTimeout(function() {
        friendList.praviteClass.renderBasePage();
        var target = 'curLodgeUnit';
        var method = 'changeCurLodgeUnit';
        var params = {roomid:luid};
        var command = new Command(target,method,params);
        container.send(command);

        //var state = $(this).attr('state');
        var state = "online";
        var target = 'chat';
        var method = 'changeUser';
        var params = {
            userid:friendid,
        roomid:luid,
        state:state
        };
        var command = new Command(target,method,params);
        container.send(command);
    },500);
}



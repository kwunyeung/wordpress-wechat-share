function WeiXinShareBtn(title, link, desc, img) {
    if (typeof WeixinJSBridge == "undefined") {
        alert("Please follow us on WeChat first. Our WeChat ID is creativeworksgroup.");
    } else {
        WeixinJSBridge.invoke('shareTimeline', {
            "title": title,
            "link": link,
            "desc": desc,
            "img_url": img
        });
    }
}

function WeiXinSendAppMessageBtn(title, link, desc, img) {
    if (typeof WeixinJSBridge == "undefined") {
        alert("Please follow us on WeChat first. Our WeChat ID is creativeworksgroup.");
    } else {
        WeixinJSBridge.invoke('sendAppMessage', {
            "title": title,
            "link": link,
            "desc": desc,
            "img_url": img
        });
    }
}

function WeiXinShareWeiBoBtn(title, link) {
    if (typeof WeixinJSBridge == "undefined") {
        alert("Please follow us on WeChat first. Our WeChat ID is creativeworksgroup.");
    } else {
        WeixinJSBridge.invoke('shareWeibo', {
            "content": title,
            "url": link,
        });
    }
}

function follow(b){
	if (typeof WeixinJSBridge == "undefined") {
		alert("请在微信客户端点击");
	} else {
		WeixinJSBridge.invoke(
			'addContact',
			{"webtype": "1","username": b,},
			function(a) {
				if (a.err_msg == 'add_contact:ok') {
					//$.post('/wapStat/add_wechat_favourite');
				} else if(a.err_msg != 'add_contact:added'){
					
				}
		});
	}
}	
    
    
$(document).ready(function(){
    $("a.wechat-share").click(function(e){
        title = $(this).find("span.title").text();
        link = $(this).find("span.link").text();
        desc = $(this).find("span.desc").text();
        img = $(this).find("span.img").text();
        WeiXinShareBtn(title, link, desc, img);
        //WeiXinSendAppMessageBtn(title, link, desc, img);
        //WeiXinShareWeiBoBtn(title, link);
    	return false;
    });
    
    $("a.wechat-follow").click(function(e){
    	follow('creativeworksgroup');
    	return false;
    });
});
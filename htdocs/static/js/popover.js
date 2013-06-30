function AjaxGet(b,c,d){
	var e=$("#"+c);
	$.ajax({
		url:b,
		type:"GET",
		dataType:"html",
		data:"in_ajax=1",
		cache:false,
		timeout:3E4,
		error:function(f){
			alert("Http Response Error!\n Error Info:"+f.responseText+"\n\u8bf7\u91cd\u65b0\u5c1d\u8bd5\u8be5\u64cd\u4f5c\uff01");
			ClearWait();
			return false
		},
		beforeSend:function(){
			CreateWait()
		},
		success:function(f){
			a=null;
			try{
				eval(f)
			}catch(g){}
			if(typeof a!="object"){
				alert(a.msg);
				return false
			}
			$("#"+c).html(f);
			d&&d();
			ClearWait();
			return false
		}
	});
	return false
}
function AjaxPost(b,c,d){
	var e=b.attr("action");
	b=b.serialize()+"&in_ajax=1";
	c.disabled=true;
	$.ajax({
		url:e,
		type:"POST",
		data:b,
		dataType:"json",
		error:function(f){
			alert("Http Response Error!\n Error Info:"+f.responseText);
			ClearWait();
			return false
		},
		beforeSend:function(){
			CreateWait()
		},
		success:function(f){
			ClearWait();
			if(f.stat){
				d&&d();
				DzgBox({
					msg:f.msg,
					type:3
				})
			}else{
				DzgBox({
					msg:f.msg,
					type:4
				});
				c.disabled=false
			}
			return false
		}
	});
	return false
}
function AjaxLevel(b,c){
	ClearLevel();
	CreateLevel(c);
	AjaxLevelGet(b);
	return false
}
function AjaxLevelGet(b){
	targetsobj=$("#cm_new_level");
	b+="&in_ajax=1";
	$.ajax({
		url:b,
		type:"GET",
		dataType:"html",
		timeout:3E4,
		error:function(c){
			alert("Http Response Error!\n Error Info:"+c.responseText);
			ClearMaskLayer();
			ClearWait();
			return false
		},
		beforeSend:function(){
			CreateMaskLayer();
			CreateWait()
		},
		success:function(c){
			a=null;
			try{
				eval(c)
			}catch(d){}
			if(typeof a!="object"){
				alert(a.msg);
				ClearMaskLayer();
				ClearWait();
				return false
			}
			ChangeLevel(c);
			ClearWait();
			return false
		}
	});
	return false
}
function AjaxLevelPost(b,c,d){
	var e=b.attr("action");
	b=b.serialize()+"&in_ajax=1";
	c.disabled=true;
	$.ajax({
		url:e,
		type:"POST",
		data:b,
		dataType:"json",
		error:function(f){
			alert("Http Response Error!\n Error Info:"+f.responseText);
			return c.disabled=false
		},
		beforeSend:function(){
			CreateMaskLayer();
			CreateWait()
		},
		success:function(f){
			ClearWait();
			if(f.stat){
				d&&d();
				ClearLevel();
				DzgBox({
					msg:f.msg,
					type:3
				})
			}else{
				DzgBox({
					msg:f.msg,
					type:4
				});
				c.disabled=false
			}
			return false
		}
	});
	return false
}
function CreateMaskLayer(){
	var b=$("#cm_maskplayer_div");
	if(b.length==0){
		b=$('<div id="cm_maskplayer_div" class="cm_maskplayer" style="display:none"></div>');
		$("body").append(b)
	}
	b.css("display")!=""&&b.css({
		width:$(document).width(),
		height:$(document).height(),
		display:""
	})
}
function ClearMaskLayer(){
	$("#cm_maskplayer_div").remove();
	return false
}
function CreateProcess(){
	windowWidth=$(document).width();
	windowHeight=$(document).height;
	var b=$("#cm_process_div");
	if(b.length==0){
		b=$('<div id="cm_process_div" class="cm_process" style="display:none">系统处理中，请等待...</div>');
		$("body").append(b)
	}
	var c=b.width(),d=b.height();
	b.css("display")!=""&&b.css({
		top:$(document).scrollTop()-100+window.screen.height/2-d/2,
		left:windowWidth/2-c/2,
		display:""
	})
}
function ClearProcess(){
	$("#cm_process_div").remove();
	return false
}
function CreateWait(){
	var b=$("#cm_wait_div");
	if(b.length==0){
		b=$('<div id="cm_wait_div" class="cm_wait" style="display:none">\u6b63\u5728\u8f7d\u5165...</div>');
		$("body").append(b)
	}
	var c=b.width();
	c=b.height();
	b.css("display")!=""&&b.css({
		top:$(document).scrollTop(),
		left:$(document).width()-90,
		display:""
	})
}
function ClearWait(){
	$("#cm_wait_div").remove();
	return false
}
function DzgBox(b,c){
	var d=$("#dzgbox");
	d.length!=0&&d.remove();
	d=$('<div class="dzgbox" id="dzgbox"></div>');
	d.html('<table border="0" cellspacing="0" cellpadding="0" class="ab_zer"><tr id="cm_new_level_title"><td class="ab_top ab_top1">&nbsp;</td><td class="ab_bg" id="dzgbox_title"></td><td class="ab_top ab_top2">&nbsp;</td></tr><tr><td class="ab_bg">&nbsp;</td><td class="ab_con" id="cm_new_level"><div id="dzgbox_content"></div><div id="dzgbox_button"></div></td><td class="ab_bg"></td></tr><tr><td class="ab_top ab_top3">&nbsp;</td><td class="ab_bg_bottom"></td><td class="ab_top ab_top4">&nbsp;</td></tr></table>');
	$("body").append(d);
	$("#cm_new_level_title").bind("mousedown",function(h){
		DzgDrag.init({
			drag:d
		},h)
	});
	type=b.type;
	type==1&&$("#dzgbox_title").html("\u786e\u5b9a\u8981\u8fdb\u884c\u8be5\u64cd\u4f5c\u5417\uff1f");
	type==2&&$("#dzgbox_title").html("\u63d0\u793a\uff01");
	type==3&&$("#dzgbox_title").html("\u64cd\u4f5c\u6210\u529f\uff01");
	type==4&&$("#dzgbox_title").html("\u64cd\u4f5c\u5931\u8d25\uff01");
	$("#dzgbox_content").html(b.msg);
	if(type==1){
		var e=$('<input type="button" value="\u662f" id="dzgbox_btn_yes" class="dzgbox_btn" />&nbsp;&nbsp;'),
		f=$('<input type="button" value="\u5426" id="dzgbox_btn_no" class="dzgbox_btn" />');
		$("#dzgbox_button").append(e);
		$("#dzgbox_button").append(f);
		e.click(function(){
			typeof b.yes=="function"&&b.yes();
			$("#dzgbox").remove()
		});
		f.click(function(){
			typeof b.no=="function"&&b.no();
			$("#dzgbox").remove()
		})
	}else{
		e=$('<input type="button" value="\u786e\u5b9a" id="dzgbox_btn_enter" class="dzgbox_btn" />');
		$("#dzgbox_button").append(e);
		e.click(function(){
			typeof b.enter=="function"&&b.enter();
			$("#dzgbox").remove()
		})
	}
	if(typeof b.mouse==
		"undefined"){
		windowWidth=$(document).width();
		windowHeight=$(window).height();
		c=d.width()/2;
		if(c==0)c=300;
		e=d.height()/2;
		f=windowWidth/2;
		var g=windowHeight/2;
		d.css("top",$(document).scrollTop()+g-e);
		d.css("left",f-c)
	}else{
		evt=c||window.event;
		ev=getEventXY(evt);
		c=ev[0];
		d.css("top",ev[1]);
		d.css("left",c)
	}
	return false
}

function CreateLevel(b,c){
	windowWidth=$(document).width();
	windowHeight=$(document).height();
	var d=$("#cm_new_level_div");
	if(d.length==0){
		d=$('<div class="cm_level_new" id="cm_new_level_div"></div>');
		$("body").append(d);
		d.html('<table border="0" cellspacing="0" cellpadding="0" class="ab_zer"><tr id="cm_new_level_title"><td class="ab_top ab_top1">&nbsp;</td><td class="ab_bg">'+b+'</td><td class="ab_top ab_top2" onclick="ClearLevel()">X</td></tr><tr><td class="ab_bg"></td><td class="ab_con" id="cm_new_level"></td><td class="ab_bg"></td></tr><tr><td class="ab_top ab_top3"></td><td class="ab_bg_bottom"></td><td class="ab_top ab_top4"></td></tr></table>');
	}
	d.css({
		top:windowHeight,
		left:220,
		display:"none"
	});
	return false
}
function ClearLevel(){
	ClearMaskLayer();
	$("#cm_new_level_div").remove();
	return false
}
function ChangeLevel(b) {
	$('cm_new_level').html('');
	var box = $("<div id='cm_level_div' style='overflow:auto; height:300px; width:800px;'>"+b+"</div>")
	$("#cm_new_level").append(box);
	windowWidth=$(document).width();
	windowHeight=$(window).height();
	b=$("#cm_new_level_div");
	var c=b.width()/2;
	if(c==0)c=300;
	var d=b.height()/2,e=windowWidth/2,f=windowHeight/2;
	b.css({
		top:$(document).scrollTop()+f-d,
		left:e-c,
		display:""
	});
	return false
}

webpackJsonp([3],{0:function(t,e,i){i("piIH"),i("BJ53"),t.exports=i("hyqR")},BJ53:function(t,e){},XZtq:function(t,e,i){var s,n,a,o;o=function(t){var e={element:"body",position:null,type:"info",allow_dismiss:!0,newest_on_top:!1,showProgressbar:!1,placement:{from:"top",align:"right"},offset:20,spacing:10,z_index:1031,delay:5e3,timer:1e3,url_target:"_blank",mouse_over:null,animate:{enter:"animated fadeInDown",exit:"animated fadeOutUp"},onShow:null,onShown:null,onClose:null,onClosed:null,icon_type:"class",template:'<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-{0}" role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'};function i(i,s,n){s={content:{message:"object"==typeof s?s.message:s,title:s.title?s.title:"",icon:s.icon?s.icon:"",url:s.url?s.url:"#",target:s.target?s.target:"-"}};n=t.extend(!0,{},s,n),this.settings=t.extend(!0,{},e,n),this._defaults=e,"-"==this.settings.content.target&&(this.settings.content.target=this.settings.url_target),this.animations={start:"webkitAnimationStart oanimationstart MSAnimationStart animationstart",end:"webkitAnimationEnd oanimationend MSAnimationEnd animationend"},"number"==typeof this.settings.offset&&(this.settings.offset={x:this.settings.offset,y:this.settings.offset}),this.init()}String.format=function(){for(var t=arguments[0],e=1;e<arguments.length;e++)t=t.replace(RegExp("\\{"+(e-1)+"\\}","gm"),arguments[e]);return t},t.extend(i.prototype,{init:function(){var t=this;this.buildNotify(),this.settings.content.icon&&this.setIcon(),"#"!=this.settings.content.url&&this.styleURL(),this.styleDismiss(),this.placement(),this.bind(),this.notify={$ele:this.$ele,update:function(e,i){var s={};for(var e in"string"==typeof e?s[e]=i:s=e,s)switch(e){case"type":this.$ele.removeClass("alert-"+t.settings.type),this.$ele.find('[data-notify="progressbar"] > .progress-bar').removeClass("progress-bar-"+t.settings.type),t.settings.type=s[e],this.$ele.addClass("alert-"+s[e]).find('[data-notify="progressbar"] > .progress-bar').addClass("progress-bar-"+s[e]);break;case"icon":var n=this.$ele.find('[data-notify="icon"]');"class"==t.settings.icon_type.toLowerCase()?n.removeClass(t.settings.content.icon).addClass(s[e]):(n.is("img")||n.find("img"),n.attr("src",s[e]));break;case"progress":var a=t.settings.delay-t.settings.delay*(s[e]/100);this.$ele.data("notify-delay",a),this.$ele.find('[data-notify="progressbar"] > div').attr("aria-valuenow",s[e]).css("width",s[e]+"%");break;case"url":this.$ele.find('[data-notify="url"]').attr("href",s[e]);break;case"target":this.$ele.find('[data-notify="url"]').attr("target",s[e]);break;default:this.$ele.find('[data-notify="'+e+'"]').html(s[e])}var o=this.$ele.outerHeight()+parseInt(t.settings.spacing)+parseInt(t.settings.offset.y);t.reposition(o)},close:function(){t.close()}}},buildNotify:function(){var e=this.settings.content;this.$ele=t(String.format(this.settings.template,this.settings.type,e.title,e.message,e.url,e.target)),this.$ele.attr("data-notify-position",this.settings.placement.from+"-"+this.settings.placement.align),this.settings.allow_dismiss||this.$ele.find('[data-notify="dismiss"]').css("display","none"),(this.settings.delay<=0&&!this.settings.showProgressbar||!this.settings.showProgressbar)&&this.$ele.find('[data-notify="progressbar"]').remove()},setIcon:function(){"class"==this.settings.icon_type.toLowerCase()?this.$ele.find('[data-notify="icon"]').addClass(this.settings.content.icon):this.$ele.find('[data-notify="icon"]').is("img")?this.$ele.find('[data-notify="icon"]').attr("src",this.settings.content.icon):this.$ele.find('[data-notify="icon"]').append('<img src="'+this.settings.content.icon+'" alt="Notify Icon" />')},styleDismiss:function(){this.$ele.find('[data-notify="dismiss"]').css({position:"absolute",right:"10px",top:"5px",zIndex:this.settings.z_index+2})},styleURL:function(){this.$ele.find('[data-notify="url"]').css({backgroundImage:"url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)",height:"100%",left:"0px",position:"absolute",top:"0px",width:"100%",zIndex:this.settings.z_index+1})},placement:function(){var e=this,i=this.settings.offset.y,s={display:"inline-block",margin:"0px auto",position:this.settings.position?this.settings.position:"body"===this.settings.element?"fixed":"absolute",transition:"all .5s ease-in-out",zIndex:this.settings.z_index},n=!1,a=this.settings;switch(t('[data-notify-position="'+this.settings.placement.from+"-"+this.settings.placement.align+'"]:not([data-closing="true"])').each(function(){return i=Math.max(i,parseInt(t(this).css(a.placement.from))+parseInt(t(this).outerHeight())+parseInt(a.spacing))}),1==this.settings.newest_on_top&&(i=this.settings.offset.y),s[this.settings.placement.from]=i+"px",this.settings.placement.align){case"left":case"right":s[this.settings.placement.align]=this.settings.offset.x+"px";break;case"center":s.left=0,s.right=0}this.$ele.css(s).addClass(this.settings.animate.enter),t.each(Array("webkit-","moz-","o-","ms-",""),function(t,i){e.$ele[0].style[i+"AnimationIterationCount"]=1}),t(this.settings.element).append(this.$ele),1==this.settings.newest_on_top&&(i=parseInt(i)+parseInt(this.settings.spacing)+this.$ele.outerHeight(),this.reposition(i)),t.isFunction(e.settings.onShow)&&e.settings.onShow.call(this.$ele),this.$ele.one(this.animations.start,function(t){n=!0}).one(this.animations.end,function(i){t.isFunction(e.settings.onShown)&&e.settings.onShown.call(this)}),setTimeout(function(){n||t.isFunction(e.settings.onShown)&&e.settings.onShown.call(this)},600)},bind:function(){var e=this;if(this.$ele.find('[data-notify="dismiss"]').on("click",function(){e.close()}),this.$ele.mouseover(function(e){t(this).data("data-hover","true")}).mouseout(function(e){t(this).data("data-hover","false")}),this.$ele.data("data-hover","false"),this.settings.delay>0){e.$ele.data("notify-delay",e.settings.delay);var i=setInterval(function(){var t=parseInt(e.$ele.data("notify-delay"))-e.settings.timer;if("false"===e.$ele.data("data-hover")&&"pause"==e.settings.mouse_over||"pause"!=e.settings.mouse_over){var s=(e.settings.delay-t)/e.settings.delay*100;e.$ele.data("notify-delay",t),e.$ele.find('[data-notify="progressbar"] > div').attr("aria-valuenow",s).css("width",s+"%")}t<=-e.settings.timer&&(clearInterval(i),e.close())},e.settings.timer)}},close:function(){var e=this,i=parseInt(this.$ele.css(this.settings.placement.from)),s=!1;this.$ele.data("closing","true").addClass(this.settings.animate.exit),e.reposition(i),t.isFunction(e.settings.onClose)&&e.settings.onClose.call(this.$ele),this.$ele.one(this.animations.start,function(t){s=!0}).one(this.animations.end,function(i){t(this).remove(),t.isFunction(e.settings.onClosed)&&e.settings.onClosed.call(this)}),setTimeout(function(){s||(e.$ele.remove(),e.settings.onClosed&&e.settings.onClosed(e.$ele))},600)},reposition:function(e){var i=this,s='[data-notify-position="'+this.settings.placement.from+"-"+this.settings.placement.align+'"]:not([data-closing="true"])',n=this.$ele.nextAll(s);1==this.settings.newest_on_top&&(n=this.$ele.prevAll(s)),n.each(function(){t(this).css(i.settings.placement.from,e),e=parseInt(e)+parseInt(i.settings.spacing)+t(this).outerHeight()})}}),t.notify=function(t,e){return new i(this,t,e).notify},t.notifyDefaults=function(i){return e=t.extend(!0,{},e,i)},t.notifyClose=function(e){void 0===e||"all"==e?t("[data-notify]").find('[data-notify="dismiss"]').trigger("click"):t('[data-notify-position="'+e+'"]').find('[data-notify="dismiss"]').trigger("click")}},n=[i("7t+N")],void 0===(a="function"==typeof(s=o)?s.apply(e,n):s)||(t.exports=a)},hyqR:function(t,e){},piIH:function(t,e,i){(function(t){var e;i("XZtq"),(e=t)(function(){e("#checkAgreeRegister").on("click",function(){e(this).get(0).checked?e("#register-btn").attr("disabled",!1):e("#register-btn").attr("disabled",!0)})}),window.commonNotify=function(t,i,s,n,a,o,l,r,d){e.notify({icon:s,title:a,message:o,url:l},{element:"body",type:n,allow_dismiss:!0,newest_on_top:!0,placement:{from:t,align:i},offset:{x:15,y:80},spacing:10,z_index:1080,delay:2500,timer:1e3,url_target:"_blank",mouse_over:null,animate:{enter:r,exit:d},template:'<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify w-auto" role="alert"><span class="alert-icon" data-notify="icon"></span><div class="alert-text"</div><span class="alert-title" data-notify="title">{1}</span><span data-notify="message">{2}</span></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'})},""!==window._clickAppConfig.alert.success&&window.commonNotify("top","center","far fa-thumbs-up","success",null,window._clickAppConfig.alert.success,"","animated fadeInDown","animated fadeOutUp"),""!==window._clickAppConfig.alert.info&&window.commonNotify("top","center","far fa-bell","info",null,window._clickAppConfig.alert.info,"","animated fadeInDown","animated fadeOutUp"),""!==window._clickAppConfig.alert.warning&&window.commonNotify("top","center","fas fa-exclamation-triangle","warning",null,window._clickAppConfig.alert.warning,"","animated fadeInDown","animated fadeOutUp"),""!==window._clickAppConfig.alert.error&&window.commonNotify("top","center","fas fa-bug","danger",null,window._clickAppConfig.alert.error,"","animated fadeInDown","animated fadeOutUp")}).call(e,i("7t+N"))}},[0]);
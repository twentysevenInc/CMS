
/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 *
 * (stolen from http://touchpunch.furf.com)
 */
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);

browse_history = [];

$(document).ready(function(){

	// load last site when ready
	var cookie = getCookie('cms-site')
	// console.log(cookie);
	if(cookie) cmsLoadSite(cookie);
	else cmsLoadSite('dashboard.php');

	// var show = getCookie('showsidebar');
	// if(show == 'false'){
	// 	document.getElementById('sidebar').style.display = 'none';
	// 	document.getElementById('content').style.width = '100%';
	// 	document.getElementsByTagName('nav')[0].style.width = '100%';
	// 	document.getElementById('overlay').style.marginLeft = '-22%';
	// }

	// $( "#dashboard").sortable({
	// 	update: function( event, ui ) {
	// 		console.log('what');
	// 	}
	// });
 //    $( "#dashboard").disableSelection();
});

function cmsLoadSite(url){
	setCookie("cms-site", url, 100);
	var time = 200;
	$('#content').fadeOut(time);
	$('#overlay').fadeIn(time);
	setTimeout(function(){
		doAjax(url, 'GET', '', function(data){
			// console.log(data);
			$('#content').html(data);
			$('#overlay').fadeOut(200);
			$('#content').fadeIn(200);
		});
	}, time);
}

function cmsSetAndLoadSite(url, elem){
	// set elem active
	$('#sidebar .sidebar-content .sidebar-selected').removeAttr('class', 'sidebar-selected');
	$(elem).attr('class', 'sidebar-selected');

	cmsLoadSite(url);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function notifications(e){
	e.preventDefault();
	if(document.getElementById('notifications').style.display == 'inline'){
		document.getElementById('notifications').style.display = 'none';
	}
	else{
		document.getElementById('notifications').style.display = 'inline';
		document.getElementById('notifications').style.top = '4rem';
		document.getElementById('notifications').style.left = '-2rem';
	}
}

function sidebar(e){
	e.preventDefault();
	return;
	if(document.getElementById('sidebar').style.display == 'none'){

		document.getElementById('sidebar').style.marginLeft = '-78%';
		document.getElementById('sidebar').style.display = 'inline';

		document.getElementById('overlay').style.marginLeft = '0';
		// document.getElementById('content').style.width = '78%';
		// document.getElementsByTagName('nav')[0].style.width = '78%';

		// document.getElementById('sidebar').style.marginLeft = '0px';
		$('#sidebar').animate({
			marginLeft: '0px'
		}, 200, function(){

		});
		if (!mq.matches) {
			$('nav').animate({
				width: '78%'
			}, 200, function(){
			});
			$('#content').animate({
				width: '78%'
			}, 200, function(){
			});
		}
		// $('#hideSidebar').css("display", "none");

		setCookie('showsidebar','true',100);
		$('nav').children().first().css('display','none');
	}else{
		document.getElementById('overlay').style.marginLeft = '-22%';

		$('#sidebar').animate({
			marginLeft: '-22%'
		}, 200, function(){
			document.getElementById('sidebar').style.display = 'none';
		});
		$('nav').animate({
			width: '100%'
		}, 200, function(){
		});
		$('#content').animate({
			width: '100%'
		}, 200, function(){
		});
		// $('#hideSidebar').css("display", "inline");

		setCookie('showsidebar','false',100);
		$('nav').children().first().css('display','inline-block');

		// document.getElementsByTagName('nav')[0].firstChild.style.display = 'block';
		// document.getElementById('content').style.width = '100%';
		// document.getElementsByTagName('nav')[0].style.width = '100%';
	}

}
$(document).ready(function(){
	if(getCookie('showsidebar') == 'true'){
		$('nav').children().first().css('display','none');
	}
	// $('#darken').click(function(){
	// 	hideAlerts();
	// });
	if (matchMedia) {
		mq = window.matchMedia("(max-width: 320pt)");
		mq.addListener(mobileSidebar);
		mobileSidebar(mq);
	}
});
function mobileSidebar(mq) {
	if (mq.matches) {
		$('nav').children().first().css('display','inline-block');
		$('#sidebar').css('display','none');
		$('#overlay').css('marginLeft', '-22%');
	}
}

function doAjax(url, type, data, callback){
	$.ajax({
		type: type,
		url: url,
		data: data,
		success: function(data){
			callback(data);
		},
		error: function(xhr, status, error){
			var err = xhr.responseText;
			ret = err.Message;
		}
	});
}


function hideAlerts(){
	$('#alert').fadeOut(150);
	$('#warning').fadeOut(150);
	$('#darken').fadeOut(250);
}

function showAlert(title, message, buttonTitles, buttonColors, actions){
	// console.log(actions[0]);
	var alert = $('#alert');
	alert.find('h2').html(title);
	alert.find('p').html(message);
	$('#darken').fadeIn(150);
	alert.fadeIn(250);

	alert.find('li').html('');
	for (var i = 0; i < buttonTitles.length; i++) {
		alert.find('li').append('<a href="javascript:void(0);" onclick="('+actions[i]+')(event);" class="button '+buttonColors[i]+'">'+buttonTitles[i]+"</a>")
	};
}

function showWarning(title, message, buttonTitles, buttonColors, actions){
	// console.log(actions[0]);
	var alert = $('#warning');
	alert.find('h2').html(title);
	alert.find('p').html(message);
	$('#darken').fadeIn(150);
	alert.fadeIn(250);

	alert.find('li').html('');
	for (var i = 0; i < buttonTitles.length; i++) {
		alert.find('li').append('<a href="javascript:void(0);" onclick="('+actions[i]+')(event);" class="button '+buttonColors[i]+'">'+buttonTitles[i]+"</a>")
	};
}

function pushSite(url, data){
	data = data.replace("$(document).ready", "");
	browse_history.push([url, data]);
}

function popSite(){
	return browse_history.pop();
}

function navigateBack(){
	$('#content').fadeOut(100);
	var site = popSite();
	setCookie("cms-site", site[1]);
	setTimeout(function(){
		$('#content').html(site[1]);
		$('#content').fadeIn(100);
	}, 100);
}

function navigateTo(url){
	var cookieUrl = getCookie("cms-site");
	setCookie("cms-site", url);
	pushSite(cookieUrl, $('#content').html());
	var btn = '<h3><img src="img/back-white.png"><a href="javascript:void(0);" onClick="javascript:navigateBack();">Back</a></h3>';
	$('#content').fadeOut(100);
	$('#overlay').fadeIn(200);

	setTimeout(function(){
		$.ajax({
		type: "GET",
		url: url,
		success: function(data){
			var menu = '<ul class="menu">\n'+btn+'\n</ul>\n';
			$('#content').html(menu + data);
			$('#overlay').fadeOut(200);
			$('#content').fadeIn(100);
		},
		error: function(xhr, status, error){
			alert("An error occured");
			//reload page
			var err = eval("(" + xhr.responseText + ")");
			alert(err.Message);
		}
	});
	}, 100);
}

function navigateToWithMenuColor(url, menuColor){
	var cookieUrl = getCookie("cms-site");
	setCookie("cms-site", url);
	pushSite(cookieUrl, $('#content').html());
	var btn = '<h3><img src="img/back.png"><a href="javascript:void(0);" onClick="javascript:navigateBack();">Back</a></h3>';
	$('#content').fadeOut(100);
	$('#overlay').fadeIn(200);

	setTimeout(function(){
		$.ajax({
		type: "GET",
		url: url,
		success: function(data){
			var menu = '<ul class="menu '+menuColor+'">\n'+btn+'\n</ul>\n';
			$('#content').html(menu + data);
			$('#overlay').fadeOut(200);
			$('#content').fadeIn(100);
		},
		error: function(xhr, status, error){
			alert("An error occured");
			//reload page
			var err = eval("(" + xhr.responseText + ")");
			alert(err.Message);
		}
	});
	}, 100);
}

function navigateToWithMenuColorAndActions(url, menuColor, actions){

	//[["title", "action", "classes"], ...]

	var cookieUrl = getCookie("cms-site");
	setCookie("cms-site", url);
	pushSite(cookieUrl, $('#content').html());

	var a = "";
	for (var i = 0; i < actions.length; i++) {
		a += "<a href='javascript:void(0);' onclick='"+actions[i][1]+"' class='button "+actions[i][2]+"'>"+actions[i][0]+"</a>";
	}

	var btn = '<h3><img src="img/back.png"><a href="javascript:void(0);" onClick="javascript:navigateBack();">Back</a></h3>' + a;
	if (menuColor.length < 1)
		btn = '<h3><img src="img/back-white.png"><a href="javascript:void(0);" onClick="javascript:navigateBack();">Back</a></h3>' + a;

	$('#content').fadeOut(100);
	$('#overlay').fadeIn(200);

	setTimeout(function(){
		$.ajax({
		type: "GET",
		url: url,
		success: function(data){
			var menu = '<ul class="menu '+menuColor+'">\n'+btn+'\n</ul>\n';
			$('#content').html(menu + data);
			$('#overlay').fadeOut(200);
			$('#content').fadeIn(100);
		},
		error: function(xhr, status, error){
			alert("An error occured");
			//reload page
			var err = eval("(" + xhr.responseText + ")");
			alert(err.Message);
		}
	});
	}, 100);
}

function menuLoadSite(elem, url, src){
	var cookieUrl = getCookie("cms-site");
	setCookie("cms-site", url);
	pushSite(cookieUrl, $('#content').html());
	// console.log($('#content').html());
	$(elem).fadeOut(100);
	$('#overlay').fadeIn(200);

	$('#content .menu .active').removeAttr('class', 'active');
	$(src).attr('class', 'active');

	setTimeout(function(){
		$.ajax({
		type: "GET",
		url: url,
		success: function(data){
			$(elem).html(data);
			$('#overlay').fadeOut(200);
			$(elem).fadeIn(100);
		},
		error: function(xhr, status, error){
			alert("An error occured");
			//reload page
			var err = eval("(" + xhr.responseText + ")");
			alert(err.Message);
		}
	});
	}, 100);
}

function checkSystem(){
    $('#check-system-button').html('<img src="img/loading.gif"/>');
    doAjax("checkSystem/checkSystem.php", "GET", null, function(data){
        $('#state-content').fadeOut(function(){
            changeView($('.active'));
            $('#state-content').fadeIn(function(){
                showAlert(
                    'Fancy!',
                    'CMS state check just finished!',
                    ['Okay','Show me!'],
                    ['normal-button','normal-button'],
                    [function(){ hideAlerts();},function(){ hideAlerts();changeView($('.menu h1:first-of-type a'));}]
                    );
            });
        });
    });
}

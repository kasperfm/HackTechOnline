webpackJsonp([2,5],{14:function(e,i,o){(function(e){!function(e){e.notification=function(i){function o(e){var i=[[2,"One second","1 second from now"],[60,"seconds",1],[120,"One minute","1 minute from now"],[3600,"minutes",60],[7200,"One hour","1 hour from now"],[86400,"hours",3600],[172800,"One day","tomorrow"],[604800,"days",86400],[1209600,"One week","next week"],[2419200,"weeks",604800],[4838400,"One month","next month"],[29030400,"months",2419200],[58060800,"One year","next year"],[290304e4,"years",29030400],[580608e4,"One century","next century"],[580608e5,"centuries",290304e4]],o=(new Date-e)/1e3,t=1;o<0&&(o=Math.abs(o),"from now",t=1);for(var n,a=0;n=i[a++];)if(o<n[0])return"string"==typeof n[2]?n[t]:Math.floor(o/n[2])+" "+n[1];return e}var t,n,a,s,r,d,l;if(i=e.extend({title:void 0,content:void 0,timeout:0,img:void 0,border:!0,fill:!1,showTime:!1,click:void 0,icon:void 0,color:void 0,error:!1},i),t=e("#notifications"),t.length||(t=e("<div>",{id:"notifications"}).appendTo(e("body"))),n=e("<div>"),n.addClass("notification animated fadeInLeftMiddle fast"),1==i.error&&n.addClass("error"),e("#notifications .notification").length>0?n.addClass("more"):t.addClass("animated flipInX").delay(1e3).queue(function(){t.removeClass("animated flipInX"),t.clearQueue()}),a=e("<div>",{click:function(){e(this).parent().is(":last-child")?(e(this).parent().remove(),e("#notifications .notification:last-child").removeClass("more")):e(this).parent().remove()}}),a.addClass("hide"),d=e("<div class='left'>"),r=e("<div class='right'>"),void 0!=i.title){var c="<h2>"+i.title+"</h2>";n.addClass("big")}else var c="";if(void 0!=i.content)var f=i.content;else var f="";if(l=e("<div>",{html:c+f}),l.addClass("inner"),l.appendTo(r),void 0!=i.img)s=e("<div>",{style:"background-image: url('"+i.img+"')"}),s.addClass("img"),s.appendTo(d),0==i.border&&s.addClass("border"),1==i.fill&&s.addClass("fill");else{if(void 0!=i.icon)var m=i.icon;else if(1!=i.error)var m='"';else var m="c";icon=e('<div class="icon">').html(m),void 0!=i.color&&icon.css("color",i.color),icon.appendTo(d)}if(d.appendTo(n),r.appendTo(n),a.appendTo(n),0!=i.showTime){var v=Number(new Date);timeHTML=e("<div>",{html:"<strong>"+o(v)+"</strong> ago"}),timeHTML.addClass("time").attr("title",v),timeHTML.appendTo(r),setInterval(function(){e(".time").each(function(){var i=e(this).attr("title");e(this).html("<strong>"+o(i)+"</strong> ago")})},4e3)}return n.hover(function(){a.show()},function(){a.hide()}),n.prependTo(t),n.show(),i.timeout&&setTimeout(function(){var e=n.prev();e.hasClass("more")&&(e.is(":first-child")||n.is(":last-child"))&&e.removeClass("more"),n.remove()},i.timeout),void 0!=i.click&&(n.addClass("click"),n.bind("click",function(o){e(o.target).is(".hide")||i.click.call(this)})),this}}(e)}).call(i,o(1))},40:function(e,i,o){e.exports=o(14)}},[40]);
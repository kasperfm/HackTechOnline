!function(e){var t={};function n(o){if(t[o])return t[o].exports;var i=t[o]={i:o,l:!1,exports:{}};return e[o].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)n.d(o,i,function(t){return e[t]}.bind(null,i));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=42)}({42:function(e,t,n){e.exports=n(43)},43:function(e,t){var n;(n=jQuery).notification=function(e){function t(e){var t=[[2,"One second","1 second from now"],[60,"seconds",1],[120,"One minute","1 minute from now"],[3600,"minutes",60],[7200,"One hour","1 hour from now"],[86400,"hours",3600],[172800,"One day","tomorrow"],[604800,"days",86400],[1209600,"One week","next week"],[2419200,"weeks",604800],[4838400,"One month","next month"],[29030400,"months",2419200],[58060800,"One year","next year"],[290304e4,"years",29030400],[580608e4,"One century","next century"],[580608e5,"centuries",290304e4]],n=(new Date-e)/1e3,o=1;n<0&&(n=Math.abs(n),o=1);for(var i,r=0;i=t[r++];)if(n<i[0])return"string"==typeof i[2]?i[o]:Math.floor(n/i[2])+" "+i[1];return e}var o,i,r,a,l,s,d;if(e=n.extend({title:void 0,content:void 0,timeout:0,img:void 0,border:!0,fill:!1,showTime:!1,click:void 0,icon:void 0,color:void 0,error:!1},e),(o=n("#notifications")).length||(o=n("<div>",{id:"notifications"}).appendTo(n("body"))),(i=n("<div>")).addClass("notification animated fadeInLeftMiddle fast"),1==e.error&&i.addClass("error"),n("#notifications .notification").length>0?i.addClass("more"):o.addClass("animated flipInX").delay(1e3).queue((function(){o.removeClass("animated flipInX"),o.clearQueue()})),(r=n("<div>",{click:function(){n(this).parent().is(":last-child")?(n(this).parent().remove(),n("#notifications .notification:last-child").removeClass("more")):n(this).parent().remove()}})).addClass("hide"),s=n("<div class='left'>"),l=n("<div class='right'>"),null!=e.title){var c="<h2>"+e.title+"</h2>";i.addClass("big")}else c="";if(null!=e.content)var u=e.content;else u="";if((d=n("<div>",{html:c+u})).addClass("inner"),d.appendTo(l),null!=e.img)(a=n("<div>",{style:"background-image: url('"+e.img+"')"})).addClass("img"),a.appendTo(s),0==e.border&&a.addClass("border"),1==e.fill&&a.addClass("fill");else{if(null!=e.icon)var f=e.icon;else f=1!=e.error?'"':"c";icon=n('<div class="icon">').html(f),null!=e.color&&icon.css("color",e.color),icon.appendTo(s)}if(s.appendTo(i),l.appendTo(i),r.appendTo(i),0!=e.showTime){var m=Number(new Date);timeHTML=n("<div>",{html:"<strong>"+t(m)+"</strong> ago"}),timeHTML.addClass("time").attr("title",m),timeHTML.appendTo(l),setInterval((function(){n(".time").each((function(){var e=n(this).attr("title");n(this).html("<strong>"+t(e)+"</strong> ago")}))}),4e3)}return i.hover((function(){r.show()}),(function(){r.hide()})),i.prependTo(o),i.show(),e.timeout&&setTimeout((function(){var e=i.prev();e.hasClass("more")&&(e.is(":first-child")||i.is(":last-child"))&&e.removeClass("more"),i.remove()}),e.timeout),null!=e.click&&(i.addClass("click"),i.bind("click",(function(t){n(t.target).is(".hide")||e.click.call(this)}))),this}}});
!function(t){function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}var e={};n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:o})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},n.p="",n(n.s=46)}({46:function(t,n,e){t.exports=e(47)},47:function(t,n){Echo.private("notifications"+parent.userToken).listen("Notification",function(t){var n=5e3;!1===t.autohide&&(n=0),$.notification({title:t.title,icon:"c",color:"#fff",timeout:n,content:t.message})})}});
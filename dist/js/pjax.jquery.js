!function(t){var e={support:{pjax:window.history&&window.history.pushState&&window.history.replaceState&&!navigator.userAgent.match(/(iPod|iPhone|iPad|WebApps\/.+CFNetwork)/),storage:!!window.localStorage},toInt:function(t){return parseInt(t)},stack:{},getTime:function(){return 1*new Date},getRealUrl:function(t){return t=(t||"").replace(/\#.*?$/,""),t=t.replace("?pjax=true&","?").replace("?pjax=true","").replace("&pjax=true","")},getUrlHash:function(t){return t.replace(/^[^\#]*(?:\#(.*?))?$/,"$1")},getLocalKey:function(t){var e="pjax_"+encodeURIComponent(t);return{data:e+"_data",time:e+"_time",title:e+"_title"}},removeAllCache:function(){if(e.support.storage)for(var t in localStorage)"pjax"===(t.split("_")||[""])[0]&&delete localStorage[t]},getCache:function(t,o,a){var n,l,r;if(o=e.toInt(o),t in e.stack){if(n=e.stack[t],ctime=e.getTime(),n.time+1e3*o>ctime)return n;delete e.stack[t]}else if(a&&e.support.storage){var i=e.getLocalKey(t);if(l=i.data,r=i.time,n=localStorage.getItem(l)){if(e.toInt(localStorage.getItem(r))+1e3*o>e.getTime())return{data:n,title:localStorage.getItem(i.title)};localStorage.removeItem(l),localStorage.removeItem(r),localStorage.removeItem(i.title)}}return null},setCache:function(t,o,a,n){var l,r=e.getTime();e.stack[t]={data:o,title:a,time:r},n&&e.support.storage&&(l=e.getLocalKey(t),localStorage.setItem(l.data,o),localStorage.setItem(l.time,r),localStorage.setItem(l.title,a))},removeCache:function(t){if(t=e.getRealUrl(t||location.href),delete e.stack[t],e.support.storage){var o=e.getLocalKey(t);localStorage.removeItem(o.data),localStorage.removeItem(o.time),localStorage.removeItem(o.title)}}},o=function(a){if(a=t.extend({selector:"",container:"",callback:function(){},filter:function(){}},a),!a.container||!a.selector)throw new Error("selector & container options must be set");t("body").delegate(a.selector,"click",function(n){if(n.which>1||n.metaKey)return!0;var l=t(this),r=l.attr("href");if("function"==typeof a.filter&&!0===a.filter.call(this,r,this))return!0;if(r===location.href)return!0;if(e.getRealUrl(r)==e.getRealUrl(location.href)){var i=e.getUrlHash(r);return i&&(location.hash=i,a.callback&&a.callback.call(this,{type:"hash"})),!0}n.preventDefault(),a=t.extend(!0,a,{url:r,element:this,push:!0}),o.request(a)})};o.xhr=null,o.options={},o.state={},o.defaultOptions={timeout:2e3,element:null,cache:86400,storage:!0,url:"",push:!0,show:"",title:"",titleSuffix:"",type:"GET",data:{pjax:!0},dataType:"html",callback:null,beforeSend:function(e){t(o.options.container).trigger("pjax.start",[e,o.options]),e&&e.setRequestHeader("X-PJAX",!0)},error:function(){o.options.callback&&o.options.callback.call(o.options.element,{type:"error"}),location.href=o.options.url},complete:function(e){t(o.options.container).trigger("pjax.end",[e,o.options])}},o.showFx={_default:function(t,e,o){this.html(t),e&&e.call(this,t,o)},fade:function(t,e,o){var a=this;o?(a.html(t),e&&e.call(a,t,o)):this.fadeOut(500,function(){a.html(t).fadeIn(500,function(){e&&e.call(a,t,o)})})}},o.showFn=function(e,a,n,l,r){var i=null;"function"==typeof e?i=e:(e in o.showFx||(e="_default"),i=o.showFx[e]),i&&i.call(a,n,function(){var e=location.hash;""!=e?(location.href=e,/Firefox/.test(navigator.userAgent)&&history.replaceState(t.extend({},o.state,{url:null}),document.title)):window.scrollTo(0,0),l&&l.call(this,n,r)},r)},o.success=function(a,n){if(!0!==n&&(n=!1),o.html&&(a=t(a).find(o.html).html()),-1!=(a||"").indexOf("<html"))return o.options.callback&&o.options.callback.call(o.options.element,{type:"error"}),location.href=o.options.url,!1;var l,r=o.options.title||"";""==r&&o.options.element&&(l=t(o.options.element),r=l.attr("title")||l.text());var i=a.match(/<title>(.*?)<\/title>/);i&&(r=i[1]),r&&-1==r.indexOf(o.options.titleSuffix)&&(r+=o.options.titleSuffix),document.title=r,o.state={container:o.options.container,timeout:o.options.timeout,cache:o.options.cache,storage:o.options.storage,show:o.options.show,title:r,url:o.options.oldUrl};var c=t.param(o.options.data);""!=c&&(o.state.url=o.options.url+(/\?/.test(o.options.url)?"&":"?")+c),o.options.push?(o.active||(history.replaceState(t.extend({},o.state,{url:null}),document.title),o.active=!0),history.pushState(o.state,document.title,o.options.oldUrl)):!1===o.options.push&&history.replaceState(o.state,document.title,o.options.oldUrl),o.options.showFn&&o.options.showFn(a,function(){o.options.callback&&o.options.callback.call(o.options.element,{type:n?"cache":"success"})},n),o.options.cache&&!n&&e.setCache(o.options.url,a,r,o.options.storage)},o.request=function(a){a.hasOwnProperty("data")&&(o.defaultOptions.data=a.data),a=t.extend(!0,o.defaultOptions,a);var n,l=t(a.container);if(a.oldUrl=a.url,a.url=e.getRealUrl(a.url),t(a.element).length&&(n=e.toInt(t(a.element).attr("data-pjax-cache")))&&(a.cache=n),!0===a.cache&&(a.cache=86400),a.cache=e.toInt(a.cache),0===a.cache&&e.removeAllCache(),a.showFn||(a.showFn=function(t,e,n){o.showFn(a.show,l,t,e,n)}),o.options=a,o.options.success=o.success,a.cache&&(n=e.getCache(a.url,a.cache,a.storage)))return a.beforeSend(),a.title=n.title,o.success(n.data,!0),a.complete(),!0;o.xhr&&o.xhr.readyState<4&&(o.xhr.onreadystatechange=t.noop,o.xhr.abort()),o.xhr=t.ajax(o.options)};var a="state"in window.history,n=location.href;t(window).bind("popstate",function(e){var l=!a&&location.href==n;if(a=!0,!l){var r=e.state;if(r&&r.container)if(t(r.container).length){var i={url:r.url,container:r.container,push:null,timeout:r.timeout,cache:r.cache,storage:r.storage,title:r.title,element:null};o.request(i)}else window.location=location.href}}),e.support.pjax||(o=function(){return!0},o.request=function(t){t&&t.url&&(location.href=t.url)}),t.pjax=o,t.pjax.util=e,t.inArray("state",t.event.props)<0&&t.event.props.push("state")}(jQuery);
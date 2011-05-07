/*1303601705,169776317*/

if (window.CavalryLogger) { CavalryLogger.start_js(["uBXoU"]); }

if(!window.skipDomainLower&&navigator&&navigator.userAgent&&document.domain.toLowerCase().match(/(^|\.)facebook\..*/)&&!(parseInt((/Gecko\/([0-9]+)/.exec(navigator.userAgent)||[]).pop(),10)<=20060508))document.domain=window.location.hostname.replace(/^.*(facebook\..*)$/i,'$1');window.onloadhooks=window.onloadhooks||[];window.onloadRegister=window.onloadRegister||function(a){onloadhooks.push(a);};window.onafterloadhooks=window.onafterloadhooks||[];window.onafterloadRegister=window.onafterloadRegister||function(a){onafterloadhooks.push(a);};function run_if_loaded(a,b){return window.loaded&&b.call(a);}function run_with(b,a,c){Bootloader.loadComponents(a,bind(b,c));return false;}function wait_for_load(c,b,e){e=bind(c,e,b);if(window.loaded)return e();switch((b||event).type){case 'load':case 'focus':onafterloadRegister(e);return;case 'click':var d=c.style,a=document.body.style;d.cursor=a.cursor='progress';onafterloadRegister(function(){d.cursor=a.cursor='';if(c.tagName.toLowerCase()=='a'){if(false!==e()&&c.href)window.location.href=c.href;}else if(c.click)c.click();});break;}return false;}function bind(c,b){var a=Array.prototype.slice.call(arguments,2);return function(){var e=c||(this==window?false:this),d=a.concat(Array.prototype.slice.call(arguments));if(typeof(b)=="string"){if(e[b])return e[b].apply(e,d);}else return b.apply(e,d);};}var curry=bind(null,bind,null);function env_get(a){return window.Env&&Env[a];}window.__DEV__=window.__DEV__||0;document.documentElement.className=document.documentElement.className.replace('no_js','');
function hasArrayNature(a){return (!!a&&(typeof a=='object'||typeof a=='function')&&('length' in a)&&!('setInterval' in a)&&(Object.prototype.toString.call(a)==="[object Array]"||('callee' in a)||('item' in a)));}function $A(b){if(!hasArrayNature(b))return [b];if(b.item){var a=b.length,c=new Array(a);while(a--)c[a]=b[a];return c;}return Array.prototype.slice.call(b);}
function eval_global(c){if('string'!=typeof(c)){throw new Error('JS sent to eval_global is not a string.  Only strings '+'are permitted.');}else if(''==c)return;var d=document.createElement('script');d.type='text/javascript';try{d.appendChild(document.createTextNode(c));}catch(a){d.text=c;}var b=(document.getElementsByTagName("head")[0]||document.documentElement);b.appendChild(d);b.removeChild(d);}
function copy_properties(b,c){b=b||{};c=c||{};for(var a in c)b[a]=c[a];if(c.hasOwnProperty&&c.hasOwnProperty('toString')&&(typeof c.toString!='undefined')&&(b.toString!==c.toString))b.toString=c.toString;return b;}function add_properties(a,b){return copy_properties(window[a]||(window[a]={}),b);}function is_empty(b){if(b instanceof Array){return b.length==0;}else if(b instanceof Object){for(var a in b)return false;return true;}else return !b;}
if(!window.async_callback)window.async_callback=function(a,b){return a;};function Arbiter(){copy_properties(this,{_listeners:[],_events:{},_callbacks:{},_last_id:1,_listen:{},_index:{}});copy_properties(this,Arbiter);}copy_properties(Arbiter,{SUBSCRIBE_NEW:'new',SUBSCRIBE_ALL:'all',BEHAVIOR_EVENT:'event',BEHAVIOR_PERSISTENT:'persistent',BEHAVIOR_STATE:'state',LIVEMESSAGE:'livemessage',BOOTLOAD:'bootload',FUNCTION_EXTENSION:'function_ext',CONTEXT_CHANGE:'ui/context-change',PAGECACHE_INVALIDATE:'pagecache/invalidate',NEW_NOTIFICATIONS:'chat/new_notifications',LIST_EDITOR_LISTS_CHANGED:'listeditor/friend_lists_changed',subscribe:function(k,b,i){if(!k||k.length==0)return null;k=$A(k);var a=Arbiter._getInstance(this);a._listeners.push({callback:b,types:k});var h=a._listeners.length-1;for(var d=0;d<k.length;d++)if(a._index[k[d]]){a._index[k[d]].push(h);}else a._index[k[d]]=[h];i=i||Arbiter.SUBSCRIBE_ALL;if(i==Arbiter.SUBSCRIBE_ALL){var c,j,g;for(var e=0;e<k.length;e++){j=k[e];if(j in a._events)for(var f=0;f<a._events[j].length;f++){c=a._events[j][f];g=b.apply(null,[j,c]);if(g===false){a._events[j].splice(f,1);f--;}}}}return {subscriberID:h};},unsubscribe:function(e){var a=Arbiter._getInstance(this);var c=a._listeners[e.subscriberID];for(var d=0;d<c.types.length;d++){var f=c.types[d];if(a._index[f])for(var b=0;b<a._index[f].length;b++)if(a._index[f][b]==e.subscriberID){a._index[f].splice(b,1);if(a._index[f].length==0)delete a._index[f];break;}}delete a._listeners[e.subscriberID];},inform:function(i,c,b){var l=hasArrayNature(i);var k=$A(i);var a=Arbiter._getInstance(this);var h={};b=b||Arbiter.BEHAVIOR_EVENT;for(var e=0;e<k.length;e++){var i=k[e],d=null;if(b==Arbiter.BEHAVIOR_PERSISTENT){d=a._events.length;if(!(i in a._events))a._events[i]=[];a._events[i].push(c);a._events[i]._stateful=false;}else if(b==Arbiter.BEHAVIOR_STATE){d=0;a._events[i]=[c];a._events[i]._stateful=true;}else if(i in a._events)a._events[i]._stateful=false;window.ArbiterMonitor&&ArbiterMonitor.log('event',i,c,a);var g;if(a._index[i]){var j=$A(a._index[i]);for(var f=0;f<j.length;f++){g=a._listeners[j[f]].callback.apply(null,[i,c]);if(g===false){if(d!==null)a._events[i].splice(d,1);break;}}}a._updateCallbacks(i,c);window.ArbiterMonitor&&ArbiterMonitor.log('done',i,c,a);h[i]=g;}return l?h:h[k[0]];},query:function(b){var a=Arbiter._getInstance(this);if(!(b in a._events))return null;if(a._events[b].length)return a._events[b][0];return null;},_instance:null,_getInstance:function(a){if(a instanceof Arbiter)return a;if(!Arbiter._instance)Arbiter._instance=new Arbiter();return Arbiter._instance;},registerCallback:function(b,d){var h,c=0,a=Arbiter._getInstance(this),g=false;if(typeof b=='function'){h=a._last_id;a._last_id++;g=true;}else{if(!a._callbacks[b])return null;h=b;}if(hasArrayNature(d)){var i={};for(var f=0;f<d.length;f++)i[d[f]]=1;d=i;}for(var j in d){try{if(a.query(j))continue;}catch(e){}c+=d[j];if(a._listen[j]===undefined)a._listen[j]={};a._listen[j][h]=(a._listen[j][h]||0)+d[j];}if(c==0&&g){b();return null;}if(!g){a._callbacks[h].depnum+=c;}else a._callbacks[h]={callback:async_callback(b,'arbiter'),depnum:c};return h;},_updateCallbacks:function(d,c){if(c===null||!this._listen[d])return;for(var b in this._listen[d]){this._listen[d][b]--;if(this._listen[d][b]<=0)delete this._listen[d][b];this._callbacks[b].depnum--;if(this._callbacks[b].depnum<=0){var a=this._callbacks[b].callback;delete this._callbacks[b];a();}}}});
Function.prototype.deferUntil=function(a,h,b,i){var f=a();if(f){this(f);return;}var e=this,d=null,g=(+new Date());var c=function(){f=a();if(!f)if(h&&(new Date()-g)>=h){i&&i();}else return;d&&clearInterval(d);e(f);};d=setInterval(c,20,b);return d;};var Bootloader=window.Bootloader=(window.Bootloader&&window.Bootloader.realBootloader)?window.Bootloader:(function(a){return {realBootloader:true,configurePage:function(b){var h={};var g=this.resolveResources(b);for(var c=0;c<g.length;c++){h[g[c].src]=g[c];this.requested(g[c].name);this._startCSSPoll(g[c].name);}var e=document.getElementsByTagName('link');for(var c=0;c<e.length;++c){if(e[c].rel!='stylesheet')continue;for(var d in h)if(e[c].href.indexOf(d)!==-1){var f=h[d].name;this._cssLinkMap[f]={link:e[c]};if(h[d].permanent)this._permanent[f]=true;delete h[d];break;}}},loadComponents:function(d,b){d=$A(d);var g=[];for(var e=0;e<d.length;++e){if(!d[e])continue;var c=this._componentMap[d[e]];if(!!c)for(var f=0;f<c.length;++f)g.push(c[f]);}return this.loadResources(g,b);},loadResources:function(h,b,g,k){h=Bootloader.resolveResources($A(h));if(g){var e={};for(var c=0;c<h.length;++c)e[h[c].name]=true;for(var d in this._requested)if(!(d in this._permanent)&&!(d in e)&&!(d in this._earlyResources))this._unloadResource(d);this._earlyResources={};}var l=[];var f=[];for(var c=0;c<h.length;++c){var i=h[c];if(i.permanent)this._permanent[i.name]=true;var j=Arbiter.BOOTLOAD+'/'+i.name;if(Arbiter.query(j)!==null)continue;if(!i.nonblocking)f.push(j);if(!this._requested[i.name]){this.requested(i.name);l.push(i);window.CavalryLogger&&CavalryLogger.getInstance().measureResources(i,k);}}if(b)b=Arbiter.registerCallback(b,f);for(var c=0;c<l.length;++c)this.requestResource(l[c].type,l[c].src,l[c].name);return b;},requestResource:function(k,h,f){var c=this.getHardpoint();if(k=='js'){var g=document.createElement('script');g.src=h;g.type='text/javascript';g.async=true;var b=function(){Bootloader.done([f]);};g.onload=g.onerror=b;g.onreadystatechange=function(){if(this.readyState in {loaded:1,complete:1})b();};c.appendChild(g);}else if(k=='css'){if(document.createStyleSheet){var i=this._styleTags,j=-1;for(var d=0;d<i.length;d++)if(i[d].imports.length<25){j=d;break;}if(j==-1){i.push(document.createStyleSheet());j=i.length-1;}i[j].addImport(h);this._cssLinkMap[f]={tagIdx:j,href:h};}else{var e=document.createElement('link');e.rel="stylesheet";e.type="text/css";e.media="all";e.href=h;this._cssLinkMap[f]={link:e};c.appendChild(e);}this._startCSSPoll(f);}},_activeCSSPolls:{},_expireTime:null,_runCSSPolls:function(){var g=(+new Date());if(g>=this._expireTime){if(window.send_error_signal)if(Math.random()<.01)send_error_signal('js_timeout_and_exception','00001:error:CSS timeout.');var d=[];for(var f in this._activeCSSPolls)d.push(f);Bootloader.done(d,true);this._activeCSSPolls={};}else{var e=Bootloader._CSS_EXPECTED_HEIGHT;var b;var d=[];for(var f in this._activeCSSPolls){var c=this._activeCSSPolls[f];var h=c.offsetHeight==e||c.currentStyle&&c.currentStyle.height==e+'px'||window.getComputedStyle&&(b=document.defaultView.getComputedStyle(c,null))&&b.getPropertyValue('height')==e+'px';if(h){d.push(f);c.parentNode.removeChild(c);delete this._activeCSSPolls[f];}}if(!is_empty(d)){Bootloader.done(d,true);this._expireTime=g+Bootloader._CSS_POLL_EXPIRATION;}}return is_empty(this._activeCSSPolls);},_startCSSPoll:function(d){var c='bootloader_'+d.replace(/[^a-z0-9]/ig,'_');var b=bagofholding;bind(this,function(){var e=document.createElement('div');e.id=c;document.body.appendChild(e);this._expireTime=(+new Date())+Bootloader._CSS_POLL_EXPIRATION;var g=is_empty(this._activeCSSPolls);this._activeCSSPolls[d]=e;if(g)var f=setInterval(bind(this,function(){if(this._runCSSPolls())f&&clearInterval(f);}),20);}).deferUntil(function(){return document.body;},5000,false,b.curry("Still no DOM"));},done:function(f,c){var g=(a&&a._preloaded)||[];(a||{})._preloaded=[];f=f.concat(g);this.requested(f);if(!c){var e={sender:this};Arbiter.inform(Arbiter.BOOTLOAD,e,Arbiter.BEHAVIOR_EVENT);}for(var b=0;b<f.length;++b){var d=f[b];Arbiter.inform(Arbiter.BOOTLOAD+'/'+d,true,Arbiter.BEHAVIOR_STATE);}},requested:function(c){c=$A(c);for(var b=0;b<c.length;++b)this._requested[c[b]]=true;},enableBootload:function(b){for(var c in b)if(!this._componentMap[c])this._componentMap[c]=b[c];},_unloadResource:function(e){if(e in this._cssLinkMap){var c=this._cssLinkMap[e],d=c.link;if(d){d.parentNode.removeChild(d);}else{var f=this._styleTags[c.tagIdx];for(var b=0;b<f.imports.length;b++)if(f.imports[b].href==c.href){f.removeImport(b);break;}}delete this._cssLinkMap[e];delete this._requested[e];Arbiter.inform(Arbiter.BOOTLOAD+'/'+e,null,Arbiter.BEHAVIOR_STATE);}},getHardpoint:function(){if(!this._hardpoint){var c,b=document.getElementsByTagName('head');if(b.length){c=b[0];}else c=document.body;this._hardpoint=c;}return this._hardpoint;},setResourceMap:function(c){if(!c)return;for(var b in c){if(!c[b].name)c[b].name=b;this._resources[b]=c[b];}},resolveResources:function(e,b){if(!e)return;var d=new Array(e.length);for(var c=0;c<e.length;++c)if(!e[c].type&&e[c] in this._resources){d[c]=this._resources[e[c]];if(b&&(b in d[c]))d[c]=d[c][b];}else d[c]=e[c];return d;},loadEarlyResources:function(d){this.setResourceMap(d);var c=[];for(var b in d)c.push(this._resources[b]);this.loadResources(c);for(var b in d){var e=this._resources[b];if(!e.permanent)this._earlyResources[e.name]=e;}},_requested:{},_permanent:{},_componentMap:{},_cssLinkMap:{},_styleTags:[],_hardpoint:null,_resources:{},_earlyResources:{},_CSS_POLL_EXPIRATION:5000,_CSS_EXPECTED_HEIGHT:42};})(window.Bootloader);
if(window==window.top)window.Log=(function(){var k='_e_',l=(window.name||'').toString();l=(l.length==7&&k==l.substr(0,3))?l.substr(3):(window.name=k+window._EagleEyeSeed).substr(3);var i=k+l+'_',g=new Date(+new Date()+604800000).toGMTString(),e=window.location.hostname.replace(/^.*(facebook\..*)$/i,'$1'),f='; expires='+g+';path=/; domain='+e,d=0,h=false,m=false,j=[];var c=function(n){return i+(d++)+'='+encodeURIComponent(n)+f;};var b=function(p){var q=(document.cookie.search(k)>=0);while(j.length>0){var r=c(j[0]);if(q&&((document.cookie.length+r.length)>3950||document.cookie.split(';').length>19))break;document.cookie=r;q=true;j.shift();}if(!!p||!h&&q&&((document.cookie.length>2500||document.cookie.split(';').length>15))&&(m||(window.Arbiter&&window.OnloadEvent&&Arbiter.query(OnloadEvent.ONLOAD)))){var o=new Image();h=true;o.onload=function(){h=false;b();};var n=window._EagleEyeDomain||(window.Env&&Env.tracking_domain)||'';o.src=n+'/ajax/nectar.php?asyncSignal='+(Math.floor(Math.random()*10000)+1)+'&'+(!p?'':'s=')+(+new Date());}};var a=function(p,n,o){var q=[l,+new Date(),p].concat(n);q.push(q.length);Bootloader.loadComponents('json',function(){var r=JSON.stringify(q);if(!o){j.push(r);}else document.cookie=c(r);b(o);});};a.loaded=function(){m=true;};return a;})();
function set_ue_cookie(a){document.cookie="act="+encodeURIComponent(a)+"; path=/; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');}var user_action=(function(){var m=(!window.ArbiterMonitor)?'r':'a',o=0,g=0,n,e,f,p,l,j,b,c,i=[0,0,0,0],d=function(){if(!!j){var r={profile_minifeed:1,info_tab:1,gb_content_and_toolbar:1,gb_muffin_area:1,ego:1,bookmarks_menu:1,jewelBoxNotif:1,jewelNotif:1,BeeperBox:1,navSearch:1};for(var q=j;q&&q!=document.body;q=q.parentNode){if(!q.id||typeof q.id!=='string')continue;if(q.id.substr(0,8)=='pagelet_')return q.id.substr(8);if(q.id.substr(0,8)=='box_app_')return q.id;if(r[q.id])return q.id;}}return '-';},h=function(r){if(!ge('content'))return [0,0,0,0];var q=$('content');var s=window.Vector2?Vector2.getEventPosition(r):{x:0,y:0};return [s.x,s.y,q.offsetLeft,q.clientWidth];},k=function(){o++;var r=p+'/'+o;set_ue_cookie(r);var q={};if(window.collect_data_attribs){q=collect_data_attribs(j,['ft','gt']);copy_properties(q.ft,c.ft||{});copy_properties(q.gt,c.gt||{});}if(m=='a'){ArbiterMonitor.initUE(r);f=ArbiterMonitor.getInternRef(j);}window.Log&&Log('act',[p,o,e||'-',b,n||'-',f||d(j),m,window.URI?URI.getRequestURI(true,true).getUnqualifiedURI().toString():location.pathname+location.search+location.hash,q].concat(i));l=true;},a=function(u,q,s,t,r){if(!!s){n=s.type;if(n=='click'&&ge('content'))i=h(s);var t=0;s.ctrlKey&&(t+=1);s.shiftKey&&(t+=2);s.altKey&&(t+=4);s.metaKey&&(t+=8);if(t)n+=t;}if(!u&&s)u=s.getTarget();if(!!u){e=(u.getAttribute&&u.getAttribute('ajaxify')||u.action||u.href||u.name);j=u;}if(!!q&&!b)b=q;if(!!r)c=r;if(t=='FORCE'||e)Bootloader.loadComponents('dom-collect',k);};return function(u,q,s,t,r){if(g){!l&&a(u,q,s,t,r);return;}if(t=='INDIRECT')return;n=e=f=j=b=null;c={};l=false;p=(+new Date());g=1;a(u,q,s,t,r);setTimeout(function(){g=0;},0);};})();
ge=$=function(a){return typeof a=='string'?document.getElementById(a):a;};
CSS=window.CSS||{hasClass:function(b,a){b=$(b);return (' '+b.className+' ').indexOf(' '+a+' ')>-1;},addClass:function(b,a){b=$(b);if(a&&!CSS.hasClass(b,a))b.className=b.className+' '+a;return b;},removeClass:function(b,a){b=$(b);b.className=b.className.replace(new RegExp('(^|\\s)'+a+'(?:\\s|$)','g'),'$1');return b;},toggleClass:function(b,a){return CSS.conditionClass(b,a,!CSS.hasClass(b,a));},conditionClass:function(c,b,a){return (a?CSS.addClass:CSS.removeClass)(c,b);},show:function(a){CSS.removeClass(a,'hidden_elem');},hide:function(a){CSS.addClass(a,'hidden_elem');},conditionShow:function(b,a){CSS.conditionClass(b,'hidden_elem',!a);}};
var Parent={byTag:function(a,b){b=b.toUpperCase();while(a&&a.nodeName!=b)a=a.parentNode;return a;},byClass:function(b,a){while(b&&!CSS.hasClass(b,a))b=b.parentNode;return b;}};
!function(){if(window.__primer)return;window.__primer=true;var a=null;document.documentElement.onclick=function(d){d=d||window.event;a=d.target||d.srcElement;var e=Parent.byTag(a,'A');if(!e)return;var b=e.getAttribute('ajaxify');var f=e.href;var i=b||f;i&&user_action(e,'a',d);if(b&&f&&!(/#$/).test(f)){var g=d.which&&d.which!=1;var h=d.altKey||d.ctrlKey||d.metaKey||d.shiftKey;if(g||h)return;}var c=['dialog'];switch(e.rel){case 'dialog-pipe':c.push('ajaxpipe');case 'dialog':case 'dialog-post':Bootloader.loadComponents(c,function(){Dialog.bootstrap(i,null,e.rel=='dialog',null,null,e);});break;case 'async':case 'async-post':Bootloader.loadComponents('async',function(){AsyncRequest.bootstrap(i,e);});break;case 'theater':Bootloader.loadComponents('PhotoTheater',function(){PhotoTheater.bootstrap(i,e);});break;case 'toggle':CSS.toggleClass(e.parentNode,'openToggler');Bootloader.loadComponents('Toggler',function(){Toggler.bootstrap(e);});break;default:return;}return false;};document.documentElement.onsubmit=function(b){b=b||window.event;var c=b.target||b.srcElement;if(c&&c.nodeName=='FORM'&&c.getAttribute('rel')=='async'){user_action(c,'f',b);var d=a;Bootloader.loadComponents('dom-form',function(){Form.bootstrap(c,d);});return false;}};}();
var Mixins={Arbiter:{_getArbiterInstance:function(){return this._arbiter||(this._arbiter=new Arbiter());},inform:function(c,b,a){return this._getArbiterInstance().inform(c,b,a);},subscribe:function(c,a,b){return this._getArbiterInstance().subscribe(c,a,b);},unsubscribe:function(a){this._getArbiterInstance().unsubscribe(a);}}};
Function.prototype.extend=function(a){if(!Metaprototype._arbiterHandle)Metaprototype._arbiterHandle=Arbiter.subscribe(Arbiter.BOOTLOAD,Metaprototype._onbootload.bind(Metaprototype));Metaprototype._queue(this,a);};function Metaprototype(){}copy_properties(Metaprototype,{makeFinal:function(a){},_pending:{},_queue:function(b,c){b.__class_extending=true;var a=Arbiter.registerCallback(bind(Metaprototype,Metaprototype._apply,b,c),[Arbiter.FUNCTION_EXTENSION+'/'+c,Arbiter.BOOTLOAD]);if(a!==null)this._pending[c]=true;},_onbootload:function(b,a){this._update();},_update:function(){for(var a in this._pending)if(!!window[a]){delete this._pending[a];if(!window[a].__class_extending){Arbiter.inform(Arbiter.FUNCTION_EXTENSION+'/'+a,true,Arbiter.BEHAVIOR_STATE);}else window[a].__class_name=a;}},_apply:function(a,c){delete a.__class_extending;var d=__metaprototype(window[c],0);var b=__metaprototype(a,d.prototype.__level+1);b.parent=d;if(!!a.__class_name)Arbiter.inform(Arbiter.FUNCTION_EXTENSION+'/'+a.__class_name,true,Arbiter.BEHAVIOR_STATE);}});function __metaprototype(c,a){if(c.__metaprototype)return c.__metaprototype;var b=new Function();b.construct=__metaprototype_construct;b.prototype.construct=__metaprototype_wrap(c,a,true);b.prototype.__level=a;b.base=c;c.prototype.parent=b;c.__metaprototype=b;return b;}function __metaprototype_construct(a){__metaprototype_init(a.parent);var c=[];var b=a;while(b.parent){c.push(new_obj=new b.parent());new_obj.__instance=a;b=b.parent;}a.parent=c[1];c.reverse();c.pop();a.__parents=c;a.__instance=a;return a.parent.construct.apply(a.parent,arguments);}function __metaprototype_init(d){if(d.initialized)return;var a=d.base.prototype;if(d.parent){__metaprototype_init(d.parent);var e=d.parent.prototype;for(var b in e)if(b!='__level'&&b!='construct'&&a[b]===undefined)a[b]=d.prototype[b]=e[b];}d.initialized=true;var c=d.prototype.__level;for(var b in a)if(b!='parent')a[b]=d.prototype[b]=__metaprototype_wrap(a[b],c);}function __metaprototype_wrap(c,b,d){if(typeof c!='function'||c.__prototyped)return c;var a=function(){var g=this.__instance;if(g){var h=g.parent;g.parent=b?g.__parents[b-1]:null;if(d){var e=[];for(var f=1;f<arguments.length;f++)e.push(arguments[f]);var i=c.apply(g,e);}else var i=c.apply(g,arguments);g.parent=h;return i;}else return c.apply(this,arguments);};a.__prototyped=true;return a;}Function.prototype.mixin=function(){var a=[this.prototype].concat(Array.prototype.slice.call(arguments));Function.mixin.apply(null,a);};Function.mixin=function(){for(var b=1,a=arguments.length;b<a;++b)copy_properties(arguments[0],Mixins[arguments[b]]||arguments[b]);};Function.prototype.bind=function(b){var a=[b,this].concat(Array.prototype.slice.call(arguments,1));return bind.apply(null,a);};Function.prototype.curry=Function.prototype.bind.bind(null,null);Function.prototype.shield=function(b){if(typeof this!='function')throw new TypeException();var a=this.bind.apply(this,$A(arguments));return function(){return a();};};Function.prototype.defer=function(b,a){if(typeof this!='function')throw new TypeError();b=b||0;return setTimeout(this,b,a);};Function.prototype.recur=function(b,a){if(typeof this!='function')throw new TypeError();return setInterval(this,b,a);};function bagofholding(){}function bagof(a){return function(){return a;};}function abstractMethod(){throw new Error('You must implement this function in your base class.');}
var ua={ie:function(){return ua._populate()||this._ie;},firefox:function(){return ua._populate()||this._firefox;},opera:function(){return ua._populate()||this._opera;},safari:function(){return ua._populate()||this._safari;},chrome:function(){return ua._populate()||this._chrome;},windows:function(){return ua._populate()||this._windows;},osx:function(){return ua._populate()||this._osx;},linux:function(){return ua._populate()||this._linux;},iphone:function(){return ua._populate()||this._iphone;},_populated:false,_populate:function(){if(ua._populated)return;ua._populated=true;var a=/(?:MSIE.(\d+\.\d+))|(?:(?:Firefox|GranParadiso|Iceweasel).(\d+\.\d+))|(?:Opera(?:.+Version.|.)(\d+\.\d+))|(?:AppleWebKit.(\d+(?:\.\d+)?))/.exec(navigator.userAgent);var c=/(Mac OS X)|(Windows)|(Linux)/.exec(navigator.userAgent);var b=/\b(iPhone|iP[ao]d)/.exec(navigator.userAgent);if(a){ua._ie=a[1]?parseFloat(a[1]):NaN;if(ua._ie>=8&&!window.HTMLCollection)ua._ie=7;ua._firefox=a[2]?parseFloat(a[2]):NaN;ua._opera=a[3]?parseFloat(a[3]):NaN;ua._safari=a[4]?parseFloat(a[4]):NaN;if(ua._safari){a=/(?:Chrome\/(\d+\.\d+))/.exec(navigator.userAgent);ua._chrome=a&&a[1]?parseFloat(a[1]):NaN;}else ua._chrome=NaN;}else ua._ie=ua._firefox=ua._opera=ua._chrome=ua._safari=NaN;if(c){ua._osx=!!c[1];ua._windows=!!c[2];ua._linux=!!c[3];}else ua._osx=ua._windows=ua._linux=false;ua._iphone=b;}};
OnloadEvent={ONLOAD:'onload/onload',ONLOAD_CALLBACK:'onload/onload_callback',ONLOAD_DOMCONTENT:'onload/dom_content_ready',ONLOAD_DOMCONTENT_CALLBACK:'onload/domcontent_callback',ONBEFOREUNLOAD:'onload/beforeunload',ONUNLOAD:'onload/unload'};function _include_quickling_events_default(){return !window.loading_page_chrome;}function onbeforeunloadRegister(a,b){if(b===undefined)b=_include_quickling_events_default();b?_addHook('onbeforeleavehooks',a):_addHook('onbeforeunloadhooks',a);}function onunloadRegister(a){if(!window.onunload)window.onunload=function(){Arbiter.inform(OnloadEvent.ONUNLOAD,true,Arbiter.BEHAVIOR_STATE);};_addHook('onunloadhooks',a);}function onleaveRegister(a){_addHook('onleavehooks',a);}function _addHook(b,a){window[b]=(window[b]||[]).concat(a);}function removeHook(a){window[a]=[];}function _domcontentready(){Arbiter.inform(OnloadEvent.ONLOAD_DOMCONTENT,true,Arbiter.BEHAVIOR_STATE);}function _bootstrapEventHandlers(){var a=document,d=window;if(a.addEventListener){if(ua.safari()<525){var c=setInterval(function(){if(/loaded|complete/.test(a.readyState)){_domcontentready();clearInterval(c);}},10);}else a.addEventListener("DOMContentLoaded",_domcontentready,true);}else{var b='javascript:void(0)';if(d.location.protocol=='https:')b='//:';a.write('<script onreadystatechange="if (this.readyState==\'complete\') {'+'this.parentNode.removeChild(this);_domcontentready();}" '+'defer="defer" src="'+b+'"><\/script\>');}d.onload=function(){d.CavalryLogger&&CavalryLogger.getInstance().setTimeStamp('t_layout');var e=a&&a.body&&a.body.offsetWidth;Arbiter.inform(OnloadEvent.ONLOAD,true,Arbiter.BEHAVIOR_STATE);};d.onbeforeunload=function(){var e={};Arbiter.inform(OnloadEvent.ONBEFOREUNLOAD,e,Arbiter.BEHAVIOR_STATE);if(!e.warn)Arbiter.inform('onload/exit',true);return e.warn;};}onload_callback=Arbiter.registerCallback(function(){window.CavalryLogger&&CavalryLogger.getInstance().setTimeStamp('t_onload');Arbiter.inform(OnloadEvent.ONLOAD_CALLBACK,true,Arbiter.BEHAVIOR_STATE);},[OnloadEvent.ONLOAD]);domcontent_callback=Arbiter.registerCallback(function(){window.CavalryLogger&&CavalryLogger.getInstance().setTimeStamp('t_domcontent');Arbiter.inform(OnloadEvent.ONLOAD_DOMCONTENT_CALLBACK,true,Arbiter.BEHAVIOR_STATE);},[OnloadEvent.ONLOAD_DOMCONTENT]);if(!window._eventHandlersBootstrapped){_eventHandlersBootstrapped=true;_bootstrapEventHandlers();}
function tx(b,a){if(typeof _string_table=='undefined')return;b=_string_table[b];return _tx(b,a);}function intl_ends_in_punct(a){if(typeof a!='string')return false;return a.match(new RegExp(intl_ends_in_punct.punct_char_class+'['+')"'+"'"+'\u00BB'+'\u0F3B'+'\u0F3D'+'\u2019'+'\u201D'+'\u203A'+'\u3009'+'\u300B'+'\u300D'+'\u300F'+'\u3011'+'\u3015'+'\u3017'+'\u3019'+'\u301B'+'\u301E'+'\u301F'+'\uFD3F'+'\uFF07'+'\uFF09'+'\uFF3D'+'\s'+']*$'));}intl_ends_in_punct.punct_char_class='['+'.!?'+'\u3002'+'\uFF01'+'\uFF1F'+'\u0964'+'\u2026'+'\u0EAF'+'\u1801'+'\u0E2F'+'\uFF0E'+']';function intl_render_list_separator(){return _tx("{previous-items}, {next-items}",{'previous-items':'','next-items':''});}function intl_phonological_rules(e){var c,b=e,d=window.intl_locale_rewrites;try{if(d){var pats=[],reps=[];for(var p in d.patterns){var pat=p,rep=d.patterns[p];for(var m in d.meta){c=new RegExp(m.slice(1,-1),'g');pat=pat.replace(c,d.meta[m]);rep=rep.replace(c,d.meta[m]);}pats[pats.length]=pat;reps[reps.length]=rep;}for(var ii=0;ii<pats.length;ii++){c=new RegExp(pats[ii].slice(1,-1),'g');if(reps[ii]=='javascript'){if(m=new String(e.match(c)))e=e.replace(c,m.slice(1).toLowerCase());}else e=e.replace(c,reps[ii]);}}}catch(a){e=b;}c=new RegExp('\x01','g');e=e.replace(c,'');return e;}function _tx(e,a){if(!a)return e;var d;for(var c in a){if(intl_ends_in_punct(a[c])){d=new RegExp('\\{'+c+'\\}'+intl_ends_in_punct.punct_char_class+'*','g');}else d=new RegExp('\\{'+c+'\\}','g');var b='';if(a[c][0]!='~')b='\x01';e=e.replace(d,b+a[c]+b);}e=intl_phonological_rules(e);return e;}
InitialJSLoader={INITIAL_JS_READY:'BOOTLOAD/JSREADY',load:function(a){InitialJSLoader.callback=Bootloader.loadResources(a,InitialJSLoader.callback);},callback:Arbiter.registerCallback(function(){Arbiter.inform(InitialJSLoader.INITIAL_JS_READY,true,Arbiter.BEHAVIOR_STATE);},[OnloadEvent.ONLOAD_DOMCONTENT_CALLBACK])};
function goURI(b,a){b=b.toString();if(!a&&window.PageTransitions&&PageTransitions.isInitialized()){PageTransitions.go(b);}else if(window.location.href==b){window.location.reload();}else window.location.href=b;}function loadExternalJavascript(f,b,a){if(f instanceof Array){var e=f.shift(0);if(e){loadExternalJavascript(e,function(){if(f.length){loadExternalJavascript(f,b,a);}else b&&b();},a);}else if(b)b();}else{var c=a?document.body:document.getElementsByTagName('head')[0];var d=document.createElement('script');d.type='text/javascript';d.src=f;if(b){d.onerror=d.onload=b;d.onreadystatechange=function(){if(this.readyState=="complete"||this.readyState=="loaded")b();};}c.appendChild(d);return d;}}function invoke_callbacks(b,d){if(b)for(var c=0;c<b.length;c++)try{(new Function(b[c])).apply(d);}catch(a){}}
window.Event=window.Event||function(){};Event.__inlineSubmit=function(b,event){var a=Event.__getHandler&&Event.__getHandler(b,'submit');return a?null:Event.__bubbleSubmit(b,event);};Event.__bubbleSubmit=function(a,event){if(document.documentElement.attachEvent){var b;while(b!==false&&(a=a.parentNode))b=a.onsubmit?a.onsubmit(event):Event.__fire&&Event.__fire(a,'submit',event);return b;}};
JSCC=window.JSCC||function(){var a={},b={};return {get:function(c){if(c in a){b[c]=a[c]();delete a[c];return b[c];}else return b[c];},init:function(c){copy_properties(a,c);}};}();
function BigPipe(a){copy_properties(this,{arbiter:Arbiter,rootNodeID:'content',lid:0,isAjax:false,isReplay:false,rrEnabled:true,domContentCallback:domcontent_callback,onloadCallback:onload_callback,domContentEvt:OnloadEvent.ONLOAD_DOMCONTENT_CALLBACK,onloadEvt:OnloadEvent.ONLOAD_CALLBACK,forceFinish:false,_phaseDoneCallbacks:[],_currentPhase:0,_lastPhase:-1,_timeout:20});copy_properties(this,a);this._cavalry=(this.lid&&window.CavalryLogger)?CavalryLogger.getInstance(this.lid):null;this._inst=this._cavalry&&(window._pagelet_profile||this._cavalry.isPageletProfiler());BigPipe._current_instance=this;if(window.env_get&&env_get('tti_vision')===1)(new TTIVisualizer(this)).init();this.arbiter.registerCallback(this.domContentCallback,['pagelet_displayed_all']);this.arbiter.inform('phase_begin_0',true,Arbiter.BEHAVIOR_STATE);this._inst&&this._cavalry.setTimeStamp('t_phase_begin_0');this.onloadCallback=this.arbiter.registerCallback(this.onloadCallback,['pagelet_displayed_all']);}copy_properties(BigPipe.prototype,{_ct:function(a){return (!a||'length' in a&&a.length===0)?{}:a;},_displayPagelet:function(d){d.content=this._ct(d.content);for(var c in d.content){if(d.append){if(d.append==='bigpipe_root'){target_id=this.rootNodeID;}else target_id=d.append;}else target_id=c;var b=document.getElementById(target_id);var a=d.content[c];if(b){if(a){if(typeof a!='string')a=DynaTemplate.renderToHtml(a[0],a[1]);if(!d.append&&d.has_inline_js){if(window.DOM&&window.HTML){DOM.setContent(b,HTML(a));}else Bootloader.loadComponents('dom',function(){DOM.setContent(b,HTML(a));});}else if(d.append||ua.ie()<8){if(!d.append)while(b.firstChild)b.removeChild(b.firstChild);this._appendNodes(b,a);}else b.innerHTML=a;}if(this._inst)this._cavalry.onPageletEvent('display',d.id);}}this.arbiter.inform(d.id+'_displayed',true,Arbiter.BEHAVIOR_STATE);},_appendNodes:function(a,d){var e=document.createElement('div');var c=ua.ie()<7;if(c)a.appendChild(e);e.innerHTML=d;var b=document.createDocumentFragment();while(e.firstChild)b.appendChild(e.firstChild);a.appendChild(b);if(c)a.removeChild(e);},_downloadJsForPagelet:function(a){Bootloader.loadResources(a.js||[],bind(this,function(){if(this._inst)this._cavalry.onPageletEvent('jsdone',a.id);a.requires=a.requires||[];if(!this.isAjax||a.phase>=1)a.requires.push('uipage_onload');var c=bind(this,function(){if(!this._isRelevant())return;invoke_callbacks(a.onload);if(this._inst)this._cavalry.onPageletEvent('onload',a.id);this.arbiter.inform('pagelet_onload',true,Arbiter.BEHAVIOR_EVENT);if(a.page_cache){if(!a.id&&this.isAjax)a.html=$("content").innerHTML;Quickling.cacheAndExecResponse(a,true);}a.provides&&this.arbiter.inform(a.provides,true,Arbiter.BEHAVIOR_STATE);});var b=bind(this,function(){this._isRelevant()&&invoke_callbacks(a.onafterload);});this.arbiter.registerCallback(c,a.requires);this.arbiter.registerCallback(b,[this.onloadEvt]);}),false,a.id);},_downloadCssAndDisplayPagelet:function(c){if(this._inst)this._cavalry.onPageletEvent('css',c.id);var b=bind(this,function(){var d=c.display_dependency||[];var f=[];for(var e=0;e<d.length;e++)f.push(d[e]+'_displayed');this.arbiter.registerCallback(this._displayPagelet.bind(this,c),f);});var a=c.css||[];if(this.isReplay){Bootloader.loadResources(a,null,false,c.id);b();}else Bootloader.loadResources(a,b,false,c.id);},onPageletArrive:function(b){if(this._inst)this._cavalry.onPageletEvent('arrive',b.id);var c=b.phase;if(!this._phaseDoneCallbacks[c])this._phaseDoneCallbacks[c]=this.arbiter.registerCallback(this._onPhaseDone.bind(this),['phase_complete_'+c]);if(b.the_end)this._lastPhase=b.phase;if(b.tti_phase!==undefined)this._ttiPhase=b.tti_phase;b.jscc&&invoke_callbacks([b.jscc]);b.tplts&&DynaTemplate.registerTemplates(b.tplts);Bootloader.setResourceMap(b.resource_map);Bootloader.enableBootload(this._ct(b.bootloadable));this.arbiter.registerCallback(this._downloadCssAndDisplayPagelet.bind(this,b),['phase_begin_'+c]);var a;if(!this.jsNonBlock){a=this.domContentEvt;}else a=b.id+'_displayed';this.arbiter.registerCallback(this.onloadCallback,['pagelet_onload']);this.arbiter.registerCallback(this._downloadJsForPagelet.bind(this,b),[a]);this.arbiter.registerCallback(this._phaseDoneCallbacks[c],[b.id+'_displayed']);b.is_last&&this.arbiter.inform('phase_complete_'+c,true,Arbiter.BEHAVIOR_STATE);b.invalidate_cache&&b.invalidate_cache.length&&Arbiter.inform(Arbiter.PAGECACHE_INVALIDATE,b.invalidate_cache);},_onPhaseDone:function(){if(this._currentPhase===this._ttiPhase&&this.rrEnabled){this.arbiter.inform('tti_bigpipe',{s:this.lid},Arbiter.BEHAVIOR_EVENT);this._cavalry&&this._cavalry.setTTIPhase(this._ttiPhase).measurePageLoad(true);}var b=this._currentPhase+1;var a=bind(this,function(){this._inst&&this._cavalry.setTimeStamp('t_phase_begin_'+b);this.arbiter.inform('phase_begin_'+b,true,Arbiter.BEHAVIOR_STATE);});if(this.isReplay){a();}else setTimeout(a,this._timeout);if(this._currentPhase===this._lastPhase)this.arbiter.inform('pagelet_displayed_all',true,Arbiter.BEHAVIOR_STATE);this._currentPhase++;},_isRelevant:function(){return this==BigPipe._current_instance||this.isReplay||this.jsNonBlock||this.forceFinish;}});
DynaTemplate=window.DynaTemplate||(function(){var g='[[',i='\\[\\[',h='\\]\\]';var l={};var a={};function d(n,m){return m.indexOf(g+n)!=-1;}function e(m){return Object.prototype.toString.call(m)==="[object Array]";}function f(m){return m&&typeof m=="object";}function c(m){switch(m){case "&":return "&amp;";case '"':return '&quot;';case "'":return '&#39;';case "<":return "&lt;";case ">":return "&gt;";default:return m;}}function b(m){m=String(m===null?"":m);return m.replace(/&(?!\w+;)|["'<>]/g,c);}function j(n){for(var m in n){var o=n[m];a[o[0]]=o[1];l[m]=o[1];}}function k(p,m){if(p.charAt(0)=='@')return k(a[p.substring(1)],m);if(d('#',p)||d('^',p)){var o=new RegExp(i+"(\\^|\\#)\\s*(.+)\\s*"+h+"\n*([\\s\\S]+?)"+i+"\\/\\s*\\2\\s*"+h+"\\s*","mg");p=p.replace(o,function(q,v,t,r){var w=m[t];w=(w&&w.__html!==undefined)?w.__html:w;if(v=='^'){if(!w||e(w)&&w.length===0){return k(r,m);}else return '';}else if(v=='#'){if(e(w)){var u=[];for(var s=0;s<w.length;s++)u.push(k(r,w[s]));return u.join('');}else if(f(w)){return k(r,w);}else if(!(typeof w=='function'))if(w)return k(r,m);return '';}});}if(!d("",p))return p;var n=new RegExp(i+"(>|\\[|&)?([^\\/#\\^]+?)\\1?"+h+"+","g");return p.replace(n,function(q,s,r){r=r.replace(/^\s*|\s*$/g,"");var t=m[r];if(!t||t instanceof Array&&t.length===0)return '';switch(s){case '>':if(t[0].charAt(0)=='@'){return k(t[0],t[1]);}else if(!(t[0] in l))return '';return k(l[t[0]],t[1]);case '&':default:if(window.HTML&&t instanceof HTML)return t.toString();return t.__html!==undefined?t.__html:b(t);}});}return {registerTemplates:j,renderToHtml:k};})();
function incorporate_fragment(a){var c=/^(?:(?:[^:\/?#]+):)?(?:\/\/(?:[^\/?#]*))?([^?#]*)(?:\?([^#]*))?(?:#(.*))?/;var b='';a.href.replace(c,function(d,g,h,f){var e,i;e=i=g+(h?'?'+h:'');if(f){f=f.replace(/^(!|%21)/,'');if(f.charAt(0)=='/')e=f.replace(/^\/+/,'/');}if(e!=i){if(window._script_path)document.cookie="rdir="+window._script_path+"; path=/; domain="+window.location.hostname.replace(/^.*(\.facebook\..*)$/i,'$1');window.location.replace(b+e);}});}if(window._script_path!==undefined)incorporate_fragment(window.location);
!function(){var b=document.documentElement;var a=function(c){c=c||window.event;var d=c.target||c.srcElement;var f=d.getAttribute('placeholder');if(f){var e=Parent.byClass(d,'focus_target');if('focus'==c.type||'focusin'==c.type){if(d.value==f){d.value='';CSS.removeClass(d,'DOMControl_placeholder');}if(e){CSS.addClass(e,'child_is_active');CSS.addClass(e,'child_is_focused');CSS.addClass(e,'child_was_focused');Arbiter.inform('reflow');}}else{if(d.value==''){CSS.addClass(d,'DOMControl_placeholder');d.value=f;e&&CSS.removeClass(e,'child_is_active');}e&&CSS.removeClass(e,'child_is_focused');}}};b.onfocusin=b.onfocusout=a;if(b.addEventListener){b.addEventListener('focus',a,true);b.addEventListener('blur',a,true);}}();
document.documentElement.onkeydown=function(a){a=a||window.event;var b=a.target||a.srcElement;var c=a.keyCode==13&&!a.altKey&&!a.ctrlKey&&!a.metaKey&&!a.shiftKey&&CSS.hasClass(b,'enter_submit');if(c){Bootloader.loadComponents(['dom','input-methods'],function(){if(!Input.isEmpty(b)){var d=DOM.scry(b.form,'.enter_submit_target')[0]||DOM.scry(b.form,'[type="submit"]')[0];d&&d.click();}});return false;}};
function fc_click(a,b){user_action(a,'ufi');fc_expand(a,b);}function fc_expand(a,b){var c=a.form;fc_uncollapse(c);CSS.removeClass(c,'hidden_add_comment');if(b!==false)(c.add_comment_text_text||c.add_comment_text).focus();return false;}function fc_uncollapse(a){CSS.removeClass(a,'collapsed_comments');}
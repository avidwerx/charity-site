/* Modernizr 2.0.6 (Custom Build) | MIT & BSD
 * Build: http://www.modernizr.com/download/#-csstransforms-csstransforms3d-iepp-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
window.Modernizr=function(a,b,c){function C(a,b){var c=a.charAt(0).toUpperCase()+a.substr(1),d=(a+" "+o.join(c+" ")+c).split(" ");return B(d,b)}function B(a,b){for(var d in a)if(k[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function A(a,b){return!!~(""+a).indexOf(b)}function z(a,b){return typeof a===b}function y(a,b){return x(n.join(a+";")+(b||""))}function x(a){k.cssText=a}var d="2.0.6",e={},f=!0,g=b.documentElement,h=b.head||b.getElementsByTagName("head")[0],i="modernizr",j=b.createElement(i),k=j.style,l,m=Object.prototype.toString,n=" -webkit- -moz- -o- -ms- -khtml- ".split(" "),o="Webkit Moz O ms Khtml".split(" "),p={},q={},r={},s=[],t=function(a,c,d,e){var f,h,j,k=b.createElement("div");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:i+(d+1),k.appendChild(j);f=["&shy;","<style>",a,"</style>"].join(""),k.id=i,k.innerHTML+=f,g.appendChild(k),h=c(k,a),k.parentNode.removeChild(k);return!!h},u,v={}.hasOwnProperty,w;!z(v,c)&&!z(v.call,c)?w=function(a,b){return v.call(a,b)}:w=function(a,b){return b in a&&z(a.constructor.prototype[b],c)};var D=function(a,c){var d=a.join(""),f=c.length;t(d,function(a,c){var d=b.styleSheets[b.styleSheets.length-1],g=d.cssRules&&d.cssRules[0]?d.cssRules[0].cssText:d.cssText||"",h=a.childNodes,i={};while(f--)i[h[f].id]=h[f];e.csstransforms3d=i.csstransforms3d.offsetLeft===9},f,c)}([,["@media (",n.join("transform-3d),("),i,")","{#csstransforms3d{left:9px;position:absolute}}"].join("")],[,"csstransforms3d"]);p.csstransforms=function(){return!!B(["transformProperty","WebkitTransform","MozTransform","OTransform","msTransform"])},p.csstransforms3d=function(){var a=!!B(["perspectiveProperty","WebkitPerspective","MozPerspective","OPerspective","msPerspective"]);a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d);return a};for(var E in p)w(p,E)&&(u=E.toLowerCase(),e[u]=p[E](),s.push((e[u]?"":"no-")+u));x(""),j=l=null,a.attachEvent&&function(){var a=b.createElement("div");a.innerHTML="<elem></elem>";return a.childNodes.length!==1}()&&function(a,b){function s(a){var b=-1;while(++b<g)a.createElement(f[b])}a.iepp=a.iepp||{};var d=a.iepp,e=d.html5elements||"abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",f=e.split("|"),g=f.length,h=new RegExp("(^|\\s)("+e+")","gi"),i=new RegExp("<(/*)("+e+")","gi"),j=/^\s*[\{\}]\s*$/,k=new RegExp("(^|[^\\n]*?\\s)("+e+")([^\\n]*)({[\\n\\w\\W]*?})","gi"),l=b.createDocumentFragment(),m=b.documentElement,n=m.firstChild,o=b.createElement("body"),p=b.createElement("style"),q=/print|all/,r;d.getCSS=function(a,b){if(a+""===c)return"";var e=-1,f=a.length,g,h=[];while(++e<f){g=a[e];if(g.disabled)continue;b=g.media||b,q.test(b)&&h.push(d.getCSS(g.imports,b),g.cssText),b="all"}return h.join("")},d.parseCSS=function(a){var b=[],c;while((c=k.exec(a))!=null)b.push(((j.exec(c[1])?"\n":c[1])+c[2]+c[3]).replace(h,"$1.iepp_$2")+c[4]);return b.join("\n")},d.writeHTML=function(){var a=-1;r=r||b.body;while(++a<g){var c=b.getElementsByTagName(f[a]),d=c.length,e=-1;while(++e<d)c[e].className.indexOf("iepp_")<0&&(c[e].className+=" iepp_"+f[a])}l.appendChild(r),m.appendChild(o),o.className=r.className,o.id=r.id,o.innerHTML=r.innerHTML.replace(i,"<$1font")},d._beforePrint=function(){p.styleSheet.cssText=d.parseCSS(d.getCSS(b.styleSheets,"all")),d.writeHTML()},d.restoreHTML=function(){o.innerHTML="",m.removeChild(o),m.appendChild(r)},d._afterPrint=function(){d.restoreHTML(),p.styleSheet.cssText=""},s(b),s(l);d.disablePP||(n.insertBefore(p,n.firstChild),p.media="print",p.className="iepp-printshim",a.attachEvent("onbeforeprint",d._beforePrint),a.attachEvent("onafterprint",d._afterPrint))}(a,b),e._version=d,e._prefixes=n,e._domPrefixes=o,e.testProp=function(a){return B([a])},e.testAllProps=C,e.testStyles=t,g.className=g.className.replace(/\bno-js\b/,"")+(f?" js "+s.join(" "):"");return e}(this,this.document),function(a,b,c){function k(a){return!a||a=="loaded"||a=="complete"}function j(){var a=1,b=-1;while(p.length- ++b)if(p[b].s&&!(a=p[b].r))break;a&&g()}function i(a){var c=b.createElement("script"),d;c.src=a.s,c.onreadystatechange=c.onload=function(){!d&&k(c.readyState)&&(d=1,j(),c.onload=c.onreadystatechange=null)},m(function(){d||(d=1,j())},H.errorTimeout),a.e?c.onload():n.parentNode.insertBefore(c,n)}function h(a){var c=b.createElement("link"),d;c.href=a.s,c.rel="stylesheet",c.type="text/css";if(!a.e&&(w||r)){var e=function(a){m(function(){if(!d)try{a.sheet.cssRules.length?(d=1,j()):e(a)}catch(b){b.code==1e3||b.message=="security"||b.message=="denied"?(d=1,m(function(){j()},0)):e(a)}},0)};e(c)}else c.onload=function(){d||(d=1,m(function(){j()},0))},a.e&&c.onload();m(function(){d||(d=1,j())},H.errorTimeout),!a.e&&n.parentNode.insertBefore(c,n)}function g(){var a=p.shift();q=1,a?a.t?m(function(){a.t=="c"?h(a):i(a)},0):(a(),j()):q=0}function f(a,c,d,e,f,h){function i(){!o&&k(l.readyState)&&(r.r=o=1,!q&&j(),l.onload=l.onreadystatechange=null,m(function(){u.removeChild(l)},0))}var l=b.createElement(a),o=0,r={t:d,s:c,e:h};l.src=l.data=c,!s&&(l.style.display="none"),l.width=l.height="0",a!="object"&&(l.type=d),l.onload=l.onreadystatechange=i,a=="img"?l.onerror=i:a=="script"&&(l.onerror=function(){r.e=r.r=1,g()}),p.splice(e,0,r),u.insertBefore(l,s?null:n),m(function(){o||(u.removeChild(l),r.r=r.e=o=1,j())},H.errorTimeout)}function e(a,b,c){var d=b=="c"?z:y;q=0,b=b||"j",C(a)?f(d,a,b,this.i++,l,c):(p.splice(this.i++,0,a),p.length==1&&g());return this}function d(){var a=H;a.loader={load:e,i:0};return a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=r&&!s,u=s?l:n.parentNode,v=a.opera&&o.call(a.opera)=="[object Opera]",w="webkitAppearance"in l.style,x=w&&"async"in b.createElement("script"),y=r?"object":v||x?"img":"script",z=w?"img":y,A=Array.isArray||function(a){return o.call(a)=="[object Array]"},B=function(a){return Object(a)===a},C=function(a){return typeof a=="string"},D=function(a){return o.call(a)=="[object Function]"},E=[],F={},G,H;H=function(a){function f(a){var b=a.split("!"),c=E.length,d=b.pop(),e=b.length,f={url:d,origUrl:d,prefixes:b},g,h;for(h=0;h<e;h++)g=F[b[h]],g&&(f=g(f));for(h=0;h<c;h++)f=E[h](f);return f}function e(a,b,e,g,h){var i=f(a),j=i.autoCallback;if(!i.bypass){b&&(b=D(b)?b:b[a]||b[g]||b[a.split("/").pop().split("?")[0]]);if(i.instead)return i.instead(a,b,e,g,h);e.load(i.url,i.forceCSS||!i.forceJS&&/css$/.test(i.url)?"c":c,i.noexec),(D(b)||D(j))&&e.load(function(){d(),b&&b(i.origUrl,h,g),j&&j(i.origUrl,h,g)})}}function b(a,b){function c(a){if(C(a))e(a,h,b,0,d);else if(B(a))for(i in a)a.hasOwnProperty(i)&&e(a[i],h,b,i,d)}var d=!!a.test,f=d?a.yep:a.nope,g=a.load||a.both,h=a.callback,i;c(f),c(g),a.complete&&b.load(a.complete)}var g,h,i=this.yepnope.loader;if(C(a))e(a,0,i,0);else if(A(a))for(g=0;g<a.length;g++)h=a[g],C(h)?e(h,0,i,0):A(h)?H(h):B(h)&&b(h,i);else B(a)&&b(a,i)},H.addPrefix=function(a,b){F[a]=b},H.addFilter=function(a){E.push(a)},H.errorTimeout=1e4,b.readyState==null&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",G=function(){b.removeEventListener("DOMContentLoaded",G,0),b.readyState="complete"},0)),a.yepnope=d()}(this,this.document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//								KenBurns jQuery Plugin 2011
//
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------API VARS--------------------------------

(function($) {
  unique_id = 0;
jQuery.fn.kenburns_plugin = function(set) {

	unique_id++;
	
	
	if (this.length > 1){
      this.each(function() { 
      	$(this).kenburns_plugin(set);
      });
      return this;
  }
  
	
	set = $.extend({
				  zoomfactor: 1.5,											    // this factor describes how big image area will be fitted into canvas view at the end of ken burns effect
				  																					// sub rect area size of original image is calculated as follow: destination_area = original_canvas_size * zoomfactor; possible value float or 'random'
				  																					// if zoom factor is greater than 1.0 it means that ken burns effect will zoom out otherwise it will zoom in																				
				  start_cpoint: [0,100],										// describes where is center of canvas located over image at the beginning of ken burns effect ( units: x,y percents of original image size 0 - 100) 
				  start_cpoint_random: true,								// idf true above array is treated like range from where point is randomly picked
				  dest_cpoint: [0,100],											// describes where is center of canvas located over image at the end of ken burns effect ( units: x,y percents of original image size 0 - 100) 
				  dest_cpoint_random: true,
				  																					// start and dest cpoint are properly shifted to fill all canvas area with image
				  orig_img_width: null,
				  orig_img_height: null,
				  frames_per_second: 30,
				  anim_time: 5000,													// animation time described in miliseconds
				  hover_mode: 'play_on_hover',							// ken burns effect hover mode: 'none' - nothing happens when user hovers over the image, 
				  																					//												'pause_on_hover' - effect freezes on hover, 
				  																					//												'play_on_hover' - effect is played only when user hovers over the image
				  play_in_loop: true,												// ken burn effect loop mode: if true effext will be looped when it reaches its end otherwise no
				  auto_play: true,
				  z_index: 1,
				  flash_at_start: false,
				  canvas_width: null,
				  canvas_height: null,
				  alignment: 'relative',
				  run_at_init: true,												  // internal flag used to determine if effect should be started at init
				  theme: 'classic'
				},
			set || {});


//-----------------------------------GLOBAL VARS--------------------------------


//=================================FUNCTIONS==========================================================================
return this.each(function() {				

var $image = $(this);		                      
var $canvas = null;
var $canvas_img = null; // only for ie ver < 9 and chrome
var $target = null; // hover target canvas or img element
var $overlay = null;
var x = 0;
var y = 0;

var canvas_width = $image.width();
var canvas_height = $image.height();

if( set.canvas_width != null )
		canvas_width = set.canvas_width;
		
if( set.canvas_height != null )
		canvas_height = set.canvas_height;						

var orig_img_width = set.orig_img_width;
var orig_img_height = set.orig_img_height;
var frames_per_second = set.frames_per_second;
var frame_time = Math.round( 1000 / set.frames_per_second );
var anim_time = set.anim_time;
var start_rect = new Object();
var dest_rect = new Object();
var start_cpoint = set.start_cpoint;
var dest_cpoint = set.dest_cpoint;
var current_frame = 1;
var frames_amount = Math.round( ( anim_time * frames_per_second ) / 1000 );
var zoomfactor = set.zoomfactor;
var support_canvas = !!document.createElement('canvas').getContext;
 
var hover_mode = set.hover_mode;
var animate_tick = null;
var play_in_loop = set.play_in_loop;
var auto_play = set.auto_play;
var width = 0;
var height = 0;
var start_cpoint_random = set.start_cpoint_random;
var dest_cpoint_random = set.dest_cpoint_random;
var max_factor = orig_img_width / canvas_width;
var is_playing = false;
var is_started = false;
var z_index = set.z_index;
var canvas = null;

var bk_kb_canvas_id = "bk_kb_canvas-" + unique_id;
var bk_kb_overlay_id = "bk_kb_overlay-" + unique_id;

$image.attr( 'data-bk-kb-id', bk_kb_canvas_id );
			 
if( zoomfactor != 'random' && zoomfactor > max_factor )
	  zoomfactor = max_factor;

var userAgent = navigator.userAgent.toString().toLowerCase();

if( jQuery.browser.webkit && (userAgent.indexOf('chrome') != -1))			// rely on css transform for sub pixel rendering in webkit browsers safari and chrome
		support_canvas = false;

var delay = 250;
if( !support_canvas && ( jQuery.browser.msie && ( parseInt(jQuery.browser.version, 10) < 9 ) ) )	  	
		delay = 0;	
		
		if (jQuery.browser.webkit && document.readyState != "complete"){
		    setTimeout( arguments.callee, 100 );
		    return;
    }
//---------------------------------------------------------------------------------------------------------------    
function getrandzoom() {
			 return get_random_value( 0 , max_factor * 100 ) / 100;
		}	
		
		function init_kenburns() {
			 if( !support_canvas ) {
			 	 $image.after('<div class="bk_canvas_underlay ' + set.theme + '" id="'+ bk_kb_canvas_id +'"><img src="'+ $image.attr('src') +'" width="' + orig_img_width + 'px" height="' + orig_img_height + 'px"/></div>');
			 	 $canvas = $image.next('div.bk_canvas_underlay#' + bk_kb_canvas_id);
			 	 $canvas_img = $canvas.find('img');
			 	 $canvas_img.css({'position': 'relative', 'overflow' : 'hidden', 'margin' : '0px', 'padding:' : '0px', 'top' : '0px', 'left' : '0px', 
			 	 									'-webkit-transform-origin' : '0px 0px', '-moz-transform-origin' : '0px 0px', '-o-transform-origin' : '0px 0px', 
			 	 									'-ms-transform-origin' : '0px 0px', 'transform-origin' : '0px 0px'});
			 	 $target = $canvas;
			 	 $overlay = $canvas_img;  
			 } else {
				 $image.after('<div class="bk_canvas_underlay ' + set.theme + '" id="'+ bk_kb_canvas_id +'"><canvas class="bk_canvas"></canvas></div>');
				 $canvas = $image.next('div.bk_canvas_underlay#' + bk_kb_canvas_id);
				 $target = $canvas;
				 						 
				 canvas = $canvas.find('canvas.bk_canvas').get(0);
				 canvas.setAttribute('width',canvas_width);
	       canvas.setAttribute('height',canvas_height);
	       $overlay = $canvas.find('canvas.bk_canvas');
			 }
			 
			 if( set.alignment == 'relative' ) {
				 $canvas.css({'top': -canvas_height + "px", 
											'left': "0px",
						      		'width': canvas_width + "px", 
											'height': canvas_height + "px",
											'position': 'relative',
											'overflow' : 'hidden'
					 					 });
			 } else if( set.alignment == 'absolute' )	{
			 	 $canvas.css({'top': "0px", 
											'left': "0px",
						      		'width': canvas_width + "px", 
											'height': canvas_height + "px",
											'position': 'absolute',
											'overflow' : 'hidden'
					 					 });
			 }	 	 					 	 					 			 
			 						 
			 width = canvas_width;
			 if( width > orig_img_width )
			 		 width = orig_img_width;
			 		 
			 height = canvas_height;
			 if( height > orig_img_height )
			 		 height = orig_img_height; 
			 
			 zoomfactor = ( set.zoomfactor == 'random') ?	getrandzoom() :	zoomfactor;
			 
			 set_start_rect();
			 set_dest_rect();
			 $image.trigger("bk.kenburns.init");
			 
			 draw_current_frame();					 								
		}
		
		function interpolate_point(x1, y1, x2, y2, i) {
            // Finds a point between two other points
            return  {x: x1 + (x2 - x1) * i,
                     y: y1 + (y2 - y1) * i}
    }

    function interpolate_rect(r1, r2, i) {
            // Blend one rect in to another
            var p1 = interpolate_point(r2['x'], r2['y'], r1['x'], r1['y'], i);
            var p2 = interpolate_point(r2['width'], r2['height'], r1['width'], r1['height'], i);
            return [p1.x, p1.y, p2.x, p2.y];
    }
    
    function validate_rect( rect, zoom ) {
    	 if( rect['x'] < 0 ) {
    	 	   rect['x'] = 0;
    	 }
    	 
    	 if( rect['y'] < 0 ) {
    	 	   rect['y'] = 0;
    	 }	
    	 
    	 if( rect['x'] + rect['width'] > orig_img_width - 1 ) {
    	 	   rect['x'] = ( orig_img_width - rect['width']  );
    	 }
    	 
    	 if( rect['y'] + rect['height'] > orig_img_height - 1 ) {
    	 	   rect['y'] = ( orig_img_height - rect['height'] );
    	 }
    	 
    	 return rect;    
    }
    
    function get_random_value( start, stop ) {
    	 return Math.floor( Math.random() * ( stop - start )) + start;
    }		
		
		function set_start_rect() {
			 
			 var x = start_cpoint[0];
			 var y = start_cpoint[1];
			 
			 
			 if( start_cpoint_random ) {
			 		 x = get_random_value( start_cpoint[0], start_cpoint[1] );
			 		 y = get_random_value( start_cpoint[0], start_cpoint[1] );	
			 }
			 		 
	 
			 var center_x = Math.round( orig_img_width * x / 100 );		// x coordiante of canvas center point on orignal image described in pixels
			 var center_y = Math.round( orig_img_height * y / 100 );   // y coordiante of canvas center point on orignal image described in pixels		 
			 
			 start_rect['x'] = Math.round( center_x - width / 2 );
			 start_rect['y'] = Math.round( center_y - height / 2 );
			 start_rect['width'] = width;
			 start_rect['height'] = height;
			 
			 // to do valide and clip rect !!!
			 start_rect = validate_rect( start_rect, 1.0 );
		}
		
		function set_dest_rect() {
			 
			 var x = dest_cpoint[0];
			 var y = dest_cpoint[1];
			 
			 
			 if( dest_cpoint_random ) {
			 		 x = get_random_value( dest_cpoint[0], dest_cpoint[1] );
			 		 y = get_random_value( dest_cpoint[0], dest_cpoint[1] );	
			 }
			 
	 
			 var center_x = Math.round( orig_img_width * x / 100 );		// x coordiante of canvas center point on orignal image described in pixels
			 var center_y = Math.round( orig_img_height * y / 100 );   // y coordiante of canvas center point on orignal image described in pixels
			 
			 dest_rect['x'] = Math.round( center_x - (width * zoomfactor) / 2 );
			 dest_rect['y'] = Math.round( center_y - (height * zoomfactor) / 2 );
			 dest_rect['width'] = Math.round( width * zoomfactor);
			 dest_rect['height'] = Math.round( height * zoomfactor);
			 
			 //$('#log').text(" r0: " + dest_rect['x']+ " r1: " + dest_rect['y']+ " r2: " + dest_rect['width']+ " r3: " + dest_rect['height']);
			 
			 // to do valide and clip rect !!!
			 dest_rect = validate_rect( dest_rect, zoomfactor );
		}	
		
		function animate_frame() {     
     ////window.console.log("animate_frame before: ");
     ////window.console.log("animate_frame before: " + is_playing);
     if( !is_playing )
     			return;			
     
     ////window.console.log("animate_frame after: ");			
     draw_current_frame();
		 if( current_frame < frames_amount)
		   {
		    current_frame++;
		    //animate_tick = setTimeout( function(){ this.animate_frame.call(this); }, frame_time );
		    
		    $image.oneTime(frame_time, function() {
												   animate_frame();
				});
		    
		    //requestAnimFrame(animate_frame);
		   }
		 else
		 	 {
		 	 	if( play_in_loop )
		 	 	  {
		 	 			current_frame = 1;
		 	 			zoomfactor = ( set.zoomfactor == 'random') ?	getrandzoom() :	zoomfactor;
		 	 			
		 	 			set_start_rect();
			 			set_dest_rect();
			 			
		 	 			$overlay.fadeOut(delay, function(){
		 	 																animate_loop_transition();
		 	 															});
		 	 	  }
		 	 }	      
		}
		
		function animate_loop_transition() {
			draw_current_frame();
			//animate_tick = setTimeout( function(){ this.animate_frame.call(this); }, frame_time );
			
			$image.oneTime(frame_time, function() {
												   animate_frame();
		  });
			
			$overlay.fadeIn(delay);
		}	
		
		function draw_current_frame() {
		  var r = interpolate_rect(start_rect, dest_rect, current_frame / frames_amount );
	     
	     if( !support_canvas ) {
	     	 var s = width / r[2];
	     	 var p1 = r[0] * s * -1;
	     	 var p2 = r[1] * s * -1;
	     	 
	     	 //$('#log').text("current_frame: " + current_frame + " r0: " + r[0]+ " r1: " + r[1]+ " r2: " + r[2]+ " r3: " + r[3] + " scale: " + s);
	     	 
	     	 ////window.console.log("draw_current_frame: !support_canvas");
	     	 
	     	 if( jQuery.browser.msie ) {
		     	   $canvas_img.css({'filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="nearest neighbor",M11=' + s + ',M12=0,M21=0,M22=' + s + ",Dx=" + p1 + ",Dy=" + p2 + ")"});
		         $canvas_img.css({'-ms-filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="nearest neighbor",M11=' + s + ',M12=0,M21=0,M22=' + s + ",Dx=" + p1 + ",Dy=" + p2 + ")"});
	       } else if( Modernizr.csstransforms ){
			 			 //p1 = r[0] * s * -1;
			     	 //p2 = r[1] * s * -1;
			     	 
			     	 ////window.console.log("draw_current_frame: Modernizr.csstransforms");
			     	 if( Modernizr.hw3dTransform ) {
			     	 	   $canvas_img.css({ '-webkit-transform': "translate3d(" + p1 + "px," + p2 + "px,0) scale(" + s + ")",
			     	 	   									 '-ms-transform': "translate3d(" + p1 + "px," + p2 + "px,0) scale(" + s + ")",
			     	 	   									 '-o-transform': "translate3d(" + p1 + "px," + p2 + "px,0) scale(" + s + ")",
			     	 	   									 '-moz-transform': "translate3d(" + p1 + "px," + p2 + "px,0) scale(" + s + ")",
			     	 	   									 'transform': "translate3d(" + p1 + "px," + p2 + "px,0) scale(" + s + ")" });
			     	 	   									 
			     	 	   ////window.console.log("draw_current_frame: Modernizr.hw3dTransform");									 
			     	 } else {
			     	 	   $canvas_img.css({ '-webkit-transform': "translate(" + p1 + "px," + p2 + "px) scale(" + s + ")",
			     	 	   									 '-ms-transform': "translate(" + p1 + "px," + p2 + "px) scale(" + s + ")",
			     	 	   									 '-o-transform': "translate(" + p1 + "px," + p2 + "px) scale(" + s + ")",
			     	 	   									 '-moz-transform': "translate(" + p1 + "px," + p2 + "px) scale(" + s + ")",
			     	 	   									 'transform': "translate(" + p1 + "px," + p2 + "px) scale(" + s + ")" });
			     	 	   									 
			     	 	   //$('#log').text("current_frame: " + $image.attr('src') + "  " + current_frame + " r0: " + r[0]+ " r1: " + r[1]+ " r2: " + r[2]+ " r3: " + r[3] + " scale: " + s);
			     	 	   ////window.console.log("draw_current_frame: !Modernizr.hw3dTransform");									 
			     	 }	    	
	 			 }    
	     } else {
	     	 //var canvas = $canvas.get(0);
		     var ctx = canvas.getContext('2d');
		     //ctx.save();
		     //ctx.globalCompositeOperation = 'destination-in';
		     ctx.drawImage($image.get(0), r[0], r[1], r[2], r[3] , 0, 0, canvas_width, canvas_height);
		     //ctx.restore();
	     }
	     //$image.trigger("bk.kenburns.currentframe", [current_frame, frames_amount]);
		}				
			
		function start_kenburns() {
			 //if( !is_started ) {
			 //	 is_started = true;
				 if( (hover_mode == 'pause_on_hover' || hover_mode == 'none' ) && auto_play ) {
		  		is_playing = true;
		  		animate_frame();
		  		$image.trigger("bk.kenburns.play");
				  }		
				  else if( hover_mode == 'play_on_hover' ) {
				  	  //$image.one("load", function() {
							//  draw_current_frame();
							//});
				  	  draw_current_frame();
				  	  $image.trigger("bk.kenburns.pause");  
				  } 
				  else {
				  	  $image.trigger("bk.kenburns.pause");
				  }
			 //} 	
		}
     

		
		$.fn.kenburns_plugin.Play = function() {
                //window.console.log("Play before: ");
                //if( !is_playing ) {
                	  is_playing = true;
                	  //jQuery(this).show();
                	  //window.console.log("Play after: ");
                	  draw_current_frame();
                		//animate_tick = setTimeout( function(){ this.animate_frame.call(this); }, frame_time );
                		
                		$image.oneTime(frame_time, function() {
												   //window.console.log("img: " + $image.attr('src') );
												   animate_frame();
										});
                		
                		$image.trigger("bk.kenburns.play");
                //	}	 		  
            }
            
    $.fn.kenburns_plugin.Pause = function() {
                //window.console.log("Pause befor: ");
                //if( is_playing ) {
                		is_playing = false;
                		//window.console.log("Pause after: ");
                		//clearTimeout(animate_tick);
                		//animate_tick = null;
                		
                		$image.stopTime();
                		
                		$image.trigger("bk.kenburns.pause");
               // }		
            }
            
    $.fn.kenburns_plugin.Current_Shift = function() {
                var r = interpolate_rect(start_rect, dest_rect, current_frame / frames_amount );
								var img_shift = new Object();
								
								var s = width / r[2];
								img_shift['scale'] = s;
						    img_shift['trx'] = r[0] * s * -1;
						    img_shift['try'] = r[1] * s * -1;
						    
						    return img_shift;		
            }
            
    $.fn.kenburns_plugin.Start = function() {
               	start_kenburns(); 
            }                            
		
		/*
		window.requestAnimFrame = (function(){
      return  window.requestAnimationFrame       || 
              window.webkitRequestAnimationFrame || 
              window.mozRequestAnimationFrame    || 
              window.oRequestAnimationFrame      || 
              window.msRequestAnimationFrame     || 
              function( callback,  element){
                window.setTimeout(callback, 1000 / frames_per_second );
              };
    })();
    */
		
						
//=================================END OF FUNCTIONS==========================================================================	


//=================================MAIN======================================================================================		
		init_kenburns();
		
		if( set.flash_at_start ) {
			$overlay.fadeOut(delay, function() {
															  draw_current_frame(); 
																$overlay.fadeIn(delay, function() {
																											 if( set.run_at_init )	 	 
																											     start_kenburns();
																											 } );
															});
			
		} else {	
		  if( set.run_at_init )
		      start_kenburns();	
	  }  		
		//							
//================================END OF MAIN=====================================================================		
		

//================================EVENT HANDLERS==================================================================
    $target.hover(
		  function(event){
										////window.console.log("bk.kenburns. $target.mouseenter");
										if( hover_mode == 'pause_on_hover' && is_playing ) {
											  //clearTimeout(animate_tick);
											  //animate_tick = null;
											  $image.stopTime();
											  
											  $image.trigger("bk.kenburns.pause");
										}	  
										else if( hover_mode == 'play_on_hover' && !is_playing ) {
											  //if( animate_tick == null )
											  //		animate_tick = setTimeout( function(){ this.animate_frame.call(this); }, frame_time );
											  
											  $image.oneTime(frame_time, function() {
												   animate_frame();
												});
											  
											  $image.trigger("bk.kenburns.play");
										}	  		
    				    }, 
		  function(event){
										////window.console.log("bk.kenburns. $target.mouseleave");
										if( hover_mode == 'pause_on_hover' && !is_playing ) {
											  //if( animate_tick == null )
											  //		animate_tick = setTimeout(function(thisObj){ thisObj.animate_frame(); }, frame_time, this);
											  
											  $image.oneTime(frame_time, function() {
												   animate_frame();
												});
											  
											  $image.trigger("bk.kenburns.play");
										}	  
										else if( hover_mode == 'play_on_hover' && is_playing ) {
											  //clearTimeout(animate_tick);
											  //animate_tick = null;
											  $image.stopTime();
											  
											  $image.trigger("bk.kenburns.pause");	
										}	  	
    						}
		);						
    						
    $image.bind('bk.kenburns.pause', function() {
		  is_playing = false;
		  //window.console.log("bk.kenburns.pause binder: ");   
		});
		
		$image.bind('bk.kenburns.play', function() {
		  is_playing = true;
		  //window.console.log("bk.kenburns.play binder");
		});						
//================================END OF EVENT HANDLERS==================================================================		
});
};
})(jQuery);		
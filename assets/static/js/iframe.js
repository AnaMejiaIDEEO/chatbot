/*! iFrame Resizer (iframeSizer.contentWindow.min.js) - v3.5.14 - 2017-03-30
 *  Desc: Include this file in any page being loaded into an iframe
 *        to force the iframe to resize to the content size.
 *  Requires: iframeResizer.min.js on host page.
 *  Copyright: (c) 2017 David J. Bradshaw - dave@bradshaw.net
 *  License: MIT
 */
;
!function(aS){function aR(e,d,f){"addEventListener" in window?e.addEventListener(d,f,!1):"attachEvent" in window&&e.attachEvent("on"+d,f)
}function aQ(e,d,f){"removeEventListener" in window?e.removeEventListener(d,f,!1):"detachEvent" in window&&e.detachEvent("on"+d,f)
}function aN(b){return b.charAt(0).toUpperCase()+b.slice(1)
}function aM(i){var h,n,m,l=null,k=0,j=function(){k=bx(),l=null,m=i.apply(h,n),l||(h=n=null)
};
return function(){var b=bx();
k||(k=b);
var a=ab-(b-k);
return h=this,n=arguments,0>=a||a>ab?(l&&(clearTimeout(l),l=null),k=b,m=i.apply(h,n),l||(h=n=null)):l||(l=setTimeout(j,a)),m
}
}function aL(b){return bw+"["+aO+"] "+b
}function aK(b){bD&&"object"==typeof window.console&&console.log(aL(b))
}function aJ(b){"object"==typeof window.console&&console.warn(aL(b))
}function aG(){aF(),aK("Initialising iFrame ("+location.href+")"),aE(),aA(),aC("background",aY),aC("padding",by),bq(),av(),au(),az(),bo(),at(),aH=bp(),a8("init","Init message from host page"),aI()
}function aF(){function a(b){return"true"===b?!0:!1
}var d=be.substr(bl).split(":");
aO=d[0],aX=aS!==d[1]?Number(d[1]):aX,aU=aS!==d[2]?a(d[2]):aU,bD=aS!==d[3]?a(d[3]):bD,ai=aS!==d[4]?Number(d[4]):ai,a0=aS!==d[6]?a(d[6]):a0,aW=d[7],bB=aS!==d[8]?d[8]:bB,aY=d[9],by=d[10],aT=aS!==d[11]?Number(d[11]):aT,aH.enable=aS!==d[12]?a(d[12]):!1,af=aS!==d[13]?d[13]:af,bC=aS!==d[14]?d[14]:bC
}function aE(){function d(){var b=window.iFrameResizer;
aK("Reading data from page: "+JSON.stringify(b)),bf="messageCallback" in b?b.messageCallback:bf,aI="readyCallback" in b?b.readyCallback:aI,br="targetOrigin" in b?b.targetOrigin:br,bB="heightCalculationMethod" in b?b.heightCalculationMethod:bB,bC="widthCalculationMethod" in b?b.widthCalculationMethod:bC
}function c(f,e){return"function"==typeof f&&(aK("Setup custom "+e+"CalcMethod"),ae[e]=f,f="custom"),f
}"iFrameResizer" in window&&Object===window.iFrameResizer.constructor&&(d(),bB=c(bB,"height"),bC=c(bC,"width")),aK("TargetOrigin for parent set to: "+br)
}function aD(d,c){return -1!==c.indexOf("-")&&(aJ("Negative CSS value ignored for "+d),c=""),c
}function aC(a,d){aS!==d&&""!==d&&"null"!==d&&(document.body.style[a]=d,aK("Body "+a+' set to "'+d+'"'))
}function aA(){aS===aW&&(aW=aX+"px"),aC("margin",aD("margin",aW))
}function az(){document.documentElement.style.height="",document.body.style.height="",aK('HTML & body height set to "auto"')
}function ay(b){var c={add:function(e){function a(){a8(b.eventName,b.eventType)
}bE[e]=a,aR(window,e,a)
},remove:function(e){var d=bE[e];
delete bE[e],aQ(window,e,d)
}};
b.eventNames&&Array.prototype.map?(b.eventName=b.eventNames[0],b.eventNames.map(c[b.method])):c[b.method](b.eventName),aK(aN(b.method)+" event listener: "+b.eventType)
}function ax(b){ay({method:b,eventType:"Animation Start",eventNames:["animationstart","webkitAnimationStart"]}),ay({method:b,eventType:"Animation Iteration",eventNames:["animationiteration","webkitAnimationIteration"]}),ay({method:b,eventType:"Animation End",eventNames:["animationend","webkitAnimationEnd"]}),ay({method:b,eventType:"Input",eventName:"input"}),ay({method:b,eventType:"Mouse Up",eventName:"mouseup"}),ay({method:b,eventType:"Mouse Down",eventName:"mousedown"}),ay({method:b,eventType:"Orientation Change",eventName:"orientationchange"}),ay({method:b,eventType:"Print",eventName:["afterprint","beforeprint"]}),ay({method:b,eventType:"Ready State Change",eventName:"readystatechange"}),ay({method:b,eventType:"Touch Start",eventName:"touchstart"}),ay({method:b,eventType:"Touch End",eventName:"touchend"}),ay({method:b,eventType:"Touch Cancel",eventName:"touchcancel"}),ay({method:b,eventType:"Transition Start",eventNames:["transitionstart","webkitTransitionStart","MSTransitionStart","oTransitionStart","otransitionstart"]}),ay({method:b,eventType:"Transition Iteration",eventNames:["transitioniteration","webkitTransitionIteration","MSTransitionIteration","oTransitionIteration","otransitioniteration"]}),ay({method:b,eventType:"Transition End",eventNames:["transitionend","webkitTransitionEnd","MSTransitionEnd","oTransitionEnd","otransitionend"]}),"child"===af&&ay({method:b,eventType:"IFrame Resized",eventName:"resize"})
}function aw(f,e,h,g){return e!==f&&(f in h||(aJ(f+" is not a valid option for "+g+"CalculationMethod."),f=e),aK(g+' calculation method set to "'+f+'"')),f
}function av(){bB=aw(bB,ac,bm,"height")
}function au(){bC=aw(bC,bs,aP,"width")
}function at(){!0===a0?(ax("add"),bj()):aK("Auto Resize disabled")
}function ar(){aK("Disable outgoing messages"),bF=!1
}function aq(){aK("Remove event listener: Message"),aQ(window,"message",a2)
}function ap(){null!==aV&&aV.disconnect()
}function ao(){ax("remove"),ap(),clearInterval(ad)
}function an(){ar(),aq(),!0===a0&&ao()
}function bq(){var b=document.createElement("div");
b.style.clear="both",b.style.display="block",document.body.appendChild(b)
}function bp(){function p(){return{x:window.pageXOffset!==aS?window.pageXOffset:document.documentElement.scrollLeft,y:window.pageYOffset!==aS?window.pageYOffset:document.documentElement.scrollTop}
}function o(e){var c=e.getBoundingClientRect(),f=p();
return{x:parseInt(c.left,10)+parseInt(f.x,10),y:parseInt(c.top,10)+parseInt(f.y,10)}
}function n(d){function l(e){var c=o(e);
aK("Moving to in page link (#"+k+") at x: "+c.x+" y: "+c.y),a3(c.y,c.x,"scrollToOffset")
}var k=d.split("#")[1]||d,j=decodeURIComponent(k),i=document.getElementById(j)||document.getElementsByName(j)[0];
aS!==i?l(i):(aK("In page link (#"+k+") not found in iFrame, so sending to parent"),a3(0,0,"inPageLink","#"+k))
}function m(){""!==location.hash&&"#"!==location.hash&&n(location.href)
}function h(){function c(d){function e(f){f.preventDefault(),n(this.getAttribute("href"))
}"#"!==d.getAttribute("href")&&aR(d,"click",e)
}Array.prototype.forEach.call(document.querySelectorAll('a[href^="#"]'),c)
}function g(){aR(window,"hashchange",m)
}function b(){setTimeout(m,a6)
}function a(){Array.prototype.forEach&&document.querySelectorAll?(aK("Setting up location.hash handlers"),h(),g(),b()):aJ("In page linking not fully supported in this browser! (See README.md for IE8 workaround)")
}return aH.enable?a():aK("In page linking not enabled"),{findTarget:n}
}function bo(){aK("Enable public methods"),bv.parentIFrame={autoResize:function(b){return !0===b&&!1===a0?(a0=!0,at()):!1===b&&!0===a0&&(a0=!1,ao()),a0
},close:function(){a3(0,0,"close"),an()
},getId:function(){return aO
},getPageInfo:function(b){"function"==typeof b?(aj=b,a3(0,0,"pageInfo")):(aj=function(){},a3(0,0,"pageInfoStop"))
},moveToAnchor:function(b){aH.findTarget(b)
},reset:function(){a4("parentIFrame.reset")
},scrollTo:function(d,c){a3(c,d,"scrollTo")
},scrollToOffset:function(d,c){a3(c,d,"scrollToOffset")
},sendMessage:function(d,c){a3(0,0,"message",JSON.stringify(d),c)
},setHeightCalculationMethod:function(b){bB=b,av()
},setWidthCalculationMethod:function(b){bC=b,au()
},setTargetOrigin:function(b){aK("Set targetOrigin: "+b),br=b
},size:function(e,d){var f=""+(e?e:"")+(d?","+d:"");
a8("size","parentIFrame.size("+f+")",e,d)
}}
}function bn(){0!==ai&&(aK("setInterval: "+ai+"ms"),ad=setInterval(function(){a8("interval","setInterval: "+ai)
},Math.abs(ai)))
}function bk(){function v(d){function c(b){!1===b.complete&&(aK("Attach listeners to "+b.src),b.addEventListener("load",r,!1),b.addEventListener("error",q,!1),n.push(b))
}"attributes"===d.type&&"src"===d.attributeName?c(d.target):"childList"===d.type&&Array.prototype.forEach.call(d.target.querySelectorAll("img"),c)
}function u(b){n.splice(n.indexOf(b),1)
}function t(b){aK("Remove listeners from "+b.src),b.removeEventListener("load",r,!1),b.removeEventListener("error",q,!1),u(b)
}function s(d,h,f){t(d.target),a8(h,f+": "+d.target.src,aS,aS)
}function r(b){s(b,"imageLoad","Image loaded")
}function q(b){s(b,"imageLoadFailed","Image load failed")
}function p(b){a8("mutationObserver","mutationObserver: "+b[0].target+" "+b[0].type),b.forEach(v)
}function o(){var d=document.querySelector("body"),c={attributes:!0,attributeOldValue:!1,characterData:!0,characterDataOldValue:!1,childList:!0,subtree:!0};
return a=new g(p),aK("Create body MutationObserver"),a.observe(d,c),a
}var n=[],g=window.MutationObserver||window.WebKitMutationObserver,a=o();
return{disconnect:function(){"disconnect" in a&&(aK("Disconnect body MutationObserver"),a.disconnect(),n.forEach(t))
}}
}function bj(){var b=0>ai;
window.MutationObserver||window.WebKitMutationObserver?b?bn():aV=bk():(aK("MutationObserver not supported in this browser!"),bn())
}function bi(f,e){function h(b){var k=/^\d+(px)?$/i;
if(k.test(b)){return parseInt(b,aZ)
}var j=e.style.left,i=e.runtimeStyle.left;
return e.runtimeStyle.left=e.currentStyle.left,e.style.left=b||0,b=e.style.pixelLeft,e.style.left=j,e.runtimeStyle.left=i,b
}var g=0;
return e=e||document.body,"defaultView" in document&&"getComputedStyle" in document.defaultView?(g=document.defaultView.getComputedStyle(e,null),g=null!==g?g[f]:0):g=h(e.currentStyle[f]),parseInt(g,aZ)
}function bh(b){b>ab/2&&(ab=2*b,aK("Event throttle increased to "+ab+"ms"))
}function bg(g,d){for(var p=d.length,o=0,n=0,m=aN(g),l=bx(),k=0;
p>k;
k++){o=d[k].getBoundingClientRect()[g]+bi("margin"+m,d[k]),o>n&&(n=o)
}return l=bx()-l,aK("Parsed "+p+" HTML elements"),aK("Element position calculated in "+l+"ms"),bh(l),n
}function bd(b){return[b.bodyOffset(),b.bodyScroll(),b.documentElementOffset(),b.documentElementScroll()]
}function bc(f,e){function h(){return aJ("No tagged elements ("+e+") found on page"),document.querySelectorAll("body *")
}var g=document.querySelectorAll("["+e+"]");
return 0===g.length&&h(),bg(f,g)
}function bb(){return document.querySelectorAll("body *")
}function a9(x,w,v,u){function t(){ah=g,bA=a,a3(ah,bA,x)
}function s(){function c(e,d){var f=Math.abs(e-d)<=aT;
return !f
}return g=aS!==v?v:bm[bB](),a=aS!==u?u:aP[bC](),c(ah,g)||aU&&c(bA,a)
}function r(){return !(x in {init:1,interval:1,size:1})
}function q(){return bB in ak||aU&&bC in ak
}function p(){aK("No change in size detected")
}function o(){r()&&q()?a4(w):x in {interval:1}||p()
}var g,a;
s()||"init"===x?(a7(),t()):o()
}function a8(h,g,l,k){function j(){h in {reset:1,resetPage:1,init:1}||aK("Trigger event: "+g)
}function i(){return am&&h in bt
}i()?aK("Trigger event cancelled: "+h):(j(),al(h,g,l,k))
}function a7(){am||(am=!0,aK("Trigger event lock on")),clearTimeout(ag),ag=setTimeout(function(){am=!1,aK("Trigger event lock off"),aK("--")
},a6)
}function a5(b){ah=bm[bB](),bA=aP[bC](),a3(ah,bA,b)
}function a4(d){var c=bB;
bB=ac,aK("Reset trigger event: "+d),a7(),a5("reset"),bB=c
}function a3(a,n,m,l,k){function j(){aS===k?k=br:aK("Message targetOrigin: "+k)
}function g(){var c=a+":"+n,b=aO+":"+c+":"+m+(aS!==l?":"+l:"");
aK("Sending message to host page ("+b+")"),bz.postMessage(bw+b,k)
}!0===bF&&(j(),g())
}function a2(r){function q(){return bw===(""+r.data).substr(0,bl)
}function p(){return r.data.split("]")[1].split(":")[0]
}function o(){return r.data.substr(r.data.indexOf(":")+1)
}function n(){return !("undefined"!=typeof module&&module.exports)&&"iFrameResize" in window
}function i(){return r.data.split(":")[2] in {"true":1,"false":1}
}function h(){var a=p();
a in b?b[a]():n()||i()||aJ("Unexpected message ("+r.data+")")
}function g(){!1===aB?h():i()?b.init():aK('Ignored message of type "'+p()+'". Received before initialization.')
}var b={init:function(){function a(){be=r.data,bz=r.source,aG(),aB=!1,setTimeout(function(){bu=!1
},a6)
}document.body?a():(aK("Waiting for page ready"),aR(window,"readystatechange",b.initFromParent))
},reset:function(){bu?aK("Page reset ignored by init"):(aK("Page size reset by host page"),a5("resetPage"))
},resize:function(){a8("resizeParent","Parent window requested size check")
},moveToAnchor:function(){aH.findTarget(o())
},inPageLink:function(){this.moveToAnchor()
},pageInfo:function(){var c=o();
aK("PageInfoFromParent called from parent: "+c),aj(JSON.parse(c)),aK(" --")
},message:function(){var c=o();
aK("MessageCallback called from parent: "+c),bf(JSON.parse(c)),aK(" --")
}};
q()&&g()
}function a1(){"loading"!==document.readyState&&window.parent.postMessage("[iFrameResizerChild]Ready","*")
}if("undefined"!=typeof window){var a0=!0,aZ=10,aY="",aX=0,aW="",aV=null,by="",aU=!1,bt={resize:1,click:1},a6=128,aB=!0,ah=1,ac="bodyOffset",bB=ac,bu=!0,be="",aH={},ai=32,ad=null,bD=!1,bw="[iFrameSizer]",bl=bw.length,aO="",ak={max:1,min:1,bodyScroll:1,documentElementScroll:1},af="child",bF=!0,bz=window.parent,br="*",aT=0,am=!1,ag=null,ab=16,bA=1,bs="scroll",bC=bs,bv=window,bf=function(){aJ("MessageCallback function not defined")
},aI=function(){},aj=function(){},ae={height:function(){return aJ("Custom height calculation function not defined"),document.documentElement.offsetHeight
},width:function(){return aJ("Custom width calculation function not defined"),document.body.scrollWidth
}},bE={},bx=Date.now||function(){return(new Date).getTime()
},bm={bodyOffset:function(){return document.body.offsetHeight+bi("marginTop")+bi("marginBottom")
},offset:function(){return bm.bodyOffset()
},bodyScroll:function(){return document.body.scrollHeight
},custom:function(){return ae.height()
},documentElementOffset:function(){return document.documentElement.offsetHeight
},documentElementScroll:function(){return document.documentElement.scrollHeight
},max:function(){return Math.max.apply(null,bd(bm))
},min:function(){return Math.min.apply(null,bd(bm))
},grow:function(){return bm.max()
},lowestElement:function(){return Math.max(bm.bodyOffset(),bg("bottom",bb()))
},taggedElement:function(){return bc("bottom","data-iframe-height")
}},aP={bodyScroll:function(){return document.body.scrollWidth
},bodyOffset:function(){return document.body.offsetWidth
},custom:function(){return ae.width()
},documentElementScroll:function(){return document.documentElement.scrollWidth
},documentElementOffset:function(){return document.documentElement.offsetWidth
},scroll:function(){return Math.max(aP.bodyScroll(),aP.documentElementScroll())
},max:function(){return Math.max.apply(null,bd(aP))
},min:function(){return Math.min.apply(null,bd(aP))
},rightMostElement:function(){return bg("right",bb())
},taggedElement:function(){return bc("right","data-iframe-width")
}},al=aM(a9);
aR(window,"message",a2),a1()
}}();
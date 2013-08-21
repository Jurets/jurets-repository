if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        }
        return this;
    }
}

/*extend js objects*/
var pls = {};
pls.beget = function(o) {
    var F = function() {};
    F.prototype = o;
    return new F();
};
Function.prototype.set_method = function(name, func) {
    if (!this.prototype[name]) this.prototype[name] = func;
    return this;
};
Function.set_method('inherits',
function(Parent) {
    this.prototype = new Parent();
    return this;
});
Function.set_method('set_base',
function(Parent) {
    this.prototype = Parent;
    return this;
});
pls.registerNameSpaces = function(ns, prototype) {
    var nsParts = ns.split(".");
    var root = window;
    for (var i = 0; i < nsParts.length; i++) {
        if (typeof root[nsParts[i]] == "undefined") {
            if (prototype && i == nsParts.length - 1) root[nsParts[i]] = sbBaseObj.beget(prototype);
            else root[nsParts[i]] = new Object();
        }
        root = root[nsParts[i]];
    }
};

function fontSize(obj, fSize, lHeight){
	var object = document.getElementById(obj);
	
	var compStyle = window.getComputedStyle(object, "");
	
	var oldfontSize = parseInt(compStyle.getPropertyValue("font-size").replace("px",""));
	var oldlineHeight = parseInt(compStyle.getPropertyValue("line-height").replace("px",""));

	if(document.all){
		object.style.cssText = 'font-size:'+(oldfontSize+(fSize-oldfontSize))+'px!important; line-height:'+(oldlineHeight+(lHeight-oldlineHeight))+'px!important';
	}else{
		object.setAttribute('style', 'font-size:'+(oldfontSize+(fSize-oldfontSize))+'px!important; line-height:'+(oldlineHeight+(lHeight-oldlineHeight))+'px!important');
	}
	
	var el = object.childNodes;
	
	var pattern=/fz-/g;
	
	for(var i=0; i<el.length; i++)
	{
		if(el.tagName.toLowerCase() == 'h2')
		{
			fontSizeChild(el[i], (fSize-oldfontSize), (lHeight-oldlineHeight));
		}
	
		if(el[i].className)
		{
			if(el[i].className.match(pattern)){
				fontSizeChild(el[i], (fSize-oldfontSize), (lHeight-oldlineHeight));
			}
		}
	}
}

function fontSizeChild(object, fSize, lHeight){
	var compStyle = window.getComputedStyle(object, "");

	var oldfontSize = parseInt(compStyle.getPropertyValue("font-size").replace("px",""));
	var oldlineHeight = parseInt(compStyle.getPropertyValue("line-height").replace("px",""));

	if(document.all){
		object.style.cssText = 'font-size:'+(oldfontSize+fSize)+'px!important; line-height:'+(oldlineHeight+lHeight)+'px!important';
	}else{
		object.setAttribute('style', 'font-size:'+(oldfontSize+fSize)+'px!important; line-height:'+(oldlineHeight+lHeight)+'px!important');
	}
}

function toggleBox(obj){
	var object = document.getElementById(obj);
	object.style.display = (object.style.display != 'none' ? 'none' : '' );
}

$(function () {
	$('form').each(function () {
		$(this).submit(function () {
			$('.require', this).each(function () {
				if($(this).val() == "" || $(this).val() == " "){
					$(this).addClass("inputError");
				}else
					$(this).removeClass("inputError");
			});

			if($(".inputError", this).size() > 0)
				return false;
				
			return true;
		})
	});

	$("#main-news ul.list li").hover(function () { 
		
		var $index = $("#main-news ul.list li").index( $(this) );
						   $('.list-active').addClass('display-none');
		                   $("#list-"+$index).removeClass('display-none');		
		
		$("#main-news ul.list li").removeClass('show');

		$(this).addClass('show');
	});

//	pls.main.newsroller.news = new pls.main.newsroller.Ctor('NewsScroller','NewsScrollerContainer', 'window.ScrollSpeed');
});
pls.registerNameSpaces("pls.main.newsroller");

/*------------------------ NEWS ROLLER START --------------------------------------*/

pls.main.newsroller.Ctor = function(rollerId, rollerContainerId, rollInterval)
{
    this.rollerId = rollerId;
    this.rollerContainerId = rollerContainerId;
    this.rollInterval = rollInterval;
    var that = this;
    var tOutNews,objNews;

    var newsScrollerInit = function (){
		try{
			var newsDiv=document.getElementById(rollerId);//'NewsScroller1'
			AreaHeightNews=newsDiv.offsetHeight;
			
			var lines = $('#'+rollerId+' > li');//getElementsByTagName("div"); 
			for(var i=0;i<(lines.length>5? 5:lines.length) ;i++){
				var newNode=lines[i].cloneNode(true);
				newsDiv.appendChild(newNode)
			}

			objNews=document.getElementById(rollerContainerId);//"NewsScrollerContainer"
			objNews.style.top=0;
			that.ScrollNewsDiv();
		}catch(e){}
    }

    this.ScrollNewsDiv = function (){
		if(typeof that.num == 'undefined')
			that.num = 0;
			that.num--;
		if( that.num<AreaHeightNews*(-1)){ 
           clearTimeout(tOutNews);
           that.num = 0;
		}
		objNews.style.top=that.num + 'px';
		tOutNews=setTimeout('pls.main.newsroller.ScrollNewsDiv()',that.rollInterval)
	}
        
    pls.main.newsroller.ScrollNewsDiv = this.ScrollNewsDiv;
    
    this.scrollStop = function() { clearTimeout(tOutNews); }

    this.scrollResume = function (element,evt){
		var containsDOM = function (container, containee){
			var isParent = false;
			do{
				if ((isParent = container == containee)) break;
					containee = containee.parentNode;
			} while(containee != null);
				return isParent;
			}
			var isOut="";
			if (element.contains && evt.toElement){ isOut=(!element.contains(evt.toElement));}
			else if (evt.relatedTarget){ isOut=(!containsDOM(element, evt.relatedTarget)); }
			if(isOut){that.ScrollNewsDiv();}
        }

    newsScrollerInit()
}
/*------------------------  NEWS ROLLER END --------------------------------------*/

/*------------------------ WINDOW POPUP START --------------------------------------*/
function popUp(url) {

	var winW = 700;
	var winH = 700;//680;
	
	var left = (screen.width/2)-(winW/2);

	newwindow=window.open(url,'name','width='+winW+', height='+winH+', location=1,left='+left+',top=50');
	if (window.focus) {newwindow.focus()}
	return false;
}
/*------------------------ WINDOW END START --------------------------------------*/

/*---------------------- BANNER PLACEMENT START -----------------------------------*/
function placeBanner(banner, content, after){ 
        var contentParagraphs = $(content).find("p").filter(':parent');
        var contentDivs = $(content).find("div").filter(':parent');        
        var elems = contentParagraphs.length > 0 ? contentParagraphs : contentDivs;
         pos = (elems.length > after-1) ? after-1 : elems.length - 1
         if(elems.length > 0) {
          $(banner).insertAfter(elems[pos]);
         }
         $(banner).show();
}
/*---------------------- BANNER PLACEMENT END --------------------------------------*/

function addBookmark(url, title)
{
    if (!url) url = location.href;
    if (!title) title = document.title;
	
  try {
    if (jQuery.browser.mozilla) {
      window.sidebar.addPanel (title,url, "");
    } else if (jQuery.browser.msie) {
      window.external.AddFavorite(url, title);
    } else {
      alert('нажмите Ctrl+D для добавление в избранное!');
    }
    return false;
  }
  catch(e) { 
    return false;
  }	
	
/*
    //Gecko
    if ((typeof window.sidebar == "object") && (typeof window.sidebar.addPanel == "function")) window.sidebar.addPanel (title, url, "");
    //IE4+
    else if (typeof window.external == "object") window.external.AddFavorite(url, title);
    //Opera7+
    else if (window.opera && document.createElement)
    {
        var a = document.createElement('A');
        if (!a) return false; //IF Opera 6
        a.setAttribute('rel','sidebar');
        a.setAttribute('href',url);
        a.setAttribute('title',title);
        a.click();
    }
    else return false;

    return true;*/
}

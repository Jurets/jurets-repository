	$(function () {
		var $gallery = $('#gallery-slider');
		var $galleryText = $('#gallery-text');
		var $ul = $('> ul',$gallery);
		var $li = $('> li',$ul);
		var $next = $('.gallery-next');
		var $prev = $('.gallery-prev');
		var $index = 0;

		$galleryText.html($('.image-description', $li[0]).html());

		$('> ul', $gallery).css({
			width: ($li.width()*$li.size())
		});
		
        //set height for photo text
       /* var $newheight = $galleryText.height();
        if ($newheight)
            $galleryText.height($newheight * 3);*/
            
        //set width for gallery-nav
        var $galleryN = $("#gallery-nav");
        //$navstr = '<a>1</a>...<span>99</span><a>99</a><a>99</a><a>99</a><a>99</a>...<a>99</a>';
        var $count = $('li', $ul).length;
        var $navstr = '<a>1</a>...<span>' + ($count - 5) + '</span>';
        for (i = 4; i >= 1; i--) {
            $navstr += ('<a>' + ($count - i) + '</a>');
        }
        $navstr += ('...<a>' + $count + '</a>');
        $galleryN.html($navstr);
        var $newwidth = ($galleryN.width());
        if ($newwidth)
            $galleryN.width($newwidth + 2);
        $galleryN.empty();
        
		GalleryScroll($index);
		pagination(1);
		
		function GalleryScroll($index)
		{
			if($index >= ($li.size()-1))
				$next.addClass('visibility-none');		
			else
				$next.removeClass('visibility-none');
				
			if($index <= 0)
				$prev.addClass('visibility-none');
			else
				$prev.removeClass('visibility-none');
		
		
			$next.unbind('click').bind('click', function () 
			{
				if($index >= $li.size()) $index = $li.size(); else ++$index;
				
				GalleryScroll($index);
				return true;
			});
			
			$prev.unbind('click').bind('click', function () 
			{
				if($index <= 0) $index = 0; else --$index;
			
				GalleryScroll($index);
				return true;
			});		

			pagination($index+1);
			
			$ul.animate({
				marginLeft: -($li.width()*$index)+'px'
			}, 300, function() {
				$galleryText.html($('.image-description', $li[$index]).html());
			});

			return $index;
		}

		function pagination($index)
		{
			var $galleryP = $("#gallery-pages");
			var $galleryN = $("#gallery-nav");
			
			var $midRange = 5;
			var $rangeStart = $index - Math.floor($midRange/($midRange+1));
			var $rangeEnd = $index + Math.floor($midRange/($midRange+1));
			var $page = null;
			
			$galleryN.empty();

			if($rangeStart <= 0)
			{
				$rangeEnd += Math.abs($rangeStart)+1;
				$rangeStart = 1;
			}			
			
			if($index <= $li.size()) 
				$rangeEnd = 4+$index;			
			
			if($rangeEnd > $li.size())
			{
				$rangeStart -= $rangeEnd-$li.size();
				$rangeEnd = $li.size();
			}	

			var $range = Array.range($rangeStart,$rangeEnd);					

			for(var $i=1; $i<=$li.size(); $i++)
			{
				if($range[0] > 2 && $i == $range[0]) $galleryN.append('...');
			
                if($i==1 || $i==$li.size() || $range.in_array($i)) 
					if($i == $index)
						$galleryN.append('<span>'+$i+'</span>');
					else
					{
						$page = document.createElement('a');
						$page.innerHTML = $i;
						$page.href = 'javascript:void(0)';
						$page.onclick = (function() 
						{
							var $index = $i-1;
							return function() {
								GalleryScroll($index);
							}
						})();

						$galleryN.append($page);
					}

				if($range[$midRange-1] < $li.size()-1 && $i == $range[$midRange-1])  $galleryN.append('...');  
			}
		}
	
	});
	
	Array.prototype.in_array = function(p_val) {
		for(var i = 0; i < this.length; i++) 
		{
			if(this[i] == p_val)
				return true;
		}
		return false;
	}	
	
	Array.range= function(a, b, step){
		var A= [];
		if(typeof a== 'number'){
			A[0]= a;
			step= step || 1;
			while(a+step<= b){
				A[A.length]= a+= step;
			}
		}
		else{
			var s= 'abcdefghijklmnopqrstuvwxyz';
			if(a=== a.toUpperCase()){
				b=b.toUpperCase();
				s= s.toUpperCase();
			}
			s= s.substring(s.indexOf(a), s.indexOf(b)+ 1);
			A= s.split('');        
		}
		return A;
	}	
/*
 * http://jquery.com/
 */
 
$(document).ready(function() {
	slider1(10000, 680); // set delay between the automatic slider and width of photos 
});

function slider1($secs, $photo_wth) {	$addC = $(".itemidx.current").length;	if($addC == 0) {		$(".itemidx:first").addClass("current");	}
	$allPort = ($(".itemidx").length) - 1;	$wthDivide = 935 - $photo_wth;	$tileWth = parseInt($wthDivide / $allPort);	$caption_wth = $photo_wth - 63;	$caption_wth = $caption_wth + 'px';	$photo_wth = $photo_wth + 'px';
	$(".itemidx").css("width", $tileWth);	$(".itemidx.current").css("width", $photo_wth);	$(".caption").css({ width: $caption_wth, opacity: 0 });	if(typeof(isClicked) == 'undefined') { var isClicked = 0; }
	$(".itemidx").click(function() {	isClicked = 1;	var classClicked = $(this).attr('class');	if(classClicked !== 'itemidx current') {			$(".itemidx.current").removeClass("current").addClass("prev").stop().animate({ width: $tileWth }, 630);	$(this).addClass("current").css("width", $tileWth).stop().animate({ width: $photo_wth }, 730);	$(".itemidx.prev").removeClass("prev"); }	});
	if(typeof(isHovered) == 'undefined') { var isHovered = 0; }	$(".itemidx").hover(function() {	isHovered = 1;	}, function() {	isHovered = 0;	});	setInterval(function() {	if(isHovered == 0 && isClicked == 0) {	nextItm('680px', $tileWth);	}	}, $secs);}
function nextItm($photo_wth, $tile_width) {	$current = $(".itemidx.current");	$next = $(".itemidx.current").next();	if($next.attr('class') == undefined) {	$next = $(".itemidx:first");	} else {	}	$current.removeClass("current").css("width", $photo_wth).stop().animate({ width: $tile_width }, 630);	$next.addClass("current").css("width", $tile_width).stop().animate({ width: $photo_wth }, 730);}

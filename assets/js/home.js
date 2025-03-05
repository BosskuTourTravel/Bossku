var itemWidth=0,itemHeight=0,$grid = $('.grid'),$gridsquare= $('.grid.square'),$gridsquareitems = $gridsquare.find('div.itemsquare'),$gridcollage = $('.grid.collage'),$gridcollageitems = $gridcollage.find('div'),$gridproduct=$('.owl-product'),$gridproductitem=$gridproduct.find('li.item'),
setHeights  = function()
{ 
	//product
	itemHeight=0;
	itemHeightArticle=0;
	$('.owl-carousel').css('display','block');
	$gridproductitem=$('.owl-product').find('li.item');
	$gridproductitemarticle=$gridproductitem.find('article');
	$gridproductitemimg=$gridproductitem.find('.imgproduct');
	//$gridproductitem.css('height','auto');
	$gridproductitemarticle.css('height','auto');
	$gridproductitemimg.css('height','auto');
	itemWidth=$gridproductitem.find(".imgproduct").width();
	
	$($gridproductitem).each(function( index ) {
		// if(itemHeight < parseInt($(this).outerHeight())){
			// itemHeight=parseInt($(this).outerHeight());
		// }
		if(itemHeightArticle < parseInt($(this).find("article").outerHeight())){
			itemHeightArticle=$(this).find("article").outerHeight();
		}
		//console.log(itemHeight);
	});
	itemHeight=6/9*itemWidth;
	//console.log(itemHeightArticle);
	$($gridproductitem).each(function( index ) {
		$(this).find('.imgproduct').css('height',itemHeight);
		$(this).find("article").css('height',itemHeightArticle);
	});

	//square
	itemWidth=0;  
	$('.grid.square .imgproduct').css( 'height', 'auto'); 
	$('ul.slideevent li .imgproduct').css( 'height', 'auto');  	
	$('ul.slideodd li .imgproduct').css( 'height', 'auto');  
	$('.grid.square .arrowed').css( 'margin-top', '0px');
    if ($(window).width() > 991) {
		containerWidth=($('.container').width()/4)-12;
	}else{
		containerWidth=($('.container').width()/2)-12;
	}
	var $gridcollage = $('.grid.collage');
	var $gridcollageitems = $gridcollage.find('div');
	//console.log(containerWidth);
	$($gridsquareitems).each(function( index ) {
	  itemWidth = parseInt( $( this ).width() ); 
	  //console.log(itemWidth);
	});
	if(itemWidth != containerWidth){
		itemWidth=containerWidth;
	}
	$('.grid.square .imgproduct').css( 'height', itemWidth);   
	$('ul.slideevent li .imgproduct').css( 'height', itemWidth);  	
	$('ul.slideodd li .imgproduct').css( 'height', itemWidth);  	
	
	    
	$('.grid.square .arrowed').each(function(){
	    var labelHeight=$(this).outerHeight();
	    //$(this).css( 'margin-top', (itemWidth-labelHeight)/2);  
	});

	//collageitems
	itemWidth=0;
	$($gridcollageitems).each(function( index ) {
	  itemWidth = parseInt( $( this ).outerWidth() ); 
	  //console.log(itemWidth);  	  
	});

	$('.grid.collage .img.imgproduct').css( 'height', itemWidth); 	
	$('.grid.collage .img').css( 'height', itemWidth);
	$('.grid.collage .tags').css( 'margin-top', itemWidth/2.5);
	$('.grid.collage .tags.tlandscape').css( 'margin-top', itemWidth/2.5);
	
	$('.grid.collage .landscape-2x .img-wrapper').css( 'height', itemWidth-1); 
	$('.grid.collage .landscape-2x .img .thumbnail').css( 'height', itemWidth-1);

	//square big
	$('.grid.collage .square-2x .img').css( 'height', itemWidth*2+9); 
	/*$('.grid.collage .square-2x .img .thumbnail').css( 'height', itemWidth*2+9);
	$('.grid.collage .square-2x .img .thumbnail .box-product').css( 'height', itemWidth*2+9); 
	$('.grid.collage .square-2x .img .thumbnail .box-product .imgproduct').css( 'height', itemWidth*2+9); 	*/
	$('.grid.collage .square-2x .tags').css( 'margin-top', (itemWidth*2)/2.4+9); 
	$('.grid.collage .square-2xx .tags').css( 'margin-top', (itemWidth*2)/2.4+9); 
};

setHeights();
$( window ).on( 'resize', setHeights );
$grid.on( 'load', setHeights );

function loadLazy() {
	$(".lazy").lazyload({
		effect        : "fadeIn",
		failure_limit : 120
	});
}

$(document).ready(function() {
  $(".owl-product").owlCarousel({
	loop:true,
	autoplay:false,
	autoplayTimeout: 5000,
	autoplayHoverPause: true,
	nav:true,
	lazyLoad: true,
	dots:true,
	margin:0,
	responsiveClass:true,
	responsive:{
	  0:{
		items:1
	  },
	  540:{
		items:2
	  },
	  960:{
		items:3
	  },
	  1200:{
		items:3
	  }
	},
	    afterMove:function(){loadLazy();}
  });

  $("#owl-promo-highlights").owlCarousel({
	loop:true,
	autoplay:false,
	autoplayTimeout: 5000,
	autoplayHoverPause: true,
	nav:true,
	lazyLoad: true,
	dots:true,
	margin:0,
	responsiveClass:true,
	responsive:{
	  0:{
		items:1
	  },
	  768:{
		items:3
	  },
	  960:{
		items:4
	  }
	},
	    afterMove:function(){loadLazy();}
  });

    setHeights();
	loadLazy();

    $('#slides').superslides({play: 0, inherit_height_from: '#slideshome',pagination:true,play:7000});
    //document.ontouchmove = function(e) {e.preventDefault();};
    $('#slides').hammer().on('swipeleft', function() {$(this).superslides('animate', 'next');});
    $('#slides').hammer().on('swiperight', function() {$(this).superslides('animate', 'prev');});
    $('#slideshome .container').on('click', function() {$('#slides').superslides('stop');});
    $('#slides').css('touch-action','initial');

});

var loadHomeSlide=function(){
	$('#slides ul').load(g_DomainName + '/ajax/getHomeSlide.asp',function(){
	    $('#slides').superslides('update');
	    $('#slides').superslides('start');
	});
};
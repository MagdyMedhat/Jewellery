// $('img.photo',this).imagesLoaded(myFunction)
// execute a callback when all images have loaded.
// needed because .load() doesn't work on cached images
// mit license. paul irish. 2010.
// webkit fix from Oren Solomianik. thx!
// callback function is passed the last image to load
// as an argument, and the collection as `this`
$.fn.imagesLoaded = function(callback){
    var elems = this.filter('img'),
    len = elems.length;
    elems.bind('load',function(){
        if (--len <= 0){
            callback.call(elems,this);
        }
    }).each(function(){
        // cached images don't fire load sometimes, so we reset src.
        if (this.complete || this.complete === undefined){
            var src = this.src;
            // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
            // data uri bypasses webkit log warning (thx doug jones)
            this.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
            this.src = src;
        }
    });
    return this;
};
$(document).ready(function(){
	// Main menu
	$("ul#menu-main-menu").superfish({
		delay:       1000,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       'fast',                          // faster animation speed 
		autoArrows:  false,                           // disable generation of arrow mark-up 
		dropShadows: false,                            // disable drop shadows 
		delay:         300,                // the delay in milliseconds that the mouse can remain outside a submenu without it closing 
	});
	// hover scroll
	$('#asideNav .slide').hoverscroll({
		width:    890,    // Width of the list container
		height:   105       // Height of the list container
	});
	// aside tabs
	$("#tabs").tabs();
	// click on plus icon
	var asideNav = $('#asideNav');
	$('#overlay-open a',asideNav).click(function(e){
		if(asideNav.hasClass('expanded')){
			$('#overlaybg').fadeOut('slow',function(){$(this).remove()})
			asideNav.removeClass('expanded').find('#tabs').slideUp('fast',function(){
				$(this).slideDown(function(){
					// update the menu
					$('#asideNav .slide:not(:hidden)').hoverscroll('update')
				});
			})
		}else{
			// add overlay bg
			$('body').append('<div id="overlaybg"></div>').find('#overlaybg').css({opacity:0.7}).fadeIn('slow')
			// slide
			asideNav.addClass('expanded').find('#tabs').slideUp('fast',function(){
				$(this).slideDown(function(){
					// update the menu
					$('#asideNav .slide:not(:hidden)').hoverscroll('update')
				})
			})
		}
		e.preventDefault()
	})
	// click on any slide image
	var links = $('#asideNav .slide a');
	links.click(function(e){
		links.removeClass('selected')
		$(this).addClass('selected')
		if(asideNav.hasClass('expanded')){
			$('#overlay-open a',asideNav).trigger('click');
		}
		//e.preventDefault()
	})
	
	// click on info icon
	$('.box_cont .info').click(function(){
		$(this).next().slideToggle();
	})
	// click on big image thumbs
	$('#mainOfferCont .box_images_btns img').click(function(){
		var href = $(this).attr('data-src');
		// change the src
		$('#mainOfferCont .mainImage').attr('src',href).imagesLoaded(function(){
			$(this).hide().fadeIn(500);
		});
	})
	// timer
	$('#mainOfferCont #timer').countdown({
		until: new Date(2012,11-1,29)
	});
});
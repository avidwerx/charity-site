jQuery(document).ready(function($) {

/*--------------------------------------------------------
/ 			Cause page slider code
/*--------------------------------------------------------*/
												
	var slider = $('#featureslide').bxSlider({controls: false,mode: 'fade',
    captions: true});
	 // assign a click event to the external thumbnails
  $('.thumbs li a').click(function(){
  // var thumbIndex = $('.thumbs li a').index(this);
  var thumbIndex = $(this).attr("data-id");
    // call the "goToSlide" public function
    slider.goToSlide(thumbIndex);
  
    // remove all active classes
    $('.thumbs li a').removeClass('pager-active');
    // assisgn "pager-active" to clicked thumb
    $(this).addClass('pager-active');
    // very important! you must kill the links default behavior
    return false;
  });

  // assign "pager-active" class to the first thumb
  $('.thumbs li a:first').addClass('pager-active');

  //controls external
  $('#go-prev').click(function(){
    slider.goToPreviousSlide();
    return false;
  });

  $('#go-next').click(function(){
    slider.goToNextSlide();
    return false;
  });
  //colorbox     
	$(".donate_btn").colorbox({inline:true, width:"53%"});
	$(".donatebutton").colorbox({inline:true, width:"53%"});
	
 //carousel for thumbnails
$(".thumbs ul").rcarousel({
					orientation: "vertical",
					margin: 0,
					height:157,
					visible: 2,
					step: 1,
					navigation: {next:".downarrow",prev:".uparrow"}
				});
				
				$( ".uparrow" )
					.add( ".downarrow" )
					.hover(
						function() {
							$( this ).css( "opacity", 0.7 );
						},
						function() {
							$( this ).css( "opacity", 1.0 );
						}
					); 
	
});
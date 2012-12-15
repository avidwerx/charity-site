jQuery(document).ready(function($) {

/*--------------------------------------------------------
/ REGISTRATION FORM 
/*--------------------------------------------------------*/
//$('.signupform').click(function() {
$(".signupform").colorbox({inline:true,href: "#register_form_div", innerWidth: '875px', innerHeight: '727px'});
   //  $("#register-form-div").show();
//	$('#register-form').modal();

//	});
$("#cboxOverlay").live("click",function() {
	$(".signupform").colorbox().close();
});
   
/*--------------------------------------------------------
/ SLIM SCROLL
/*--------------------------------------------------------*/
if($("body.page-template-dashboard-php").length > 0) {
  $(' #step2_wrap,#projectform').slimScroll({
        height: '840px',
		width: '730px',
		alwaysVisible: true
    });
}	

//===== Dual select boxes =====//
	
	$.configureBoxes();
	
/*--------------------------------------------------------
/ word count
/*--------------------------------------------------------*/

$("#cause-title").counter({
    type: 'word', 
    goal: 20,
	msg: '/20'
});

$("#textarea").counter({
    type: 'word', 
    goal: 120,
	msg: '/120'
});


//===== Tooltips =====//
	
	$('.tipN').tipsy({gravity: 'n',fade: true});
	$('.tipS').tipsy({gravity: 's',fade: true});
	$('.tipW').tipsy({gravity: 'w',fade: true});
	$('.tipE').tipsy({gravity: 'e',fade: true});
/*--------------------------------------------------------
/ 	RADIO REPLACEMENT
/*--------------------------------------------------------*/
$('input:radio').each(function() {
        $(this).hide();
        $('<a class="radio-fx" href="#"><div class="radio"></div></a>').insertAfter(this);
    });
    $('.radio-fx').live('click',function(e) {
        e.preventDefault();
          var $check = $(this).prev('input');
          $('.radio-fx div').attr('class','radio');
          $(this).find('div').attr('class','radio-checked');          
          $check.attr('checked', true);
		  if($check.attr("id") == 'datepicker_2') {
		  $('#datepicker_2').datepicker("show");} else{
				$('#datepicker_2').datepicker("hide");
		  }
    });
/*--------------------------------------------------------
/ HANDLE THE  DASHBOARD ANIMATION
/*-------------------------------------------------------*/

$('.tabs-contenor').addClass('sliding').delay(2000).slideDown({duration:1000,easing:'jswing'});

/*--------------------------------------------------------
/ CAUSES PAGE SORTABLE
/*--------------------------------------------------------*/

$( ".recent_project-list #example" ).sortable();

/*--------------------------------------------------------
/ donations page filter
/*---------------------------------------------------------*/

		$(".donation_filter select").change(function() { 
		var active = $(this).val();				
		$('.donation-div').hide();		
		var matches = $("#donations").find(".donation-div")
		
	matches.each(function() {
		if($(this).attr("data-id") === active) {
		
		$(this).show(); }
		});
		if(active === 'all') {			
			matches.show();
		}
	});
	
	var seen = {};
$('.donation_filter select option').each(function() {
    var txt = $(this).text();
    if (seen[txt])
        $(this).remove();
    else
        seen[txt] = true;
});

/*--------------------------------------------------------
/ PRELOAD IMAGES
/*---------------------------------------------------------*/
 var cache = [];
  // Arguments are image paths relative to the current page.
  $.preLoadImages = function() {
    var args_len = arguments.length;
    for (var i = args_len; i--;) {
      var cacheImage = document.createElement('img');
      cacheImage.src = arguments[i];
      cache.push(cacheImage);
    }
	}
	jQuery.preLoadImages(
		directory+"/images/sliderbg.png",
		directory+"/images/body_background.jpeg",
		directory+"/images/inner-header.png",
		directory+"/images/userprofilbg.png",
		directory+"/images/continents.png",
		directory+"/images/thumbnail.png",
		directory+"/images/tabarea-bg.png",
		directory+"/images/normalbg.png"
	
	);
/*--------------------------------------------------------
/	DASHBOARD STATUS UPDATE
/*--------------------------------------------------------*/

		$("#userstatus").change(function(){	
		//$(this).mask();	
		var named = $(this).attr("name");
		var valued = $(this).val();	
		
			$.ajax({
			type:'POST', 
			url: "wp-admin/admin-ajax.php?action=update_status&status="+valued,
			data : {			
			name:  named,
			status: valued,
			},
			success: function(response) {
			
			}
	     
		});
		
	});

/*--------------------------------------------------------
/ Login form
/*-------------------------------------------------------*/
$('.loginform').click(function(e) {
	e.preventDefault();
	$.ajax({
			type:'POST', 
			url: "wp-admin/admin-ajax.php?action=login_form",		
			success: function(response) {
				$("body").append(response);	
				//$.colorbox({innerWidth:560,innerHeight:400, open:true});
				
				$.colorbox({href: "#login_form_div", width:"960px", height:"500px", inline:true,open:true});
				$("#colorbox").addClass("colorbox-form"); 
				
			}
		
		
		});
});

/*--------------------------------------------------------
/ FEATURED SLIDER CYCLE
/*-------------------------------------------------------*/
if ($('body.featured').length > 0) {
	$('#content-pages').cycle({ 
		fx:     'scrollRight', 
		speed:  'fast', 
		timeout: 0, 
		pager:  '#navigation', 
		pagerAnchorBuilder: function(idx, slide) { 
			// return selector string for existing anchor 
			return '#navigation li:eq(' + idx + ') a'; 
		} 
	});

}

/*--------------------------------------------------------
/ MESSAGES HANDLER
/*-------------------------------------------------------*/
/*$( "#message-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			dialogClass: "messagedialog"
		});	


$("#user-links .messages" )			
			.click(function(e) {
			e.preventDefault();
				$("#message-form" ).dialog( "open" );
				
			});*/
/*--------------------------------------------------------
/ HOMEPAGE SLIDER CYCLE
/*-------------------------------------------------------*/
if ($('body.home').length > 0) {
	$('#home_slider').cycle({ 
		fx:     'scrollRight', 
		speed:  'slow', 
		timeout: 0, 
		//easing: 'easeOutBack',
		pager:  '#navigation', 
		pagerAnchorBuilder: function(idx, slide) { 
			// return selector string for existing anchor 
			return '#navigation li:eq(' + idx + ') a'; 
		} 
	});

}


/**********CALENDAR*********/  
/**********CALENDAR*********/	
	
	
var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			//theme: true, //Remove Comment For color theme
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});	

/**********NOTIFICATIONS*********/  
/**********NOTIFICATIONS*********/ 


$('#simple-alert').click(function(ev) {

    $.msgbox("jQuery is a fast and concise JavaScript Library that simplifies HTML document traversing, event handling, animating, and Ajax interactions for rapid web development.", {type: "info"});

});




$('#attention-alert').click(function(ev) {

   $.msgbox("The selection includes process white objects. Overprinting such objects is only useful in combination with transparency effects.");

});




$('#error').click(function(ev) {

    $.msgbox("An error 1053 ocurred while perfoming this service operation on the MySql Server service.", {type: "error"});

});


$('#confirm').click(function(ev) {

   $.msgbox("Are you sure that you want to permanently delete the selected element?", {
	type: "confirm",
    
	buttons : [
        {type: "submit", value: "Yes"},{type: "submit", value: "No"},
		{type: "cancel", value: "Cancel"}]},
	
	function(result) { $("#result2").text(result); });

});




$('#simple_forms').click(function(ev) {

  $.msgbox("<p>In order to process your request you must provide the following:</p>", {
    type    : "prompt",
    name    : "lock",
    inputs  : [
      {type: "text",     name: "username", value: "", label: "Username:", required: true},
      {type: "password", name: "password", value: "", label: "Password:", required: true}
    ],
    buttons : [
      {type: "submit", name: "submit", value: "Sign In"},
      {type: "cancel", value: "Cancel"}
    ],
    form : {
      active: true,
      method: 'post',
      action: 'login.php'
    }
  });
  
  ev.preventDefault();

});



$("#form_with_confirm").click(function() {
									   
  $.msgbox("<p>In order to process your request you must provide the following:</p>", {
    type    : "prompt",
    inputs  : [
      {type: "text",     label: "Insert your Name:", value: "", required: true},
      {type: "password", label: "Insert your Password:", value: "", required: true}
    ],
    buttons : [
      {type: "submit", value: "OK"},
      {type: "cancel", value: "Exit"}
    ]
  }, function(name, password) {
    if (name) {
      $.msgbox("Hello <strong>"+name+"</strong>, your password is <strong>"+password+"</strong>.", {type: "info"});
    } else {
      $.msgbox("Bye!", {type: "info"});
    }
  });
  
});



/*Stiky Notes*/

$( '.stiky-auto-hide' ).click( function () 
	{
	 var notice = '<div class="notice">'
	  + '<div class="notice-body">' 
	  + '<img src="images/info2.png" alt="" />'
	  + '<h3>Auto Hide Stiky Note</h3>'
	  + '<p>This Message will disappear after few seconds</p>'
	  + '</div>'
	  + '<div class="notice-bottom">'
	  + '</div>'
	  + '</div>';
							  
	  $( notice ).purr(
	   {
		 usingTransparentPNG: true
	   }
	   );
						
		return false;
		}
		);
 
 
 
				
$( '.stiky-fixed' ).click( function () 
	{
	  var notice = '<div class="notice">'
	  + '<div class="notice-body">' 
	  + '<img src="images/info2.png" alt="" />'
	  + '<h3>"Sticky" Purr Example</h3>'
	  + '<p>akshay is good boy</p>'
	  + '</div>'
	  + '<div class="notice-bottom">'
	  + '</div>'
	  + '</div>';
							  
	  $( notice ).purr(
	      {
		    usingTransparentPNG: true,
		    isSticky: true
		  }
		);
						
		return false;
	}
	);






 $('.newmedia').on("click",function() {

		$('#basic-modal-content').dialog({
            resizable: false,
            modal: true,
            width: 400,
            height: 450,
            overlay: { backgroundColor: "#000", opacity: 0.5 },           
            close: function(ev, ui) { $(this).remove(); },
			dialogClass: "mediadialog"
    });
		return false;
	
});

$('.existing').on("click",function() {

		$('#basic-modal-content-existing').dialog({
            resizable: false,
            modal: true,
            width: 400,
            height: 450,
            overlay: { backgroundColor: "#000", opacity: 0.5 },           
            close: function(ev, ui) { $(this).remove(); },
			dialogClass: "mediadialog"
    });
		return false;
	
});

$('.scrolling-modal').click(function (e) {
		$('#basic-modal-content2').modal();
		return false;
	});		



	
	
/**********INPUT MASK*********/  
/**********INPUT MASK*********/

      $('#date').click(function(){$(this).mask("99/99/9999"); });    /******$("#date").mask("99/99/9999",{placeholder:" "} );***this is code you can use for place holder**/
	  
      $('#phone').click(function(){$(this).mask("(999) 999-9999"); });
	  
	  $('#phone-ext').click(function(){$(this).mask("(999) 999-9999? x99999"); });
	  
      $('#tin').click(function(){$(this).mask("99-9999999"); });
	  
      $('#ssn').click(function(){$(this).mask("999-99-9999"); });
	  
	  $('#product-key').click(function(){$(this).mask("a*-999-a999"); });
	  
	  $('#eye-script').click(function(){$(this).mask("~9.99 ~9.99 999"); });
	  
	  
	  $('#datepicker_1' ).hover(
		function(){
			$(this).datepicker({ altField: "#alternate",altFormat: "DD, d MM, yy" }) 
		}
	);	
	
	 $('#datepicker_2' ).datepicker({ 			
			altField: "#alternate2",
			altFormat: "DD, d MM, yy",
			dateFormat: "MM,DD,yy",
			showOtherMonths: true,
			selectOtherMonths: true,		
			dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
			}) ;

	
	/*oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});*/
				
	oTable = $('#example1').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});		

oTable = $('#example2').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});	
				
/*-------------------------				
/*--------------------------------------------------------
/ JQ CHART
/*-------------------------------------------------------*/
 jQuery(".plot a").live("click",function(e) {
	e.preventDefault();
		get_graph_data_line();
  });
  
   jQuery(".bar a").live("click",function(e) {
	e.preventDefault();
		get_graph_data_bar();
  });
  
   jQuery(".pie a").live("click",function(e) {
	e.preventDefault();
	get_graph_data_pie();
  });
  
 /*--------------------------------------------------------/
/ Progress bar
/*--------------------------------------------------------*/
if($("body.page-template-dashboard-php1").length > 0) {
$( "#progress_bar" ).progressbar({
			value: 0.0001
		}); 
$("#progress_bar .ui-progressbar-value").addClass("ui-corner-right");	

var counter2 = $("#counter");
var currentAmount2 = counter2.html();
var str = $(".goal-amount").html();
//var realnum1 = parseInt(num1);
var resultSub = 500 - currentAmount2;
var resultPercent = resultSub / 500;
var progress = resultPercent * 100;
var actual = 100 - progress;
new_width = actual+"%";  // you will need to calculate the necessary width yourself.

$("#progress_bar .ui-progressbar-value").animate({width: new_width}, 4000);
//*----------------------------------------------------------------------------------//
// SWITCH CHANGE ICON BASED ON POSITIVE OR NEGATIVE CHANGE
//*----------------------------------------------------------------------------------*//
var str = $("#goal-percent .change").html();
if (str.indexOf('-') == -1) {
    $('#goal-percent .change').removeClass("negative").addClass("positive");
}else {
	$('#goal-percent .change').removeClass("positive").addClass("negative");
}
}
  /*--------------------------------------------------------
/ animate number
/*-------------------------------------------------------*/
  
     $.fn.animateNumber = function(to) {
        var $ele = $(this),
            num = parseInt($ele.html()),
            up = to > num,
            num_interval = Math.abs(num - to) / 90;

        var loop = function() {
            num = up ? Math.ceil(num+num_interval) : Math.floor(num-num_interval);
            if ( (up && num > to) || (!up && num < to) ) {
                num = to;
                clearInterval(animation)
            }
            $ele.html(num);
        }

        var animation = setInterval(loop, 70);
}

var $counter = $("#counter");
var $percent = $("#percent");
var currentAmount = $counter.html();
$percent.animateNumber(actual);
$counter.animateNumber(currentAmount);

/*--------------------------------------------------------
/ jQuery scroll
/*-------------------------------------------------------*/
//$('.dashboard-content .shelf').jScrollPane();
 //$("#mcs_container").mCustomScrollbar("vertical",400,"easeOutCirc",1.05,"auto","yes","yes",10);

/*--------------------------------------------------------
/ settings form 
/*-------------------------------------------------------*/
/*	var name = $( "#name" ),
			email = $( "#email" ),
			password = $( "#password" ),
			allFields = $( [] ).add( name ).add( email ).add( password ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			resizable: false,
			dialogClass: 'fixed-dialog',
			show: {effect: "slide", duration: 600, direction: "down",distance: 200, easing: 'easeInOutSine', },
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$("#user-links .settings" )			
			.click(function(e) {
			e.preventDefault();
				$( "#dialog-form" ).tabs().dialog( "open" );
				$("#vert-tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
				$("#vert-tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
				
			});
	
		*/

	
// add code for activity feed post//
	$(".comment-submit-btn" ).click(function(e) {
		e.preventDefault();		
		var activitycomment = $("input[name='activitycomment']").val();
		var userid = $("#userid").val();
		$.ajax({
		type:'POST', 
		url: 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=activity_post&activityomment='+activitycomment+'&userid='+userid,		
		success: function(response) {
	     $("input[name='activitycomment']").val("");
	
    }});	
	});
	$(".ui-dialog-titlebar").hide();
	
	$(".ui-widget-overlay").live ("click",function() {
    $("#basic-modal-content-existing,#basic-modal-content").dialog( "destroy" );
});


/**********TABS MENU*********/  
/**********TABS MENU*********/
	
	  $(".tabs_links ul li:first").addClass("active").show(); //Activate first tab
	  $(".tab_content").hide(); //Hide all content
	  $(".tab_content:first").show(); //Show first tab content
	  //On Click Event
	  $(".tabs_links ul li").click(function() {
		  $(".tabs_links ul li").removeClass("active"); //Remove any "active" class
		  $(this).addClass("active"); //Add "active" class to selected tab
		  $(".tab_content").hide(); //Hide all tab content
		  var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		  $(activeTab).fadeIn(); //Fade in the active content
	  	  return false;
	  });
	  
	  /* $(".viewmore").click(function() {
		  $(".tabs_links ul li").removeClass("active"); //Remove any "active" class
		 var the_tab = $(this).attr("href");
		 $(".").find().addClass("active"); //Add "active" class to selected tab
		  $(".tab_content").hide(); //Hide all tab content
		  var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		  $(activeTab).fadeIn(); //Fade in the active content
	  	  return false;
	  });*/
	  
	  
	  
	  
	  /*Horizontal Tabs*/
	  
	  $(".horizontal-tabs ul li:first").addClass("active").show(); //Activate first tab
	  $(".horizontal-tab-content").hide(); //Hide all content
	  $(".horizontal-tab-content:first").show(); //Show first tab content
	  //On Click Event
	  $(".horizontal-tabs ul li").click(function() {
		  $(".horizontal-tabs ul li").removeClass("active"); //Remove any "active" class
		  $(this).addClass("active"); //Add "active" class to selected tab
		  $(".horizontal-tab-content").hide(); //Hide all tab content
		  var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		  $(activeTab).fadeIn(); //Fade in the active content
	  	  return false;
	  });
	  
	  
	  /*Vertical Tabs*/
	  
	  $(".vertical-tabs ul li:first").addClass("active").show(); //Activate first tab
	  $(".vertical-tab-content").hide(); //Hide all content
	  $(".vertical-tab-content:first").show(); //Show first tab content
	  //On Click Event
	  $(".vertical-tabs ul li").click(function() {
		  $(".vertical-tabs ul li").removeClass("active"); //Remove any "active" class
		  $(this).addClass("active"); //Add "active" class to selected tab
		  $(".vertical-tab-content").hide(); //Hide all tab content
		  var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		  $(activeTab).fadeIn(); //Fade in the active content
	  	  return false;
	  });


	  
	  //*--------------------------------------------------/
	  // CONFIRM PLUGIN BELOW
	  //*--------------------------------------------------*/
	  $.confirm = function(params){
		
		if($('#confirmOverlay').length){
			// A confirm is already shown on the page:
			return false;
		}
		
		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){
			
			// Generating the markup for the buttons:
			
			buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'<span></span></a>';
			
			if(!obj.action){
				obj.action = function(){};
			}
		});
		
		var markup = [
			'<div id="confirmOverlay">',
			'<div id="confirmBox">',
			'<h1>',params.title,'</h1>',
			'<p>',params.message,'</p>',
			'<div id="confirmButtons">',
			buttonHTML,
			'</div></div></div>'
		].join('');
		
		$(markup).hide().appendTo('body').fadeIn();
		
		var buttons = $('#confirmBox .button'),
			i = 0;

		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){
				
				// Calling the action attribute when a
				// click occurs, and hiding the confirm.
				
				obj.action();
				$.confirm.hide();
				return false;
			});
		});
	}

	$.confirm.hide = function(){
		$('#confirmOverlay').fadeOut(function(){
			$(this).remove();
		});
	}
	//*--------------------------------------------------/
	// Handle project submission
	//*--------------------------------------------------*/
	  // add code for activity feed post//
	$("#project .new_project > a" ).click(function(e) {
		e.preventDefault();				
		//var confirm = '<div id="dialog-confirm" title="End Active Project?">	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Creating a new project will end any other active projects. Do you want to continue?</p></div>';	
		//$("body").append(confirm);
		/*$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Create new project": function() {
					$.ajax({
						type:'POST', 
						url: 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=create_new_cause',		
						success: function(response) {
						 alert("Your new cause has been created!");
						 $( "#dialog-confirm" ).dialog( "close" );
						 $(".project-items-div").hide();
							$("#wizard").fadeIn();
						 console.log(response);
						},
						complete: function() {	
							
						}
						
						});
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});	*/
		$.confirm({
			'title'		: 'Create a new cause',
			'message'	: 'Creating a new project will end any other active projects. Do you want to continue?',
			'buttons'	: {
				'Yes'	: {
					'class'	: 'blue',
					'action': function(){
							$.ajax({
								type:'POST', 
								url: 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=create_new_cause',		
								success: function(response) {															
								 $(".project-items-div").hide();
									$("#wizard").fadeIn('fast',function(){
										var buildreturn = $("<input type='hidden' value="+response+" name='cause-project-id' id='cause-project-id'>");
										$("#wizard").append(buildreturn);
									});
								 console.log(response);
								},
								complete: function() {	
									$("#wizard.swMain .actionBar a:visible").eq(0).css("margin-right","242px");
								}
								
								});
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		
			
	});
	
	 //*--------------------------------------------------/
	  // Handle donation submission
	  //*--------------------------------------------------*/
	  // add code for activity feed post//
	$("#send_donation" ).click(function(e) {
		e.preventDefault();		
		var title = $("#name").val();		
		var email = $("#email").val();
		var phone = $("#phone").val();
		var amount = $("#donation_amount").val();
		var comment = $("#cause_comment").val();
		var post_id = $("#cause_id").val();
		var author_id = $("#author_id").val();
		var author_email = $("#author_email").val();
		var author_name = $("#author_name").val();
		
		$.ajax({
		type:'POST', 
		url: 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=send_donation&postid='+post_id+'&name='+title+"&email="+email+"&phone="+phone+"&amount="+amount+"&comment="+comment+"&author_id="+author_id+"&author_name="+author_name+"&author_email="+author_email,		
		success: function(response) {
	    // alert(title+" has been created!");
		 log.console(response);
		}});	
	});
/*-----------------------------------------------------------*/
/*			Google places for input field     				*/
/*-----------------------------------------------------------*/	
function google_places_input() {	
	var input = document.getElementById('cause-location');
	var options = {
	types: ['(cities)'],
	componentRestrictions: {country: 'us'}
	};

autocomplete = new google.maps.places.Autocomplete(input, options);
}
if($("body.page-template-dashboard-php").length > 0) {
google_places_input();
}
/*-----------------------------------------------------------*/
/*				jQuery tooltip for slider					*/
/*-----------------------------------------------------------*/

var $slideMe = $("<div></div>")
					.addClass("slideTip")
                    .css({ position : 'absolute' , top : 10, left : 0 })
                    .text("$0")
                    .hide()
	
	//*--------------------------------------------------------------
	// Handle slider on project tab
	//*--------------------------------------------------------------*/
	$( "#slider-range" ).slider({
			range: "min",
			orientation: "horizontal",			
			max: 10000,
			value: 124,
			 animate: true,
			slide: function( event, ui ) {
				$( "#project_goal > input" ).val( "$" + ui.value );
				$(".slideTip").text( "$" + ui.value );
			},
			change: function(event, ui) {
				$(".slideTip").addClass("valueChanged");
			}
		})
		.find(".ui-slider-handle")
                .append($slideMe)
                .hover(function()
                        { $slideMe.show()}, 
                       function()
                        { $slideMe.hide()}
                );
		$( "#project_goal > input" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) );
			
//*--------------------------------------------------------------
// Handle  new media gallery
//*--------------------------------------------------------------*/
	$(".newmedia" ).click(function(e) {
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');
	var title = '';
	   
	$('#file-form').ajaxForm({
		url: 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=new_media&title=mark test gallery',
		beforeSend: function() {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
			
		},
		beforeSubmit: function() {
			title = $("#file-form #galleryname").val();	
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		complete: function(xhr) {
		console.log(xhr);
		$("#basic-modal-content").dialog( "destroy" ); 
		}
}); 

	});
	
	//*--------------------------------------------------------------
// Handle  existing media gallery
//*--------------------------------------------------------------*/
	$(".existing" ).click(function(e) {
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');
	var postid = $("#galleryselect").val();
	   
	$('#file-form-existing').ajaxForm({
		url: 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=existing_media&post_id='+postid,
		beforeSend: function() {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		complete: function(xhr) {
		console.log(xhr);
		$("#basic-modal-content-existing").dialog( "destroy" ); 
		}
}); 

	});
//*--------------------------------------------------------------
// Handle  existing media gallery shuffle
//*--------------------------------------------------------------*/
$(".album-grid a").on("click",function(e) {
	e.preventDefault();
	$(".album-grid").not(".primary").css("z-index", "10");
	$(".album-grid").removeClass("activeimg");
	$(this).parent().css("z-index","99999").addClass("activeimg");
});

//*--------------------------------------------------------------
// Handle  getting chart data
//*--------------------------------------------------------------*/
function get_graph_data() {

	var url = 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=get_donations_week';
 $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: 'json',
        success: function (msg) {
		//alert(msg);
        var data = msg;
        initChart(data);
                }
		});
		
		function initChart(data) {
                $('#jqChart1').jqChart({
                    title: { text: 'Data from Ajax call' },
                    border: {
                    cornerRadius: 20,
                    lineWidth: 4,
                    strokeStyle: 'transparent'
                },
				 axes: [
                        {
                           type: 'dateTime',
                             location: 'bottom',
                             minimum: new Date(2012, 7, 1),
                             maximum: new Date(2012, 7, 12),
                             interval: 2,
                             intervalType: 'days'
                        }
                      ],
                    background: 'transparent',
                    series: [
                                {
                                    title: 'Series',
                                    type: 'splineArea',
                                    data: data,
									labels: { stringFormat: '$ %d ', font: '12px lato' }
                                }
                            ]
                });
            }			
			
			
  }
  
  function get_graph_data_line() {
$('#jqChart1').jqChart('update');
	var url = 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=get_donations_week';
 $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: 'json',
        success: function (msg) {
		//alert(msg);
        var data = msg;
        initChart(data);
                }
		});
		
		function initChart(data) {
                $('#jqChart').jqChart({
                    title: { text: 'Data from Ajax call' },
                    border: {
                    cornerRadius: 20,
                    lineWidth: 4,
                    strokeStyle: 'transparent'
                },
				 axes: [
                        {
                           type: 'dateTime',
                             location: 'bottom',
                             minimum: new Date(2012, 7, 1),
                             maximum: new Date(2012, 7, 12),
                             interval: 1,
                             intervalType: 'days'
                        }
                      ],
                    background: 'transparent',
                    series: [
                                {
                                    title: 'Donations',
                                    type: 'plot',
                                    data: data,
									labels: { stringFormat: '$ %d ', font: '12px lato' }
                                }
                            ]
                });
            }			
			
			
  }
  
   function get_graph_data_pie() {
	$('#jqChart1').jqChart('update');
	var url = 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=get_donations_week';
 $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: 'json',
        success: function (msg) {
		//alert(msg);
        var data = msg;
        initChart(data);
                }
		});
		
		function initChart(data) {
                $('#jqChart').jqChart({
                    title: { text: 'Data from Ajax call' },
                    border: {
                    cornerRadius: 20,
                    lineWidth: 4,
                    strokeStyle: 'transparent'
                },
				 axes: [
                        {
                           type: 'dateTime',
                             location: 'bottom',
                             minimum: new Date(2012, 7, 1),
                             maximum: new Date(2012, 7, 12),
                             interval: 1,
                             intervalType: 'days'
                        }
                      ],
                    background: 'transparent',
                    series: [
                                {
                                    title: 'Donations',
                                    type: 'pie',
                                    data: data,
									labels: { stringFormat: '$ %d ', font: '12px lato' }
                                }
                            ]
                });
            }			
			
			
  }
  
   function get_graph_data_bar() {

	var url = 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=get_donations_week';
 $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: 'json',
        success: function (msg) {
		//alert(msg);
        var data = msg;
        initChartbar(data);
                }
		});
		
		function initChartbar(data) {
                $('#jqChart1').jqChart({
                    title: { text: 'Data from Ajax call' },
                    border: {
                    cornerRadius: 20,
                    lineWidth: 4,
                    strokeStyle: 'transparent'
                },
				 axes: [
                        {
                           type: 'dateTime',
                             location: 'bottom',
                             minimum: new Date(2012, 7, 1),
                             maximum: new Date(2012, 7, 12),
                             interval: 1,
                             intervalType: 'days'
                        }
                      ],
                    background: 'transparent',
                    series: [
                                {
                                    title: 'Donations',
                                    type: 'bar',
                                    data: data,
									labels: { stringFormat: '$ %d ', font: '12px lato' }
                                }
                            ]
                });
            }			
			
			
  }
//get_graph_data();  

//*----------------------------------------------------------------//
// 			HANDLE THE IMAGE GALLERY ON THE DASHBOARD             //
//---------------------------------------------------------------*//
 var z = 0; //for setting the initial z-index's
  var inAnimation = false; //flag for testing if we are in a animation
  $('#pictures img').each(function() { //set the initial z-index's
    z++; //at the end we have the highest z-index value stored in the z variable
    $(this).css('z-index', z); //apply increased z-index to <img>
  });
  function swapFirstLast(isFirst) {
    if(inAnimation) return false; //if already swapping pictures just return
    else inAnimation = true; //set the flag that we process a image
    var processZindex, direction, newZindex, inDeCrease; //change for previous or next image
    if(isFirst) { processZindex = z; direction = '-'; newZindex = 1; inDeCrease = 1; } //set variables for "next" action
    else { processZindex = 1; direction = ''; newZindex = z; inDeCrease = -1; } //set variables for "previous" action
    $('#pictures img').each(function() { //process each image
      if($(this).css('z-index') == processZindex) { //if its the image we need to process
        $(this).animate({ 'top' : direction + $(this).height() + 'px' }, 'slow', function() { //animate the img above/under the gallery (assuming all pictures are equal height)
          $(this).css('z-index', newZindex) //set new z-index
            .animate({ 'top' : '0' }, 'slow', function() { //animate the image back to its original position
              inAnimation = false; //reset the flag
            });
        });
      } else { //not the image we need to process, only in/de-crease z-index
        $(this).animate({ 'top' : '0' }, 'slow', function() { //make sure to wait swapping the z-index when image is above/under the gallery
          $(this).css('z-index', parseInt($(this).css('z-index')) + inDeCrease); //in/de-crease the z-index by one
        });
      }
    });
    return false; //don't follow the clicked link
  }
  $('#next a').click(function() {
    return swapFirstLast(true); //swap first image to last position
  });
  $('#prev a').click(function() {
    return swapFirstLast(false); //swap last image to first position
  });
  
 //handle switching to the tabs via links//
$("a.viewmore").live("click",function(e){
	e.preventDefault();
	// var $tabs = $('.tabs_links').tabs();	 
  $(".tabs_links").tabs('select', 4) // switch to last tab
  return false;
}); 

/*--------------------------------------------------------
/		SMART WIZARD
/*-------------------------------------------------------*/

function onFinishCallback(){
       if(validateAllSteps()){
	   var cause_title = $("#projectform #cause-title").val();
	   var cause_featured_text = $("#projectform #textarea").val();
	   var cause_category = $("#projectform #cause-category").val();
	   var cause_location = $("#projectform #cause-location").val();
	   var causeID = $("#cause-project-id").val();
	   var cause_goal = $("input[name='project-goal-amount']").val();	  
	   if($("#projectform #datepicker_2").prop('checked')){
		var cause_duration = $("#projectform  #datepicker_2").val();
		}else{
		var cause_duration = $("#projectform  #funding-duration").val();
		}
		 var str = $("#projectform").serialize();
         var url = 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=update_cause';	   
	     var url_campaign = 'http://avidwerx.com/charity/wp-admin/admin-ajax.php?action=admin_request_handler_new&ak_action=donationmanager_update_campaign&donationmanager_title='+cause_title+'&donationmanager_description='+cause_featured_text+'&donationmanager_top_limit='+cause_goal+'&donationmanager_currency=USD&postid='+causeID;
		 
			 $.ajax({
					type: "POST",
					url: url,
					data: str,
					beforeSend: function() {console.log(url);console.log(str);},	
					success: function (msg) {
					console.log(msg);
					 //window.location.reload(true);
				   },	
					complete: function() {
						 $.ajax({
							type: "POST",
							url: url_campaign,							
							beforeSend: function() {console.log(url_campaign);},	
							success: function (response) {console.log(response);}
							});
					}
			});	   
      }
}
function leaveAStepCallback(obj){
        var step_num= obj.attr('rel'); // get the current step number		
        return validateSteps(step_num); // return false to stay on step and true to continue navigation 
      }
	  
// Your Step validation logic
function validateSteps(stepnumber){
        var isStepValid = true;
        // validate step 1
        if(stepnumber == 1){
         if($("#projectform #cause-title").val() == ''){
			$("#projectform #cause-title").addClass('Invalid_Field');
			$("#projectform #cause-title").parent().append("<span class='errorspan'>Please add a title for your cause.</span>");
			isStepValid = false;
		 }else {
		  isStepValid = true;
		 }
		  if($("#projectform #textarea").val() == ''){
			$("#projectform #textarea").addClass('Invalid_Field');
			$("#projectform #textarea").parent().append("<span class='errorspan'>Please add a description for your cause.</span>");
			isStepValid = false;
		 }
		 else {
		  isStepValid = true;
		 }
		  if($("#projectform #cause-category").val() == ''){
			$("#projectform #cause-category").addClass('Invalid_Field');
			$("#projectform #cause-category").parent().parent().append("<span class='errorspan' style='margin-top:-38px;'>Please choose a category for your cause.</span>");
			isStepValid = false;
		 }
		 else {
		  isStepValid = true;
		 }
		  if($("#projectform #cause-location").val() == '') {
			$("#projectform #cause-location").addClass('Invalid_Field');
			$("#projectform #cause-location").parent().append("<span class='errorspan' >Please add a location for your cause.</span>");
			isStepValid = false;
		 }
		 else {
		   isStepValid = true;
		  }		 
		  /* if($("#projectform #slider-range .valueChanged").text() == '$0') {
			$("#projectform #slider-range .valueChanged").addClass('Invalid_Field');
			$("#projectform #slider-range .valueChanged").parent().append("<span class='errorspan'>Please set a goal for your cause.</span>");
			isStepValid = false;
		 }	*/
			 if($(".Invalid_Field").length > 0) {
			 $('html, body').animate({
			scrollTop: $(".Invalid_Field:eq(0)").offset().top
			}, 1200);
			}
		}
		if(stepnumber == 4){
			$(".buttonSkip").css("display","none");
			$(".buttonNext").css("margin-right","0px");
			$(".buttonFinish").css("display","inline-block");
		}
		
       return isStepValid;
      }
function validateAllSteps(){
        var isStepValid = true;
		if (validateSteps(1)){
        if($("#wizard .Invalid_Field").length > 0 )  {
			isStepValid = false;
		}else {
			isStepValid = true;
		}
        return isStepValid;
		}
      } 	  
/*function leavestepCallback(stepnumber) {
	if(stepnumber != 1){
		$(".actionBar").append("<a href='#' class='buttonSkip'>Skip</a>");
		//$('#wizard').smartWizard("doForwardProgress");
	}
}*/
	$('#wizard').smartWizard(
 {
  // Properties
    selected: 0,  // Selected Step, 0 = first step   
    keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
    enableAllSteps: false,  // Enable/Disable all steps on first load
    transitionEffect: 'slideleft', // Effect on navigation, none/fade/slide/slideleft
    contentURL:null, // specifying content url enables ajax content loading
    contentCache:true, // cache step contents, if false content is fetched always from ajax url
    cycleSteps: false, // cycle step navigation
    enableFinishButton: true, // makes finish button enabled always
    errorSteps:[],    // array of step numbers to highlighting as error steps
    labelNext:'Next', // label for Next button
    labelPrevious:'Previous', // label for Previous button
    labelFinish:'Finish',  // label for Finish button        
  // Events
    onLeaveStep: leaveAStepCallback, // triggers when leaving a step
    onShowStep: null,  // triggers when showing a step
    onFinish: onFinishCallback  // triggers when Finish button is clicked
 }
); 



$(".buttonDisabled").live("click",function(e) {
	e.preventDefault();
	$("#wizard").hide();
	$(".project-items-div").fadeIn();
	alert('clicked');
	
	
});	

/*--------------------------------------------------------
/ GAUGE CODE
/*-------------------------------------------------------*/

 /*$('#gaugeContainer').jqxGauge({
                ranges: [{ startValue: 0, endValue: 55, style: { fill: '#4bb648', stroke: '#4bb648' }, endWidth: 5, startWidth: 1 },
                         { startValue: 55, endValue: 110, style: { fill: '#fbd109', stroke: '#fbd109' }, endWidth: 10, startWidth: 5 },
                         { startValue: 110, endValue: 165, style: { fill: '#ff8000', stroke: '#ff8000' }, endWidth: 13, startWidth: 10 },
                         { startValue: 165, endValue: 220, style: { fill: '#e02629', stroke: '#e02629' }, endWidth: 16, startWidth: 13 }],
                ticksMinor: { interval: 5, size: '5%' },
                ticksMajor: { interval: 10, size: '9%' },
                value: 0,
                colorScheme: 'scheme02',
                animationDuration: 1200,
				width: 200
            });
            $('#gaugeContainer').bind('valueChanging', function (e) {
                $('#gaugeValue').text(Math.round(e.args.value) + ' kph');
            });
            $('#gaugeContainer').jqxGauge('value', 140);*/
           
		   
/*--------------------------------------------------------
/	SOCIAL STREAM
/*--------------------------------------------------------*/
if($("body.page-template-dashboard-php").length > 0) {
 $('#result').dpSocialFeedr({
                twitter: 'cnn',
                //youtube: 'cnn',
				facebook_page: '5550296508',
				delicious: '',
				flickr: '52617155@N08',
				tumblr: '',
				dribbble: '',
				digg: '',
				pinterest: '',
				vimeo: '',
                displayStyle: 'list',
                showIcons: true,
				addColorbox: false,
				displayStyle: 'list',
                total: 6            });	
		}		
/*-------------------------------------------------
/	New google chart data
/*-------------------------------------------------*/

 function init_donations_chart() { 	
 var flash = [[0, 2], [1, 6], [2,3], [3, 8], [4, 5], [5, 13], [6, 8]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
 
var plot = jQuery.plot(jQuery("#graph"),
			   [ { data: flash, label: "Flash(x)", color: "#25c913"}, { data: html5, label: "HTML5(x)", color: "#00aeff"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { show: false},
				   grid: { hoverable: true, clickable: true, borderColor: 'none', borderWidth: 1, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#graph").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					/*showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);*/
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#graph").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});
	}
	init_donations_chart();
	
	/*----------------------------------------------------------/
	/*				guague rotation script						*/
	/*----------------------------------------------------------*/
	if($("body.page-template-dashboard-php").length > 0) {
	function rotate_gauge(){
		var gauge = $(".pointer");
		var s = $("#activecause").val();
		var n = parseFloat(77) - s;
		var Fillwidth = s * 10;
		var FillwidthA = 90 - Fillwidth;
		  if(s > 77)
        {
          s = 77;
        }
		    gauge.transition({rotate: ''+'-'+s+'deg',delay: 3400},'2000','ease');	
			$("#gaugeContainer .fullguage").delay(4130).animate({ width: ''+FillwidthA+'%' }, { duration: 1900 });	
				
	}	
	rotate_gauge();
	
	}
	/*----------------------------------------------------------/
	/*				countdown script						*/
	/*----------------------------------------------------------*/
		$("#countdown").countdown({
				date: "17 october 2012 12:00:00",
				format: "on"
			/*},
			
			function() {
				// callback function*/
			});
			
/*--------------------------------------------------------
/ clone form fields 
/*--------------------------------------------------------*/
if($("body.page-template-dashboard-php").length > 0) {
$('.reward_add').live('click',function(ev) {
	ev.preventDefault();
    var aim = $(this);
    var ap = aim.parent().parent().parent();
    var newbk = ap.clone(true);
    var apindex = $('[class^=block-]').index(ap);
	var apcount = $('[class^=reward-count-]').index(ap);
    var bkId = 'block-' + (apindex + 1);
	var rewardcount = 'reward-count-' + (apindex + 1);
	//var apcounttext = apcount.text();
	console.log(newbk);
    newbk.addClass('block-' + (apindex + 2)).removeClass(bkId);
	newbk.find("[class^=reward-count-]").addClass('reward-count-' + (apindex + 2)).removeClass(rewardcount);
	newbk.find("[class^=reward-count-]").text("Reward #"+ (apindex + 2) );
	newbk.find(':input').each(function() {
		this.name = this.name.replace(/\[(\d+)\]/, function(str,p1){
                return '[' + (parseInt(p1,10)+1) + ']';
	});
	});
    ap.after(newbk);
});
$('.delete-reward').live('click',function(e){
	e.preventDefault();
    $(this).parent().parent().parent().remove();
});
}

//===== Multiple select with dropdown =====//
	
	$(".chzn-select").chosen(); 
	
	//===== Autocomplete =====//
	
	var availableTags = [ "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme" ];
	$( "#ac" ).autocomplete({
	source: availableTags
	});	
	
		//===== Form elements styling =====//
	
	//$("select, input:checkbox, input:radio, input:file").uniform();
	
/*--------------------------------------------------------------------*/
/* HANDLE USER PASSWORD CHANGE
/*---------------------------------------------------------------------*/

 function update_user_pass(){
 $(".ui-dialog-buttonset .ui-button:eq(0)").live("click", function(e) {
				e.preventDefault();
			var password = $("#passwordchange").val();
			var password_again = $("#passwordagain").val();
			var userid = $("#pass_user_id").val();
			var url = ajaxurl+"?action=update_user_pass&password="+password+"&userid="+userid;
			$.ajax({
					type:'POST', 
					url: url,	
					beforeSend: function() {console.log(url);
						if(password != password_again) {
						$("#passwordagain").css("border-color", "red");
						$("#passwordagain").parent().prepend("<label style='color:red; font-size:12px;display:block;'>Passwords do not match.</label>");
						return false;
						}
					},
					success: function(response) {console.log(response); },
					complete: function() {/*$("#passwordForm").colorbox.close("Password updated!");*/
						  $("#dialog-message").dialog('close');
					}
		});	

	});
	}
	//jQuery('.passchange').colorbox({inline:true, innerWidth: '475px', innerHeight: '197px',onComplete: function(){ 
	
 //}});
  update_user_pass();
  
  
  //===== UI dialog =====//
  
  $( "#dialog-message" ).dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Ok: function() {
				//$( this ).dialog( "close" );
				
			},
			
			Cancel: function() {
				$(this).dialog("close");
			}
			
		},
		open: function(event) {
			 $('.ui-dialog-buttonpane').find('button:contains("ok")').addClass('changepass');
		 }
	});
  
  $( ".passchange" ).live("click",function() {
		$( "#dialog-message" ).dialog( "open" );
		return false;
	});	
	//=================================================//
	//			fb login click scripts				  //
	//================================================//
	
	//=============fb auth function==================//
	function authFacebook() {
	FB.login(function(response) {
		if (response.authResponse) {
			//redirectWithParam('fb_extended_token', 1);
			var url = ajaxurl+"?action=fb_connect_member";
		 $.ajax({
					type: "POST",
					url: url,
					data: str,
					beforeSend: function() {console.log(url);},	
					success: function (msg) {
					console.log(msg);
				}
				});	
		} else {
			console.log('User cancelled login or did not fully authorize.');
		}
	}, {scope: 'manage_pages, publish_actions, publish_stream'});
	}
	//=============fb logout function==================//
	function logoutFacebook() {
		
		    
			  $( "#fb-logout-message" ).dialog({
					autoOpen: true,
					modal: true,
					buttons: {
						Logout: function() {
							//$( this ).dialog( "close" );
							var url = ajaxurl+"?action=fb_disconnect_member";
							 $.ajax({
										type: "POST",
										url: url,
										data: str,
										beforeSend: function() {console.log(url);},	
										success: function (msg) {
										console.log(msg);
										},
										complete: function() { $("#fb-logout-message").dialog("close");  window.setTimeout('location.reload()', 2000); }
									});	
							
						},
						
						Cancel: function() {
							$(this).dialog("close");
						}
						
					}
				});
			
			
	
	}
	
	
	
	//============fb handlle click event on account page *login* =====================//
	$( ".facebooklogin").live("click",function() {
		authFacebook();
		
	});
	
	//============fb handlle click event on account page *logout* =====================//
	$( ".facebooklogout").live("click",function(e) {
		e.preventDefault();
		logoutFacebook();
		
	});
	
	//============twitter handlle click event on account page *login* =====================//
	$( ".twitterlogin").live("click",function() {
		var url = $(".hidden-url").val();
		window.open(url, 'Twitter authentication', 'menubar=no,width=760,height=360,toolbar=no');
				
		
	});
	
});
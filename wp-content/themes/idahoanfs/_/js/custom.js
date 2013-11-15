// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){

	//call Superfish
    $('ul.sf-menu').superfish();

	//display Search
	$('a.revealButton').live('click', showSearch);
	//hide search
	$('a.hideButton').live('click', hideSearch);


	$('#slideHolder').cycle({ 
    	pager:  '#slider-nav' 
	});

	$('#rotator_play_pause').toggle(function() {
	    $('#slideHolder').cycle('pause');
	    $(this).html('>');
	}, function(){
		$('#slideHolder').cycle('resume');
	    $(this).html('||');
	});

	//starts rotator in heroSlider.js
	//init_rotator();

	//force placeholder text
	form_field_text();
	
	if($('.homeVideo').length) {
		//colorbox for home page video
		$('.homeVideo').colorbox({iframe:true, innerWidth:560, innerHeight:349});
	}
	
	//stripe the compare chart
	$('#compareChart tr:even td').addClass('oddStripe');

	//Broker Contact Form Display
	$('.mailContactForm').hide();
	$('.envelope').live('click', brokerContactForm);
	
	//print for nutrition chart
	$('#print_button').click(function(){
window.print();
//		$('.PrintArea').printArea({mode: "popup", popClose: true});
	});
	
	//print for product pages
	$('#print_contents').click(function(){ 
//		$('#pageContents').printArea({mode: "popup", popClose:true});
window.print();
	});
	
	if ($('#faqList').length) {
		$('#faqList p').hide();
		$('#faqList a.question').live('click', function() {
			$('#faqList p.shown').removeClass('shown').slideToggle();
			$(this).next('p').addClass('shown').slideToggle();
			return false;
		}); // end listenter
	}// end if
	
	$('#newsletter_form').submit(function() {
		if ($('#certify:checked').val() == '1') {
			$("#newsletter_form").attr("action", "http://cl.exct.net/subscribe.aspx?lid=3548829");
			$("#newsletter_form").submit();
			return true;
		}
		$('<div class="error">You must be 18 years or older to submit this form.</div>').appendTo('#signupBox');
		return false;
	});

//	if($('#emailContent').length) { 
		
		$('#email_button').bind('click', function() { 
			$('#emailOverlay').show();
			return false;
		});
		
		$('.emailClose').bind('click', function() {
			$('#emailOverlay').hide();
			return false;
		});
//	}

});

/* Author: RIESTER

*/

function showSearch() { 
	$('.revealButton').fadeOut();
	$('#productSearchFull').stop(true, true).animate(
		{top: '0px'},
		500, 
		function() {
			$('.revealButton').attr('class','hideButton').fadeIn(); 
		}
	);
	return false;
} //showSearch

function hideSearch() { 
	$('.hideButton').fadeOut('slow');
	$('#productSearchFull').stop(true, true).animate(
		{top: '-160px'}, 
		500, 
		function() {
			$('.hideButton').attr('class','revealButton').fadeIn('fast'); 
		}
	);
	return false;
} //hideSearch

function brokerContactForm() { 
	$(this).siblings('.mailContactForm').slideToggle();
} //brokerContactForm
	
function form_field_text() {
	$('input[type="text"]').each(function(){
	  var defaultVal = $(this).attr('placeholder');
	  $(this).focus(function(){
	    if ($(this).val() == defaultVal){
	      $(this).removeClass('active').val('');
	    }
	  })
	  .blur(function(){
	    if ($(this).val() === ''){
	      $(this).addClass('active').val(defaultVal);
	    }
	  })
	  .blur().addClass('active');
	});
	$('form').submit(function(){
	  $('.default').each(function(){
	    var defaultVal = $(this).attr('title');
	    if ($(this).val() == defaultVal){
	      $(this).val('');
	    }
	  });
	});

} //end form_field_text
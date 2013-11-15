// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){
	
	
	$('.validate_contact').submit(function(event){
		
		if ($('input#first_name', this).val() == '') {
			alert('Please enter your first name');
			$('input#first_name', this).focus();
			return false;
		}

		if ($('input#last_name', this).val() == '') {
			alert('Please enter your last name');
			$('input#last_name', this).focus();
			return false;
		}

		if ($('input#name', this).val() == '') {
			alert('Please enter your name');
			$('input#name', this).focus();
			return false;
		}

		if ($('input#email', this).val() == '') {
			alert('Please enter your email');
			$('input#email', this).focus();
			return false;
		}

		var apos = $('input#email', this).val().indexOf('@');
		var dotpos = $('input#email', this).val().lastIndexOf('.');

		if ( apos < 1 || dotpos-apos < 2 ) {
			alert('Please enter a valid email');
			$('input#email', this).focus();
			return false;
		}

		if(!$('#certify', this).is(':checked')) {
			alert('Please certify that you are at least 18 years old');
			$('input#certify', this).focus();
			return false;
		}

	});

});


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
// Transition speed. 
	var speed = 200,
	// Pause setting. 
	pause = false,
	// Slide Speed
	slideTime = 10000,
	// find the slide in the photoRotate element
	slides = $('#photoRotate').find('li'),
	totalSlides = slides.length,
	// find the text in the textRotate element
	slideText = $('#textRotate').find('li'),
	// start at the beginning
	index = 0,
	p1 = 2;


// Rotator function.
function rotate() {

	// Stop, if user has interacted. 
	if (pause) {
		return;
	}

	if(index === totalSlides) {
		index = 0;
	}

	//transition to the next slide
	//move the current style to next box in controls
	$('#rotator_controls li').find('a').removeClass('current').eq(index).addClass('current');

//	slideText.eq(index).fadeIn(speed).delay(slideTime).fadeOut(speed);
//	slides.eq(index++).fadeIn(speed).delay(slideTime).fadeOut(speed, rotate);

	//set the slides and text
	slideText.eq(index).fadeIn(speed);
	slides.eq(index).fadeIn(speed);

	//check to see if the user has paused
	function pauseCheck() {
		if (pause) {
			return;
		} else {
			//fadeout current slide, 1up index and start over
			slideText.eq(index).fadeOut(speed);
			slides.eq(index++).fadeOut(speed, rotate);
		}
	}
	//check to see if the user has interacted while the slide was shown
	setTimeout(pauseCheck,slideTime);

}

// Initialize. 
function init_rotator() {

	// Does element exist? 
	if (!$('#photoRotate').length) {
		// If not, exit. 
		return;
	}

	// Hide all but first photo and set of text
	$('#photoRotate li:first, #textRotate li:first').siblings('li').hide();

	rotate();

}  //end init_rotator
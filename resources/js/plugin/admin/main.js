// ______________ PAGE LOADING
export const Loader = () => {
	$(window).on("load", function(e) {
		$("#global-loader").fadeOut("slow");
	})
}

// ______________Full screen
export const FullScreen = () => {
    $(document).on("click", ".fullscreen-button", function toggleFullScreen() {
        if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    });
}

// ______________ BACK TO TOP BUTTON
export const BackToTop = () => {
	$(window).on("scroll", function(e) {
		if ($(this).scrollTop() > 0) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	$(document).on("click", "#back-to-top", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
}

export const ActivateSidebarScroll = () => {
    const ps = new PerfectScrollbar('.app-sidebar', {
        useBothWheelAxes:true,
        suppressScrollX:true,
    });
    const ps1 = new PerfectScrollbar('.sidebar-right', {
        useBothWheelAxes:true,
        suppressScrollX:true,
    });
}

export const SideMenu = () => {
    var slideMenu = $('.side-menu');

	// Toggle Sidebar
	$(document).on('click','[data-toggle="sidebar"]',function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});
	
	$(".app-sidebar").hover(function() {
		if ($('body').hasClass('sidenav-toggled')) {
			$('body').addClass('sidenav-toggled-open');
		}
	}, function() {
		if ($('body').hasClass('sidenav-toggled')) {
			$('body').removeClass('sidenav-toggled-open');
		}
	});


	// Activate sidebar slide toggle
	$("[data-toggle='slide']").on('click',function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			slideMenu.find("[data-toggle='slide']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='slide.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();
	
	
	// ______________Active Class
	$(".app-sidebar li a").each(function() {
	  var pageUrl = window.location.href.split(/[?#]/)[0];
		if (this.href == pageUrl) { 
			$(this).addClass("active");
			$(this).parent().addClass("active"); // add active to li of the current link
			$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
			$(this).parent().parent().parent().parent().parent().addClass("active"); 
			$(this).parent().parent().prev().click(); // click the item to make it drop
		}
	});
}
(function($) {
	$(document).ready(function() {
		var md = new MobileDetect(window.navigator.userAgent);
		if(md.mobile()){
			$('body').removeClass('devvn_desktop').addClass('devvn_mobile');
		}else{
			$('body').removeClass('devvn_mobile').addClass('devvn_desktop');
		}
	})
})(jQuery)
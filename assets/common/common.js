var error_toast = function (title, messages) {
	toast(title, messages, 'error');
};
var warning_toast = function (title, messages) {
	toast(title, messages, 'warning');
};
var info_toast = function (title, messages) {
	toast(title, messages, 'info');
};

var success_toast = function (title, messages) {
	toast(title, messages, 'success');
};

var toast = function (title, messages, status) {
	/*
		positionClass : toast-top-right, toast-bottom-right, 
			toast-bottom-left, toast-top-left, toast-top-full-width, 
			toast-bottom-full-width,toast-top-center, toast-bottom-center
		showMethod : fadeIn, slideDown
		slideUp : fadeOut, slideUp
	*/
	
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-bottom-center",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	toastr[status](messages, title);
}
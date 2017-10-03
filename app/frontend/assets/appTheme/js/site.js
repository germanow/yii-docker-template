;(function($) {
    $(function() {
        var selector = '.nav li';

        $(selector).on('click', function() {
            $(selector).removeClass('active');
            $(this).addClass('active');
        });
    });

	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate

	if($(".help-block-error").height() == 0){
		
	}
	$(".next").click(function(){
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		//show hte next fieldsets
		next_fs.show(); 
		//hide the current fielset with style
		current_fs.hide();
	});

	$(".previous").click(function(){
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();

		//deactivate next step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass('active');
		//show hte next fieldsets
		previous_fs.show(); 
		//hide the current fielset with style
		current_fs.hide();
	});
})(jQuery);
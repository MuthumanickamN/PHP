$(document).ready(function() {
    $('.datePicker')
        .datepicker({
            format: 'dd/mm/yyyy'
        })
});

$(document).ready(function () {

            $("#addButton").click(function () {
                if( ($('.form-horizontal .control-group').length+1) > 15) {
                    alert("Only 2 control-group allowed");
                    return false;
                }
                var id = ($('.form-horizontal .control-group').length + 1).toString();
                $('.form-horizontal').append('<div class="control-group" id="control-group' + id + '"><label class="control-label" for="inputEmail' + id + '">Option ' + id + '</label><div class="controls' + id + '"><textarea type="text" class="form-control" rows="3"></textarea></div></div>');
            });

            $("#removeButton").click(function () {
                if ($('.form-horizontal .control-group').length == 1) {
                    alert("No more textbox to remove");
                    return false;
                }

                $(".form-horizontal .control-group:last").remove();
            });
        });
		
		

!function ($) {
    $(document).on("click","ul.nav li.parent > a ", function(){          
        $(this).find('em').toggleClass("fa-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
	$(window).on('resize', function () {
  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
	}
})


 
 
 <!-- /.content -->
<div class="clearfix"></div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
<strong>Copyrights &copy; <script type="text/javascript">document.write((new Date()).getFullYear());</script>.</strong> All rights reserved.
</footer>
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<div class="modal fade" id="modstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		  <div class="modal-dialog">
			<div class="modal-content">
			</div>
		  </div>
		</div>
<script type="text/javascript">
$('#hideMe').delay(3000).fadeOut('slow');


$(document).ready(function () {
$(".numeric_input").keydown(function (e) {
       // alert(value);
        //keycode fr dot is 190
        // Allow: backspace, delete, tab, escape, enter and 
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    $(".numeric_input").keyup(function(){
        var value = $(this).val();
        value = value.replace(/^(0*)/,"");
        $(this).val(value);
    });
    
});
</script>

</body>
</html>
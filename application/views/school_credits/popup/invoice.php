
<div class="modal fade rotate" id="update_invoice" style="display:none;">
    <div class="modal-dialog modal-lg"> 
        <form id="update_invoice-form" method="post">   
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">School Invoice Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body panel-body">
                    <p><span class="alertMsg"></span></p>
                    <input type="hidden" name="id" id="id_val">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Status</label>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control input-invoice-status" id="status" name="status" >
                                <option value="">Select</option>
                                <option value="1">PAID</option>
                                <option value="0">NOT PAID</option>
                            </select>
                        </div>
                            
                </div>
                <div class="modal-footer panel-footer">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <button type="button" class="btn rkmd-btn btn-secondary" data-addempid="" id="update_invoice-btn" onclick="updateStatus()">Update</button> 
                            <button type="button" class="btn rkmd-btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>      
   
    </div>
</div>
<script>var baseurl = "<?php echo site_url(); ?>";</script>
<script type="text/javascript">
    function updateStatus(){
        jQuery.ajax({
        type:'POST',
        url:baseurl+'index.php/School_credits/updatestatus',
        data:jQuery("form#update_invoice-form").serialize(),
        dataType:'json',    
                     
        success: function (json) {
            $('.text-danger').remove();
            if (json['error']) {   
                for (i in json['error']) {
                    //var element = $('.input-school-' + i.replace('_', '-'));
                    var element = $('.input-invoice-' + i);
                    $(element).after('<div class="text-danger left_align" style="font-size: 14px;">' + json['error'][i] + '</div>');
                }
            } else {
                if(json['status']=='success'){
                    jQuery('span#success-msg').html('<div class="alert alert-success">School invoice status updated successfully</div>');
                    
                    jQuery('form#update_invoice-form').find('select').each(function () {
                        jQuery(this).val('');
                    });
                    jQuery('#update_invoice').modal('hide');
                    jQuery('.modal-backdrop.fade').css('display','none');
                    location.reload();
                }
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
}
</script>

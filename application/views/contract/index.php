<?php $this->load->view('includes/header3'); ?>

<style>
    .badge{font-size: 100% !important;}
    a.badge {color: #fff !important;}
    .changeStatusDiv{  margin:20px;  }
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title" style="color: green"><?php echo $title;?></h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Academy Activities</a></li>
                  <li class="breadcrumb-item"><a href="#"><?php echo $title;?></a></li>
                </ol>
              </div>
            </div>
        </div>
       
    </div>
<div class="content-body">
<!-- Zero configuration table -->
<section id="configuration">
<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $title;?></h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

        </div>
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="mainbox col-sm-12">
                    <div class="panel panel-info">
                    <form id="contractListForm" method="POST">
                        <input type="hidden" name="bulk_id" id="bulk_id" >

                        <div class="row changeStatusDiv">
                            <button  data-toggle="modal" data-target="#confirmModal" data-val="all" class="btn btn-info changeStatus"  title="Update Status">Invoice All  </button>
                        </div>
                        <table id="contractList" class="table table-bordered table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">Check all<br>
                                        <input type="checkbox" id="checkall" name="checkall">
                                    </th>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Parent Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Wallet Balance</th>
                                    <th scope="col">Invoice Amount</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($arrayList)){
                                    foreach ($arrayList as $contract) { ?>
                                <tr>
                                    <td style="text-align: center">
                                        <input type="checkbox" data-val="<?php echo $contract['id'];?>" id="selectContract" value="<?php echo $contract['id'];?>" class="selectContract" name="contract_id[<?php echo $contract['id'];?>]">
                                    </td>
                                    <td></td>                                    
                                    <td><?php echo $contract['student_name'];?></td>
                                    <td><?php echo $contract['activity_id'];?></td>
                                    <td><?php echo $contract['parent_name'];?></td>
                                    <td><?php echo $contract['parent_mobile'];?></td>
                                    <td><?php echo date('F');?></td>
                                    <td><?php echo isset($contract['balance_credits'])?$contract['balance_credits']:'0';?></td>
                                    <td><?php echo $contract['amount'];?></td>
                                    <td>
                                        <?php 
                                        if($contract['balance_credits'] == 0){ ?>
                                            <button  class="btn btn-danger" >Insufficient Balance </button>
                                        <?php }else{ ?>
                                        <button  data-toggle="modal" data-target="#confirmModal" data-val="<?php echo $contract['id'];?>" class="btn btn-warning changeStatus"  title="Invoice">Invoice  </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php }
                                    }
                                    ?>
                            </tbody>
                            

                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
</div>
</div>
</div>

<div class="modal fade rotate" id="confirmModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-success">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Customer Contract Invoice</h4>
                    <button type="button" class="close" onclick="clearForm()" data-dismiss="modal">&times;</button>
                </div>
              <form id="updateContract" name="updateContract" method="POST">
              <input type="hidden" name="contract_id[]" id="id_val">
              <div class="modal-body row" id="confirmMessage">     
                  <div class="col-lg-6 alignCenter">
                    <button type="button" class="btn btn-success" onclick="updateRequest1()">Invoice Now</button>  
                  </div>
                  <div class="col-lg-6 alignCenter">
                    <button type="button" class="btn btn-danger"onclick="clearForm()"  data-dismiss="modal">Cancel</button>
                  </div>
              </div>
          </form>
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>
<script type="text/javascript">
$(function () { 
   var t = $('#contractList').DataTable( {
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": true,              
      "pageLength": 25,
    });
    t.on( 'order.dt search.dt', function () {
        t.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();    
});
$("#checkall").click(function(){
    if(this.checked){
        $('.selectContract').each(function(){
            this.checked = true;
        })
    }else{
        $('.selectContract').each(function(){
            this.checked = false;
        })
    }
});
$(".selectContract").click(function(){
    if($(".selectContract").length == $(".selectContract:checked").length) {
        $("#checkall").prop("checked", true);
    } else {
        $("#checkall").prop("checked", false);
    }

});
$(".changeStatus").click(function(e){
    e.preventDefault();
    getval=$(this).attr('data-val');
    $('#id_val').val(getval);
});
function clearForm(){
    jQuery('form#updateContract').find('select, input').each(function () {
        jQuery(this).val('');
    });
}
function updateRequest(){
    id_value = $('#id_val').val();

    if(id_value == 'all'){
        $('#bulk_id').val(id_value);
        var formData = jQuery("form#contractListForm").serialize();
    }else{
        var formData = jQuery("form#updateContract").serialize();
    }
        jQuery.ajax({
        type:'POST',
        url:baseurl+'Contract_customer_invoice/invoice',
        data:formData,
        dataType:'json',    
             
        success: function (json) {
        $(".errorMsg").html('');
          if(json['error']){
            for (i in json['error']) {
            if(i == 'error_msg'){
                $('.checkAlert').html('<div class="alert alert-danger">'+json['error'][i]+'</div>')
              }
              var element = $('#'+ i);
              $(element).parent().find(".errorMsg").html(json['error'][i]);
            }
          }else{
              if(json['status']=='success'){
                jQuery('form#updateContract').find('input, select').each(function () {
                    jQuery(this).val('');
                });
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


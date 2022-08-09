<?php 
 $this->load->view('includes/header3'); ?>
<style type="text/css">
#title

{
   background-image: linear-gradient(180deg, #efefef, #dfe1e2);
    text-shadow: #fff 0 1px 0;
    border: solid 1px #cdcdcd;
    border-color: #d4d4d4;
    border-top-color: #e6e6e6;
    border-right-color: #d4d4d4;
    border-bottom-color: #cdcdcd;
    border-left-color: #d4d4d4;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 0 1px #FFF inset;
    font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 20px;
  line-height: 20px;
}
h5
{
  font-family: "Open Sans",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
  font-size: 15px;
  line-height: 20px;
  font-size: 1em;
    font-weight: bold;
    line-height: 18px;
    margin-bottom: 0.5em;
    color: #5E6469;
    padding: 5px 10px 3px 10px;
    border-right: none;
    text-align: left;
    padding-left: 12px;
    padding-right: 12px;
  font-size: 12px;
  line-height: 20px;
}


</style>
<style rel="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
 
 <script type="text/javascript">
 	$(function () {
              
                    $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
                });
 </script>
      <div id="active_admin_content" class="without_sidebar">
        <div id="main_content_wrapper">
          <div id="main_content">

 <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
         <div class="content-body"><!-- Zero configuration table -->
<section id="configuration" class="dashboard">
    

        <div class="row">
        <div class="col-12"><div class="card">
      <div class="card-header">
        <h4 class="card-title">Wallet Transactions History </h4>
            </div>
            </div> 
            </div> 
            </div> 
            
             
<div class="row">
                <div class="col-12 col-md-12">
    <div class="card">
     
      <div class="card-content collapse show">
        <div class="card-body p-0">
              <div class="table-responsive">
        <table id="listTable" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
            <thead>
                <tr>
                    <th>Wallet Transaction ID</th>
                    <th>Date</th>
                    <th>Transaction Details</th>
                    <th>Parent ID</th>
                    <th>Student ID</th>
                    <th>Gross Amount</th>
                    <th>Discount %</th>
                    <th>VAT %</th>
                    <th>VAT Amount</th>
                    <th>Credit (AED)</th>
                    <th>Debit (AED)</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $output;?>
            </tbody>
            
        </table>
        </div>   
                  
    </br>

      </section>
    </div>
  </div>
</div>
</div>
</div>
</div>
</html>

<script>
$(document).ready(function (e) {
$('#listTable').dataTable({
				    /*dom: 'Bfrtip',
                    buttons: [
                    {
                        extend: 'print',
                        title: "Transaction History",
                        
                    },
                    { 
                        extend: 'pdf', 
                        title: 'Transaction History', 
                        
                        orientation : 'landscape',
                        pageSize : 'LEGAL',
                        text : '<i class="fa fa-file-pdf-o"> PDF</i>',
                        titleAttr : 'PDF'
                    },
                    { 
                        extend: 'excel', 
                        title: 'Transaction History', 
                    
                    }],*/
				    "order":[1, 'asc'],
				    "ordering": false,
				    "lengthMenu": [[20, 50, 100, 200, 500, -1], [20, 50, 100, 200, 500, "All"]]
				    
				});
});
</script>


                

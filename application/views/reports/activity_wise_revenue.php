<?php $this->load->view('includes/header3'); ?>
<style>
    .dataTables_filter {
        display: none;
    }

    .dataTables_wrapper .dt-buttons {
        float: right;
        text-align: center;
        font-size: 12px;
    }

    .dataTables_paginate {                              
        font-size: 10px;
        margin-bottom: 5px;
    }

    .dataTables_length {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .dataTables_info {
        font-size: 12px;
    }
    @media print {
  .dataTables_wrapper th, td {
      white-space: normal;
  }
}
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <!--<div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green"><?php echo $title;?></h3>
                <div class="row breadcrumbs-top">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li class="breadcrumb-item"><a href="#"><?php echo $title;?> </a></li>
                    </ol>
                  </div>
                </div>
            </div>
        </div>-->
        <div class="col-lg-12"><span id="success-msg"></span></div>
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
                                            
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-2">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                
                                                
                                                <div class="col-lg-2">
                                                    <button id="fetch" class="btn btn-success margin-top-20 fetch">Search</button>
                                                </div>
                                          

                                            </div>
                                            
                                            
                                            <table id="reportlisting"  class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Revenue</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                          <th  class="text-center"></th>
                                          <th  class="text-center"></th>
                                          <th  class="text-center"></th>
                                                    </tr>
                                                    
                                                </tfoot>

                                            </table>

                                            

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
<?php
$this->load->view('templates/footer');
?>
<script type="text/javascript">

jQuery(document).ready(function() {
    var titlename = '<?php echo $title;?>';
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
   getList(fromdateval, todateval);
   
   jQuery(document).on('click','.fetch', function(e){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      
      if(from_date !="" && to_date =="")
      {
         alert('Please select both dates');
         return false;
      }
      else if(from_date =="" && to_date !="")
      {
         alert('Please select both dates');
         return false;
      }
      getList(from_date, to_date);
   });
   
   
} );

function getList(from_date, to_date)
{
   titlename = 'Activity Wise Revenue Report ';
   $.ajax({    
         type: "POST",   
         url: base_url+"Accountsreport/activity_wise_revenue_list",
         data: {
            from_date:from_date,
            to_date:to_date
         },             
         async: true,
         datatype: "html",
         success : function(data)
         {
            
            $('#reportlisting').dataTable().fnDestroy();
            $('#reportlisting tbody').html(data);
            $('#reportlisting').dataTable( {
               dom: 'Bfrtip',
               buttons: [
                  { extend: 'print', 
                  footer: true, 
                  messageTop: titlename+' for '+from_date+'  to  '+to_date, 
                  title: titlename, 
                  exportOptions: {
                        columns: [ 0, 1, 2 ]
                     },

                  }
               ],
               "fnRowCallback" : function(nRow, aData, iDisplayIndex ){
                var info = $(this).DataTable().page.info();
                $("td:first", nRow).html(info.start + iDisplayIndex +1);
               return nRow;
            },
               "footerCallback": function ( row, data, start, end, display ) {
                  var api = this.api(), data;
          
                  // Remove the formatting to get integer data for summation
                  var intVal = function ( i ) {
                     return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                           i : 0;
                  };
                  // Total over all pages
                  vattotal = api
                     .column( 2 )
                     .data()
                     .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                     }, 0 );
          
                  
                  
                  jQuery( api.column( 2 ).footer() ).html(
                     'Total Revenue : AED '+vattotal.toFixed(2)
                  );
                  
               }
            } );
            
            
         }
         
   });
   
   
}

   

</script>
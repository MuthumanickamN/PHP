<?php $this->load->view('includes/header3'); ?>

<style>
    .badge{font-size: 100% !important;}
    a.badge {color: #fff !important;}
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
                      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Reports</a></li>
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
                                            <form action ="<?php echo base_url() . 'reports/contract_payment' ?>" id="searchForm" method="POST">
                                            
                                            <div class="row" style="margin-bottom: 20px">    
                                                <div class="col-lg-2">
                                                    <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-2">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                 <?php 
                                            $paymentArray = array('Cash','Online','Card','Cheque');
                                            ?>
                                            <div class="col-lg-2">
                                                    <b>Payment Type</b>
                                                    <select class="form-control" id="paymentTypeVal" name="paymentTypeVal">
                                                        <option value="">Select</option>
                                                        <?php if(isset($paymentArray)){
                                                            foreach ($paymentArray as $payment) { ?>
                                                                <option value="<?php echo $payment ?>" <?php if(isset($paymentTypeVal) && $payment==$paymentTypeVal ){ echo 'selected';} ?>><?php echo $payment; ?></option>
                                                            <?php }
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <button class="btn btn-success margin-top-20">Search</button>
                                                </div>
                                            </div>
                                              </form>
                                            <table id="contractListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">PSA ID</th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">Parent Name</th>
                                                        <th scope="col">Payment Type</th>
                                                        <th scope="col">Bank</th>
                                                        <th scope="col">Cheque number</th>
                                                        <th scope="col">Cheque Date</th>
                                                        <th scope="col">Pay date</th>
                                                        <th scope="col">Amount</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($arrayList)){
                                                        foreach ($arrayList as $contract) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $contract['psa_id'];?></td>
                                                        <td><?php echo $contract['student_name'];?></td>
                                                        <td><?php echo $contract['parent_name'];?></td>
                                                        <td><?php echo $contract['payment_type'];?></td>
                                                        <td><?php echo $contract['bank'];?></td>
                                                        <td><?php echo $contract['cheque_number'];?></td>
                                                        <td><?php echo ($contract['payment_type'] == 'Cheque')?date('d-m-Y', strtotime($contract['cheque_date'])):'';?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($contract['payable_date']));?></td>
                                                        <td><?php echo $contract['amount'];?></td>                                                        
                                                        


                                                    </tr>
                                                    <?php }
                                                        }
                                                        ?>
                                                </tbody>
                                                

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
    var t = jQuery('#contractListing').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', 
            footer: true, 
            messageTop: titlename+' for '+fromdateval+' - '+todateval, 
            title: titlename, 
            exportOptions: {
                    columns: [ 1, 2, 3, 4,5,6,7,8,9 ]
                },
            },
        ],
        "fnRowCallback" : function(nRow, aData, iDisplayIndex ){
                var info = $(this).DataTable().page.info();
                $("td:first", nRow).html(info.start + iDisplayIndex +1);
               return nRow;
            },
     
    } );
} );

</script>


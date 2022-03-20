<?php $this->load->view('includes/header3'); ?>
<style>
   /* .dataTables_filter {
        display: block;
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
    label{padding: 3px 5px;}*/
</style>
<?php 
$role = strtolower($this->session->userdata['role']);
$userid = $this->session->userid;
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green">Users</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                    </div>
                </div>
            </div>
            <?php if($role == 'admin' || $role == 'superadmin'):?>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>
                    
                    <div class="media-body media-right text-right">
                        <ul class="list-inline mb-0">
                            <li>
                                <?php if($filter != "all") { 
                                    if($filter == "superadmin" || $filter == "admin" ){
                                        $url = base_url().'Admin?add='.$filter;
                                        echo '<a href="<?php echo $url;?>" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-plus"></i> Add</a>';
                                    }
                                    else if($filter == "coach" || $filter == "headcoach"){
                                        $url = base_url().'Coach?add='.$filter;
                                        echo '<a href="<?php echo $url;?>" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-plus"></i> Add</a>';
                                    }
                                    else
                                    {
                                        echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#add-user" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-plus"></i> Add</a>';
                                    }
                                
                                ?>
                                
                            </li>
                        </ul>

                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php endif;?>
        </div>
         <div class="content-body" style="width:100%;">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Activity</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                            <table id="userListing" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">User ID</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Role</th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">Current Sign In</th>
                                                        <th scope="col">Sign In Count</th>
                                                        <th scope="col">Last Sign In</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>

                                            </table>
                                        
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

$this->load->view('users/popup/display');
$this->load->view('users/popup/edit');
$this->load->view('users/popup/add');
$this->load->view('users/popup/delete');
$this->load->view('users/popup/password');
$this->load->view('templates/footer');
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        
        var filter = "<?php echo $filter;?>";
        //alert(filter);
        jQuery('#userListing').dataTable({
            "lengthChange": false,
            "paging": true,
            "processing": false,
            "serverSide": true,
            "searching": true,
            "order": [],
            "ajax": {
                "url": baseurl + "users/getUserListing",
                "type": "POST",
                "data": {
                    'filter':filter
                }
            },

            "columns": [{
                    //"bVisible": false,
                    //"aTargets": [0]
                },
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    mRender: function(data, type, row) {
                        var bindHtml = '';
                        bindHtml += '<a data-toggle="modal" data-target="#dispaly-user" href="javascript:void(0);" title="View user" class="display-user ml-1  btn btn-info fa fa-eye"  data-userid="' + row[10] + '"></a>';
                        <?php if($role == 'admin' || $role == 'superadmin' ) {
                        ?>
                        
                        bindHtml += '<a data-toggle="modal" data-target="#update-user" href="javascript:void(0);" title="Edit Staff" class="update-user-details ml-1  btn  btn-warning fa fa-edit"  data-userid="' + row[10] + '"></a>';
                         <?php } ?>
                        if(row[10] != 1) {
                            //bindHtml += '<a data-toggle="modal" data-target="#delete-user" href="javascript:void(0);" title="Delete Stff" class="delete-user-details ml-1 btn  btn-danger fa fa-trash" data-userid="' + row[10] + '"></a>';
                        }
                    
                        bindHtml += '<a data-toggle="modal" data-target="#update-password" href="javascript:void(0);" title="Change Password" class="change-password-details ml-1 btn btn-warning fa fa-lock" onclick="ChangePassword(' + row[10] + ')"  data-userid="' + row[10] + '"></a>';
                   

                    if(row[4] != 'Parent') {
                    bindHtml += ' <a href="<?php echo base_url();?>Role_delegation?id=' + row[10] + '"  class="btn  btn-primary fa " data-userid="' + row[10] + '">Assign</a>';
                       
                    }
                    return bindHtml;
                    }
                },

            ],
            "fnRowCallback" : function(nRow, aData, iDisplayIndex ){
                var info = $(this).DataTable().page.info();
                $("td:first", nRow).html(info.start + iDisplayIndex +1);
               return nRow;
            },
            
        });

        /*function filterGlobal(v) {
            jQuery('#userListing').DataTable().search(
                v,
                false,
                false
            ).draw();
        }
        jQuery('input.global_filter').on('keyup click', function() {
            var v = jQuery(this).val();
            filterGlobal(v);
        });
        jQuery('input.column_filter').on('keyup click', function() {
            jQuery('#userListing').DataTable().ajax.reload();
        });*/
    });

    function ChangePassword(id){
        jQuery('#id_value').val(id);
    }
</script>

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
</style>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green">School Registration / Profile Report</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                    </div>
                </div>
            
            </div>
            
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>
                    <div class="media-body media-right text-right">
                        <ul class="list-inline mb-0">
                            <li>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add-school" class="float-right btn btn-primary btn-sm" style="margin: 4px;"><i class="fa fa-plus"></i> Add</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12"><span id="success-msg"></span></div>
        <div class="content-body">
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
                                    <div class="mainbox col-sm-12">
                                        <div class="panel panel-info">
                                            <table id="schoolListing" class="table table-bordered table-hover small">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">School ID</th>
                                                        <th scope="col">School Name	</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Contact</th>
                                                        <th scope="col">Contact Person</th>
                                                        <th scope="col">TRN Number</th>
                                                        <th scope="col">Email-ID</th>
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
                </div>
            </section>
        </div>
    </div>
</div>
<?php
$this->load->view('school_profile_reports/popup/display');
$this->load->view('school_profile_reports/popup/edit');
$this->load->view('school_profile_reports/popup/add');
$this->load->view('school_profile_reports/popup/delete');
$this->load->view('templates/footer');
?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#schoolListing').dataTable({
            "lengthChange": false,
            "paging": true,
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": baseurl + "index.php/school_profile_reports/getListing",
                "type": "POST",
                "data": function(data) {
                    let searchParams = new URLSearchParams(window.location.search)
                    if(searchParams.has('role')){
                        searchParams.get('role');
                        data.role=searchParams.get('role');
                    }
                    data.name = $('#name_filter').val();
                    data.email = $('#email_filter').val();
                    data.mobile = $('#contact_filter').val();
                    data.address = $('#address_filter').val();
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
                {
                    mRender: function(data, type, row) {
                        var bindHtml = '';
                        bindHtml += '<a data-toggle="modal" data-target="#dispaly-school" href="javascript:void(0);" title="View school" class="display-school ml-1 btn-ext-small btn btn-sm btn-info"  data-schoolid="' + row[0] + '"><i class="fas fa-eye"></i></a>';
                        bindHtml += '<a data-toggle="modal" data-target="#update-school" href="javascript:void(0);" title="Edit school" class="update-school-details ml-1 btn-ext-small btn btn-sm btn-primary"  data-schoolid="' + row[0] + '"><i class="fas fa-edit"></i></a>';
                        //bindHtml += '<a data-toggle="modal" data-target="#delete-school" href="javascript:void(0);" title="Delete school" class="delete-school-details ml-1 btn-ext-small btn btn-sm btn-danger" data-schoolid="' + row[0] + '"><i class="fas fa-times"></i></a>';
                        return bindHtml;
                    }
                },

            ],
            "fnRowCallback" : function(nRow, aData, iDisplayIndex){
				$("td:first", nRow).html(iDisplayIndex +1);
				return nRow;
				}, // auto serial no
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            }
        });

        function filterGlobal(v) {
            jQuery('#schoolListing').DataTable().search(
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
            jQuery('#schoolListing').DataTable().ajax.reload();
        });
        jQuery.fn.dataTable.ext.errMode = 'throw';
    });
</script>

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
        <h3 class="content-header-title" style="color: green">Student Profile Report</h3>
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
              </li>
            </ul>

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
                <h4 class="card-title">Student Profile</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

              </div>
              <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                  <div class="mainbox col-sm-12">
                    <div class="panel panel-info">

                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="text-align:center">Student ID</th>
                            <th style="text-align:center">Student Name</th>
                            <th style="text-align:center">Parent Id</th>
                            <th style="text-align:center">Parent Name</th>
                            <th style="text-align:center">Mobile</th>
                            <th style="text-align:center">Parent E-mail</th>
                            <th style="text-align:center">Status</th>
                            <th style="text-align:center">Approval Status</th>
                            <th style="text-align:center">Actions</th>

                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="text-align:center"><?php echo  $registrations['id']; ?></td>
                            <td style="text-align:center"><?php echo  $registrations['name']; ?></td>
                            <td style="text-align:center"><?php echo  $registrations['id']; ?></td>
                            <td style="text-align:center"><?php echo  $registrations['parent_user_id']; ?></td>
                            <td style="text-align:center"><?php echo  $registrations['parent_name']; ?></td>
                            <td style="text-align:center"><?php echo  $registrations['parent_mobile']; ?></td>
                            <td style="text-align:center">
                              <?php if($registrations['status'] == 'Active'){?>
                                  <label style="padding: 2px 8px; " class="btn-success">ACTIVE</label>
                                  <?php }else { ?>
                                  <label style="padding: 2px 8px; " class="btn-danger">INACTIVE</label>
                              <?php } ?>
                            </td>
                            <td style="text-align:center">
                              <?php if($registrations['approval_status'] == 'Approved'){?>
                                  <label style="padding: 2px 8px; " class="btn-success">APPROVED</label>
                                  <?php }else { ?>
                                  <label style="padding: 2px 8px; " class="btn-danger">PENDING</label>
                              <?php } ?>
                            </td>
                            <td style="text-align:center"><a  href="<?php echo base_url('index.php/Students/view/'.$registrations['id']); ?>" title="View transaction" class="view-transaction ml-1 btn-ext-small btn btn-sm btn-warning" >View</a></td>

                          </tr>
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
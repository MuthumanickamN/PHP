<?php $this->load->view('includes/header3'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    });

    $(function() {

      $('#dialog').fadeIn('slow').delay(1000).fadeOut('slow');
    });
  </script>
  <style type="text/css">
    .table th {
      font-family: Arial, Helvetica;
    }
    .btn2 {
      color: black;
      background-color: white;

    }
  </style>

  <div id="dialog" style="display: none; left:40%; position: fixed; background-color:#f4f5fa;
            height: 50px;line-height: 45px; width: 500px;" class="row">
    <span id="lblText" style="color: Green; top: 50px;"></span> <?php displayMessage(); ?>
  </div>
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
        <div class="content-header-right col-md-6 col-12">
          <div class="media width-250 float-right">
            <media-left class="media-middle">
              <div id="sp-bar-total-sales"></div>
            </media-left>
            <div class="media-body media-right text-right">
              <ul class="list-inline mb-0">
                <li> <a href="<?php echo site_url('index.php/users/add/'); ?>" class="btn btn-primary"><b>New Users</b></a></li>
              </ul>

            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Users List</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">

                    <div class="table-responsive">
                      <table id="user-list" class="table table-striped table-bordered dt-responsive nowrap display dataTable" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                        <thead>
                          <tr>
                            <th style="text-align: center">Id</th>
                            <!--<th style="text-align: center">User Id</th>-->
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">Role</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Mobile</th>
                            <th style="text-align: center">Current Sign in</th>
                            <th style="text-align: center">Last Sign in</th>
                            <th style="text-align: center">Sign in Count</th>
                            <!--<th style="text-align: center">Actions</th>-->
                          </tr>
                        </thead>
                        <tbody>
                          <?php /*foreach ($data as $d) { ?>
                            <tr>
                              <td><?php echo $d->user_id; ?></td>
                              <!--<td><?php //echo ''; ?></td>-->
                              <td><?php echo $d->email; ?></td>
                              <td><?php echo $d->user_name; ?></td>
                              <td><?php echo $d->role; ?></td>
                              <td><?php echo $d->status; ?></td>
                              <td><?php echo $d->mobile; ?></td>
                              <td><?php echo $d->current_sign_in_at; ?></td>
                              <td><?php echo $d->last_sign_in_at; ?></td>
                              <td><?php echo $d->sign_in_count; ?></td>
                              <!--<td>
                                <form method="DELETE" action="<?php echo base_url('users/delete/' . $d->user_id); ?>">
                                  <a class="btn btn-info btn-xs" href="<?php echo base_url('users/edit/' . $d->user_id) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                  <button type="submit" class="btn btn-danger btn-xs"><i class="btn btn-info fa fa-eye"></i></button>
                                </form>
                              </td>-->
                            </tr>
                          <?php }*/ ?>


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
<!-- Script -->
<script type="text/javascript">
     $(document).ready(function(){
        $('#user-list').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url()?>index.php/users/getUsers'
          },
          'columns': [
             { data: 'user_id' },
             { data: 'email' },
             { data: 'user_name' },
             { data: 'role' },
             { data: 'status' },
             { data: 'mobile' },
             { data: 'current_sign_in_at' },
             { data: 'last_sign_in_at' },
             { data: 'sign_in_count' },
          ]
        });
     });
     </script>
  <script>
/*
$('#user-list').DataTable({
    "ajax": {
        url : "<?php echo base_url(); ?>index.php/users/get_users",
        type : 'GET'
    },
});*/

</script>
</body>

</html>
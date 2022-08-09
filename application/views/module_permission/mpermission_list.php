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
        <h3 class="content-header-title" style="color: green">Menu Permission</h3>
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
                <h4 class="card-title"></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

              </div>
              <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                  <form method="post">
                    <div class="table-responsives">
                      <table id="examples" class="table table-striped table-bordered dt-responsive nowrap" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                        <thead>
                          <tr>
                            <th style="text-align: center">module_name</th>
                            <th style="text-align: center">module_group</th>
                            <th style="text-align: center">superadmin</th>
                            <th style="text-align: center">admin</th>
                            <th style="text-align: center">headcoach</th>
                            <th style="text-align: center">coach</th>
                            <th style="text-align: center">Parent</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($data as $d) { ?>
                            <tr>
                              <td><?php echo $d->module_name; ?></td>
                              <td><?php echo $d->module_group; ?></td>
                              <td><?php $checked = ($d->superadmin) ? "checked" : '';
                                  echo "<input type='checkbox' name='superadmin[" . $d->id . "]' value='" . $d->superadmin . "' $checked>"; ?></td>
                              <td><?php $checked = ($d->admin) ? "checked" : '';
                                  echo "<input type='checkbox' name='admin[" . $d->id . "]' value='" . $d->admin . "' $checked>"; ?></td>
                              <td><?php $checked = ($d->headcoach) ? "checked" : '';
                                  echo "<input type='checkbox' name='headcoach[" . $d->id . "]' value='" . $d->headcoach . "' $checked>"; ?></td>
                              <td><?php $checked = ($d->coach) ? "checked" : '';
                                  echo "<input type='checkbox' name='coach[" . $d->id . "]' value='" . $d->coach . "' $checked>"; ?></td>
                              <td><?php $checked = ($d->parent) ? "checked" : '';
                                  echo "<input type='checkbox' name='parent[" . $d->id . "]' value='" . $d->parent . "' $checked>"; ?></td>
                            </tr>
                          <?php } ?>

                        </tbody>

                      </table>
                      <input type="submit" value="Save" name="Save" />
                  </form>
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
</body>

</html>
<?php $this->load->view('includes/header3'); ?>
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
              <li><a href="<?php echo site_url('index.php/users'); ?>" class="btn btn-primary"><b>Users List</b></a></li>
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
                <h4 class="card-title">Users Add</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                  <div class="mainbox col-sm-12">
                    <div class="panel panel-info">
                      <form method="post" id="usercreate">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="user_name" name="user_name" value="" placeholder="user name">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Email</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="email" name="email" value="" placeholder="email@example.com">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Password</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="password" name="password" value="" placeholder="******">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Password Confirmation</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" value="" placeholder="******">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Mobile number</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="mobile" name="mobile" value="" placeholder="ex:9876543210">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Gender</label>
                            <div class="col-sm-10">
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="user_gender_male" value="Male">
                                <label class="form-check-label" for="user_gender_male">
                                  Male
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="user_gender_female" value="Female">
                                <label class="form-check-label" for="user_gender_female">
                                Female
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Date of Birth</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="" placeholder="user name">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Role</label>
                            <div class="col-sm-10">
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="user_role_superadmin" value="superadmin" >
                                <label class="form-check-label" for="user_role_superadmin">
                                  SuperAdministrator
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="user_role_admin" value="admin">
                                <label class="form-check-label" for="user_role_admin" style="text-align:left">
                                Administrator
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="user_role_parent" value="parent">
                                <label class="form-check-label" for="user_role_parent" style="text-align:left">
                                Parent
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="user_role_headcoach" value="headcoach">
                                <label class="form-check-label" for="user_role_headcoach" style="text-align:left">
                                HeadCoach
                                </label>
                              </div>
                              <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="user_role_coach" value="coach">
                                <label class="form-check-label" for="user_role_coach" style="text-align:left">
                                Coach
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align:left">Status</label>
                            <div class="col-sm-10">
                              <select class="form-control" id="status" name="status">
                                <option value=""></option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                              </select>
                            </div>
                          </div>


                          <div class="form-group row">
                            <div class="col-md-8 col-md-offset-2 pull-right">
                              <input type="submit" class="btn btn-secondary" name="Save" class="btn">
                            </div>
                          </div>
                        </div>
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
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
       <input type="hidden" name="hid_user_id" id="hid_user_id" value="<?php echo $user_id;?>">
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
                        </div>
                    </div>
                

                    <?php 
                        foreach($main_menus as $value) {
                    ?>
                           
                           <div class="col-sm-12">
                              <div class="card">
                                 <div class="card-header">
                                    <h4 class="card-title"><?php echo $value->main_menu_name;?></h4>
                                    
                                 </div>
                              
                                 <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                          <div class="mainbox col-sm-12">
                                             <div class="panel panel-info">
                                                <table class="table table-bordered table-hover">
                                                   <thead>
                                                   <tr>
                                                      <th><input type="checkbox" class="checkall" name="checkall">&nbsp; Check all</th> 
                                                      <th>Sl_no</th>  
                                                      <th>Menu</th>  
                                                      <th>Sub Menu</th>
                                                      <th>Action</th>
                                                   </tr> 
                                                   </thead>
                                                   <tbody>
                                                      <?php 
                                                         $main_menu_id = $value->Id;
                                                         $sql2="SELECT main_menu_sub_modules.*, main_menu_modules.main_menu_name, COALESCE(role_permission.permission, 0) as permission 
                                                         FROM `main_menu_sub_modules` 
                                                         LEFT JOIN main_menu_modules on main_menu_modules.id = main_menu_sub_modules.main_menu_id
                                                         LEFT JOIN role_permission on role_permission.sub_module_id = main_menu_sub_modules.id and role_permission.user_id = $user_id
                                                         WHERE main_menu_sub_modules.main_menu_id = $main_menu_id order by main_menu_sub_modules.position";
                                                         $query = $this->db->query($sql2);
                                                         $submenus = $query->result();
                                                         $j = 0; 
                                                         foreach($submenus as $value2)
                                                         {  
                                                             $j++; 
                                                             
                                                             if($value2->permission != 1)
                                                             {

                                                                $display = 'block';
                                                                $btn = "<button class='btn btn-info assign_btn' name='assign_btn' data-user_id='".$user_id."' data-val='".$value2->Id."'>Assign</button>";
                                                             
                                                                 
                                                             }
                                                             else{
                                                                $display = 'none';
                                                                $btn ="<button class='btn btn-danger remove_btn' name='assign_btn' data-user_id='".$user_id."' data-val='".$value2->Id."'>Remove</button>";
                                                             }

                                                        ?>
                                                               <tr>
                                                                  <td><input style="display:<?php echo $display;?>" type="checkbox" class="check" name="check" value="<?php echo $value2->Id;?>"></th> 
                                                                  <td><?php echo $j; ?></td>  
                                                                  <td><?php echo $value2->main_menu_name; ?></td>  
                                                                  <td><?php echo $value2->sub_menu_name; ?></td>  


                                                                  <td><?php echo  $btn; ?></td>  
                                                               </tr> 
                                                               
                                                            
                                                      <?php   }

                                                      ?>
                                                         
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                       
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function(){
        $(document).on("click", ".assign_btn", function(){
            var this_ = this;
            var hid_user_id = $('#hid_user_id').val();
            var sub_module_id = $(this).attr('data-val');
            $.ajax({    
                type: "POST",   
                url: base_url+"Role_delegation/assign",
                data: {
                    user_id:hid_user_id,
                    sub_module_id:sub_module_id
                },             
                async: true,
                datatype: "text",
                success : function(data)
                {
                    $(this_).closest('tr').find('.check').prop("checked", false);
                    $(this_).closest('tr').find('.check').attr("disabled", true);
                    $(this_).closest('tr').find('.check').css("display", 'none');
                    $(this_).removeClass('assign_btn');
                    $(this_).removeClass('btn-info');

                    $(this_).addClass('remove_btn');
                    $(this_).addClass('btn-danger');
                    $(this_).text('Remove');
                    
                }
            });
        });

        $(document).on("click", ".remove_btn", function(){
            var this_ = this;
            var hid_user_id = $('#hid_user_id').val();
            var sub_module_id = $(this).attr('data-val');
            $.ajax({    
                type: "POST",   
                url: base_url+"Role_delegation/remove",
                data: {
                    user_id:hid_user_id,
                    sub_module_id:sub_module_id
                },             
                async: true,
                datatype: "text",
                success : function(data)
                {
                    $(this_).closest('tr').find('.check').prop("checked", false);
                    $(this_).closest('tr').find('.check').attr("disabled", false);
                    $(this_).closest('tr').find('.check').css("display", 'block');
                    $(this_).removeClass('remove_btn');
                    $(this_).removeClass('btn-danger');

                    $(this_).addClass('assign_btn');
                    $(this_).addClass('btn-info');
                    $(this_).text('Assign');
                    
                }
            });
        });
		$(document).on("click", ".checkall", function(){
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
$(document).on("click", ".check", function(){
	var cnt1 = $(this).closest('table').find('td input:checkbox').length;
	var cnt = $(this).closest('table').find('td input:checkbox:checked').length;
if(cnt1==cnt) 
{
    $(this).closest('table').find('.checkall').prop('checked', this.checked);
}
else
{
    $(this).closest('table').find('.checkall').prop('checked', false);
}
});
    });
</script>
<?php
$this->load->view('templates/footer');
?>

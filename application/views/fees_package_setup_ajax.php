
             <?php    if($opcode==1)
{  

    $query=$this->db->query("select id from slot_class_registrations where slot_classes_max=".$slot_classes_max);
    $row=$query->row_array();

    $id=$row['id'];
    $id1=$id+1;

	$query1=$this->db->query("select * from slot_class_registrations where id=".$id1);
    $row1=$query1->row_array(); ?>
	                    <div class="row"  id="one">
                        <div class="col-md-3 control text-left"></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_min1"  name="slot_classes_min1"    placeholder="Min"  class="form-control" ></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_max1"  name="slot_classes_max1" oninput="limits()"   placeholder="Max" class="form-control" ></div>
                           <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_fees1"  name="slot_classes_fees1"  oninput="allnumeric1(document.form.slot_classes_fees1); fees_limits()" placeholder="Max"  class="form-control" ></div>
                         <div class="col-md-1 control text-left">
                        <input type="button" id="classes"  name="classes"  value="+Add" onclick="show_two()"  class="form-control" ></div>
                         <div class="col-md-1 control text-left">
                        <input type="button" id="classes"  name="classes" onclick="$('#one').hide();" value="-Minus" class="form-control" ></div>
                        </div>
                      <?php } 

                     if($opcode==2)
{   

       $query1=$this->db->query("select id from slot_class_registrations where slot_classes_max=".$slot_classes_max1);
    $row1=$query1->row_array();

    $id=$row1['id'];
    $id1=$id+1;

    $query2=$this->db->query("select * from slot_class_registrations where id=".$id1);
    $row2=$query2->row_array();
    ?>
   <div class="row"  id="two">
                        <div class="col-md-3 control text-left"></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_min2"  name="slot_classes_min2"    placeholder="Min"  class="form-control" ></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_max2"  name="slot_classes_max2"   placeholder="Max" class="form-control" ></div>
                           <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_fees2"  name="slot_classes_fees2"  placeholder="Max"  class="form-control" ></div>
                        
                         <div class="col-md-1 control text-left">
                        <input type="button" id="classes"  name="classes" onclick="$('#two').hide();" value="-Minus" class="form-control" ></div>
                        </div>



                    <?php } 
 if($opcode==3)
{  

    $query=$this->db->query("select id from slot_class_registrations where slot_classes_max=".$slot_classes_max);
    $row=$query->row_array();

    $id=$row['id'];
    $id1=$id+1;

    $query1=$this->db->query("select * from slot_class_registrations where id=".$id1);
    $row1=$query1->row_array(); ?>
                        <div class="row"  id="one">
                        <div class="col-md-3 control text-left"></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_min1"  name="slot_classes_min1" value="<?php echo $row1['slot_classes_min']; ?>"   placeholder="Min"  class="form-control" ></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_max1"  name="slot_classes_max1" oninput="limits()" value="<?php echo $row1['slot_classes_max']; ?>"  placeholder="Max" class="form-control" ></div>
                           <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_fees1"  name="slot_classes_fees1" value="<?php echo $row1['fees']; ?>" oninput="allnumeric1(document.form.slot_classes_fees1); fees_limits()" placeholder="Max"  class="form-control" ></div>
                         <div class="col-md-1 control text-left">
                             <?php if($row1['fees']=="") {?>
                        <input type="button" id="classes"  name="classes"  value="+Add" onclick="show_two()"  class="form-control" ><?php } else {?>
                         <input type="button" id="classes"  name="classes"  value="+Add" onclick="show_four()"  class="form-control" ><?php } ?>
                    </div>
                         <div class="col-md-1 control text-left">
                        <input type="button" id="classes"  name="classes" onclick="$('#one').hide();" value="-Minus" class="form-control" ></div>
                        </div>
                      <?php }  

                      if($opcode==4)
{   

       $query1=$this->db->query("select id from slot_class_registrations where slot_classes_max=".$slot_classes_max1);
    $row1=$query1->row_array();

    $id=$row1['id'];
    $id1=$id+1;

    $query2=$this->db->query("select * from slot_class_registrations where id=".$id1);
    $row2=$query2->row_array();
    ?>
   <div class="row"  id="two">
                        <div class="col-md-3 control text-left"></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_min2"  name="slot_classes_min2" value="<?php echo $row2['slot_classes_min']; ?>"   placeholder="Min"  class="form-control" ></div>
                        <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_max2"  name="slot_classes_max2" value="<?php echo $row2['slot_classes_max']; ?>"  placeholder="Max" class="form-control" ></div>
                           <div class="col-md-1 control text-left">
                        <input type="text" id="slot_classes_fees2"  name="slot_classes_fees2" value="<?php echo $row2['fees']; ?>" placeholder="Max"  class="form-control" ></div>
                        
                         <div class="col-md-1 control text-left">
                        <input type="button" id="classes"  name="classes" onclick="$('#two').hide();" value="-Minus" class="form-control" ></div>
                        </div>



                    <?php } ?>


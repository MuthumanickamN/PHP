<?php if($opcode==1){ ?>
<div class="col-md-12">
          <div class="header">
            <h3>My Cart Summary</h3>
          </div>
          <div class="body">
            <form id="myCartForm" class="form-horizontal"  name="form" method="POST" >
            <table class="table table-bordered">
                <thead>
                  <th>S.No</th>
                  <th>Bk id</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Hour</th>
                  <th>Activity</th>
                  <th>Location</th>
                  <th>Level</th>
                  <th>Lane/Court</th>
                  <th>Coach</th>
                  <th>Price (AED)</th>
                  <th>Remove</th>
                </thead>
                <tbody>
                  <?php if(isset($cartList) && !empty($cartList)) { ?>
                  <input type="hidden" name="sid" id="sid" value="<?php echo $cartList[0]['student_id'];?>">
                  <input type="hidden" name="activity_id" id="activity_id" value="<?php echo $cartList[0]['activity_id'];?>">
                  <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total;?>">
                  <?php foreach ($cartList as $key => $value) { ?>
                  <tr class="tblrow_<?php echo $value['id'] ?>">
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $value['ticket_no']; ?></td>
                    <td><?php echo date('d/m/Y',strtotime($value['checkout_date'])); ?></td>
                    <td><?php echo $value['from_time'].'-'.$value['to_time']; ?></td>
                    <td><?php echo $value['hour']; ?></td>
                    <td><?php echo $value['activity']; ?></td>
                    <td><?php echo $value['location_id']; ?></td>
                    <td><?php echo $value['level_id']; ?></td>
                    <td><?php echo $value['lane_court_id']; ?></td>
                    <td><?php echo $value['coach_id']; ?></td>
                    <td><?php echo $value['amount']; ?></td>
                    <td>
                      <a type="button" onClick="deletetmp(<?php echo $value['id'] ?>)" style="color:white;text-decoration:none;" class="btn btn-danger fa fa-trash" data-id="4" data-toggle="tooltip" >
                        </a>
                    </td>
                  </tr>
                <?php } ?>
                <tfoot>
                  <th colspan="10" style="text-align: right">Total</th>
                  <th colspan="2"><?php echo $total;?></th>
                </tfoot>
              <?php } ?>
                </tbody>
            </table>
          </form>
            <div class="row">
              <div class="col-md-6">
                <button id="save" type="button" name="submit" onclick="backView()" class="btn btn-warning" > <i class="fa fa-arrow-left"></i> BACK</button>
              </div>
              <div class="col-md-6 ">
                <button id="save" type="button" name="submit" onclick="checkout('<?php echo $parent_id;?>','<?php echo $total;?>')" class="btn btn-success float-right checkout_btn" > CHECKOUT <i class="fa fa-arrow-right"></i></button>
              </div>
            </div>
          </div>
      </div>

  <div class="modal" id="confirmModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading">
                    <h4 class="modal-title -remove-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body" id="confirmMessage" style="padding: 20px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-danger" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  

</script>
      <?php } ?>
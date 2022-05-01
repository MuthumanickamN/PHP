
 <h3>Old slot Details</h3><hr>
<table class="table table-bordered ">
<thead>
    <th>S.No</th>
    <th>Booking ID</th>
    <th>Date</th>
    <th>Activity</th>
    <th>Location</th>
    <th>Time</th>
    <th>Hour</th>
    <th>Coach</th>
</thead>
<tbody>
    <tr>
        <td>1</td>
        <td><?php echo $oldSlot['ticket_no'];?></td>
        <td><?php echo date('d-m-Y', strtotime($oldSlot['checkout_date']));?></td>
        <td><?php echo $oldSlot['activity_id'];?></td>
        <td><?php echo $oldSlot['location_id'];?></td>
        <td><?php echo $oldSlot['from_time'].'-'.$oldSlot['to_time'];?></td>
        <td><?php echo $oldSlot['hour'];?></td>
        <td><?php echo $oldSlot['coach_id'];?></td>
    </tr>

</tbody>
</table><hr>
<h3>New slot Details</h3><hr>
<table class="table table-bordered">
<thead>
    <th>S.No</th>
    <th>Booking ID</th>
    <th>Date</th>
    <th>Activity</th>
    <th>Location</th>
    <th>Time</th>
    <th>Hour</th>
    <th>Coach</th>
</thead>
<tbody>
    <tr>
        <td>1</td>
        <td><?php echo $newSlot['ticket_no'];?></td>
        <td><?php echo date('d-m-Y', strtotime($newSlot['checkout_date']));?></td>
        <td><?php echo $newSlot['activity_id'];?></td>
        <td><?php echo $newSlot['location_id'];?></td>
        <td><?php echo $newSlot['from_time'].'-'.$newSlot['to_time'];?></td>
        <td><?php echo $newSlot['hour'];?></td>
        <td><?php echo $newSlot['coach_id'];?></td>
    </tr>

</tbody>
</table><hr>
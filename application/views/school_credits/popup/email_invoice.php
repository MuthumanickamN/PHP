<html> 
<head> 
<title>Welcome to Primestar Sport Academy</title> 
</head> 
<body> 
<header id="login-header" style="background-color: #ba272d; height: 80px; text-align: center;">
<div align="center" style="padding: 10px">
<img src="http://app.primestaruae.com:3001/assets/PSA_logo.jpg">
</div></header>
<h1 style="color: red; text-align:center"><?php echo $school_name; ?> - School Invoice Report</h1>
<div style="width:100%">
	<div class="width:100%">
		<table style="width:100%; border-collapse: collapse; border-color: #ccc; " border="1" >
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">Transaction Id</td>
                <td style="padding: 0px 10px; border-color: #ccc;">
                    <p><?php echo $wtx_id; ?></p>
                </td>
                <td style="padding: 0px 10px; border-color: #ccc;">Transaction Date</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo date('d-m-Y', strtotime($transaction_date)); ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">Transaction type</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo ucfirst($transaction_type); ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">Account code</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $account_code; ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">Activity</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $activity_id; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">School id</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $school_id; ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">School name</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $school_name; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">Location</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $location_id; ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">contact</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $contact; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">Contact person</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $contact_person; ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">TRN no</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $trn_number; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">Email Address</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $email_id; ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">Transaction amount</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $transaction_amount; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">VAT Percentage</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $vat_percentage; ?></p></td>
            </tr>
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">VAT amount</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $vat_value; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">NET Amount</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $net_amount; ?></p></td>
            </tr>
            
            
            <tr>
                <td style="padding: 0px 10px; border-color: #ccc;">Description</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo $description; ?></p></td>
                <td style="padding: 0px 10px; border-color: #ccc;">Transaction created on</td>
                <td style="padding: 0px 10px; border-color: #ccc;"><p><?php echo date('d-m-Y', strtotime($created_at)); ?></p></td>
            </tr>
            
            
        </table>
	</div>
</div>
<p>Thanks & Regards<br/>PSA Admin team</p>
<br/>
<br/>
Click here to visit our website:<a href="<?php echo base_url();?>"><?php echo base_url();?></a>   </body> 
</html>
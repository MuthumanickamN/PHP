<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 
class Contract_details extends CI_Controller {  
	public function __construct(){
		parent::__construct();
		$this->load->model('Contact_details_model');
	}
	public function index(){
		$this->load->view('contract_details/contact_details_listing_view');
	}

	public function contact_listing(){       

	//error_reporting(E_ALL);
	
		$postdata = $this->input->post();
        $get_contact_details = $this->Contact_details_model->get_contact_details($postdata);	


        $output_data = array();
        $no = $_POST['start'];
		$edit_btn="";
        foreach ($get_contact_details as $key => $get_list) {            

            $edit_btn .= "<td><a href='javascript:void(0)' onclick='show_student_details(".$get_list['id'].")'  id='show_student' class='btn btn-info btn-xs' data-id='".$get_list['id']."'>View</a></td>";
           
			if(!empty($get_list['contract_from_date']))
			{
				$fromdate =	date("d/m/Y", strtotime($get_list['contract_from_date']));
			}
			else
			{
				$fromdate =	"";
			}

			if(!empty($get_list['contract_to_date']))
			{
				$todate =	date("d/m/Y", strtotime($get_list['contract_to_date']));
			}
			else
			{
				$todate =	"";
			}
			
			$no++;
            $row = array();
            $row[] = $no;
            $row[] = $get_list['name'];
            $row[] = $get_list['father_name'];
            $row[] = $get_list['activity_name'];                     
            $row[] =  $fromdate;
            $row[] = $todate;
            $row[] = $get_list['contract_vat_amount'];                     
            $row[] = $get_list['contract_net_amount'];
			$row[] = $edit_btn;
      
            
            $output_data[] = $row;
        }        
        
        $count = $this->Contact_details_model->count_all($postdata);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $output_data,
        );
      
        echo json_encode($output);
        
    }
	
	public function show_student_details()
	{
		$contact_id = $this->input->post('contact_id');
		$crtldata = $this->Contact_details_model->show_student_details($contact_id);
		#echo '<pre>'; print_r($crtldata); echo '</pre>';
		$form_html = "";
		if(!empty($crtldata[0]))
		{
			$form_html.= "<div class='col-md-12'>
                    <table class='table'>
					  <tbody>
						<tr>
						  <th>Student Name</th>
						  <td>".$crtldata[0]['name']."</td>
						</tr>
						<tr>
						  <th>Parent Name</th>
						  <td>".$crtldata[0]['father_name']."</td>
						</tr>
						<tr>
						  <th>Activity</th>
						  <td>".$crtldata[0]['activity_name']."</td>
		
						</tr>
						<tr>
						  <th>From Date</th>
						  <td>".date("d/m/Y", strtotime(str_replace('/', '-', $crtldata[0]['contract_from_date'])))."</td>
			
						</tr>
						<tr>
						  <th>To Date</th>
						  <td>".date("d/m/Y", strtotime(str_replace('/', '-', $crtldata[0]['contract_to_date'])))."</td>
						</tr>
					  </tbody>
					</table>";
		}	
		
		if(!empty($crtldata[0]))
		{
			
			$get_playment =	$this->Contact_details_model->show_student_payment($crtldata[0]['id']);
			
			if(!empty($get_playment))
			{
				$form_html.= "<table class='table'>
					  <thead>
						<tr>
						  <th scope='col'>S.no</th>
						  <th scope='col'>Payment Type</th>
						  <th scope='col'>Cheque Number</th>
						  <th scope='col'>Cheque Date</th>
						  <th scope='col'>Payable Date</th>
						  <th scope='col'>Payable Amount</th>
						</tr>
					  </thead>
					  <tbody>";
				$i=1;
				foreach($get_playment as $values)
				{
					$form_html .= "
						<tr>
						  <th scope='row'>".$i."</th>
						  <td>".$values['payment_type']."</td>
						  <td>".$values['cheque_number']."</td>";
			    if($values['cheque_date'])
			    {
					  $form_html .= "<td>".date("d/m/Y", strtotime(str_replace('/', '-', $values['cheque_date'])))."</td>";
			    }
			    else
			    {
			        $form_html .= "<td></td>";
			    }
			    
			    if($values['payable_date'])
			    {
					  $form_html .= "<td>".date("d/m/Y", strtotime(str_replace('/', '-', $values['payable_date'])))."</td>";
			    }
			    else
			    {
			        $form_html .= "<td></td>";
			    }
			    
						  
			   $form_html .= "<td>".$values['payable_amount']."</td>
						</tr>";
				$i++;
				}
				$form_html.= "</tbody></table>
				</div>";

			}
			else
			{
				$form_html.= "<table class='table'>
					  <tbody>
						<tr>
						  <th scope='row'></th>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td></td>
						</tr>
					  </tbody>
				</table>
				</div>";
			}	
			
		}	
			
		
echo $form_html;		
		

		
		
	}	
	
}
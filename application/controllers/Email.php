<?php
require_once 'images/main_logo.jpg';

defined('BASEPATH') OR exit('No direct script access allowed');
  
class Email extends CI_Controller {
  
     public function __construct()
        {
            parent::__construct();
          
        }
  
  
    public function index()
    {
        $this->load->view('email_view');
    }
    public function send_mail()
    {
    $this->load->library('email');
    $this->email->set_newline("\r\n");
    $email=$this->input->post('email');
    $this->email->from('rrameshkannan8@gmail.com', 'Rameshklannan');
    $this->email->to('rameshkannan513@gmail.com');


    $this->email->subject('Welcome to Primestar Sports Academy');
    $this->email->message(' 
    <html> 
    <head> 
        <title>Welcome to CodexWorld</title> 
    </head> 
    <body> 
    <header id="login-header" style="background-color: #ba272d; height: 80px; text-align: center;">
      <div align="center" style="padding: 10px">
   
<img src="http://localhost/PSA1/application/controllers/images/main_logo.jpg">
      </div></header>
        <h1>Dear Rameshkannan,</h1>



        <br/>

        <p style="text-color:black"> Your Kid Raja Registration is approved Successfully.
        Please pay registration fees under Academy activities menu use "Registration Fees" option.
        now you can continue to select your kids activities in the "Active Kids" menu.
        <a href="http://localhost/PSA1/application/controller/Email?email=rameshkannan513@gmail.com">Click here</a> to login
        </p>
        <br/>
        <p>
        Thanks & Regards
        <br/>
        PSA Admin team</p>

        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
            <tr> 
                <th>Name:</th><td>CodexWorld</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>contact@codexworld.com</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td> 
            </tr> 
        </table> 
    </body> 
    </html>'); 
 

      

     if($this->email->send())
     {
     echo 'Your email was sent.';
     }
     else
     {
     show_error($this->email->print_debugger());
     }
    }
}
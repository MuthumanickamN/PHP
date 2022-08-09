<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'ssl://smtp.googlemail.com', 
    'smtp_port' => 587,
    'smtp_user' => 'rrameshkannan8@gmail.com',
    'smtp_pass' => '9042625362',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
/*<?php 
 


$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_user'] = 'rrameshkannan8@gmail.com';
$config['smtp_pass'] = '9042625362';
$config['smtp_port'] = 465;
$config['smtp_crypto'] = 'ssl';
$config['smtp_timeout'] = '4';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n"; 
*/


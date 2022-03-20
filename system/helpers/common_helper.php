<?php /**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package CodeIgniter
 * @author  EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://codeigniter.com
 * @since   Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter URL Helpers
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------
if ( ! function_exists('setMessage'))
{
    /**
     * Site URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @param   string  $uri
     * @param   string  $protocol
     * @return  string
     */
    function setMessage($message,$type="success")
{
    $ci_obj  =& get_instance();
    $user_id =$ci_obj->session->userdata('user_id');
    //$date    =currentDate();
    $date    =date('y-m-d');
    $sql   ="INSERT INTO  messages (message,message_type,message_date,user_id) values('$message','$type','$date','$user_id')";
    $insert=$ci_obj->db->query($sql);
}
}

function formatInIndianStyleAmount($num)
{	
	if($num<=0)
	return $num;
	
 $pos = strpos((string)$num, ".");
 if ($pos === false) {
 $decimalpart="00";
 }
 if (!($pos === false)) {
 $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos);
 }
 
if (strlen($decimalpart) == 1) {
$decimalpart = $decimalpart . '0';
}

 if(strlen($num)>3 & strlen($num) <= 12){
 $last3digits = substr($num, -3 );
 $numexceptlastdigits = substr($num, 0, -3 );
 $formatted = makeComma($numexceptlastdigits);
 //$stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
 $stringtoreturn = $formatted.",".$last3digits;
 }elseif(strlen($num)<=3){
 $stringtoreturn = $num.".".$decimalpart ;
 }elseif(strlen($num)>12){
 $stringtoreturn = number_format($num, 2);
 }

 if(substr($stringtoreturn,0,2)=="-,"){
 $stringtoreturn = "-".substr($stringtoreturn,2 );
 }
//if($stringtoreturn>0)
{
	if(strpos($stringtoreturn,".")==true)
 return $stringtoreturn;
 else
 return $stringtoreturn;
}
 //else
 //return "0";
 }


function logEmail($from_email,$to_email,$subject,$content)
{
global $dbname;
$date=change_date(Current_Date());
$date_time=Current_Date_Time();
$user_id=$_SESSION["user_id"];
$subject=mysql_escape_string($subject);
$content=mysql_escape_string($content);
$query294="insert into $dbname.email_log(date,date_time,from_email,to_email,subject,content,user_id) values('$date','$date_time','$from_email','$to_email','$subject','$content','$user_id')";
$result294=mysql_query($query294);
}
	
function currentDate()
{
$ci_obj =& get_instance();
$user_details=getLoggedUserDetails();
$company_id =$ci_obj->session->userdata('books_company_id');

$company_info=getLoggedCompanyInfo($company_id);

$date_format =$company_info['date_format'];
$time_zone   =$user_details['time_zone'];

$date = new DateTime('now', new DateTimeZone('GMT'));
$date->setTimezone(new DateTimeZone($time_zone));
return $date->format($date_format);
}

function requiredDate($no_of_day)
{
$date_format="d-m-Y";

if($no_of_day==1)
$days_string="+1 day";
else if($no_of_day>0)
$days_string="+".$no_of_day." days";
else if($no_of_day<0)
$days_string="-".$no_of_day." days";

$date=date_create(changeDate(currentDate()));
return date_format($date,strtotime($days_string, strtotime($date)));
}

function requiredParticularDate($no_of_day,$from_date)
{
$date_format="d-m-Y";

if($no_of_day==1)
$days_string="+1 day";
else if($no_of_day>0)
$days_string="+".$no_of_day." days";
else if($no_of_day<0)
$days_string="-".$no_of_day." days";

$date=date_create(changeDate($from_date));
return date_format($date,strtotime($days_string, strtotime($date)));
}


function currentDateTime()
{
//Current date time of GMT - To store in DB
$date_time_format="Y-m-d H:i:s";
$date = new DateTime('now', new DateTimeZone('GMT'));
return $date->format($date_time_format);
}

function currentTime()
{
//Current time of user time zone
$time_format="H:i:s";
$user_details=getLoggedUserDetails();
$time_zone=$user_details['time_zone'];

$date = new DateTime('now', new DateTimeZone($time_zone));
return $date->format($time_format);
}	

function currentGmtTime()
{
//Current time of GMT - to store it in db
$time_format="H:i:s";

$date = new DateTime('now', new DateTimeZone('GMT'));
return $date->format($time_format);
}	


function changeDate($date1)
{

//User time zone to GMT time zone - To store in DB
$ci_obj =& get_instance();
$db_date_format="Y-m-d";
$time_format="H:i:s";
$company_id =$ci_obj->session->userdata('books_company_id');

$user_details=getLoggedUserDetails();
$time_zone=$user_details['time_zone'];

$company_info=getLoggedCompanyInfo($company_id);
$date_format =$company_info['date_format'];

/*
echo '<hr>';
echo '<br>';	
echo $date1;
echo '<br>';
echo $date_format;
echo '<br>';
echo date($date_format,strtotime($date1));
*/

//current time of user selected zone.
$time = new DateTime('now', new DateTimeZone($time_zone));
$zone_time=$time->format($time_format);

$date = DateTime::createFromFormat($date_format,$date1);
//var_dump($date);
$date1=$date->format('Y-m-d');

$date = new DateTime($date1." ".$zone_time, new DateTimeZone($time_zone));
$date->setTimezone(new DateTimeZone('GMT'));
return $date->format($db_date_format);


/*$db_date_format="Y-m-d";
return date($db_date_format,strtotime($date1));*/

}

function userDate($date1)
{
//User time zone  - To display it in view
$ci_obj =& get_instance();
$time_format="H:i:s";
$company_id =$ci_obj->session->userdata('books_company_id');
$company_info=getLoggedCompanyInfo($company_id);
$date_format =$company_info['date_format'];

$user_details=getLoggedUserDetails();
$time_zone=$user_details['time_zone'];

//current time of user selected zone.
$time = new DateTime('now', new DateTimeZone('GMT'));
$zone_time=$time->format($time_format);

$date = new DateTime($date1." ".$zone_time, new DateTimeZone('GMT'));
$date->setTimezone(new DateTimeZone($time_zone));
return $date->format($date_format);
}

function userTime($time)
{
//User time zone  - To display it in view
$time_format="h:i:s a";
$db_date_format="d-m-Y";

$user_details=getLoggedUserDetails();
$time_zone=$user_details['time_zone'];

$date = new DateTime($time, new DateTimeZone('GMT'));
$date->setTimezone(new DateTimeZone($time_zone));
return $date->format($time_format);
}

function userDateTime($date1)
{
//User time zone  - To display it in view
$ci_obj =& get_instance();
$company_id =$ci_obj->session->userdata('books_company_id');
$company_info=getLoggedCompanyInfo($company_id);
$date_format =$company_info['date_format'];

$user_details=getLoggedUserDetails();
$time_zone=$user_details['time_zone'];

$date = new DateTime($date1, new DateTimeZone('GMT'));
$date->setTimezone(new DateTimeZone($time_zone));
return $date->format($date_format." h:i A");
}



function strToHtml($str)
{
	return str_replace("\n","<br>",$str);
}

function htmlToStr($html)
{
	return str_replace("<br>","\n",$html);
}

function nullToZero($value)
{
	if($value=="" || $value==NULL)
	return 0;
	else
	return $value;
}


function getClientIp() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];

    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function flushBuffers(){
while (ob_get_contents()) 
ob_end_clean();
ob_start();
}

function getMimeType($file) {
    // MIME types array
    $mimeTypes = array(
        "323"       => "text/h323",
        "acx"       => "application/internet-property-stream",
        "ai"        => "application/postscript",
        "aif"       => "audio/x-aiff",
        "aifc"      => "audio/x-aiff",
        "aiff"      => "audio/x-aiff",
        "asf"       => "video/x-ms-asf",
        "asr"       => "video/x-ms-asf",
        "asx"       => "video/x-ms-asf",
        "au"        => "audio/basic",
        "avi"       => "video/x-msvideo",
        "axs"       => "application/olescript",
        "bas"       => "text/plain",
        "bcpio"     => "application/x-bcpio",
        "bin"       => "application/octet-stream",
        "bmp"       => "image/bmp",
        "c"         => "text/plain",
        "cat"       => "application/vnd.ms-pkiseccat",
        "cdf"       => "application/x-cdf",
        "cer"       => "application/x-x509-ca-cert",
        "class"     => "application/octet-stream",
        "clp"       => "application/x-msclip",
        "cmx"       => "image/x-cmx",
        "cod"       => "image/cis-cod",
        "cpio"      => "application/x-cpio",
        "crd"       => "application/x-mscardfile",
        "crl"       => "application/pkix-crl",
        "crt"       => "application/x-x509-ca-cert",
        "csh"       => "application/x-csh",
        "css"       => "text/css",
        "dcr"       => "application/x-director",
        "der"       => "application/x-x509-ca-cert",
        "dir"       => "application/x-director",
        "dll"       => "application/x-msdownload",
        "dms"       => "application/octet-stream",
        "doc"       => "application/msword",
        "dot"       => "application/msword",
        "dvi"       => "application/x-dvi",
        "dxr"       => "application/x-director",
        "eps"       => "application/postscript",
        "etx"       => "text/x-setext",
        "evy"       => "application/envoy",
        "exe"       => "application/octet-stream",
        "fif"       => "application/fractals",
        "flr"       => "x-world/x-vrml",
        "gif"       => "image/gif",
        "gtar"      => "application/x-gtar",
        "gz"        => "application/x-gzip",
        "h"         => "text/plain",
        "hdf"       => "application/x-hdf",
        "hlp"       => "application/winhlp",
        "hqx"       => "application/mac-binhex40",
        "hta"       => "application/hta",
        "htc"       => "text/x-component",
        "htm"       => "text/html",
        "html"      => "text/html",
        "htt"       => "text/webviewhtml",
        "ico"       => "image/x-icon",
        "ief"       => "image/ief",
        "iii"       => "application/x-iphone",
        "ins"       => "application/x-internet-signup",
        "isp"       => "application/x-internet-signup",
        "jfif"      => "image/pipeg",
        "jpe"       => "image/jpeg",
        "jpeg"      => "image/jpeg",
        "jpg"       => "image/jpeg",
        "js"        => "application/x-javascript",
        "latex"     => "application/x-latex",
        "lha"       => "application/octet-stream",
        "lsf"       => "video/x-la-asf",
        "lsx"       => "video/x-la-asf",
        "lzh"       => "application/octet-stream",
        "m13"       => "application/x-msmediaview",
        "m14"       => "application/x-msmediaview",
        "m3u"       => "audio/x-mpegurl",
        "man"       => "application/x-troff-man",
        "mdb"       => "application/x-msaccess",
        "me"        => "application/x-troff-me",
        "mht"       => "message/rfc822",
        "mhtml"     => "message/rfc822",
        "mid"       => "audio/mid",
        "mny"       => "application/x-msmoney",
        "mov"       => "video/quicktime",
        "movie"     => "video/x-sgi-movie",
        "mp2"       => "video/mpeg",
        "mp3"       => "audio/mpeg",
        "mpa"       => "video/mpeg",
        "mpe"       => "video/mpeg",
        "mpeg"      => "video/mpeg",
        "mpg"       => "video/mpeg",
        "mpp"       => "application/vnd.ms-project",
        "mpv2"      => "video/mpeg",
        "ms"        => "application/x-troff-ms",
        "mvb"       => "application/x-msmediaview",
        "nws"       => "message/rfc822",
        "oda"       => "application/oda",
        "p10"       => "application/pkcs10",
        "p12"       => "application/x-pkcs12",
        "p7b"       => "application/x-pkcs7-certificates",
        "p7c"       => "application/x-pkcs7-mime",
        "p7m"       => "application/x-pkcs7-mime",
        "p7r"       => "application/x-pkcs7-certreqresp",
        "p7s"       => "application/x-pkcs7-signature",
        "pbm"       => "image/x-portable-bitmap",
        "pdf"       => "application/pdf",
        "pfx"       => "application/x-pkcs12",
        "pgm"       => "image/x-portable-graymap",
        "pko"       => "application/ynd.ms-pkipko",
        "pma"       => "application/x-perfmon",
        "pmc"       => "application/x-perfmon",
        "pml"       => "application/x-perfmon",
        "pmr"       => "application/x-perfmon",
        "pmw"       => "application/x-perfmon",
        "pnm"       => "image/x-portable-anymap",
        "pot"       => "application/vnd.ms-powerpoint",
        "ppm"       => "image/x-portable-pixmap",
        "pps"       => "application/vnd.ms-powerpoint",
        "ppt"       => "application/vnd.ms-powerpoint",
        "prf"       => "application/pics-rules",
        "ps"        => "application/postscript",
        "pub"       => "application/x-mspublisher",
        "qt"        => "video/quicktime",
        "ra"        => "audio/x-pn-realaudio",
        "ram"       => "audio/x-pn-realaudio",
        "ras"       => "image/x-cmu-raster",
        "rgb"       => "image/x-rgb",
        "rmi"       => "audio/mid",
        "roff"      => "application/x-troff",
        "rtf"       => "application/rtf",
        "rtx"       => "text/richtext",
        "scd"       => "application/x-msschedule",
        "sct"       => "text/scriptlet",
        "setpay"    => "application/set-payment-initiation",
        "setreg"    => "application/set-registration-initiation",
        "sh"        => "application/x-sh",
        "shar"      => "application/x-shar",
        "sit"       => "application/x-stuffit",
        "snd"       => "audio/basic",
        "spc"       => "application/x-pkcs7-certificates",
        "spl"       => "application/futuresplash",
        "src"       => "application/x-wais-source",
        "sst"       => "application/vnd.ms-pkicertstore",
        "stl"       => "application/vnd.ms-pkistl",
        "stm"       => "text/html",
        "svg"       => "image/svg+xml",
        "sv4cpio"   => "application/x-sv4cpio",
        "sv4crc"    => "application/x-sv4crc",
        "t"         => "application/x-troff",
        "tar"       => "application/x-tar",
        "tcl"       => "application/x-tcl",
        "tex"       => "application/x-tex",
        "texi"      => "application/x-texinfo",
        "texinfo"   => "application/x-texinfo",
        "tgz"       => "application/x-compressed",
        "tif"       => "image/tiff",
        "tiff"      => "image/tiff",
        "tr"        => "application/x-troff",
        "trm"       => "application/x-msterminal",
        "tsv"       => "text/tab-separated-values",
        "txt"       => "text/plain",
        "uls"       => "text/iuls",
        "ustar"     => "application/x-ustar",
        "vcf"       => "text/x-vcard",
        "vrml"      => "x-world/x-vrml",
        "wav"       => "audio/x-wav",
        "wcm"       => "application/vnd.ms-works",
        "wdb"       => "application/vnd.ms-works",
        "wks"       => "application/vnd.ms-works",
        "wmf"       => "application/x-msmetafile",
        "wps"       => "application/vnd.ms-works",
        "wri"       => "application/x-mswrite",
        "wrl"       => "x-world/x-vrml",
        "wrz"       => "x-world/x-vrml",
        "xaf"       => "x-world/x-vrml",
        "xbm"       => "image/x-xbitmap",
        "xla"       => "application/vnd.ms-excel",
        "xlc"       => "application/vnd.ms-excel",
        "xlm"       => "application/vnd.ms-excel",
        "xls"       => "application/vnd.ms-excel",
        "xlsx"      => "vnd.ms-excel",
        "xlt"       => "application/vnd.ms-excel",
        "xlw"       => "application/vnd.ms-excel",
        "xof"       => "x-world/x-vrml",
        "xpm"       => "image/x-xpixmap",
        "xwd"       => "image/x-xwindowdump",
        "z"         => "application/x-compress",
        "zip"       => "application/zip"
    );

    $extension = end(explode('.', $file));
    return $mimeTypes[$extension]; // return the array value
}

function noToWords($no)
{   
 $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred and','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
    if($no == 0)
        return ' ';
    else {
	$novalue='';
	$highno=$no;
	$remainno=0;
	$value=100;
	$value1=1000;       
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".noToWords($remainno);
          else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".noToWords($remainno);
           }
    }
}

//ss=============setMessage===============ss//
function setMessage($message,$type="success")
{
	$ci_obj  =& get_instance();
	$user_id =$ci_obj->session->userdata('user_id');
	//$date    =currentDate();
	$date    =date('y-m-d');
	$sql   ="INSERT INTO  messages (message,message_type,message_date,user_id) values('$message','$type','$date','$user_id')";
	$insert=$ci_obj->db->query($sql);
}

//ss=============displayMessage===============ss//
function displayMessage()
{
	$ci_obj =& get_instance();
	$user_id =$ci_obj->session->userdata('user_id');
	
	$query2 = $ci_obj->db->query('select * from messages where user_id='.$user_id);
	$rows2=$query2->result_array();
	
	foreach($rows2 as $row2)
	{
	if($row2['message_type']=="success")
	$display_icon="check";
	else if($row2['message_type']=="info")
	$display_icon="info-outline";
	else if($row2['message_type']=="warning")
	$display_icon="alert-circle-o";
	else if($row2['message_type']=="danger")
	$display_icon="block";
	
	//success,info,warning,danger
	?>
    <div class="row"><div class="col-sm-12">      
    <div class="alert alert-<?php echo $row2['message_type']; ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	
    <i class="zmdi zmdi-<?php echo $display_icon; ?> pr-15 pull-left"></i>
    
	<?php echo $row2['message']; ?>
    </div>
    </div></div>
    <?php 
	}
	$sql1 ="delete from messages where user_id='".$user_id."'";
	$ci_obj->db->query($sql1);

}


function isValidUser()
{
	$ci_obj =& get_instance();
	if(empty($ci_obj->session->userdata('user_id')))
		 {
		 setMessage('Session Unavailable. Login to continue',"danger");
		 redirect(site_url('../login'));
		 exit;
		 }
}

function isValidCompany()
{
	$ci_obj =& get_instance();
	if(empty($ci_obj->session->userdata('books_company_id')))
		 {
		 setMessage('Company Unavailable. Please create',"danger");
		 redirect(site_url('../company'));
		 exit;
		 }
}

//ss==========getNumberOFDays=======ss//
function getNumberOFDays($from,$to)
{
    $from_date = new DateTime($from);
    $to_date = new DateTime($to);
    return $from_date->diff($to_date)->days;
 }

//ss==========getDiffString=======ss//
function getDiffString($from,$to,$short="No")
{
	$datetime1 = new DateTime($from);
	$datetime2 = new DateTime($to);
	$interval = $datetime1->diff($datetime2);
	
	if($short=="No")
	return $interval->format('%h')." Hours ".$interval->format('%i')." Minutes ago";
	else
	return $interval->format('%h')." H ".$interval->format('%i')." M";
}

//ss==========UsergetInfo=======ss//
function UsergetInfo($id)
{
	$ci_obj =& get_instance();
    $query1 = $ci_obj->db->query("select * from employee_master where status='Active' and employee_id='".$id."' ");
	$rows1=$query1->row_array();	
	return $rows1['employee_name'];
}

//ss==========MultipleUsergetInfo=======ss//
function MultipleUsergetInfo($id)
{
	$ids=explode(",",$id);
	$employees="";
	for($i =0 ; $i < count($ids) ;$i++)
	{
		$ci_obj =& get_instance();
		$query1 = $ci_obj->db->query("select * from employee_master where status='Active' and employee_id='".$ids[$i]."' ");
		$rows1=$query1->row_array();	
		$employees.=$rows1['employee_name'].',';
	}
    return rtrim($employees,',');
}

//ss==========AttributesValuesInfo=======ss//
function getProductName($product_id)
{
	
	$ci_obj =& get_instance();
	$attributes_values=" ";
	
	$query = $ci_obj->db->query("select * from product_services where product_id=".$product_id);
	$row1=$query->row_array();


	$query11 = $ci_obj->db->query("select * from product_services_attributes where product_id='".$product_id."' ");
	
	if($query11->num_rows()==0)
	return $row1['product_name'];
		
	$rows11=$query11->result_array();
	foreach($rows11 as $row11)
    {
			$query13 = $ci_obj->db->query("select * from attributes_values where attribute_values_id='".$row11['attribute_values_id']."' ");
			$row13=$query13->row_array();
			$attribute_value=$row13['attribute_value'];
		    $attributes_values.=$attribute_value.'/';
	}
	
    return $row1['product_name'].' - '.rtrim($attributes_values,'/');
}


function getProductNameinTamil($product_id)
{
	
	$ci_obj =& get_instance();
	$attributes_values=" ";
	
	$query = $ci_obj->db->query("select * from product_services where product_id=".$product_id);
	$row1=$query->row_array();


	$query11 = $ci_obj->db->query("select * from product_services_attributes where product_id='".$product_id."' ");
	
	if($query11->num_rows()==0)
	return $row1['product_name_add_lang'];
		
	$rows11=$query11->result_array();
	foreach($rows11 as $row11)
    {
			$query13 = $ci_obj->db->query("select * from attributes_values where attribute_values_id='".$row11['attribute_values_id']."' ");
			$row13=$query13->row_array();
			$attribute_value=$row13['attribute_value_add_lang'];
		    $attributes_values.=$attribute_value.'/';
	}
	
    return $row1['product_name_add_lang'].' - '.rtrim($attributes_values,'/');
}

//ss======initScript======ss//
function initScript()
{
	$ci_obj =& get_instance();
	$data['company_info']=getLoggedCompanyInfo($ci_obj->session->userdata('books_company_id'));
	$date_format=$data['company_info']['date_format'];
	$seperator_array=array(".","-","/");
		foreach($seperator_array as $seperator)
		{
		$count=explode($seperator,$date_format);
		if(count($count)==3)
		{
			if($count[0]=='m')
			$first='MM';
			if($count[0]=='d')
			$first='DD';
			if($count[0]=='y')
			$first='YY';
			if($count[0]=='Y')
			$first='YYYY';
			
			if($count[1]=='m')
			$second='MM';
			if($count[1]=='d')
			$second='DD';

			if($count[2]=='m')
			$third='MM';
			if($count[2]=='d')
			$third='DD';
			if($count[2]=='y')
			$third='YY';
			if($count[2]=='Y')
			$third='YYYY';
			break;
			
		}
		}
	
	  $date_format=$first.$seperator.$second.$seperator.$third;
	
    echo '<script>';
	echo 'init_datepicker("'.$date_format.'");';
	echo 'init_datetimepicker("'.$date_format.'");';
	echo '</script>';
}

function getScriptDateFormat()
{
	$ci_obj =& get_instance();
	$data['company_info']=getLoggedCompanyInfo($ci_obj->session->userdata('books_company_id'));
	$date_format=$data['company_info']['date_format'];
	$seperator_array=array(".","-","/");
		foreach($seperator_array as $seperator)
		{
		$count=explode($seperator,$date_format);
		if(count($count)==3)
		{
			if($count[0]=='m')
			$first='MM';
			if($count[0]=='d')
			$first='DD';
			if($count[0]=='y')
			$first='YY';
			if($count[0]=='Y')
			$first='YYYY';
			
			if($count[1]=='m')
			$second='MM';
			if($count[1]=='d')
			$second='DD';

			if($count[2]=='m')
			$third='MM';
			if($count[2]=='d')
			$third='DD';
			if($count[2]=='y')
			$third='YY';
			if($count[2]=='Y')
			$third='YYYY';
			break;
			
		}
		}
	
	  $date_format=$first.$seperator.$second.$seperator.$third;
	  return $date_format;
}
?>
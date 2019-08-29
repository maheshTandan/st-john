<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChildReportListController extends CI_Controller {
    
    
    public function __construct()
    {
		         parent :: __construct(); date_default_timezone_set('Asia/Kolkata');
               $this->load->model(array('Parent/ChildReportListModel','Signup_model'));
               $this->load->library('session');
               $this->load->library('form_validation');
               $this->load->model('Access_model');
               //$this->load->model(array('Signup_model','Access_model'));
               $this->load->helper(array('form', 'url'));
               $loginstatus   = $this->session->userdata('logged_in'); 
//               if($loginstatus["status"] != '1')
//                   {
//
//                       redirect('logout');
//                    }

            
            
    } 


    public function index()
    {     
            $service =  $this->Access_model->showAdminService();
            $loginstatus   = $this->session->userdata('logged_in'); 
            $parent_id = $loginstatus['parent_id'];
          //  print_r($loginstatus); die;
            $locid = $this->ChildReportListModel->loctionId($parent_id); 
            $info = $this->Signup_model->personalInfo($parent_id);
           
              
            $parentName = $this->ChildReportListModel->parentName($parent_id);
            $parentList = $this->Signup_model->parentName();

             // for parent login child not bm report
             $childName = $this->ChildReportListModel->allChild($parent_id);
             $discount = $this->ChildReportListModel->discount($parent_id);



             // for bm parent menu report child name





        //   print_r($childName); die;

            $allChild = array();
            for($i=0;$i<count($childName);$i++)
            {
               array_push($allChild,$childName[$i]['id']);
            }
            $allParent = array();
            for($i=0;$i<count($parentList);$i++)
            {
               array_push($allParent,$parentList[$i]['id']);
            }
            
          
           
            $childItem = $this->ChildReportListModel->itemName($parent_id,$allChild);
            $allChildName = $this->ChildReportListModel->allChildName($allParent);


           // print_r($allChildName); die;

            $allParentChild = array();
            for($i=0;$i<count($allChildName);$i++)
            {
               array_push($allParentChild,$allChildName[$i]['id']);
            }

            $parentItem = $this->ChildReportListModel->parentitemName($allParent,$allParentChild,$locid['0']['locid']);
          
        // print_r($parentItem); die;
            
            if($info['type']=='Business Manager')
            {
                $this->load->view('Parent/ChildReportListView', ['serviceData'=>$service,
                'parentName'=>$parentName,'parentItem'=>$parentItem,'child'=>$allChildName,'personalInfo'=>$info,'parentList'=>$parentList,
                'date1'=>'','date2'=>'']);
             }
             else{
                $this->load->view('Parent/ChildReportListView', ['serviceData'=>$service,
                'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info,
                'date1'=>'','date2'=>'','discount'=>$discount]);
            }

           
    }

    public function childReportFilter()
    {

        $service =  $this->Access_model->showAdminService();
        $loginstatus   = $this->session->userdata('logged_in'); 
        $parent_id = $loginstatus['parent_id'];
        $locid = $this->ChildReportListModel->loctionId($parent_id);
        $info = $this->Signup_model->personalInfo($parent_id);

      
      //  print_r($loginstatus); die;
        $parentName = $this->ChildReportListModel->parentName($parent_id);
        $parentList = $this->Signup_model->parentName();
       
        $childName = $this->ChildReportListModel->allChild($parent_id);
      
        
        $allChild = array();
        for($i=0;$i<count($childName);$i++)
        {
           array_push($allChild,$childName[$i]['id']);
        }
        $allParent = array();
        for($i=0;$i<count($parentList);$i++)
        {
           array_push($allParent,$parentList[$i]['id']);
        }
        


            $childItem = $this->ChildReportListModel->itemName($parent_id,$allChild);
            $allChildName = $this->ChildReportListModel->allChildName($allParent);


            $allParentChild = array();
            for($i=0;$i<count($allChildName);$i++)
            {
               array_push($allParentChild,$allChildName[$i]['id']);
            }

         //   print_r($allParentChild); die;


        if($this->input->server('REQUEST_METHOD') == 'POST'){

            if($info['type'] == 'Parent')
            {
            
            $this->form_validation->set_rules('date1', 'From Date', 'trim');
            $this->form_validation->set_rules('date2', 'To Date', 'trim');
            $this->form_validation->set_rules('child', 'Name', 'trim');
            
            $discount = $this->ChildReportListModel->discount($parent_id);
                        if ($this->form_validation->run() == FALSE)
                        {
                            
                            $this->load->view('Parent/ChildReportListView',['serviceData'=>$service,
                            'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info]);
                        }
                        else
                        {
                        
                        
                        

                            $date1 	= $this->security->xss_clean($this->input->post('date1'));
                            $date2 	= $this->security->xss_clean($this->input->post('date2'));
                            $child 	= $this->security->xss_clean($this->input->post('child'));
                         
                            
                            $discount = $this->ChildReportListModel->discount($parent_id); 
                        
                            
                            if(!empty($child))
                            {
                                $result_str = "'" . implode ( "', '", $child ) . "'";
                                $result="and b.child_id IN($result_str)";
                            }
                            else
                            {
                             $result = '';
                            }
                            $parentName1 = $this->ChildReportListModel->parentName($parent_id);
                                if($date1 !='' and $date2!=''){

                                    $date1 = date("Y-m-d", strtotime($date1));
                                    $date2 = date("Y-m-d", strtotime($date2));
                                    $date_str = "AND b.date BETWEEN '$date1' AND '$date2'";
                                }else{
                                    $date_str ='';
                                }
                            $childItem1 = $this->ChildReportListModel->itemName1($parent_id,$result,$date_str);
                            $childName1 = $this->ChildReportListModel->allChild1($parent_id,$result);

                        
                           $this->load->view('Parent/ChildReportListView',['serviceData'=>$service,
                           'parentName'=>$parentName1,'childItem'=>$childItem1,'child'=>$childName1,'personalInfo'=>$info
                            ,'date1'=>$date1,'date2'=>$date2,'discount'=>$discount]);
                        }


            }
            
            else{

                        $this->form_validation->set_rules('date1', 'From Date', 'trim');
                        $this->form_validation->set_rules('date2', 'To Date', 'trim');
                        $this->form_validation->set_rules('parent', 'Name', 'trim');
                        
                        
                        if ($this->form_validation->run() == FALSE)
                        {
                       
                            $this->load->view('Parent/ChildReportListView',['serviceData'=>$service,
                            'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info]);
                        }
                        else{
                                $date1 	= $this->security->xss_clean($this->input->post('date1'));
                                $date2 	= $this->security->xss_clean($this->input->post('date2'));
                                $parent = $this->security->xss_clean($this->input->post('parent'));

                               // echo "hfgj"; die;
                                if(!empty($parent))
                                {

                                    $result_str = "'" . implode ( "', '", $parent ) . "'";
                                    $result="and  b.parent_id IN($result_str)";
                                }

                                else
                                {
                                $result = '';
                                }
                            
                                if($date1 !='' and $date2!=''){

                                        $date1 = date("Y-m-d", strtotime($date1));
                                        $date2 = date("Y-m-d", strtotime($date2));
                                    $date_str = "AND b.date BETWEEN '$date1' AND '$date2'";
                                }else{
                                    $date_str ='';
                                }

                            
                                $parentItem = $this->ChildReportListModel->parentitemName1($locid['0']['locid'],$date_str,$result);

                             //   print_r($parentItem); die;
                            
                                $this->load->view('Parent/ChildReportListView',['serviceData'=>$service,
                                'parentItem'=>$parentItem,'parentList'=>$parentList,'personalInfo'=>$info,
                                'date1'=>$date1,'date2'=>$date2]);
                            }
                            

                            }
               
                
            }


        }
      
    public function paymentAckw()
    {

        // $paymentStatus = $this->uri->segment(2);
        // $amount = $this->uri->segment(3);
        // $txnID = $this->uri->segment(4);
        // $tnxdate = $this->uri->segment(5);
       
        // $parentIDD = $this->uri->segment(6);
        // $uniqueIDD = $this->uri->segment(7);

         $paymentStatus = $this->input->get('status');
        $amount = $this->input->get('amount');
        $txnID = $this->input->get('transactionId');
        $tnxdate = $this->input->get('transaction_date');
       
        $parentIDD = $this->input->get('parent_id');
        $uniqueIDD = $this->input->get('uniqueID');



        
        $paymentStatus = $this->input->get('status');
        $amount = $this->input->get('amount');
        $txnID = $this->input->get('transactionId');
        $tnxdate = $this->input->get('transaction_date');
        $parentIDD = $this->input->get('parent_id');
      
        $service =  $this->Access_model->showAdminService();
        
        $loginstatus   = $this->session->userdata('logged_in');


      //  $t = $this->input->get('amount');
        

        if($loginstatus == "")
        {
            $checksql="select `transactionID` from payment_tnx_info where `transactionID`='".$txnID."'";
            $result = $this->db->query($checksql);
            if($result->num_rows() > 0)
            {
                 //  echo "more than 0";
            }
            else
            {
                $parent_id = $parentIDD; 
                $emailSQL="select `userid` from user where ref_id =".$parent_id;
                $emailSQL =$this->db->query($emailSQL)->row_array();
                $email = $emailSQL['userid'];
            }
            
        }
        else
        {
            $parent_id = $loginstatus['parent_id'];
            $email = $loginstatus['user'];
        }
       
        
       
        $locid = $this->ChildReportListModel->loctionId($parent_id);
        
        //        $menu_date = '09/11/2018';
        //        $menu_date = strtotime($menu_date);
       //        $menu_date = date('Y-m-d',$menu_date);
       
       // $categoryID = "df";
        $locationid = $locid['0']['locid'];
        
       // print_r($loginstatus); die;
        
        if(trim($paymentStatus)=='declined' || trim($paymentStatus)=='declineddeclined')
        {
            $res = $this->ChildReportListModel->payment_tranx_info_record($txnID, $tnxdate, $parent_id, $locationid, $paymentStatus, $amount,$uniqueIDD);
            
            $this->ChildReportListModel->dataCopyFromTemp($txnID, $parent_id,$paymentStatus,$uniqueIDD);
         
             $transInfo = $this->ChildReportListModel->payment_info_parent($txnID, $parent_id);
           
            
            
            if($res)
            {
                
                //$insertToken = $this->Signup_model->gettokenEmail($email);
                $to = $email;
                $subject = "Payment Declined (Hot Lunch System)";
                $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <!--[if !mso]><!-->
                                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                                <!--<![endif]-->
                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                                <title>Payment Success</title>  
                        </head>
                        <body style="background: #f5f5f5">
                <div id="page-wrapper">
                <form method="post">
                  <table cellpadding="0" cellspacing="0" style="width:100%;text-align:center;border-collapse:collapse;background-color:#ffffff;max-width:600px;margin:0 auto;border:1px solid #eee;font-family:sans-serif;font-size:16px;">
                        <tbody>
                                <tr>
                                        <td>
                                        <table cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
                                                <tbody>
                                                        <tr>
                                                                <td>
                                                                <table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;max-width:600px;border-collapse:collapse;background: #f5f5f5;">
                                                                        <tbody>
                                                                        <tr>
                                                                                        <td style="width:100%;color:#464545;padding:0;text-align: left;padding: 15px;    border-bottom: 1px solid #ddd;background: #fff;"><img alt="banner(1).jpg" src="'.base_url().'application/images/logo-png.png" style="max-width: 40%"></td>
                                                                        </tr>
                                                                        <tr>
                                                                                        <td style="padding:20px;text-align:left;font-size:15px;line-height:23px;width:100%;color:#464545;background: #fff;">
                                                                                        <h4 style="font-weight:600;    margin-top: 0;">Hi '.$loginstatus["name"].',</h4>
                                                                                        <p>Your transaction of $'.$transInfo['amount'].' done in hot lunch system has been '.$paymentStatus.'.</p>
                                                                                        <p>Your Transaction ID is '.$transInfo['transactionID'].' and the Transaction Date is '.$transInfo['transactionDate'].'.</p>
                                                                                        <h5 style="font-weight:600;    margin-top: 0;">For any further queries please contact parish@mystjohns.org</h5>
                                                                                        </td>
                                                                        </tr>
                                                                        </tbody>
                                                                </table>
                                                                </td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                        </td>
                                </tr>
                        </tbody>
                </table>

                </form>
                </div>
                </body>
                </html>';
    
                 // echo  base_url()."application/images/logo-png.png"; die;
		// echo base_url()."Signup_controller/passwordform/".$insertToken['id']."/".$insertToken['token']."/".$email1; die;  
		$txt = $html;
		$headers = "From: ST John <parish@mystjohns.org>\r\n";
                $headers .= "Content-type: text/html\r\n";
                mail($to,$subject,$txt,$headers); 
                $this->index();
                $redirect = '';
                if($loginstatus == "")
                {
                    $redirect = base_url().'Signup_controller/login';
                }
                else
                {
                    $redirect = base_url().'transReport';
                }
                $x = "Your Payment has been DECLINED!";
                echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'bootbox.alert({
                      message: "'.$x.'",
                      callback: function () {
                      location.href = "'.$redirect.'";
                    }
                })';
                echo '});';
                echo '</script>';
                //redirect('childReport', 'refresh');
            }
            else
            {
                echo "FAILED DB";
            }
        }
        
        if(trim($paymentStatus)=='success')
        {
           
            $res = $this->ChildReportListModel->payment_tranx_info_record($txnID, $tnxdate, $parent_id, $locationid, $paymentStatus, $amount,$uniqueIDD);
            $this->ChildReportListModel->dataCopyFromTemp($txnID, $parent_id,$paymentStatus,$uniqueIDD);
            $transInfo = $this->ChildReportListModel->payment_info_parent($txnID, $parent_id);
            if($res)
            {
                
                //$insertToken = $this->Signup_model->gettokenEmail($email);
                $to = $email;
                $subject = "Payment Successful (Hot Lunch System)";
                $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <!--[if !mso]><!-->
                                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                                <!--<![endif]-->
                                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                                <title>Payment Success</title>  
                        </head>
                        <body style="background: #f5f5f5">
                <div id="page-wrapper">
                <form method="post">
                  <table cellpadding="0" cellspacing="0" style="width:100%;text-align:center;border-collapse:collapse;background-color:#ffffff;max-width:600px;margin:0 auto;border:1px solid #eee;font-family:sans-serif;font-size:16px;">
                        <tbody>
                                <tr>
                                        <td>
                                        <table cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
                                                <tbody>
                                                        <tr>
                                                                <td>
                                                                <table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;max-width:600px;border-collapse:collapse;background: #f5f5f5;">
                                                                        <tbody>
                                                                        <tr>
                                                                                        <td style="width:100%;color:#464545;padding:0;text-align: left;padding: 15px;    border-bottom: 1px solid #ddd;background: #fff;"><img alt="banner(1).jpg" src="'.base_url().'application/images/logo-png.png" style="max-width: 40%"></td>
                                                                        </tr>
                                                                        <tr>
                                                                                        <td style="padding:20px;text-align:left;font-size:15px;line-height:23px;width:100%;color:#464545;background: #fff;">
                                                                                        <h4 style="font-weight:600;    margin-top: 0;">Hi '.$loginstatus["name"].',</h4>
                                                                                        <p>Your transaction of $'.$transInfo['amount'].' done in hot lunch system has been successful.</p>
                                                                                        <p>Your Transaction ID is '.$transInfo['transactionID'].' and the Transaction Date is '.$transInfo['transactionDate'].'.</p>
                                                                                        <h5 style="font-weight:600;    margin-top: 0;">For any further queries please contact parish@mystjohns.org</h5>
                                                                                        </td>
                                                                        </tr>
                                                                        </tbody>
                                                                </table>
                                                                </td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                        </td>
                                </tr>
                        </tbody>
                </table>

                </form>
                </div>
                </body>
                </html>';
    
  // echo  base_url()."application/images/logo-png.png"; die;
		// echo base_url()."Signup_controller/passwordform/".$insertToken['id']."/".$insertToken['token']."/".$email1; die;  
		$txt = $html;
		$headers = "From: ST John <parish@mystjohns.org>\r\n";
                $headers .= "Content-type: text/html\r\n";
                mail($to,$subject,$txt,$headers); 
                //header( "refresh:3;url=http://localhost/st-john/childReport" );
                //redirect('childReport', 'refresh');
                $this->index();
                $redirect = '';
                if($loginstatus == "")
                {
                    $redirect = base_url().'Signup_controller/login';
                }
                else
                {
                    $redirect = base_url().'transReport';
                }
                $x = "Your Payment has been Successful.";
                echo '<script language="javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'bootbox.alert({
                      message: "'.$x.'",
                      callback: function () {
                      location.href = "'.$redirect.'";
                    }
                })';
                echo '});';
                
                echo '</script>';
            }
            else
            {
                echo "FAILED DB";
            }
            
            
            
            
            
        }
       
    }
            
    public function transactionReport()
    {
        $service =  $this->Access_model->showAdminService();
        $loginstatus   = $this->session->userdata('logged_in'); 
        $parent_id = $loginstatus['parent_id'];
        //  print_r($loginstatus); die;
        $locid = $this->ChildReportListModel->loctionId($parent_id); 
        $info = $this->Signup_model->personalInfo($parent_id);


        $parentName = $this->ChildReportListModel->parentName($parent_id);
        $parentList = $this->Signup_model->parentName();
         $childName = $this->ChildReportListModel->allChild($parent_id);
         $discount = $this->ChildReportListModel->discount($parent_id);



        $allChild = array();
        for($i=0;$i<count($childName);$i++)
        {
           array_push($allChild,$childName[$i]['id']);
        }
        $allParent = array();
        for($i=0;$i<count($parentList);$i++)
        {
           array_push($allParent,$parentList[$i]['id']);
        }

       // print_r($locid); die;

        $childItem = $this->ChildReportListModel->transactionReport($parent_id,$allChild, $locid['0']['locid']);

      //  print_r($childItem); die;
        $allChildName = $this->ChildReportListModel->allChildName($allParent);


        $allParentChild = array();
        for($i=0;$i<count($allChildName);$i++)
        {
           array_push($allParentChild,$allChildName[$i]['id']);
        }

        $parentItem = $this->ChildReportListModel->parentitemName($allParent,$allParentChild,$locid['0']['locid']);


        if($info['type']=='Business Manager')
        {
            $this->load->view('Parent/childTransReportView', ['serviceData'=>$service,
            'parentName'=>$parentName,'parentItem'=>$parentItem,'child'=>$childName,'personalInfo'=>$info,'parentList'=>$parentList,
            'date1'=>'','date2'=>'']);
        }else{
            $this->load->view('Parent/childTransReportView', ['serviceData'=>$service,
            'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info,
            'date1'=>'','date2'=>'','discount'=>$discount]);
        }

    }
    
    public function transactionReportFilter()
    {
        $service =  $this->Access_model->showAdminService();
        $loginstatus   = $this->session->userdata('logged_in'); 
        $parent_id = $loginstatus['parent_id'];
        $locid = $this->ChildReportListModel->loctionId($parent_id);
        $info = $this->Signup_model->personalInfo($parent_id);

      
      //  print_r($loginstatus); die;
        $parentName = $this->ChildReportListModel->parentName($parent_id);
        $parentList = $this->Signup_model->parentName();
       
        $childName = $this->ChildReportListModel->allChild($parent_id);
      
        
        $allChild = array();
        for($i=0;$i<count($childName);$i++)
        {
           array_push($allChild,$childName[$i]['id']);
        }
        $allParent = array();
        for($i=0;$i<count($parentList);$i++)
        {
           array_push($allParent,$parentList[$i]['id']);
        }
        


            $childItem = $this->ChildReportListModel->itemName($parent_id,$allChild);
            $allChildName = $this->ChildReportListModel->allChildName($allParent);


            $allParentChild = array();
            for($i=0;$i<count($allChildName);$i++)
            {
               array_push($allParentChild,$allChildName[$i]['id']);
            }

         //   print_r($allParentChild); die;


        if($this->input->server('REQUEST_METHOD') == 'POST'){

            if($info['type'] == 'Parent')
            {
            
            $this->form_validation->set_rules('date1', 'From Date', 'trim');
            $this->form_validation->set_rules('date2', 'To Date', 'trim');
            $this->form_validation->set_rules('child', 'Name', 'trim');
            
            $discount = $this->ChildReportListModel->discount($parent_id);
                        if ($this->form_validation->run() == FALSE)
                        {
                            
                            $this->load->view('Parent/childTransReportView',['serviceData'=>$service,
                            'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info]);
                        }
                        else
                        {
                        
                        
                        

                            $date1 	= $this->security->xss_clean($this->input->post('date1'));
                            $date2 	= $this->security->xss_clean($this->input->post('date2'));
                            $child 	= $this->security->xss_clean($this->input->post('child'));
                         
                            
                            $discount = $this->ChildReportListModel->discount($parent_id); 
                        
                            
                            if(!empty($child))
                            {
                                $result_str = "'" . implode ( "', '", $child ) . "'";
                                $result="and a.child_id IN($result_str)";
                            }
                            else
                            {
                             $result = '';
                            }
                            $parentName1 = $this->ChildReportListModel->parentName($parent_id);
                                if($date1 !='' and $date2!=''){

                                    $date1 = date("Y-m-d", strtotime($date1));
                                    $date2 = date("Y-m-d", strtotime($date2));
                                    $date_str = "AND b.transactionDate BETWEEN '$date1' AND '$date2'";
                                }else{
                                    $date_str ='';
                                }
                            $childItem1 = $this->ChildReportListModel->transactionReportFilter($locid['0']['locid'],$parent_id,$result,$date_str);
                            $childName1 = $this->ChildReportListModel->allChild1($parent_id,$result);

                        
                           $this->load->view('Parent/childTransReportView',['serviceData'=>$service,
                           'parentName'=>$parentName1,'childItem'=>$childItem1,'child'=>$childName1,'personalInfo'=>$info
                            ,'date1'=>$date1,'date2'=>$date2,'discount'=>$discount]);
                        }


            }
            
            else{

                        $this->form_validation->set_rules('date1', 'From Date', 'trim');
                        $this->form_validation->set_rules('date2', 'To Date', 'trim');
                        $this->form_validation->set_rules('parent', 'Name', 'trim');
                        
                        
                        if ($this->form_validation->run() == FALSE)
                        {
                       
                            $this->load->view('Parent/childTransReportView',['serviceData'=>$service,
                            'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info]);
                        }
                        else{
                                $date1 	= $this->security->xss_clean($this->input->post('date1'));
                                $date2 	= $this->security->xss_clean($this->input->post('date2'));
                                $parent 	= $this->security->xss_clean($this->input->post('parent'));
                                if(!empty($parent))
                                {

                                    $result_str = "'" . implode ( "', '", $parent ) . "'";
                                    $result="and  a.parent_id IN($result_str)";
                                }

                                else
                                {
                                $result = '';
                                }
                            
                                if($date1 !='' and $date2!=''){

                                        $date1 = date("Y-m-d", strtotime($date1));
                                        $date2 = date("Y-m-d", strtotime($date2));
                                    $date_str = "AND b.transactionDate BETWEEN '$date1' AND '$date2'";
                                }else{
                                    $date_str ='';
                                }

                            
                                $parentItem = $this->ChildReportListModel->transactionReportFilter1($locid['0']['locid'],$date_str,$result);
                            
                                $this->load->view('Parent/childTransReportView',['serviceData'=>$service,
                                'parentItem'=>$parentItem,'parentList'=>$parentList,'personalInfo'=>$info,
                                'date1'=>$date1,'date2'=>$date2]);
                            }
                            

                            }
               
                
            }

    }
    
    public function ajaxTransactionReport()
    {
        $transactionID = $this->input->post('transactionID');
         
        $service =  $this->Access_model->showAdminService();
        $loginstatus   = $this->session->userdata('logged_in'); 
        $parent_id = $loginstatus['parent_id'];
        //  print_r($loginstatus); die;
        $locid = $this->ChildReportListModel->loctionId($parent_id); 
        $info = $this->Signup_model->personalInfo($parent_id);


        $parentName = $this->ChildReportListModel->parentName($parent_id);
        $parentList = $this->Signup_model->parentName();
         $childName = $this->ChildReportListModel->allChild($parent_id);
         $discount = $this->ChildReportListModel->discount($parent_id);



        $allChild = array();
        for($i=0;$i<count($childName);$i++)
        {
           array_push($allChild,$childName[$i]['id']);
        }
        $allParent = array();
        for($i=0;$i<count($parentList);$i++)
        {
           array_push($allParent,$parentList[$i]['id']);
        }

       // print_r($locid); die;

        $childItem = $this->ChildReportListModel->ajaxTransactionReport($parent_id,$allChild, $locid['0']['locid'], $transactionID);
        $allChildName = $this->ChildReportListModel->allChildName($allParent);


        $allParentChild = array();
        for($i=0;$i<count($allChildName);$i++)
        {
           array_push($allParentChild,$allChildName[$i]['id']);
        }

        $parentItem = $this->ChildReportListModel->parentitemName($allParent,$allParentChild,$locid['0']['locid']);

       // print_r($childItem); die;
        $data['dataItem'] = $childItem;
        $data['parentName'] = $parentName['0']['ParentName'];
        $data['motherName'] = $parentName['0']['MotherName'];
        echo json_encode($data);
        
        
        
        
        
/*
        if($info['type']=='Business Manager')
        {
            $this->load->view('Parent/childTransReportView', ['serviceData'=>$service,
            'parentName'=>$parentName,'parentItem'=>$parentItem,'child'=>$childName,'personalInfo'=>$info,'parentList'=>$parentList,
            'date1'=>'','date2'=>'']);
        }else{
            $this->load->view('Parent/childTransReportView', ['serviceData'=>$service,
            'parentName'=>$parentName,'childItem'=>$childItem,'child'=>$childName,'personalInfo'=>$info,
            'date1'=>'','date2'=>'','discount'=>$discount]);
        } 
 */
         
         
    }


    public function bmTranscReport()
    {
      
       $service =  $this->Access_model->showAdminService();
       $loginstatus   = $this->session->userdata('logged_in'); 
       $parent_id = $loginstatus['parent_id'];
       $locid = $this->ChildReportListModel->loctionId($parent_id);


       $transaction = $this->ChildReportListModel->allTransaction($locid['0']['locid']);

       // print_r($transaction['0']); die;

       $this->load->view('Parent/bmTransactionReport',['serviceData'=>$service,
                               'transaction'=>$transaction,'date1'=>'','date2'=>'','status'=>'']);
    }



    public function bmTransactionReport()
    {
          $service =  $this->Access_model->showAdminService();
                 $loginstatus   = $this->session->userdata('logged_in'); 
                  $parent_id = $loginstatus['parent_id'];
                   $locid = $this->ChildReportListModel->loctionId($parent_id);

                        $this->form_validation->set_rules('date1', 'From Date', 'trim');
                        $this->form_validation->set_rules('date2', 'To Date', 'trim');
                        $this->form_validation->set_rules('status', 'Transaction Status', 'trim');
                        
                        
                        if ($this->form_validation->run() == FALSE)
                        {
                             $transaction = $this->ChildReportListModel->allTransaction($locid['0']['locid']);
                       
                            $this->load->view('Parent/bmTransactionReport',['serviceData'=>$service, 'transaction'=>$transaction
                            ,'date1'=>'','date2'=>'','status'=>'']);
                        }
                        else{
                                $date1  = $this->security->xss_clean($this->input->post('date1'));
                                $date2  = $this->security->xss_clean($this->input->post('date2'));
                                $status = $this->security->xss_clean($this->input->post('status'));

                              //  echo $status; die;

                                if($date1 !='' and $date2!=''){

                                $date1 = date("Y-m-d", strtotime($date1));
                                $date2 = date("Y-m-d", strtotime($date2));
                                $date_str = "AND a.transactionDate BETWEEN '$date1' AND '$date2'";
                                }else{
                                    $date_str ='';
                                }

                               // print_r($date_str); die;

                                $transaction = $this->ChildReportListModel->allTransactionFilter($locid['0']['locid'],$date_str,$status);

                                // print_r($transaction); die;

                                $this->load->view('Parent/bmTransactionReport',['serviceData'=>$service,'status'=>$status,
                               'transaction'=>$transaction,'date1'=>$date1,'date2'=>$date2 ]);

                            }
    }



    public function bmTranscationItemPopup()
{
    $transactionID = $this->input->post('transactionID');

    $transactionItem = $this->ChildReportListModel->transactionItem($transactionID);

    $discount = $this->ChildReportListModel->bmTransactiondiscount($transactionID);
    // $transactionMeal = $this->ChildReportListModel->transactionMeal($transactionID);

   

      $data['transactionItem'] = $transactionItem;
      $data['discount'] = $discount;
     // $data['transactionMeal'] = $transactionMeal;
    echo  json_encode($data);

 
}
   
}?>

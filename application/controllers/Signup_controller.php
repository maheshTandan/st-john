<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'Requests/library/Requests.php';

//require APPPATH . 'libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

//require APPPATH . 'libraries/Format.php'; 
//echo APPPATH; die;
   class Signup_controller extends CI_Controller {

   	public function __construct()
   	{
         parent :: __construct(); date_default_timezone_set('Asia/Kolkata');
          	$this->load->model(array('Signup_model','Access_model'));
          	 $this->load->helper( array('form','url','email' )); 
          	 $this->load->library(array('session','form_validation','email'));
                 
                 
                
                Requests::register_autoloader();

       
   	} 


	
    public function index() 
    { 
    	 $loc = $this->Signup_model->showlocation();
    	  $grade = $this->Signup_model->showGrade();
    	  $marital = $this->Signup_model->showMarital();

    	//  print_r($grade); die;
         
		 $this->load->view('signup/signup',['location'=>$loc,'GradeProgram'=>$grade,
		 'marital'=>$marital,'flag'=>'0']); 
    } 


    public function RegisterUser()

    {

    	 $loc = $this->Signup_model->showlocation();
    	  $grade = $this->Signup_model->showGrade();
    	  $marital = $this->Signup_model->showMarital();
    	 // print_r($grade); die;

    	  if($this->input->server('REQUEST_METHOD') == 'POST'){
	        $this->form_validation->set_rules('father_name', 'Father Name', 'trim');
			$this->form_validation->set_rules('mother_name', 'Mother Name', 'trim');
			$this->form_validation->set_rules('marital[]', 'Marital Status', 'trim|required');
			$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
			$this->form_validation->set_rules('cell_phone', 'Cell', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
	        $this->form_validation->set_rules('state', 'State ', 'trim|required');
			$this->form_validation->set_rules('zip', 'Zip ', 'numeric|trim|required');
			$this->form_validation->set_rules('cfirst_name[]', 'Child First Name', 'trim');
			$this->form_validation->set_rules('cmiddle_name[]', 'Child Middle Name', 'trim');
			$this->form_validation->set_rules('clast_name[]', 'Child Last Name', 'trim');
			$this->form_validation->set_rules('DOB[]', 'Date of Birth', 'trim');
			
		

			if ($this->form_validation->run() == FALSE)
			{
				
				
				$this->load->view('signup/signup',
				['location'=>$loc,'GradeProgram'=>$grade,'marital'=>$marital,'flag'=>'0']);
			}

			else
			{
			  	$fatherName 	= $this->security->xss_clean($this->input->post('father_name'));
				$motherName 	= $this->security->xss_clean($this->input->post('mother_name'));
				$maritalStatus 	= $this->security->xss_clean($this->input->post('marital'));
				$email 		= $this->security->xss_clean($this->input->post('email'));
				$cellphone 	= $this->security->xss_clean($this->input->post('cell_phone'));
				$address 		= $this->security->xss_clean($this->input->post('address'));
				$city 	= $this->security->xss_clean($this->input->post('city'));
				$state 	= $this->security->xss_clean($this->input->post('state'));
				$zip 	= $this->security->xss_clean($this->input->post('zip'));
				$CfirstName = $this->security->xss_clean($this->input->post('cfirst_name[]'));
	            $CmiddleName 	= $this->security->xss_clean($this->input->post('cmiddle_name[]'));
				$ClastName 		= $this->security->xss_clean($this->input->post('clast_name[]'));
				$DOB 	= $this->security->xss_clean($this->input->post('DOB'));
				
				$Gradlocation= $this->security->xss_clean($this->input->post('location'));
				$location1= $this->security->xss_clean($this->input->post('location1'));
				 
				$token = $this->security->xss_clean(md5($this->input->post('email')).md5(date('Y-m-d')));
				$email1 = $this->security->xss_clean(md5($this->input->post('email')));

              //  $price= $this->security->xss_clean($this->input->post('price'));

              //   print_r($maritalStatus['0']); die;

                   $locid = $this->Signup_model->getlocationid($location1['0']);
                   $checkemail = $this->Signup_model->getcheckEmail($email);
                 //  print_r($checkemail); die;
                //   print_r($Gradlocation); die;
				
                $insertFather = '';
               if(!empty($checkemail['count']))
               { 
				//echo "Hiiiiiii"; die;
				 $this->load->view('signup/signup',['location'=>$loc,
				 'GradeProgram'=>$grade,'marital'=>$marital,'flag'=>'1']);
                
                }
            else{
				
               	   $strFather = "";
		            $strFather = "'".$fatherName."', '', '', '".$motherName."','','', '','".$email."','".$cellphone."', '', '0','','".$maritalStatus['0']."', 'Parent', '".$address."', '".$city."', '".$state."', '".$zip."','','','','".$token."' ";
	             
					$insertFather = $this->Signup_model->insertfather($strFather);
                    $row_parentid = $this->db->insert_id();

        //             $strmother = "";
		      //       $strmother = "'".$motherName."', '', '', '','','','','".$row_parentid."','Mother','' ,''  ,'' ,'' ,'' ,'' ,'' ,'','' ";
				    // $insertMother = $this->Signup_model->insertmother($strmother);

                    $locparentid = "";
                    $locparentid = " '". $row_parentid."','72290' ";

                    $insertlocparentid = $this->Signup_model->insertlocid($locparentid);
             

           
          // 
       // print_r(($CfirstName));
          	if($CfirstName['0'] != '')
          	{
				
          		 $str = "";
       
				for($i=0; $i<count($CfirstName); $i++)
				{
					
			     $price = $this->Signup_model->getGradePrice($Gradlocation[$i]);
			   // print_r($price); die;
				 $z = '';
                 if($i == '0'){

                 $OptionsRadiosInline= $this->security->xss_clean($this->input->post('optionsRadiosInline'.$z));
                 $gender = $OptionsRadiosInline[$i];

                 }else{
                 $OptionsRadiosInline= $this->security->xss_clean($this->input->post('optionsRadiosInline'.$i));
  
                 	$gender = $OptionsRadiosInline['0'];
                 }
  
             	   $str = "'".$CfirstName[$i]."','".$CmiddleName[$i]."','".$ClastName[$i]."','','','','".$gender."','','','".$DOB[$i]."','".$row_parentid."','child','','','','','','','".$Gradlocation[$i]."','".$price['price']."',''".",''".",''";
            
                    $insertChild=  $this->Signup_model->insertChild($str);
     

				}

            	}
            	// else{
            	// 	//print_r($CfirstName); die;
            	// 	 $this->load->view('signup/signup',['location'=>$loc,'GradeProgram'=>$grade,'marital'=>$marital]);
            	// }
            }

             

           

// print_r($insertFather); die;
          	
				
			if($insertFather)
				{
					    
                       $insertToken = $this->Signup_model->gettokenEmail($email);
					   $email1 = md5($insertToken['email']); 
						
						$to = $insertToken['email'];
						$subject = "Set your password";
						$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								<!--[if !mso]><!-->
								<meta http-equiv="X-UA-Compatible" content="IE=edge" />
								<!--<![endif]-->
								<meta name="viewport" content="width=device-width, initial-scale=1.0" />
								<title>Thanks for Attending Our Event #TransformGiving!</title>  
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
														    <h4 style="font-weight:600;    margin-top: 0;">Hi ,</h4>
															<p>We want to help you set your password </p>
						
															<p>Click on the button and a link is send to your registered email for password </p>
						
															</td>
													</tr>
													<tr>
																	<td style="width:100%;color:#fff;padding: 30px 20px;;background: #fff;line-height:1.6em;text-align: left; padding-top: 0;">
																	<a href="'.base_url().'Signup_controller/passwordform/'.$insertToken['id'].'/'.$insertToken['token'].'/'.$email1.'" style="padding: 10px 30px; color: #fff; background-color: #fff;text-decoration: none;font-weight: 600;font-size: 0.8em;background: #fdbb2a;border-radius: 2px;">
																	Set your Password</a>
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

				 $this->load->view('signup/signupComplete');
				 }

			      
	                
				}
				
			}
		}



		public function ajaxGradeprice()
		{
		 $resultData = $this->input->post('selectedChild'); 
		 	 $dataval = $this->input->post('val');
		 	// print_r($resultData); die; 

         $resultPrice = $this->Signup_model->getpriceGrade($resultData);

			  $msg['success'] = false;
			        $msg['type'] = 'add';

			        if($resultPrice){
			            $msg['success'] = $resultPrice;
			        }
			          echo json_encode($msg);
      

		}
		public function passwordform()
		{

			$email =$this->uri->segment('5');
			$id =$this->uri->segment('4');
			$userid = $this->uri->segment('3');

			// print_r($userid); die;
            
               $res = $this->Signup_model->tokenData();
               $token = $res[0]->token ;
               $email1 = md5($res[0]->email); 
              

               if($token && $email1)
               { 

               	if($id == $token || $email == $email1)
               	{
                       
                       $email2=$res[0]->email;
                       $this->load->view('signup/password',['a'=>$email2,'email'=>$email,'token'=>$id,'id'=>$userid]);
               	}

               	
               }
               else{
               	echo "please signup with your email";
               }
          	
     }
	

        public function login()
        {
            if ($this->input->server('REQUEST_METHOD') == 'POST') 
            {
                $this->form_validation->set_rules('pwd1', 'Password', 'trim|required');
                $this->form_validation->set_rules('pwd2', 'Re-Password', 'required|matches[pwd1]|trim');
                $email = $this->security->xss_clean($this->input->post('email'));
                $token = $this->security->xss_clean($this->input->post('token'));
                $id = $this->security->xss_clean($this->input->post('id'));
                $email1 = $this->security->xss_clean($this->input->post('email2'));

                if ($this->form_validation->run() == FALSE) 
                {
                    $this->load->view('signup/password', ['a' => $email1, 'email' => $email, 'token' => $token, 'id' => $id]);
                } 
                else 
                {


                    $password = $this->security->xss_clean($this->input->post('pwd1'));
                    $repassword = $this->security->xss_clean($this->input->post('pwd2'));
                    $email = $this->security->xss_clean($this->input->post('email2'));


                    $insertData = array('password' => $password,
                        'userid' => $email,
                        'status' => '1',
                        'type' => 'Parent');

                    $insert = $this->Signup_model->insertUserlogin($insertData);

                    if ($insert) 
                    {
                       //print_r("hiiiii"); die;
                       //$this->load->view('login/login',['flag'=>'1']);
                       //redirect('profileform','refresh');
                       $this->profileform();
                    } 
                    else 
                    {
                       echo "User already registered";
                    }
                }
            } 
            else 
            {
                // print_r("ggfhhjklk"); die;
                $headers = array('Accept' => 'application/json');
                $options = array('auth' => array('user', 'pass'));
                $request = Requests::get('https://api.github.com/gists', $headers, $options);
                
                //echo "<br>";
               // print_r($request);
               // echo "<br>";
               // var_dump($request->status_code);
                // int(200)

               // echo "<br>";
               // var_dump($request->headers['content-type']);
                // string(31) "application/json; charset=utf-8"

              //  echo "<br>";
              //  var_dump($request->body);
                // string(26891) "[...]"
                
              //  echo "<br>HI".phpversion(); 
                $this->load->view('login/login', ['flag' => '1']);
            }
        }

	public function profileform()
	{
            
            
            if($this->input->server('REQUEST_METHOD') == 'POST')
            {
                $this->form_validation->set_rules('email', 'Email', 'trim');
                $this->form_validation->set_rules('Password', 'Password ', 'trim');

                if ($this->form_validation->run() == FALSE)
                {

                    $this->load->view('login/login',['flag'=>'1']);
                }
                else
                {
                    // print_r("helllllllpoooooo"); die;
                    $flag= '';
                    $flag1='';
                    $email 	= $this->security->xss_clean($this->input->post('email'));
                    $password 	= $this->security->xss_clean($this->input->post('Password'));

                    $result =  $this->Signup_model->loginCheck($email,$password);
                    //  print_r($result); die;
                    if($email !='' && $password != '')
                    {
                        $status = $result['status'];
                        $refid = $result['ref_id'];
                        $signup_status = $result['signup_status'] ;
                        $id = $result['id'];
                        $status1 = $result['status1'];
                        $type=$result['type'];
                        $Name =$result['Name'];
                        if($result['Name'] != '')
                        {
                                 $flag =1;
                        }
                        else
                        {
                                 $flag = 0;
                        }

                        if($status == 1 && $signup_status == 1)
                        {
                            $this->set_session($id,$email,$status1,$refid,$type,$Name);
                            $service =  $this->Access_model->showAdminService();

                                if($type=='Super Admin')
                                {

                                    redirect('SARedirection');
                                         //$this->load->view('profile/manageprofile',['serviceData'=>$service]);
                                }
                                elseif($type=='Business Manager')
                                {
                                    redirect('menuitemsel/index');
                                }
                                else
                                {
                                        //  print_r("helllllllpoooooo"); die;
                                        $this->Signup_model->userprofile();
                                        redirect('monthlyview');
                                 } 

                        }
                        else
                        {
                                   // print_r("gfhjkl"); die;
                        //	print_r($flag); die;
                          $this->load->view('login/login',['flag'=>$flag]);
                        }
                    }
                    else
                    {
                        $this->load->view('login/login',['flag'=>'1']);
                    }
                }
            }
            else
            {
                echo "Please login with your account for check profile.";
	    }
	}


	public function logout()
	 {
             
	 	foreach (array_keys($this->session->userdata) as $key)
           {
               $this->session->unset_userdata($key);
           }
              $this->load->view('login/login',['flag'=> '1']);
	}

	public function set_session($id,$email,$status,$ref_id,$type,$Name){

		      
          
		                $session_data = array('id'=> $id,
		         	                          'user'=>$email,
		         	                          'name'=>$Name,
		         	                          'status'=>$status,
		         	                          'parent_id'=>$ref_id,
		         	                          'type'=>$type

		                                      );
 
      $this->session->set_userdata('logged_in',$session_data);


	}


	public function forgetPassword()
	{

		$this->load->view('login/password_Email_Verification',['flag'=>0]);
	}

	public function emailVerify()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$this->form_validation->set_rules('email', 'Email Address','trim|required|valid_email');
			if ($this->form_validation->run() == FALSE)
			{
				
				$this->load->view('login/password_Email_Verification',['flag'=>0]);
			}

			else
			{
				$email 		= $this->security->xss_clean($this->input->post('email'));
                $email1 = $this->security->xss_clean(md5($this->input->post('email')));
                $result =  $this->Signup_model->emailCheck($email);
                $data['stuff'] = array('email1' => $email1,'id'=>$result['id']);
				
				// print_r($result); die;
			 
				 if(!empty($result))
				 {

					$to = $result['userid'];
					$subject = "Set your new password";
					$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<!--[if !mso]><!-->
							<meta http-equiv="X-UA-Compatible" content="IE=edge" />
							<!--<![endif]-->
							<meta name="viewport" content="width=device-width, initial-scale=1.0" />
							<title>Thanks for Attending Our Event #TransformGiving!</title>  
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
														<h4 style="font-weight:600;    margin-top: 0;">Hi ,</h4>
														<p>We want to help you set your password </p>
					
														<p>Click on the button and a link is send to your registered email for password </p>
					
														</td>
												</tr>
												<tr>
																<td style="width:100%;color:#fff;padding: 30px 20px;;background: #fff;line-height:1.6em;text-align: left; padding-top: 0;">
																<a href="'.base_url().'Signup_controller/passwordRecreate/'.$email1.'/'.$result['id'].'" style="padding: 10px 30px; color: #fff; background-color: #fff;text-decoration: none;font-weight: 600;font-size: 0.8em;background: #fdbb2a;border-radius: 2px;">
																Set your Password</a>
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

		// echo base_url()."Signup_controller/passwordform/".$insertToken['id']."/".$insertToken['token']."/".$email1; die;

		//  echo base_url()."Signup_controller/passwordRecreate/".$email1."/".$result['id']; die;
			$txt = $html;
		  
			$headers = "From: ST John <parish@mystjohns.org>\r\n";
			$headers .= "Content-type: text/html\r\n";
			mail($to,$subject,$txt,$headers); 
				    	$this->load->view('login/forget_password_Create',$data);
				 }
				 else
				 {
				    //	print_r("fhgjhkl"); die;
				    $flag = 1;
				 	$this->load->view('login/password_Email_Verification',['flag'=>$flag]);
				 }

			}
   }
}

	public function passwordRecreate()
	{
		$id = $this->uri->segment('4');
		 $data['stuff'] = array('id' => $id);
		 $flag =1;
		// print_r($data['stuff']['id']); die;
		$this->load->view('login/recreate_password',['id'=>$data['stuff']['id'],'flag'=>$flag]);
	}

	public function passwordCreate()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$flag= 1;
			$this->form_validation->set_rules('pwd1', 'Password', 'trim|required');
		    $this->form_validation->set_rules('pwd2', 'Re-Password', 'required|matches[pwd1]|trim');
		    $id = $this->security->xss_clean($this->input->post('emailid'));

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login/recreate_password',['flag'=>$flag,'id'=>$id]);
			}

			else
			{
			$password 	= $this->security->xss_clean($this->input->post('pwd1'));
			$repassword = $this->security->xss_clean($this->input->post('pwd2'));
			$id = $this->security->xss_clean($this->input->post('emailid'));
			$insertData = array('password'=>$password);
				
			$newPassword = $this->Signup_model->passwordCreate($id,$insertData);	
        
			 if(!empty($newPassword))
			 {
			 	$this->load->view('login/login',['flag'=>$flag]);
			 }

			}
        }
	}


	public function resetPassword()
	{
		$service1 =  $this->Access_model->showAdminService();
		$this->load->view('login/reset_password',['serviceData'=>$service1,'flag'=>'']);
	}

	public function createresetPassword()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$this->form_validation->set_rules('pwd1', 'Enter Your Old Password', 'trim|required');
		    $this->form_validation->set_rules('pwd2', 'New Password', 'required|trim');
      $service1 =  $this->Access_model->showAdminService();
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login/reset_password',['serviceData'=>$service1,'flag'=>'']);
			}

			else
			{
			$password 	= $this->security->xss_clean($this->input->post('pwd1'));
			$repassword = $this->security->xss_clean($this->input->post('pwd2'));

			$result = $this->Signup_model->checkpassword($password);
			if(!empty($result))
			{
			  $newPassword = $this->Signup_model->updatepassword($repassword,$result['id']);
            
			  if(!empty($newPassword))
			 {
				foreach (array_keys($this->session->userdata) as $key)
				{
					$this->session->unset_userdata($key);
				}
				   $this->load->view('login/login',['flag'=>'']);
			 }
			 else
			 {  
			 
                $this->load->view('login/reset_password',['serviceData'=>$service1,
                  'flag'=>'']);
			  }
			}

			else
			{

                 $this->load->view('login/reset_password',['serviceData'=>$service1,'flag'=>0]);
			}
		    }
		}
	}


public function bmPasswordReset()
{
     $service1 =  $this->Access_model->showAdminService();
       $id = $this->uri->segment('3');
      $this->load->view('login/bmPassword_reset',['serviceData'=>$service1,'parent_refid'=>$id,'flag'=>'']);
}


public function bmCreateResetPassword()
{
    $service1 =  $this->Access_model->showAdminService();
    $loginstatus   = $this->session->userdata('logged_in'); 
     $parentList = $this->Signup_model->parentName();
               
                 if($loginstatus["status"] != '1')
                 {
                    redirect('logout');
                 }

    if($this->input->server('REQUEST_METHOD') == 'POST')
    {
   
      $this->form_validation->set_rules('pwd1', 'Enter Your New Password', 'trim|required');
      $this->form_validation->set_rules('pwd2', 'Re-Enter New Password', 'required|trim');
      if ($this->form_validation->run() == FALSE)
      {
       
        $this->load->view('login/bmPassword_reset',['serviceData'=>$service1,'flag'=>'']);
      }
      else
      {
     
      $password   = $this->security->xss_clean($this->input->post('pwd1'));
      $repassword = $this->security->xss_clean($this->input->post('pwd2'));
      $refid = $this->security->xss_clean($this->input->post('parent_refid'));

      if($password != $repassword)
      {
                $this->load->view('login/bmPassword_reset',['serviceData'=>$service1,'flag'=>1,'parent_refid'=>$refid]);
                 
      }
      else
      {
         $result = $this->Signup_model->updateBmParentPassword($repassword, $refid);
          if($result == '1')
          {
              $this->load->view('login/bmPassword_reset',['serviceData'=>$service1,'flag'=>2,'parent_refid'=>$refid]);
          }
          else
          {
             $this->load->view('login/bmPassword_reset',['serviceData'=>$service1,'flag'=>'','parent_refid'=>$refid]);
          }

      }
  
      }

    }
}



	public function personalProfile()
	{
            
		$service1 =  $this->Access_model->showAdminService();
		$loginstatus   = $this->session->userdata('logged_in'); 
               
                 if($loginstatus["status"] != '1')
                 {
                    redirect('logout');
                 }
	
			$id = $this->uri->segment('3');
			$info = $this->Signup_model->personalInfo($id);
                       // print_r($info); die;
		$childinfo = $this->Signup_model->childInfo($info['id']);
	
        $childgradeinfo = $this->Signup_model->childGradeInfo();
	 
        $childclassInfo  = $this->Signup_model->childClass();
        $childcertificateInfo  = $this->Signup_model->childCertificate();
        //	print_r($childinfo); die;
        $selectChildClassCertificate = $this->Signup_model->childClassCertificate();
       // print_r($selectChildClassCertificate); die;
		$bmdiscount = $this->Signup_model->selectDiscount($id);
	
		$flag='';
		if(empty($bmdiscount))
		{ 
			$flag=1;
		}
		else{
		
			$flag=0;
		}


		$this->load->view('login/personal_info',['serviceData'=>$service1,'personalInfo'=>$info,
		'childInfo'=>$childinfo,'childgradeinfo'=>$childgradeinfo,'childclassInfo'=>$childclassInfo,
		'childcertificateInfo'=>$childcertificateInfo,'userId'=>$id,
		'selectChildClassCertificate'=>$selectChildClassCertificate,'bmdiscount'=>$bmdiscount,'flag'=>$flag]);
     
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
         
      $this->form_validation->set_rules('email', 'Email ', 'trim');
			$this->form_validation->set_rules('cell_phone', 'Cell', 'trim');
			$this->form_validation->set_rules('address', 'Address', 'trim');
			$this->form_validation->set_rules('city', 'City', 'trim');
	        $this->form_validation->set_rules('state', 'State ', 'trim');
			$this->form_validation->set_rules('zip', 'Zip ', 'trim');
		
			if ($this->form_validation->run() == FALSE)
			{
			    $this->load->view('login/personal_info',['serviceData'=>$service1,'personalInfo'=>$info,'childInfo'=>$childinfo,'childgradeinfo'=>$childgradeinfo]);
			}

			else
			{
    
			     
				$FatherName = $this->security->xss_clean($this->input->post('father_name'));
				$FatherMiddleName = $this->security->xss_clean($this->input->post('father_middle_name'));
				$FatherLastName = $this->security->xss_clean($this->input->post('father_last_name'));
				$MotherName = $this->security->xss_clean($this->input->post('mother_name'));
				$MotherMiddleName = $this->security->xss_clean($this->input->post('mother_middle_name'));
				$MotherLastName = $this->security->xss_clean($this->input->post('mother_last_name'));
				$cellphone 	= $this->security->xss_clean($this->input->post('cell_phone'));
				$address 	= $this->security->xss_clean($this->input->post('address'));
				$city 	= $this->security->xss_clean($this->input->post('city'));
				$state 	= $this->security->xss_clean($this->input->post('state'));
				$zip 	= $this->security->xss_clean($this->input->post('zip'));
				$discount 	= $this->security->xss_clean($this->input->post('discount'));
        $childDisableEnable   = $this->security->xss_clean($this->input->post('childEnable'));
				$id 	= $this->security->xss_clean($this->input->post('id'));
				$FirstName = $this->security->xss_clean($this->input->post('firstname'));
				$MiddleName = $this->security->xss_clean($this->input->post('middlename'));
				$LastName = $this->security->xss_clean($this->input->post('lastname'));
				$Gradlocation = $this->security->xss_clean($this->input->post('location'));
				$CfirstName = $this->security->xss_clean($this->input->post('cfirst_name'));
                                $CmiddleName = $this->security->xss_clean($this->input->post('cmiddle_name'));
				$ClastName 		= $this->security->xss_clean($this->input->post('clast_name'));
				$DOB 	= $this->security->xss_clean($this->input->post('DOB'));
				$AddGradlocation= $this->security->xss_clean($this->input->post('grad_location'));
				$classGrade= $this->security->xss_clean($this->input->post('classGrade[]'));
				$Certificate= $this->security->xss_clean($this->input->post('Certificate[]'));
				$childClass= $this->security->xss_clean($this->input->post('childClass[]'));
				$childcertificate= $this->security->xss_clean($this->input->post('childcertificate[]'));
				$childhiddenid= $this->security->xss_clean($this->input->post('childhiddenid[]'));
                                $email= $this->security->xss_clean($this->input->post('email'));

			//	print_r($discount); die;

				if($loginstatus['type'] == 'Business Manager')
				{
					 $insertDiscount = $this->Signup_model->insertDiscount($id,$discount);
				}

			  
							$data = array(
											'first_name'=>ucwords(strtolower($FatherName)),
											'middle_name'=>ucwords(strtolower($FatherMiddleName)),
											'last_name'=>ucwords(strtolower($FatherLastName)),
											'mother_name'=>ucwords(strtolower($MotherName)),
											'mother_middle_name'=>ucwords(strtolower($MotherMiddleName)),
											'mother_last_name'=>ucwords(strtolower($MotherLastName)),
											'email'=>$email,
                                                                                        'phone'=>$cellphone,
											'Address'=>ucwords(strtolower($address)),
											'City'=>ucwords(strtolower($city)),
											'State'=>ucwords(strtolower($state)),
											'Zip'=>$zip
										);

						

							$updatedata =  $this->Signup_model->updatePersonalInfo($data,$id);
                                                        $this->Signup_model->updateUserInfo($email,$id);
                                                        


             

						

        if($loginstatus['type'] == 'Parent')
        {
            $str1 = "";
                            if(!empty($FirstName))
                {
                for($i=0; $i< count($FirstName); $i++)
                {
                  
                    $str1 =array(
                          'first_name'=>ucwords(strtolower($FirstName[$i])),
                          'middle_name'=>ucwords(strtolower($MiddleName[$i])),
                          'last_name'=>ucwords(strtolower($LastName[$i])));
              
                    $updateChild=  $this->Signup_model->updateChildInfo($str1,$childinfo[$i]['id']);
                }
              }
        }


    if($loginstatus['type'] == 'Business Manager')
        {
            $str1 = "";
                            if(!empty($FirstName))
                {
                for($i=0; $i< count($FirstName); $i++)
                {
                  
                    $str1 =array(
                          'first_name'=>ucwords(strtolower($FirstName[$i])),
                          'middle_name'=>ucwords(strtolower($MiddleName[$i])),
                          'last_name'=>ucwords(strtolower($LastName[$i])),
                          'Child_Enable_Disable'=>$childDisableEnable[$i]);
              
                    $updateChild=  $this->Signup_model->updateChildInfo($str1,$childinfo[$i]['id']);
                }
              }
        }







						    $updateChildClassCertificate = "";

							if(!empty($childhiddenid))
							{
							    for($i=0;$i<count($childhiddenid);$i++)
							    {

										$updateChildClassCertificate = array(
															'class_id'=>$childClass[$i],
															'certificate_id'=>$childcertificate[$i],
															'child_id'=>$childhiddenid[$i]);
							
							            $updateChildClassCertificate=  $this->Signup_model->updateChildClassCertificateInfo($updateChildClassCertificate,$childhiddenid[$i]);
							    }
							}
							



							if(!empty($CfirstName))
							{
							

							$str = "";
				
							for($i=0; $i< count($CfirstName); $i++)
							{
								
							$price = $this->Signup_model->getGradePrice($AddGradlocation[$i]);

							if($i == '0'){

							$j=$i+1;
							$OptionsRadiosInline= $this->security->xss_clean($this->input->post('optionsRadiosInline'.$j));
							$gender = $OptionsRadiosInline['0'];


							}else{
							$OptionsRadiosInline= $this->security->xss_clean($this->input->post('optionsRadiosInline'.$i));
			
								$gender = $OptionsRadiosInline['0'];
							}
							
						
							$str = "'".$CfirstName[$i]."','".$CmiddleName[$i]."','".$ClastName[$i]."','','','','".$gender."','','','".$DOB[$i]."','".$id."','child','','','','','','','".$AddGradlocation[$i]."','".$price['price']."',''".",''".",''";
					
						
							$insertChild=  $this->Signup_model->insertChild($str);
						


							  $insertClassCertificate = $this->Signup_model->insertClassCertificate($insertChild,$classGrade[$i],$Certificate[$i]);

							  }
							}
						



                         //  print_r($info['type']); die;

							if(!empty($updatedata || $updateChild || $insertChild))
							{
									if($loginstatus['type']=='Super Admin'){
								header("Refresh:0");
									//redirect('SARedirection');
									
								}elseif($loginstatus['type']=='Business Manager'){
									//redirect('menuitemsel/index');
                   header("Refresh:0");

								}else{

									redirect('monthlyview');
								} 
							}
						}
					}

	}


	public function parentList()
	{
		 $service1 =  $this->Access_model->showAdminService();

		 $parentList = $this->Signup_model->parentName();
		// print_r($parentList); die;
		 $this->load->view('Parent/parentList',['serviceData'=>$service1,'parentList'=>$parentList]);
	}

}
	
?>
 

 

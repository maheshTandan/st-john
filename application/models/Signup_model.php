<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

   class Signup_model extends CI_Model {

       function __construct()
      {
            parent::__construct();
       }


        function showlocation()
        {
           $result = $this->db->query("select location from location");
           return $result->result_array();

        }

          function showGrade()
        {
           // $result = $this->db->query("select id, Grade_name,price from Child_Grade_Program_Selection");
           // return $result->result_array();
         $sql = "select b.id as id, CONCAT(a.Name,' - ',b.Grade,' : ',b.Name) As Grade_name, b.price as price from Unit as a  inner join Classes as b on a.id = b.Unit_id where b.Unit_id = 7"; 
                   $sql1 = $this->db->query($sql); 
                       return $sql1->result_array();

        }

        function showMarital()
        {
            $result = $this->db->query("select id, marital_status from parent_marital_status");
           return $result->result_array();
        }


        function insertfather($data)
        {
          $this->db->query('INSERT INTO person_details (first_name, middle_name,last_name,mother_name,mother_middle_name,mother_last_name,Gender,email,phone,dob,parent_id,parent_relation,parent_martial_status,type,Address,City,State,Zip,location,status,signup_status,token) VALUES ('.$data.")")  ;
          return true;

        }

        function insertmother($data)
        {
          $this->db->query('INSERT INTO person_details (first_name, middle_name,last_name,Gender,email,phone,dob,parent_id,parent_relation,type,Address,City,State,Zip,location,status,signup_status,token) VALUES ('.$data.")")  ;
          return true;

        }

        function insertChild($data)
        {
          $this->db->query('INSERT INTO person_details (first_name, middle_name,last_name,mother_name,mother_middle_name,mother_last_name,Gender,email,phone,dob,parent_id,parent_relation,parent_martial_status,type,Address,City,State,Zip,location,price,status,signup_status,token) VALUES ('.$data.")")  ;

           $row = $this->db->insert_id();

          return $row;

         }

         function insertClassCertificate($childid,$classid,$certificateid)
         {
          $loginstatus = $this->session->userdata('logged_in');
    
       $createdId = "select id from user where `ref_id` = ". $loginstatus['parent_id'];  
       $result1 = $this->db->query($createdId);
       $resultid = $result1->row_array();
      // print_r($classid);
       // print_r($certificateid); die;
        if($classid == '' || $certificateid == '')
        {
             $this->db->query("INSERT INTO student_class (class_id, certificate_id,child_id,status,createdBy) VALUES ('','', ".$childid.",1,".$resultid['id'].")")  ;
 
                $row = $this->db->insert_id();
        }

        else
        {

           $this->db->query("INSERT INTO student_class (class_id, certificate_id,child_id,status,createdBy) VALUES (".$classid.",".$certificateid.", ".$childid.",1,".$resultid['id'].")")  ;

           $row = $this->db->insert_id();
        }
         

          return $true;
         }


         function insertlocid($data)
         {
         // print_r($data); die;
          $this->db->query('INSERT INTO user_location (userid,locid) VALUES ('.$data.")");
          return true;
         }

         function getcheckEmail($email)
         {
            $result = $this->db->query("select count(email) as count from person_details where `email`='$email'");
           return $result->row_array(); 

         }

         function getlocationid($name)
         {
           $result = $this->db->query("select locid  from location where location='$name'");
           return $result->row_array(); 
         }

          function getgradeid($name)
         {
           $result = $this->db->query("select id from Child_Grade_Program_Selection where Grade_name='$name'");
           return $result->row_array(); 
         }
      

         function getGradePrice($id)
         {
          $result = $this->db->query("select price from Classes where id='$id'"); 
           return $result->row_array(); 
         }

         function getpriceGrade($id)
         {
          $result = $this->db->query("select id,price from Classes where id='$id'");
           return $result->row_array(); 
         }

         public function gettokenEmail($email)
         {
               
            $result = $this->db->query("select token,id,email from person_details where email='$email'");
            return $result->row_array(); 

          }

          public function tokenData()
          {
               
                $id = $this->uri->segment('3');
                $result = $this->db->query("select token,email from person_details where id='$id'");
               return $result->result(); 


          }

          public function insertUserlogin($password)
          {

               $email = $password["userid"];
               $result = $this->db->query("select id,status,signup_status from person_details where email='$email'");
               $query = $result->result();
               $refid=$query[0]->id; 
                $password["ref_id"]= $refid;

               if($this->db->insert('user', $password))
               {
                    $insertID =  $this->db->insert_id();
                    $insertData = array('parent_id' => $refid,
                        'bm_id' => 14,
                        'discount' => '0',
                        'status' => 1);
                    
                    if($this->db->insert('discount', $insertData))
                    {
                         return $insertID;
                    }
                } 
               else
               {
                return false;
                }


              
            }

            public function loginCheck($email,$password)
            {
               $sql = "select person_details.first_name as Name, person_details.status as status,person_details.signup_status as signup_status ,user.id as id,user.ref_id as ref_id, user.type as type,user.status as status1, user.password as password from person_details LEFT JOIN user ON person_details.email = user.userid  where userid='$email' and  password = '$password'"; 
                 $sql1 = $this->db->query($sql); 

                  $row =  $sql1->row_array();

                    if(empty($row['id']))
                     {
                        return false;
                 
                     }
                     
                    else
                     { 

                          $sql = "UPDATE person_details SET status= '1' ,signup_status = '1' WHERE email = '$email' ";
                            $sql1 = $this->db->query($sql); 

                          // $sql2 = "UPDATE user SET status= '1' WHERE userid = '$email' ";
                          //   $sql3 = $this->db->query($sql2); 
                              return $row;
                     }
            }

             public function emailCheck($email)
             {

               $sql = "select id,userid from user where userid = '$email'";
               $sql1 = $this->db->query($sql); 
               return $sql1->row_array();
             }


             public function passwordCreate($id,$data)
             {
              $this->db->update('user', $data, "id = '$id'");
              return true;
             }



             public function checkpassword($password)
             {
                    $loginstatus   = $this->session->userdata('logged_in'); 
                    $userid = $loginstatus['user'];
                    $sql = "select id from user where password = '$password' AND userid= '$userid'"; 
                    $sql1 = $this->db->query($sql); 
                    return $sql1->row_array();


             }


             public function updatepassword($password,$id)
             { 
                $sql = "UPDATE user SET password= '$password' WHERE id = '$id' "; 
                $sql1 = $this->db->query($sql); 
                 return true;
             }

               public function updateBmParentPassword($password,$id)
             { 
                $sql = "UPDATE user SET password= '$password' WHERE ref_id = '$id' "; 
                $sql1 = $this->db->query($sql); 
                 return true;
             }


             public function personalInfo($id)
             {
               $loginstatus   = $this->session->userdata('logged_in'); 
               $email =  $loginstatus['user']; 
          //   print_r($loginstatus['type']); die;
               $sql = "select a.id,a.first_name,a.middle_name,a.last_name,a.mother_name,a.mother_middle_name,a.mother_last_name,a.email,a.phone,a.Address,a.City,a.State,a.Zip,a.type,a.parent_martial_status,a.datetime_added as Last_login,b.marital_status from person_details a left join parent_marital_status b on a.parent_martial_status = b.id where a.id = '$id' "; 
                       $sql1 = $this->db->query($sql); 
                       return $sql1->row_array();
             }


             public function childInfo($id)
             {

               $sql = "select id,first_name,middle_name,last_name,location,dob,Child_Enable_Disable from person_details where parent_id = '$id' and parent_relation = 'child' ";
                       $sql1 = $this->db->query($sql); 
                       return $sql1->result_array();
             }


             public function childGradeInfo()
             {
                  $sql = "select b.id as id, CONCAT(a.Name,' - ',b.Grade,' : ',b.Name) As Grade_name, b.price as price from Unit as a  inner join Classes as b on a.id = b.Unit_id where b.UNIT='RELIGIOUSED2018'"; 
                     $sql1 = $this->db->query($sql); 
                       return $sql1->result_array();

             }

             public function parentInfo($id)
             {
                     $sql = "select a.id,a.first_name,a.middle_name,a.last_name,a.mother_name,a.mother_middle_name,a.mother_last_name,a.email,a.phone,a.Address,a.City,a.State,a.Zip,a.type,a.parent_martial_status,a.datetime_added as Last_login,b.marital_status from person_details a inner join parent_marital_status b on a.parent_martial_status = b.id where a.id = '$id' ";
                     $sql1 = $this->db->query($sql); 
                     return $sql1->result_array();
             }

             public function childClass()
             {

                     $sql = "select b.id as id, CONCAT(a.Name,' - ',b.Grade,' : ',b.Name) As ClassName from Unit as a
                             inner join Classes as b on a.id = b.Unit_id where b.type='School'";
                     $sql1 = $this->db->query($sql); 
                     return $sql1->result_array();
             }

             public function childCertificate()
             {

                      $sql = "select id,Certificate_Type As Name from Certification";
                      $sql1 = $this->db->query($sql); 
                      return $sql1->result_array();
             }


             public function childClassCertificate()
             {
                      $sql = " select c.class_id as id,CONCAT(a.Name,' - ',b.Grade,' : ',b.Name) As ClassName, d.Certificate_Type as Certificte,d.id as certificate_id,c.child_id as childid from Unit as a inner join Classes as b on a.id = b.Unit_id inner join student_class as c on c.class_id = b.id inner join Certification as d on d.id = c.certificate_id";
                      $sql1 = $this->db->query($sql); 
                      return $sql1->result_array();

             }
             
             public function insertDiscount($parentid,$discount)
             {
                      $loginstatus   = $this->session->userdata('logged_in'); 
                      $sql = "select parent_id  from discount where parent_id = '$parentid'"; 
                      $sql1 = $this->db->query($sql); 

                      $row = $sql1->row_array();
               
                 if($row['parent_id'] == '' || $row['parent_id'] != $parentid)
                  {
                      if($discount == '')
                      {
                          $this->db->query("INSERT INTO discount (parent_id, bm_id,discount,status) VALUES (".$parentid.",".$loginstatus['id'].",0,1)"); 
                      }

                     else
                     {
                        $this->db->query("INSERT INTO discount (parent_id, bm_id,discount,status) VALUES (".$parentid.",".$loginstatus['id'].", ".$discount.",1)"); 
                     }
                    
                  }
                 else
                  {
                     if($discount == '')
                     {
                           $this->db->query("UPDATE `discount` SET  `discount` = '0' where `parent_id`='$parentid' "); 
                     }
                     else
                     {
                        $this->db->query("UPDATE `discount` SET  `discount` = '$discount' where `parent_id`='$parentid' "); 
                     }
                      
                  }
                  return true;
             }


             public function selectDiscount($parentid)
             {
            
              $sql = "select discount from discount where parent_id = '$parentid'"; 
              $sql1 = $this->db->query($sql); 

              return $sql1->result_array();

             }
            public function updatePersonalInfo($data,$id)
            {
           

              $this->db->update('person_details', $data, "id = '$id'");
              return true;
        
              
            }
            
            public function updateUserInfo($email,$id)
            {
              $this->db->query("UPDATE `user` SET  `userid` = '$email' where `ref_id`='$id' "); 
              return true;
            }


            public function updateChildInfo($data,$id)
            {
               
               $this->db->update('person_details', $data, "id = '$id'"); 
                return true;
            }

            public function updateChildClassCertificateInfo($data,$id)
            {
               $this->db->update('student_class', $data, "child_id = '$id'"); 
                return true;
            }

            public function userprofile()
            {

                        $loginstatus   = $this->session->userdata('logged_in'); 
                        $id =  $loginstatus['id']; 
                        $sql = "select user_id from user_profile_mapping  where user_id = '$id' ";
                        $sql1 = $this->db->query($sql); 
                        $userid = $sql1->row_array();
                        $id1 = $userid['user_id'];

                      // echo $id1; die;

                        if($id1 == $id)
                        {
                          return false;
                        }
                        else
                        {
                          $this->db->query("INSERT INTO user_profile_mapping (user_id,profile_id) VALUES (".$id.",126)");
                          return true;
                        }

                   

               
            }



            public function parentName()
            {

            // $sql = "select id,first_name,mother_name,email,phone,status from person_details where parent_id = '0' and type = 'Parent' "; 

             $sql = "select id,concat(first_name, ' ', last_name) as `first_name`,CONCAT(mother_name,' ',mother_last_name) as mother_name,email,phone,status from person_details where parent_id = '0' and type = 'Parent' Group by first_name,mother_name"; 
                       $sql1 = $this->db->query($sql); 

                       return $sql1->result_array();
            }


           
          } 
          ?>
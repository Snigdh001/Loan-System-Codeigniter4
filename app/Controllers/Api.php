<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

use App\Models\Register;

class Api extends  Controller
{
    use ResponseTrait;
    protected $table='registeruser';
    
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE, get, post");
        // parent::__construct();
        // header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
        
    }
    public function allusers()
    {   
 
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
  
        $data=$this->db->table('registeruser')->select()->where('role',"user")->get()->getResultArray();
        return $this->respond($data);
    }
    public function signup()
    {  
        // die("code die here to yout bt");
        // $fname = $this->request->getJsonVar('fname',true);
        // die("code die here");
        $apimodel=model(Register::class);
        
            $data = [
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'email' => $this->request->getVar('email'),
                'mobile' => $this->request->getVar('mobile'),
                'password' => $this->request->getVar('password'),
            ];
         $result = $apimodel->insert($data);
        
         if(!$result){
            $message = $apimodel->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' =>$result,
                    'message'=>$message

                ]
            ];
            return $this->respondCreated($response);
         }

            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' =>"true"
                ]
            ];
            return $this->respondCreated($response);
        
    }
    public function login()
    {
        
        $email = $this->request->getJsonVar('email');
        $password=$this->request->getJsonVar('password');

        $usermodel=model(Usermodel::class);
        $where=[
            'email'=>$email
        ];
        $result = $usermodel->getWhere(['email'=>$email])->getResultArray();


         if(isset($result[0]['password']))
         {

            $password1 = isset($result[0]['password']) ? $result[0]['password'] : '';
         }
   
        if(isset($password1) && !empty($password1)){
                if($password1==$password){
            $session = \Config\Services::session();
            $session->set('id',$result[0]['id']);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'true',
                    'message'=>"Login Successful",
                    'role'=>$result[0]['role'],
                    'id'=>$result[0]['id']
                ]
            ]; 
            
        }
    else{
            $response = [
                'status'   => 403,
                'error'    => "Invalid user or password",
                'messages' => [
                    'success' => 'false',
                    'message'=>"Login failed"
                ]
            ]; 
            
        }
        
        
        return $this->respondCreated($response);
        # code...
    }   }

    }
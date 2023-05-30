<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Libraries\JwtLibrary;
use App\Models\Register;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Api extends  Controller
{
    use ResponseTrait;
    protected $table='email,register';
    // protected $table='email';
    public function __construct()
    {   
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE, get, post");
        
    }
    function index()
    {   
        return $this->respond("Indel APi");
    }
    public function signup()
    {  
        $apimodel=model(Register::class);
        $this->db= $db = db_connect();
        
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
         $result = $this->db->table('register')->insert($data);
    //    $result=0;
         if(!$result){
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' =>'false',
                    

                ]
            ];
            return $this->respond($response);
         }
         else{

             $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                'success' =>"true",
                'message'=> $apimodel->errors()]];
                return $this->respondCreated($response);
                }
            
        return $data;
    }

   
    public function login()
    {   
        
      
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        $email = $this->request->getJsonVar('email');
        $password=$this->request->getJsonVar('password');

        $result=$this->db->table('register')->select('user_id,name,email,password')->where('email',$email)->get()->getResultArray();


         if(isset($result[0]['password']))
         {

            $password1 = isset($result[0]['password']) ? $result[0]['password'] : '';
         }
   
        if(isset($password1) && !empty($password1))
        {
            if($password1==$password){
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => [
                        'success' => 'true',
                        'message'=>"Login Successful",
                        'id'=>$result[0]['user_id'],
                        'email'=>$result[0]['email'],
                        'name'=>$result[0]['name'],
                    ]];
                }
                else{
                    $response = [
                        'status'   => 403,
                        'error'    => "Invalid user or password",
                        'messages' => [
                            'success' => 'false',
                            'message'=>$apimodel->errors()]];  
                    }
        
        
                    return $this->respond($response);
        # code...Token
        }
        else
        {
            $response = [
            'status'   => 403,
            'error'    => $apimodel->errors(),
            'messages' => [
                'success' => 'false',
                'message'=>"Please Enter Credentials",
                'id'=>$result[0]['user_id']
                ]];
        

                return $this->respond($response);    
        }

    }
    public function newMail(){
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        
        
        $file=$_FILES['attachment'];
        $result=move_uploaded_file($file['tmp_name'],'./static/uploadimg/'.$file['name']);
         $data=[
           
            'senderId'=>$this->request->getVar("user_id"),
            "sender"=>$this->request->getVar("sender"),
            "receiver"=>$this->request->getVar("receiver"),
            "subject"=>$this->request->getVar("subject"),
            "message"=>$this->request->getVar("message"),
            "file" => $file['name']!=""?'http://localhost/snigdh_ci4/static/uploadimg/'.$file['name']:NULL,
            
        ];
        // print_r( $file) ;
        // print_r( $apimodel->error()) ;
        // die;
        $result=$apimodel->insert($data);
        if(!$result){
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' =>'false',
                    'message'=> $apimodel->errors(),

                ]
            ];
            return $this->respond($response);
         }
         else{

             $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                'success' =>"true"]];
                return $this->respondCreated($response);
                }
        return $apimodel->errors();
    }
    public function allEmail(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        $email=$this->request->getVar('email');
        $data = $this->db->table("email")->select()->where('receiver',$email)->get()->getResultArray();
        $totalMail=$this->db->table("email")->select()->where('reveiver',$email)->countAllResults();
        $response=[
            'data'=>$data,
            'totalEmail'=>$totalMail,
        ];
        
        return $this->respond($response);
    }
    public function allEmailSent(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        $email=$this->request->getVar('email');
        $data = $this->db->table("email")->select()->where('sender',$email)->get()->getResultArray();
        $totalMail=$this->db->table("email")->select()->where('sender',$email)->countAllResults();
        $response=[
            'data'=>$data,
            'totalEmail'=>$totalMail,
        ];
        
        return $this->respond($response);
    }
    public function readStatusApi(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        $id=$this->request->getVar('id');
        $data = $this->db->table("email")->where('id',$id)->update(['readStatus'=>'read']);
        // $totalMail=$this->db->table("email")->select()->where('sender',$email)->countAllResults();
       
        
        return $this->respond($data);
    }
    public function allEmailRegister(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        $data = $this->db->table("register")->select('email')->get()->getResultArray();
       
        
        return $this->respond($data);
    }
    

    }
    
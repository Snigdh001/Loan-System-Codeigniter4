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
    protected $table='registeruser';
    protected $application='loanapplication';
    
    public function __construct()
    {   
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE, get, post");
        // parent::__construct();
        
    }
    function index()
    {
        // $Token =JWT::encode
        // $jwt =$this->j->verify("snigdh","Snigdh","ES384");
        // $secret_key=getenv("JWT_Secret_Key");
        // $iat=time();
        // $exp= time()+(3600000);
        // $payload=[
        //     'sub'=>'Authorization',
        //     'iat'=>$iat,
        //     'exp'=>$exp,
        //     'tokenid'=>'1'
        // ];
        // $Token=JWT::encode($payload,$secret_key,"HS256");
        
        // $decoedkey =JWT::decode($Token,new Key($secret_key,'HS256'));
        // return $decoedkey;
        return $this->respond('index method');
    }
    public function allusers()
    {   
        // print_r($_GET);
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
  
        $data=$this->db->table('registeruser')->select()->where('role',"user")->get()->getResultArray();
        return $this->respond($data);
    }
    public function filters()
    {   
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        // print_r($_GET);
        $filterdata=array('id'=>'%%');
        $search=isset($_GET['search']) ? ($_GET['search']):"";
        // if($search)
        // {
        //     $filterdata['id']=$search;
        //     $filterdata['fname']=$search;
        //     $filterdata['lname']=$search;
        //     $filterdata['email']=$search;
        //     $filterdata['mobile']=$search;
        // }
        $lname='';
        isset($_GET['email']) ? ($filterdata['email']=$_GET['email']):"";
        isset($_GET['mobile']) ? ($filterdata['mobile']=$_GET['mobile']):"" ;
        isset($_GET['name']) ? $filterdata['fname']=$_GET['name']:"";
        $data=$this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->where('role',"user",)->like($filterdata)->get()->getResultArray();
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
         if($result)
         {
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' =>"true",
                    'message' =>$apimodel->errors()
                ]
            ];
            return $this->respondCreated($response);
         }
         else {
             $message = $apimodel->errors();
             $response = [
                 'status' => 403,
                 'error' => null,
                 'messages' => [
                     'success' =>'false',
                     'message'=>$message,
                     ]
                    ];
                    return $this->respond($response);
                }
    }
    public function login()
    {   
        
        // $Token=JWT::encode($payload,$secret_key,"HS256");
        
        $Token =$this->index();

        $apimodel= model(Register::class);
        $this->db =$db= db_connect();
        $email = $this->request->getJsonVar('email');
        $password=$this->request->getVar('password');

        $usermodel=model(Usermodel::class);
        $where=[
            'email'=>$email
        ];
        // $result=$this->db->table('registeruser')->select('email,id,password,role')->where('email',$email)->get()->getResultArray();
        // print_r($result);
        echo $email;
        die("hi");
         if(isset($result[0]['password']))
         {

            $password1 = isset($result[0]['password']) ? $result[0]['password'] : '';
         }
   
        if(isset($password1) && !empty($password1))
        {
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
                        'id'=>$result[0]['id'],
                        'authorization'=>$Token,
                    ]];
                }
                else{
                    $response = [
                        'status'   => 403,
                        'error'    => "Invalid user or password",
                        'messages' => [
                            'success' => 'false',
                            'message'=>"Login failed"]];  
                    }
        
        
                    return $this->respondCreated($response);
        # code...
        }
        else
        {
            $response = [
            'status'   => 403,
            'error'    => "Please Enter Credentials",
            'messages' => [
                'success' => 'false',
                'message'=>"Please Enter Credentials",
                'role'=>$result[0]['role'],
                'id'=>$result[0]['id']
                ]];
        

                return $this->respondCreated($response);    
        }

    }
    public function deleteuser($id=null)
    {
        if($id)
        {
            $AdminModel = model(Register::class);
            $this->db= $db = db_connect();
            $AdminModel->deletedata($id);
            $response=[
                'id'=>$id,
                'message'=>'Deleted Successfully',
                'success'=>'true'];

                return $this->respondCreated($response);
        }
        else{
            $response=[
                'id'=>$id,
                'message'=>'ERROR',
                'success'=>'false'];

                return $this->respondCreated($response);

        }
        return false;

        // return true;
    }
    public function updateuser($id){

        $data=[
            "fname"=>$this->request->getVar("fname"),
            "lname"=>$this->request->getVar("lname"),
            "email"=>$this->request->getVar("email"),
            "mobile"=>$this->request->getVar("mobile"),
        ];
       
        
        $this->db= $db = db_connect();
        if($id !="")
        {

            $this->db->table('registeruser')->where('id', $id)->update($data);
            if ($db->affectedRows() == 1) 
                    {
                        $response = [
                            'status' => 200,
                            'error' => null,
                            'messages' => [
                                'success' =>"true",
                                'message'=>"Data Update Successfully"
                            ]
                        ];
                    }
                    return $this->respondCreated($response);
        }
        else{
            $response = [
                'status' => 500,
                'error' => "ID is missing",
                'messages' => [
                    'success' =>"false",
                    'message'=>"Error occured",
                ]
            ];
        return $this->respondCreated($response);
        }
        return false;
    }

    public function loanapply(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
                                        // $secret_key=getenv("JWT_Secret_Key");
                                        // $headerdata=$this->request->getheaders();
                                        // $Token =explode(" ",$headerdata['Authorization'])[1];
                                        // $decoedkey =JWT::decode($Token,new Key($secret_key,'HS256'));
                                        // print_r($decoedkey);
                                        // die();
    
        $data = [
            'fname' => $this->request->getVar('fname'), 
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'mobile' => $this->request->getVar('mobile'),
            'gender' => $this->request->getVar('gender'),
            'aadhar' => $this->request->getVar('aadhar'),
            'pan' => $this->request->getVar('pan'),
            'profession' => $this->request->getVar('profession'),
            'income' => $this->request->getVar('income'),
            'loanAmt' => $this->request->getVar('loanAmt'),
            'duration' => $this->request->getVar('duration'),
            'address1' => $this->request->getVar('address1'),
            'address2' => $this->request->getVar('address2'),
            'pincode' => $this->request->getVar('pincode'),
            'place' => $this->request->getVar('place'),
            'country' => $this->request->getVar('country'),
            'userid' => $this->request->getVar('userid'),
        ];
        $result= $this->db->table("loanapplication")->insert($data);
        if(!$result)
        {   
            $response=[
                'status'=>'400',
                'error'=>$apimodel->error(),
                'messages' => 'Error Occured',
            ];
            return $this->respond($response);
        }
        else{
            $response=[
                'status'=>'201',
                'error'=>null,
                'messages' => 'Application Submit Successfully',
            ];
            return $this->respondCreated($response);
        }
        return $this->respond($data);
    }
    public function allApplication(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        $data = $this->db->table("loanapplication")->select()->where("status",'pending')->get()->getResultArray();
        return $this->respond($data);
    }
    }
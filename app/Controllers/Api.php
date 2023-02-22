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
        
    }
    function index()
    {   
        return $this->respond("Indel APi");
    }
    function Encodedtoken()
    {
                                                                                    // $secret_key=getenv("JWT_Secret_Key");
                                                                                    // $headerdata=$this->request->getheaders();
                                                                                    // $Token =explode(" ",$headerdata['Authorization'])[1];
                                                                                    // $decoedkey =JWT::decode($Token,new Key($secret_key,'HS256'));
                                                                                    // print_r($decoedkey);
                                                                                    // die();
        
        $secret_key=getenv("JWT_Secret_Key");
        $iat=time();
        $exp= time()+360000000;
        $payload=[
            'sub'=>'Authorization',
            'iat'=>$iat,
            'exp'=>$exp,
            'tokenid'=>'1'
        ];
        $Token=JWT::encode($payload,$secret_key,"HS256");
        
        return $Token;
    }
    function Decodedtoken($headerdata)
    {
        
        $secret_key=getenv("JWT_Secret_Key");
        if(isset($headerdata['Authorization'])){
            $token = (array)$headerdata['Authorization'];
            $token=array_values($token);
            $decoedkey =(array)JWT::decode($token[1],new Key($secret_key,'HS256'));
            return $decoedkey;
    }
}

    public function allusers()
    {   
        
        $headerdata=$this->request->getheaders();
        $tokenData=$this->Decodedtoken($headerdata);
        
        if($tokenData['tokenid']=='1')
            {
                $apimodel= model(Register::class);
                $this->db= $db = db_connect();
                $limit=$this->request->getVar("recordlimit");
                $page = $this->request->getVar("page");
                $offset=($page-1)*$limit; 
                $data=$this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->limit($limit,$offset)->get()->getResultArray();
                $totalpages= $this->db->table('registeruser')->select()->where('role',"user")->countAllResults();
                

                $response=[
                    "status"=>200,
                    "error"=>null,
                    "data"=>$data,
                    "totalpages"=>ceil($totalpages/$limit)
                ];

                return $this->respond($response);

            }
            else{
                $response=[
                    $data =>array(),
                    $error =>"Token Not Found"
                ];
                return $this->respond($response);
            }
            

    }
    public function getDetails()
    {           $id=$this->request->getVar('userId');
                $apimodel= model(Register::class);
                $this->db= $db = db_connect();
                $data=$this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->where('id',$id)->get()->getResultArray();
                return $this->respond($data);
    }


    
    public function filters()
    {   
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        $filterdata=array('id'=>'%%');
        isset($_GET['email']) ? ($filterdata['email']=$_GET['email']):"";
        isset($_GET['mobile']) ? ($filterdata['mobile']=$_GET['mobile']):"" ;
        isset($_GET['name']) ? $filterdata['fname']=$_GET['name']:"";

        if($filterdata['fname'])
            $data=$this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->where('role',"user",)->like($filterdata)->orlike('lname',$filterdata['fname'])->get()->getResultArray();
        else
            $data=$this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->where('role',"user",)->like($filterdata)->get()->getResultArray();
        
        return $this->respond($data);
    }

    public function search()
    {   
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        $filterkey=array(
            'id'=>$_GET['keyWord'],
        'fname'=>$_GET['keyWord'],
        'lname'=>$_GET['keyWord'],
        'mobile'=>$_GET['keyWord'],
        'email'=>$_GET['keyWord'],
        'role'=>$_GET['keyWord']
    );
                $limit=$this->request->getVar("recordlimit");
                $page = $this->request->getVar("page");
                $offset=($page-1)*$limit;
                $data=$this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->orlike($filterkey)->limit($limit,$offset)->get()->getResultArray();
                $totalrecord= $this->db->table('registeruser')->select('id,fname,lname,email,mobile,role')->orlike($filterkey)->countAllResults();
    $response=[
        "status"=>200,
        "error"=>null,
        "data"=>$data,
        "totalpages"=>ceil($totalrecord/$limit)
    ];
        return $this->respond($response);
    }
    public function searchApplication()
    {   
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        $filterkey=array(
            'id'=>$_GET['keyWord'],
            'userid'=>$_GET['keyWord'],
        'fname'=>$_GET['keyWord'],
        'lname'=>$_GET['keyWord'],
        'mobile'=>$_GET['keyWord'],
        'email'=>$_GET['keyWord'],
        'aadhar'=>$_GET['keyWord'],
        'pan'=>$_GET['keyWord'],
        'loanAmt'=>$_GET['keyWord'],
        'duration'=>$_GET['keyWord'],
        'income'=>$_GET['keyWord'],
        'address1'=>$_GET['keyWord'],
        'address2'=>$_GET['keyWord'],
        'place'=>$_GET['keyWord'],
        'pincode'=>$_GET['keyWord'],
        'status'=>$_GET['keyWord'],
        'country'=>$_GET['keyWord'],
        'status'=>$_GET['keyWord'],
        'remark'=>$_GET['keyWord'],
    );
                $limit=$this->request->getVar("recordlimit");
                $page = $this->request->getVar("page");
                $offset=($page-1)*$limit;
                $data=$this->db->table('loanapplication')->select()->orlike($filterkey)->limit($limit,$offset)->get()->getResultArray();
                $totalrecord= $this->db->table('loanapplication')->select()->orlike($filterkey)->countAllResults();
    $response=[
        "status"=>200,
        "error"=>null,
        "data"=>$data,
        "totalpages"=>ceil($totalrecord/$limit)
    ];
        return $this->respond($response);
    }

    public function signup()
    {  
       
        $apimodel=model(Register::class);
        // $str = $this->request->getVar('mobile');
        // $array = explode('-', $str);
        // $mobile= implode ('', $array);
        
            $data = [
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'email' => $this->request->getVar('email'),
                'mobile' => $this->request->getVar('mobile'),
                // 'mobile' => $mobile, //for postman signup
                'password' => $this->request->getVar('password'),
            ];
         $result = $apimodel->insert($data);
    //    $result=0;
         if(!$result){
            $message = $apimodel->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' =>'false',
                    'message'=>$message

                ]
            ];
            return $this->respond($data);
         }
         else{

             $response = [
                 'status' => 201,
                 'error' => null,
                 'messages' => [
                     'success' =>"true"
                     ]
                    ];
                    return $this->respondCreated($response);
                }
            
        return $data;
    }
    public function login()
    {   
        
        $Token =$this->Encodedtoken();
        $apimodel= model(Register::class);
        $this->db= $db = db_connect();
        $email = $this->request->getJsonVar('email');
        $password=$this->request->getJsonVar('password');

        $result=$this->db->table('registeruser')->select('email,id,password,role,mobile,fname,lname')->where('email',$email)->get()->getResultArray();


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
                        'email'=>$result[0]['email'],
                        'mobile'=>$result[0]['mobile'],
                        'name'=>$result[0]['fname'].' '.$result[0]['lname'],
                        'fname'=>$result[0]['fname'],
                        'lname'=>$result[0]['lname'],
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
        # code...Token
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
            'state' => $this->request->getVar('state'),
            'country' => $this->request->getVar('country'),
            'userid' => $this->request->getVar('userid'),
        ];
        // 'userid',$data['userid'] and 'status','pending'
        $flag=$this->db->table("loanapplication")->select('userid,status')->where(['userid'=>$data['userid'],'status'=>'pending'])->countAllResults();
        if($flag<1)
        {
            
            $result= $this->db->table("loanapplication")->insert($data);
            if(!$result)
        {   
            $response=[
                'status'=>'400',
                'success'=>'false',
                'error'=>$apimodel->error(),
                'messages' => 'Error Occured',
            ];
            return $this->respond($response);
        }
        else{
            $response=[
                'status'=>'201',
                'error'=>null,
                'success'=>'true',
                'messages' => 'Application Submit Successfully',
            ];
            return $this->respondCreated($response);
        }
        return $this->respond($data);
    }
    else
    {
        $response=[
            'status'=>'409',
            'success'=>'false',
            'error'=>$apimodel->error(),
            'messages' => 'Duplicate record.',
        ];
        return $this->respond($response);
    }
}
    public function 
    Application(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        // ->where("status",'pending')
        $data = $this->db->table("loanapplication")->select()->get()->getResultArray();
        return $this->respond($data);
    }
    public function allApplicationById(){
        $id=$this->request->getVar('userId');
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
        // ->where("status",'pending')
        $data = $this->db->table("loanapplication")->select()->where('userid',$id)->get()->getResultArray();
        return $this->respond($data);
    }


    public function loanAction(){
        $apimodel= model(Register::class);
        $this->db = \Config\Database::connect();
                                        
        
        $data = [
            'id' => $this->request->getVar('id'),
            'userid' => $this->request->getVar('userid'),
            'remark' => $this->request->getVar('remark'),
            'status' => $this->request->getVar('status'),
        ];
        // print_r($data['id']);
        $result= $this->db->table("loanapplication")->where('id',$data['id'])->update($data);
        if(!$result)
        {   
            $response=[
                'status'=>'400',
                'success'=>'false',
                'error'=>$apimodel->error(),
                'messages' => 'Error Occured',
            ];
            return $this->respond($response);
        }
        else{
            $response=[
                'status'=>'200',
                'error'=>null,
                'success'=>'true',
                'messages' => 'Application Updated Successfully',
            ];
            return $this->respond($response);
        }
        return $this->respond($data);
    }
    }
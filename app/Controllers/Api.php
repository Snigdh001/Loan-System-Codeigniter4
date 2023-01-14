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
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE, get, post");
        // parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
        
    }
    // public function index()
    // {   
 
    //     $apimodel= model(Register::class);
  
    //     $data= array(
    //       'name'=>"snigdh"
    //     );

    //     // print_r($data);
    //     // die;
    //     // return "shubham dudue";
    //     return $this->respond($data);
    // }
    public function shubhamdudhe()
    {  
        die("code die here to yout bt");
        $fname = $this->request->getJsonVar('fname',true);
        die("code die here");
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
    }

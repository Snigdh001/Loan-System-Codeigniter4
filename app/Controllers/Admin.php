<?php

namespace App\Controllers;

class Admin extends BaseController
{   
    protected $table='registeruser';
    public function __construct()
    {   
        $this->db = \Config\Database::connect();       
        $AdminModel = model(Register::class);
    }

    public function admindashboard(){
        $AdminModel=model(Register::class);
        
        // $data['row']=$AdminModel->FetchAllRegisterUser();
        // return view('emi/admindashboard',$data);

        $session=\Config\Services::session();
        if(isset($session) && $session->get('role')=='admin')
        {   $data['row']=$AdminModel->FetchAllRegisterUser();
            return view('emi/admindashboard',$data);
        }
        else{return redirect()->to('/login');
        }
        
    }
    
    public function update()
    {
        
        return view('emi/update');

        // return redirect()->to('admindashboard/update');
    }
    public function update_post()
    {   

        $data=$_GET;
        $AdminModel = model(Register::class);
        
        $AdminModel->UpdateDetails($data);
        return redirect()->to('admindashboard');
      
    }
    public function deleterow()
    {
        $id=$_GET['id'];
        $AdminModel = model(Register::class);
        $AdminModel->deletedata($id);
        // return redirect()->to('admindashboard');
        
    }


}
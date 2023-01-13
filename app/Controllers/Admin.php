<?php

namespace App\Controllers;
use App\Models\Register;



class Admin extends BaseController
{   
    protected $table='registeruser';
    public function __construct()
    {   
        $this->db = \Config\Database::connect();
        // $AdminModel = model(Register::class);
    }

    public function admindashboard(){

            // $data = [
            //         'users' => $mo->paginate(5), 
            //         'pager' => $mo->pager,  
            //     ]
            $db = \Config\Database::connect();
            $AdminModel=model(Register::class);
                // $data = [
                //             'users' => $AdminModel->paginate(5), 
                //             'pager' => $this->AdminModel->pager,  
                // ];
            
            
            // print_r($_POST);

            $session=\Config\Services::session();
            if(isset($session) && $session->get('role')=='admin')
            {   
                $data['row']=$AdminModel->FetchAllRegisterUser($_POST['search'],$_POST['asc'],$_POST['desc']);
                return view('emi/admindashboard',$data);
        
        }
        else{return redirect()->to('/login');}
    }
    
    public function update()
    {  
        // $val=$this->Resister->shubham();
        // print_r($val);
        // die("code die");
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
        return true;
    }
    


}
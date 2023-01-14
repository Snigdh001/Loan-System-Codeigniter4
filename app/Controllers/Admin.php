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
            $db = \Config\Database::connect();
            $AdminModel=model(Register::class);
            $session=\Config\Services::session();
            // var_dump($_POST['search']);
            if(isset($session) && $session->get('role')=='admin')
            {   

                if(isset($_GET['asc']))
                {
                    $data = [
                        'row' => $AdminModel->AscPaginate(5,$_GET['asc']), 
                        'pager' => $AdminModel->pager, ];
                        return view('emi/admindashboard',$data);
                }
                if(isset($_GET['desc'])){
                    $data = [
                        'row' => $AdminModel->DescPaginate(5,$_GET['desc']), 
                        'pager' => $AdminModel->pager, ];
                        return view('emi/admindashboard',$data);
                }
                if(isset($_GET['search'])){

                    $data = [
                        'row' => $AdminModel->SearchPaginate(5,$_GET['search']), 
                        'pager' => $AdminModel->pager, ];
                        return view('emi/admindashboard',$data);
                }
                if($_GET==NULL || isset($_GET['search']))
                {
                    $data = [
                        'row' => $AdminModel->onlyPaginate(5), 
                        'pager' => $AdminModel->pager, ];
                        return view('emi/admindashboard',$data);
                    }

                    // $data['row']=$AdminModel->FetchAllRegisterUser($_GET['search'],$_GET['asc'],$_GET['desc']);
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
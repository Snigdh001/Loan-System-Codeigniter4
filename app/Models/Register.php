<?php

namespace App\Models;
use CodeIgniter\Model;

class Register extends Model{
    
    protected $table='registeruser';
    protected $allowedFields=['fname','lname','email','mobile','password'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function fetch_datarow($email)
    {   
        $db = db_connect();
        $this->db = \Config\Database::connect();
        // $data= $this->table('registeruser')->select('email,id,password,role')->where('email',$email)->getResultArray();
        $data=$this->table('registeruser')->select('email,id,password,role')->where('email',$email)->get()->getRowArray();
        
        return $data;
    }   
    public function FetchAllRegisterUser()
    {
        $data= $this->select()->where('role','user')->get()->getResultArray();
        // print_r($data);
        return $data;
    }
    public function UpdateDetails($data)
    {
                    $db = db_connect();
    // {   $id=$this->request->getPost('id');
                     if($data['mobile']!=NULL)
                    {
                        $data1=['mobile'=>$data['mobile']];
                    }
                    if($data['email']!=NULL)
                    {
                        $data1=['email'=>$data['email']];
                    }
                    if($data['fname']!=NULL)
                    {
                        $data1=['fname'=>$data['fname']];
                    }
                    if($data['lname']!=NULL)
                    {
                        $data1=['lname'=>$data['lname']];
                    }
                    
                    $db->table('registeruser')->where('id', $data['id'])->update($data1);
                    // $this->db->update($id,$data1);
                    
                
                    if ($db->affectedRows() == 1) 
                    {
                        ECHO("Data Updated");
                    }
                    return true;
    }
    public function deletedata($id)
    {
        $db = db_connect();
        $this->where('id',$id)->delete();
        if ($db->affectedRows() > 0) 
                    {
                        ECHO ("Data Deleted");
                        return true;
                    }
                    // ECHO("Data Deleted");
        return false;


    }

}
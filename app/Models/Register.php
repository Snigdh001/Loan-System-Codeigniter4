<?php
namespace App\Models;

use CodeIgniter\Model;
class Register extends Model{

    protected $table = 'registeruser';
    protected $allowedFields=['fname','lname','email','mobile','password'];

    public function __construct()
    {
        // $db = db_connect();
        // $this->db = \Config\Database::connect();
        // $this->pager = \Config\Services::pager();
        
    }

    public function fetch_datarow($email)
    {   
        $this->db = \Config\Database::connect();
        $data= $this->db->table('registeruser')->select('email,id,password,role')->where('email',$email)->get()->getResultArray();
        return $data[0];
    }   
    public function FetchAllRegisterUser($search,$asc,$desc)
    {   $this->db = \Config\Database::connect();
        $data="";
        if($search==NULL)
        $data= $this->db->table('registeruser')->select()->where('role','user')->get()->getResultArray();
        if($search){
            $data= $this->db->table('registeruser')->select()->where('role','user')->like('fname',$search)->get()->getResultArray();
        }
        if($asc){
            $data= $this->db->table('registeruser')->select()->where('role','user')->orderBy('fname','asc')->get()->getResultArray();
        }
        if($desc){
            $data= $this->db->table('registeruser')->select()->where('role','user')->orderBy('fname','desc')->get()->getResultArray();
        }
        return $data;
        // print_r($data); 
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
    // public function shubham(){
    //     return "gunnnn";
    // }
    public function dataobj()
    {   $db = db_connect();
        $data= $db->table('registeruser')->select()->where('role','user');
        return $data;
    }
    
}
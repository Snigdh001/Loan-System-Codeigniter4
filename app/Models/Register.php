<?php
namespace App\Models;

use CodeIgniter\Model;
class Register extends Model{

    protected $table = "email";
    // protected $table = "email";

    // protected $allowedFields = ['fname', 'lname', 'mobile', 'email', 'gender','aadhar','pan','profession','loanAmt','income','duration','address1','address2','pincode','place','state','country','status','remark','userid','password','userId','loanid','interestRate','totalAmt','totalIntAmt','startDate','emiAmt','emiPaid','id'];
    // protected $allowedFields = ['id','pr_id','name','category_name','description','image','price','quantity'];


    protected $allowedFields = ['id','name','email','password','senderId','useId','sender','receiver','subject','message','date','readStatus','file','sentStatus'];
    // protected $returnType = 'array';

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();

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
    }
    public function UpdateDetails($data)
    {
                    $db = db_connect();
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

    public function SearchPaginate($blog_page,$search)
    {
        $this->db = \Config\Database::connect();
        return $this
        ->table('registeruser')
        ->select('*')
        ->where('role','user')
        ->like('fname',$search)
        ->paginate($blog_page);
    }
                                                                    // public function DescPaginate($blog_page,$desc)
                                                                    // {
                                                                    //     $this->db = \Config\Database::connect();
                                                                    //     return $this
                                                                    //     ->table('registeruser')
                                                                    //     ->select('*')
                                                                    //     ->where('role','user')
                                                                    //     ->orderBy('fname','desc')
                                                                    //     ->paginate($blog_page);
                                                                    // }
                                                                    // public function AscPaginate($blog_page,$asc)
                                                                    // {
                                                                    //     $this->db = \Config\Database::connect();
                                                                    //     return $this
                                                                    //     ->table('registeruser')
                                                                    //     ->select('*')
                                                                    //     ->where('role','user')
                                                                    //     ->orderBy('fname','asc')
                                                                    //     ->paginate($blog_page);
                                                                    // }
    public function DescPaginate($blog_page,$desc,$key)
    {
        $this->db = \Config\Database::connect();
        return $this
        ->table('registeruser')
        ->select('*')
        ->where('role','user')
        ->orderBy($key,'desc')
        ->paginate($blog_page);
    }
    public function AscPaginate($blog_page,$asc,$key)
    {
        $this->db = \Config\Database::connect();
        return $this
        ->table('registeruser')
        ->select('*')
        ->where('role','user')
        ->orderBy($key,'asc')
        ->paginate($blog_page);
    }

    public function onlyPaginate($blog_page)
    {
        $this->db = \Config\Database::connect();
        return $this
        ->table('registeruser')
        ->select('*')
        ->where('role','user')
        ->orderBy('id')
        ->paginate($blog_page);
    }
    
    
    
    
}
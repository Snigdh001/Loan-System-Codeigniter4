<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function homepage()
    {
        return view('templates/emi_header.php') .view('emi/home.php');
    }

    public function signup()
    {   
        
        $model = model(Register::class);
        if($this->request->getMethod()=='post' && $this->validate(
            [
                'fname'=>'required|min_length[3]|max_length[20]',
                'lname'=>'min_length[3]|max_length[20]',
                'email'=>'required|max_length[50]',
                'mob'=>'required|max_length[10]',
                'password'=>'required|max_length[20]'
            ]))
                {
                    $array= array(
                        'fname'=>$this->request->getPost('fname'),
                        'lname'=>$this->request->getPost('lname'),
                        'email'=>$this->request->getPost('email'),
                        'mobile'=>$this->request->getPost('mob'),
                        'password'=>$this->request->getPost('password'),
                    );
                    $res=$model->save($array);
                    if($res)
                    {
                        ECHO("Data submitted");
                        return redirect()->to('/login');
                    }
                    else{
                        $error =$this->session->flashdata('error');
                        print_r($error);
                        return redirect()->to('signup');
                    }
                }
                
            
        return view('templates/emi_header.php') .view('emi/signup.php');

    }
    public function login(){
        
        $usermodel=model(Register::class);
        
        // $db = \Config\Database::connect();
        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');
        // log_message('error', 'Some variable did not contain a value.');
        if($this->request->getMethod()==='post' && $this->validate(
            [
            'email'=>'required|max_length[50]',
            'password'=>'required|max_length[20]'
            ]
            ))
            {   

                        // $result=$usermodel->select('email,id,password,role')->where('email',$email)->first();
                        $result=$usermodel->fetch_datarow($email);
                        if($result['email']==$email && $result['password']==$password && $result['role']=='user')
                        {
                            $session=\Config\Services::session();
                            $session->set("id",$result['id']);
                            $session->set("role",$result['role']);
                           
                            return redirect()->to('/userdashboard');
                        }
                        else if($result['email']==$email && $result['password']==$password && $result['role']=='admin') {
                        {
                            $session=\Config\Services::session();
                            $session->set("id",$result['id']);
                            $session->set("role",$result['role']);
                           
                            return redirect()->to('/admindashboard');
                        }
                        }
                        else
                        {
                            echo '<script>alert("Invalid Email and Password")</script>';
                        }   
            }

        
        return view('templates/emi_header.php') .view('emi/login.php');
    }
    public function userdashboard()
    {   

        $session=\Config\Services::session();
        if(isset($session) && $session->get('role')=='user')
        {   return view('templates/emi_header.php').view('emi/userdashboard.php');
        }
        else{return redirect()->to('/login');
        }
    }
}
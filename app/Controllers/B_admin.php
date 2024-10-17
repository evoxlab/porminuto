<?php
namespace App\Controllers;
use App\Models\UsersModel;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class B_admin extends BaseController
{   
    public function admin()
    {
        $session = session();
        $id = $session->get('id');

        if(is_null($session)){
            return redirect()->route('dashboard/panel');
        }

        return view('admin');
    }
    public function login_admin()
    {
        $session = session();
        $request= \Config\Services::request();
        $email = $request->getPostGet('email');
        $password = $request->getPostGet('password');
        //new instance
        $user = new UsersModel();
        $res = $user->get_data_by_email($email);
        //validate
        if($res){
            $pass = $res->password;
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $res->id,
                    'first_name' => $res->name,
                    'last_name' => $res->lastname,
                    'email' => $res->email,
                    'privilage' => $res->privilage,
                    'active' => $res->active,
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                $data2['status'] = true;
                $data2['message'] = 'Bienvenido al sistema.';
                return json_encode($data2);
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                $data2['status'] = false;
                $data2['message'] = 'Password is incorrect.';
                return json_encode($data2);
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            $data2['status'] = false;
            $data2['message'] = 'Email does not exist.';
            return json_encode($data2);
        }
    }
}

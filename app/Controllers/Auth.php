<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\RoleModel;
class Auth extends BaseController
{  
    public function index()
    {
        if ($this->session->get('username')) {
           return redirect()->to('/dashboard');
        }
        
        $this->validation->setRule('username', 'Username', 'trim|required');
        $this->validation->setRule('password', 'Password', 'trim|required');

        // if ($this->validation->run() == false) {

            $data['title'] = 'Regio | Login';
            return view('templates/auth_header', $data)
                . view('Auth/login')
                . view('templates/auth_footer');
        // } 
        // else {

        //     // validasi suskses
        //     $this->_login();
        // }
    }
    public function login()
    {   
        $usermodel = new UserModel();
        $rolemodel = new RoleModel();
        $login =[
        'username' => $this->request->getVar('username'),
        'password' => md5($this->request->getVar('password'))];
        var_dump($login);
        $user = $usermodel->where($login)->first();
        // var_dump($user);    
        if ($user != null) {
            $data = [
                'username' => $user['username'],
                'role_id' => $user['role_id'],
                'userid' => $user['user_id']

            ];
            $this->session->set($data);
            $role = $rolemodel->where(['roles_id' => $user['role_id']])->first();
            // var_dump($role);
            return redirect()->to($role['defaulft_page']);
             
            echo "Berhasil Login";
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger" role="alert">
					Wrong Password!</div>');
                    return redirect()->to('/');
            echo "gagal login";
        }
    }

    public function logout()
    {
        unset($_SESSION['username'],
              $_SESSION['role_id'] ,                     
              $_SESSION['userid'] );
        $this->session->setFlashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            &nbsp;&nbsp;&nbsp;&nbsp;Logged Out.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>'
        );
       return  redirect()->to('/');
    }
}

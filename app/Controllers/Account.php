<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Account extends BaseController
{
    public function index(){
        $user= new UserModel();
        $nav = new NavModel();
        if($this->session->get('username')){
        $role_id = $_SESSION['role_id'];
        $data['sess'] = $user->where(['username' => $this->session->get('username')])->first();
        $data['result']=$nav->select('*')->where(['role_id' =>$role_id])
                     ->where('parent_id',NULL)->orderby('nav_order', 'ASC')->get()->getresultarray();
        $data['resultSubMenu']=$nav->select('*')->where(['role_id' =>$role_id])
        ->where('parent_id!=',NULL)->orderby('nav_order', 'ASC')->get()->getresultarray();
        $data['title'] = 'User Manager';
        $data['nav_url'] = '';;
   
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('account', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function edit()
    {
        $id = $this->request->getVar('id');
        $data = array(
            'fullname' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' =>md5($this->request->getVar('password')),
        );

        $this->user->updateData($id, $data);

        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }

}

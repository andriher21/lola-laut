<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class ClientLog extends BaseController
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
        $data['title'] = 'Client Log';
        $data['nav_url'] = 'ADMIN_CLIENTLOG';
        $today = date('Y-m-d');
        $data['client'] = $this->clientlog->indexData();
        $data['content_scripts'][] = '/js/clientlog/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('ClientLog/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function add()
    {   
        $key=date('his');
        $data = array(
        'clientnumb' => crypt($key,$this->request->getVar('name')),
        'clientname' => $this->request->getVar('name'),
    );

        $this->clientid->insertData($data);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function delete()
    {
        $id = $this->request->getVar('id');
        $delete = $this->clientid->deleteData($id);
        echo $delete;
        die();
    }
    public function setStatus()
    {
        $data = array(
            $_POST['field'] => $_POST['check'] ? '1' : '0'
        );
        $id = $this->request->getVar('id');
         $this->clientid->updateData($id, $data);
        // echo $this->client->updateUsrAccu($id, $data);
    }

}
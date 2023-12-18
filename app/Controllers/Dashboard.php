<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Dashboard extends BaseController
{
    
    public function index()
    {
        $user= new UserModel();
        $nav = new NavModel();
        if($this->session->get('username')){
        
        $role_id = $_SESSION['role_id'];
        $data['sess'] = $user->where(['username' => $this->session->get('username')])->first();
        $data['result']=$nav->select('*')->where(['role_id' =>$role_id])
                     ->where('parent_id',NULL)->orderby('nav_order', 'ASC')->get()->getresultarray();
        $data['resultSubMenu']=$nav->select('*')->where(['role_id' =>$role_id])
        ->where('parent_id!=',NULL)->orderby('nav_order', 'ASC')->get()->getresultarray();
        $data['title'] = 'Dashboard';
        $data['nav_url'] = 'ADMIN_DASHBOARD';

        $today = date('Y-m-d');
        $data['dates'] = $today;
        $data['content_scripts'][] = '/js/dashboard.js';


        $data['count']  = $this->transaksi->getCount();
        $data['last_transaction'] = $this->transaksi->getLasttransaction();
        $data['weight'] = $this->transaksi->getweight();
        $data['material'] = $this->transaksi->getmaterial();
        $data['transaction'] = $this->transaksi->gettransaction();
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('dashboard', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
}
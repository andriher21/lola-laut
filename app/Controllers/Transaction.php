<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Transaction extends BaseController
{
    
    public function daily($active_date = null)
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
        $data['title'] = 'Transaction';
        $data['nav_url'] = 'ADMIN_TRANSACTION';

        $today = getActiveDate();
        if ($active_date == null) {
            $active_date = $today;
        }
        $data['dates'] = $active_date;
        $data['active_date'] = date('l jS \of F Y', strtotime($active_date));
        $data['prev_date_uri'] = site_url('transaction/') . date('Y-m-d', strtotime($active_date . '-1 DAY'));
        $data['next_date_uri'] = site_url('transaction/') . date('Y-m-d', strtotime($active_date . '+1 DAY'));
        $data['content_scripts'][] = '/js/transaction/index.js';

        $data['user'] = $this->transaksi->getdatatransaction($active_date);
        // var_dump($data['user']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('transaction/index', $data)
                . view('templates/footer');}
                else {
                    return redirect()->to('/');
                }
    }
    public function printReport($active_date)
    {
        $today = getActiveDate();

        // $role_id = '6';
        if ($active_date == null) {
            $active_date = $today;
        }

        $data['dates'] = $active_date;

        $date = $active_date;
            $data['report'] = $this->transaksi->getdatatransaction($active_date);
  
        // var_dump($data['report']);
        // die();
       return view('transaction/report', $data);
    }
    public function exportCsv($active_date = null   )
    {
        $today = getActiveDate();
        if ($active_date == null) {
            $active_date = $today;
        }

        $data['dates'] = $active_date;

        $date = $active_date;
       
        // $role_name = $role_id == '6' ? 'Employee' : ($role_id == '7' ? 'Internal' : 'Visitor');
            $data = $this->transaksi->getdatatransaction($active_date);
        

        // $data = $this->users->getReportDaily($role_id, $date, $shift);

        $list = [];
        $list[] = ['DATE', ': ' . $date];
        $header = ['NO', 'Jenis','No Vehicle','Company','Driver', 'Jenis Vehicle ', 'Material', 'Weight In', 'Weight Out','Weight Nett', 'Time In', 'Time Out','Volume Ton','Volume M3','Total Kubik','Total M3'];
        $list[] = $header;

        foreach ($data as $key => $d) {
            $row = [
                ($key + 1),
                trim($d['jenis_transaksi']) == '' ? '-' : preg_replace('/\s/', ' ', $d['jenis_transaksi']),
                // preg_replace('/\s/', ' ', $d['nama']),
                trim($d['vehicle']) == '' ? '-' : preg_replace('/\s/', ' ', $d['vehicle']),
                trim($d['company']) == '' ? '-' : preg_replace('/\s/', ' ', $d['company']),
                trim($d['driver']) == '' ? '-' : preg_replace('/\s/', ' ', $d['driver']),
                trim($d['jenis_vcl']) == '' ? '-' : preg_replace('/\s/', ' ', $d['jenis_vcl']),
                trim($d['material']) == '' ? '-' : preg_replace('/\s/', ' ', $d['material']),
                trim($d['weight_in']) == '' ? '-' : preg_replace('/\s/', ' ', $d['weight_in']),
                trim($d['weight_out']) == '' ? '-' : preg_replace('/\s/', ' ', $d['weight_out']),
                trim($d['nett_weight']) == '' ? '-' : preg_replace('/\s/', ' ', $d['nett_weight']),
                $d['date_in'],
                $d['date_out'],
                trim($d['vol_ton']) == '' ? '-' : preg_replace('/\s/', ' ', $d['vol_ton']),
                trim($d['vol_kubik']) == '' ? '-' : preg_replace('/\s/', ' ', $d['vol_kubik']),
                trim($d['total_ton']) == '' ? '-' : preg_replace('/\s/', ' ', $d['total_ton']),
                trim($d['total_kubik']) == '' ? '-' : preg_replace('/\s/', ' ', $d['total_kubik']),
            ];

            $list[] = $row;
        }

        $f = fopen('php://memory', 'w');

        foreach ($list as $fields) {
            fputcsv($f, $fields, ";");
        }

        // reset the file pointer to the start of the file
        fseek($f, 0);

        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="' . $date . ' - Transaction Report.csv";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
        fclose($f);
    }
    public function edit()
    {
        $id = $this->request->getVar('id');
        $data = array(
            'material' => $this->request->getVar('material'),
        );

        $this->transaksi->updateData($id, $data);
    
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function delete()
    {
        $id = $this->request->getVar('id');
        $delete = $this->transaksi->deleteData($id);
        // echo $delete;
        return ;
    }


}
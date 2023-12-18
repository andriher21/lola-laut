<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class ReportTrash extends BaseController
{
    
    public function index($start = false, $end = false)
    {
        $user= new UserModel();
        $nav = new NavModel();
        if($this->session->get('username')){
                $role_id = $_SESSION['role_id'];
                $active_date = null;
                $data['sess'] = $user->where(['username' => $this->session->get('username')])->first();
                $data['result']=$nav->select('*')->where(['role_id' =>$role_id])
                            ->where('parent_id',NULL)->orderby('nav_order', 'ASC')->get()->getresultarray();
                $data['resultSubMenu']=$nav->select('*')->where(['role_id' =>$role_id])
                ->where('parent_id!=',NULL)->orderby('nav_order', 'ASC')->get()->getresultarray();
               
                    $data['title'] = 'Transaction';
                    $data['nav_url'] = 'ADMIN_TRANSACTIONTRASH';

                    $today = getActiveDate();
                    if ($active_date == null) {
                        $active_date = $today;
                    }
                
                    if ($start == Null  && $end == NULL) 
                    {
                        $start = date('Y-m-d', strtotime("-6 day", strtotime(date("Y-m-d"))));;
                        $end = date('Y-m-d');
                    }
                    $data['content_scripts'][] = '/js/transaction/report.js';
                    $data['start'] = date('d M Y',strtotime($start));
                    $data['end'] = date('d M Y',strtotime($end));
                    $data['report'] = $this->transaksi->getdatareporttrash($start, $end);
                    // var_dump($data['report']);
                return view('templates/header')
                        . view('templates/sidebar', $data)
                        . view('templates/topbar', $data)
                        . view('report-trash/index', $data)
                        . view('templates/footer');}
                else {
                    return redirect()->to('/');
                }
    }
    public function printReportData($start, $end)
    {
        // $today = getActiveDate();

        // $role_id = '6';
        if ($start == null and $end = null) {
            return;
        }

        $data['start'] = date('d M Y',strtotime($start));
        $data['end'] = date('d M Y',strtotime($end));
        $data['report'] = $this->transaksi->getdatareport($start, $end);
  
        // var_dump($data['report']);
        // die();
       return view('Report/print_report', $data);
    }
    public function exportCsv($start, $end)
    {
        if ($start == null and $end = null) {
            return;
        }

        $data['start'] = date('d M Y',strtotime($start));
        $data['end'] = date('d M Y',strtotime($end));
       
        // $role_name = $role_id == '6' ? 'Employee' : ($role_id == '7' ? 'Internal' : 'Visitor');
        $data = $this->transaksi->getdatareport($start, $end);
        

        // $data = $this->users->getReportDaily($role_id, $date, $shift);

        $list = [];
        $list[] = ['DATE', ': ' . $start];
        $list[] = ['TO', ': ' . $end];
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

        $f = fopen('php://memory', 'a');

        foreach ($list as $fields) {
            fputcsv($f, $fields, ";");
        }

        // reset the file pointer to the start of the file
        fseek($f, 0);

        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="' . $start .'-'.$end. ' - Transaction ReportTransaction.csv";');
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
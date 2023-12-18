<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Tujuan extends BaseController
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
        $data['title'] = 'Tujuan';
        $data['nav_url'] = 'ADMIN_TUJUAN';
        $today = date('Y-m-d');
        if($role_id == '1' || $role_id == '4'){
             $data['tujuan'] = $this->tujuan->indexData();
        }
        elseif($role_id == '2'){
            $data['tujuan'] = $this->tujuan->getdatatrash();
        }
        $data['content_scripts'][] = '/js/tujuan/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('Tujuan/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'tujuan';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->tujuan->deleteAll();
            if ($delete['status'] == 0){
                $this->tujuan->insertAll($data);
            }
        }
        die();
    }
    public function add()
    {   $data= array(
            'company_tujuan' => $this->request->getVar('company'),
            'alamat_tujuan' => $this->request->getVar('alamat_tujuan'),
            'token' => 'Ab42cFQ'
         );
        $response = $this->curl->request('POST', 'tujuan', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);

        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
        if($return['status'] == 0){
        $d= array(
            'tujuan_id' => $return['id'],
            'tujuan_company' => $this->request->getVar('company'),
            'alamat_tujuan' => $this->request->getVar('alamat_tujuan'),
         );}
         else {
            $d= array(
                'tujuan_company' => $this->request->getVar('company'),
                'alamat_tujuan' => $this->request->getVar('alamat_tujuan'),
             );}
         

        $this->tujuan->insertData($d);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id =$this->request->getVar('id');

        $data= array(
            'id'=> $id,
            'company_tujuan' => $this->request->getVar('company'),
            'alamat_tujuan' => $this->request->getVar('alamat_tujuan'),
            'token' => 'Ab42cFQ'
         );
        $response = $this->curl->request('PUT', 'tujuan', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);

        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
        if($return['status'] == 0){
        $d = array(
            'tujuan_company' => $this->request->getVar('company'),
            'alamat_tujuan' => $this->request->getVar('alamat_tujuan'),
        );
       }
        $this->tujuan->updateData($id, $d);

        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }

    public function delete()
    {
        $id = $this->request->getVar('id');
        $data = array(
            'id'=> $this->request->getVar('id'),
            'token' => 'Ab42cFQ'
             );
             // Send request
        $response = $this->curl->request('DELETE', 'tujuan', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $delete = $this->tujuan->delete($id);
        // echo $delete;
        die();
    }

public function readCSV()
{
    $input = $this->validate([
        'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv],'
    ]);
    if (!$input) {
        $data['validation'] = $this->validator;
        return ; 
    }else{
        if($file = $this->request->getFile('file')) {
        if ($file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('../public/csvfile', $newName);
            $file = fopen("../public/csvfile/".$newName,"r");
            $i = 0;
            $numberOfFields = 4 ;
            $importData = array();
            while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                $num = count($filedata);
                if($i > 0 &&  $num == $numberOfFields){ 
                    $importData[$i]['company'] = $filedata[0];
                    $importData[$i]['alamat_tujuan'] = $filedata[1];
                }
                $i++;
            }
            fclose($file);
            return json_encode($importData);
        
            }}
        }
        

    }
    public function doImport()
    {
        $tujuan = $this->request->getVar('data');
        // var_dump($company);
        for ($i = 0; $i < count($tujuan); $i++) {
            $data = array(
                'tujuan_company' => $tujuan[$i]['company'],
                'alamat_tujuan' => $tujuan[$i]['alamat_tujuan'],
            );
            $save = $this->tujuan->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
}

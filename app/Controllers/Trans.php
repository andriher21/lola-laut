<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Trans extends BaseController
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
        $data['title'] = 'Trans';
        $data['nav_url'] = 'ADMIN_TRANS';
        $today = date('Y-m-d');
        if($role_id == '1' || $role_id == '4'){
            $data['trans'] = $this->trans->getTrans(17000);
            $data['typevcl'] = $this->typevcl->indexData();}
        elseif($role_id == '2'){
            $data['trans'] = $this->trans->getDataTrash();
            $data['typevcl'] = $this->typevcl->indexData();}
        
        $data['content_scripts'][] = '/js/trans/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('Trans/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'trans';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->trans->deleteAll();
            if ($delete['status'] == 0){
                $this->trans->insertAll($data);
            }
        }
        die();
    }
    public function add()
    {
        $data = array(
        'vehicle' => $this->request->getVar('vehicle'),
        'owner' => $this->request->getVar('owner'),
        'company' => $this->request->getVar('company'),
        'type_vehicle' => $this->request->getVar('type_vcl'),
        'material' => $this->request->getVar('material'),
        'long_vehicle' => $this->request->getVar('panjang'),
        'wide_vehicle' => $this->request->getVar('lebar'),
        'high_vehicle' => $this->request->getVar('tinggi'),
        'volume_vehicle' => $this->request->getVar('volume'),
        'created_by' => $this->session->get('username'),
        'last_in' => date('Y-m-d'),
        'overweight' => $this->request->getVar('overweight'),
        'token' => 'Ab42cFQ'
    );
    $response = $this->curl->request('POST', 'trans', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);

        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
        if($return['status'] == 0){
            $data = array(
                'trans_id' => $return['id'],
                'trans_vehicle' => $this->request->getVar('vehicle'),
                'trans_owner' => $this->request->getVar('owner'),
                'trans_company' => $this->request->getVar('company'),
                'trans_type_vcl' => $this->request->getVar('type_vcl'),
                'trans_material' => $this->request->getVar('material'),
                'trans_long_vcl' => $this->request->getVar('panjang'),
                'trans_wide_vcl' => $this->request->getVar('lebar'),
                'trans_high_vcl' => $this->request->getVar('tinggi'),
                'trans_volume_vcl' => $this->request->getVar('volume'),
                'trans_overweight' => $this->request->getVar('overweight'),
            );}
        else {
            $data = array(
                'trans_vehicle' => $this->request->getVar('vehicle'),
                'trans_owner' => $this->request->getVar('owner'),
                'trans_company' => $this->request->getVar('company'),
                'trans_type_vcl' => $this->request->getVar('type_vcl'),
                'trans_material' => $this->request->getVar('material'),
                'trans_long_vcl' => $this->request->getVar('panjang'),
                'trans_wide_vcl' => $this->request->getVar('lebar'),
                'trans_high_vcl' => $this->request->getVar('tinggi'),
                'trans_volume_vcl' => $this->request->getVar('volume'),
                'trans_overweight' => $this->request->getVar('overweight'),
            );;
        }

        $this->trans->insertData($data);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id =$this->request->getVar('id');
        $data = array(
            'id' => $id,
            'vehicle' => $this->request->getVar('vehicle'),
            'owner' => $this->request->getVar('owner'),
            'company' => $this->request->getVar('company'),
            'type_vehicle' => $this->request->getVar('type_vcl'),
            'material' => $this->request->getVar('material'),
            'long_vehicle' => $this->request->getVar('panjang'),
            'wide_vehicle' => $this->request->getVar('lebar'),
            'high_vehicle' => $this->request->getVar('tinggi'),
            'volume_vehicle' => $this->request->getVar('volume'),
            'created_by' => $this->session->get('username'),
            'last_in' => date('Y-m-d'),
            'overweight' => $this->request->getVar('overweight'),
            'token' => 'Ab42cFQ'
        );
        $response = $this->curl->request('PUT', 'trans', ["headers"=>["Accept"=>"application/json"],
            'form_params' => $data]);
    
            // Read response
            $code = $response->getStatusCode();
            $output =$response->getBody();
            $return = json_decode($output,true);
            if($return['status'] == 0){
                $d = array(
                'trans_vehicle' => $this->request->getVar('vehicle'),
                'trans_owner' => $this->request->getVar('owner'),
                'trans_company' => $this->request->getVar('company'),
                'trans_type_vcl' => $this->request->getVar('type_vcl'),
                'trans_material' => $this->request->getVar('material'),
                'trans_long_vcl' => $this->request->getVar('panjang'),
                'trans_wide_vcl' => $this->request->getVar('lebar'),
                'trans_high_vcl' => $this->request->getVar('tinggi'),
                'trans_volume_vcl' => $this->request->getVar('volume'),
                'trans_overweight' => $this->request->getVar('overweight'),
                'trans_status' => '0',
            );}
        else{
            $d = array(
                'trans_vehicle' => $this->request->getVar('vehicle'),
                'trans_owner' => $this->request->getVar('owner'),
                'trans_company' => $this->request->getVar('company'),
                'trans_type_vcl' => $this->request->getVar('type_vcl'),
                'trans_material' => $this->request->getVar('material'),
                'trans_long_vcl' => $this->request->getVar('panjang'),
                'trans_wide_vcl' => $this->request->getVar('lebar'),
                'trans_high_vcl' => $this->request->getVar('tinggi'),
                'trans_volume_vcl' => $this->request->getVar('volume'),
                'trans_overweight' => $this->request->getVar('overweight'),
                'trans_status' => '1',
            );
        }

        $this->trans->updateData($id, $d);

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
        $response = $this->curl->request('DELETE', 'trans', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $delete = $this->trans->delete($id);
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
            $numberOfFields = 10 ;
            $importData = array();
            while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                $num = count($filedata);
                if($i > 0 &&  $num == $numberOfFields){ 
                    $importData[$i]['vehicle'] = $filedata[0];
                    $importData[$i]['owner'] = $filedata[1];
                    $importData[$i]['company'] = $filedata[2];
                    $importData[$i]['type_vcl'] = $filedata[3];
                    $importData[$i]['material'] = $filedata[4];
                    $importData[$i]['panjang'] = $filedata[5];
                    $importData[$i]['lebar'] = $filedata[6];
                    $importData[$i]['tinggi'] = $filedata[7];
                    $importData[$i]['volume'] = $filedata[8];
                    // $importData[$i]['overwight'] = $filedata[9];
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
        $trans = $this->request->getVar('data');
        for ($i = 0; $i < count($trans); $i++) {
            $data = array(
                'trans_vehicle' => $trans[$i]['vehicle'],
                'trans_owner' => $trans[$i]['owner'],
                'trans_company' => $trans[$i]['company'],
                'trans_type_vcl' => $trans[$i]['type_vcl'],
                'trans_material' => $trans[$i]['material'],
                'trans_long_vcl' => $trans[$i]['panjang'],
                'trans_wide_vcl' => $trans[$i]['lebar'],
                'trans_high_vcl' => $trans[$i]['tinggi'],
                'trans_volume_vcl' => $trans[$i]['volume'],
            );
            $save = $this->trans->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
}

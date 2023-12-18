<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Flasi extends BaseController
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
        $data['title'] = 'Flasi';
        $data['nav_url'] = 'ADMIN_FLASI';
        $today = date('Y-m-d');
        if($role_id == '1' || $role_id == '4'){
            $data['flasi'] = $this->flasi->indexData();
            $data['typevcl'] = $this->typevcl->indexData();
            $data['plant'] = $this->plant->indexData();
        }
        elseif($role_id == '2'){
            $data['flasi'] = $this->flasi->getdatatrash();
            $data['typevcl'] = $this->typevcl->indexData();
            $data['plant'] = $this->plant->indexData();
        }
        $data['content_scripts'][] = '/js/flasi/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('flasi/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'flasi';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->flasi->deleteAll();
            if ($delete['status'] == 0){
                $this->flasi->insertAll($data);
            }
        }
        // die();
    }
    public function add()
    {
        $data = array(
        'plant' => $this->request->getVar('plant'),
        'material' => $this->request->getVar('material'),
        'type_vehicle' => $this->request->getVar('type_vcl'),
        'flasi_ton' => $this->request->getVar('ton'),
        'flasi_cm' => $this->request->getVar('cm'),
        'token' => 'Ab42cFQ'
    );
        $response = $this->curl->request('POST', 'flasi', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);

        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
        if($return['status'] == 0){
            $d = array(
                'flasi_id' => $return['id'],
                'flasi_plant' => $this->request->getVar('plant'),
                'flasi_material' => $this->request->getVar('material'),
                'flasi_type_vcl' => $this->request->getVar('type_vcl'),
                'flasi_ton' => $this->request->getVar('ton'),
                'flasi_cm' => $this->request->getVar('cm'),
                'flasi_status' => '0',
                );
                $this->flasi->insertData($d);}
        else {
            $d = array(
                'flasi_plant' => $this->request->getVar('plant'),
                'flasi_material' => $this->request->getVar('material'),
                'flasi_type_vcl' => $this->request->getVar('type_vcl'),
                'flasi_ton' => $this->request->getVar('ton'),
                'flasi_cm' => $this->request->getVar('cm'),
                'flasi_status' => '1',
                 );
                 $this->flasi->insertData($d);}
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id =$this->request->getVar('id');
        $data = array(
            'id' => $id,
            'plant' => $this->request->getVar('plant'),
            'material' => $this->request->getVar('material'),
            'type_vehicle' => $this->request->getVar('type_vcl'),
            'flasi_ton' => $this->request->getVar('ton'),
            'flasi_cm' => $this->request->getVar('cm'),
            'token' => 'Ab42cFQ'
        );
            $response = $this->curl->request('PUT', 'flasi', ["headers"=>["Accept"=>"application/json"],
            'form_params' => $data]);
    
            // Read response
            $code = $response->getStatusCode();
            $output =$response->getBody();
            $return = json_decode($output,true);
           
                $d = array(
                    'flasi_plant' => $this->request->getVar('plant'),
                    'flasi_material' => $this->request->getVar('material'),
                    'flasi_type_vcl' => $this->request->getVar('type_vcl'),
                    'flasi_ton' => $this->request->getVar('ton'),
                    'flasi_cm' => $this->request->getVar('cm'),
                    'flasi_status' => '0',
                    );
                    $this->flasi->updateData($id,$d);
            

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
        $response = $this->curl->request('DELETE', 'flasi', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody(); 
        $delete = $this->flasi->delete($id);
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
            $numberOfFields = 5 ;
            $importData = array();
            while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                $num = count($filedata);
                if($i > 0 &&  $num == $numberOfFields){ 
                    $importData[$i]['plant'] = $filedata[0];
                    $importData[$i]['material'] = $filedata[1];
                    $importData[$i]['type_vcl'] = $filedata[2];
                    $importData[$i]['ton'] = $filedata[3];
                    $importData[$i]['cm'] = $filedata[4];
                    
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
        $flasi = $this->request->getVar('data');
        for ($i = 0; $i < count($flasi); $i++) {
            $data = array(
                'flasi_plant' => $flasi[$i]['plant'],
                'flasi_material' => $flasi[$i]['material'],
                'flasi_type_vcl' => $flasi[$i]['type_vcl'],
                'flasi_ton' => $flasi[$i]['ton'],
                'flasi_cm' => $flasi[$i]['cm'],
            );
            $save = $this->flasi->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
}

<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Driver extends BaseController
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
        $data['title'] = 'Driver';
        $data['nav_url'] = 'ADMIN_DRIVER';
        $today = date('Y-m-d');
        if($role_id == '1' || $role_id == 4){
            $data['driver'] = $this->driver->indexData();   
        }
        elseif($role_id == '2'){
            $data['driver'] = $this->driver->getdatatrash();   
        }
        $data['content_scripts'][] = '/js/driver/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('Driver/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'driver';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->driver->deleteAll();
            if ($delete['status'] == 0){
                $this->driver->insertAll($data);
            }
        }
        die();
    }
    public function add()
    {
        $data = array(
        'name' => $this->request->getVar('name'),
        'nik' => $this->request->getVar('nik'),
        'address' => $this->request->getVar('address'),
        'token' => 'Ab42cFQ'
         );
         $response = $this->curl->request('POST', 'driver', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);

        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
        if($return['status'] == 0){
            $d = array(
                'driver_id' => $return['id'],
                'driver_name' => $this->request->getVar('name'),
                'driver_nik' => $this->request->getVar('nik'),
                'driver_address' => $this->request->getVar('address'),
                 );}
        else {
            $d = array(
                'driver_name' => $this->request->getVar('name'),
                'driver_nik' => $this->request->getVar('nik'),
                'driver_address' => $this->request->getVar('address'),
                 );
        }
        $this->driver->insertData($d);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id =$this->request->getVar('id');
        $data = array(
            'id'=> $id,
            'name' => $this->request->getVar('name'),
            'nik' => $this->request->getVar('nik'),
            'address' => $this->request->getVar('address'),
            'token' => 'Ab42cFQ'
             );
             $response = $this->curl->request('PUT', 'driver', ["headers"=>["Accept"=>"application/json"],
            'form_params' => $data]);
    
            // Read response
            $code = $response->getStatusCode();
            $output =$response->getBody();
            $return = json_decode($output,true);
            if($return['status'] == 0){
                $d = array(
                    'driver_name' => $this->request->getVar('name'),
                    'driver_nik' => $this->request->getVar('nik'),
                    'driver_address' => $this->request->getVar('address'),
                    'driver_status' => '0',
                     );}
            else {
                $d = array(
                    'driver_name' => $this->request->getVar('name'),
                    'driver_nik' => $this->request->getVar('nik'),
                    'driver_address' => $this->request->getVar('address'),
                    'driver_status' => '1',
                     );
            }

        $this->driver->updateData($id, $d);

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
        $response = $this->curl->request('DELETE', 'driver', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $delete = $this->driver->delete($id);
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
                $numberOfFields = 3 ;
                $importData = array();
                while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                    $num = count($filedata);
                    if($i > 0 &&  $num == $numberOfFields){ 
                        $importData[$i]['name'] = $filedata[0];
                        $importData[$i]['nik'] = $filedata[1];
                        $importData[$i]['address'] = $filedata[2];
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
        $driver = $this->request->getVar('data');
        // var_dump($company);
        for ($i = 0; $i < count($driver); $i++) {
            $data = array(
                'driver_name' => $driver[$i]['name'],
                'driver_nik' => $driver[$i]['nik'],
                'driver_address' => $driver[$i]['address'],
            );
            $save = $this->driver->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
    public function RestoreData(){
    
        $id = $this->request->getVar('id');
         $this->driver->restoreData($id);
    }
}

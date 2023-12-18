<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Plant extends BaseController
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
        $data['title'] = 'Plant';
        $data['nav_url'] = 'ADMIN_PLANT';
        $today = date('Y-m-d');
        if($role_id == '1'|| $role_id == '4'){
            $data['plant'] = $this->plant->indexData();
        }
        elseif($role_id == '2'){
            $data['plant'] = $this->plant->getdatatrash();
        }
        $data['content_scripts'][] = '/js/plant/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('Plant/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'plant';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->plant->deleteAll();
            if ($delete['status'] == 0){
                $this->plant->insertAll($data);
            }
        }
        die();
    }
    public function add()
    {
        $data = array(
        'plant' => $this->request->getVar('plant'),
        'token' => 'Ab42cFQ'
         );
         $apiURL = 'plant';
         // Send request
         $response = $this->curl->request('POST', 'plant', ["headers"=>["Accept"=>"application/json"],
         'form_params' => $data]);
 
         // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();
         $return = json_decode($output,true);
        if($return['status'] == 0){
            $d = array(
                'plant_id' => $return['id'],
                'plant' => $this->request->getVar('plant'),
                'plant_status' => '0',
                );
            }
        else {
            $d = array(
                'plant' => $this->request->getVar('plant'),
                'plant_status' => '1',
                 );
          }
          $this->plant->insertData($d);

        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {   $id =$this->request->getVar('id');
        $data = array(
            'id'=> $id,
            'plant' => $this->request->getVar('plant'),
            'token' => 'Ab42cFQ'
             );
             // Send request
        $response = $this->curl->request('PUT', 'plant', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
         $d = array(
                'plant' => $this->request->getVar('plant'),
                 );
        $this->plant->updateData($id, $d);

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
        $response = $this->curl->request('DELETE', 'plant', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $delete = $this->plant->delete($id);
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
                        $importData[$i]['plant'] = $filedata[0];
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
        $plant = $this->request->getVar('data');
        // var_dump($company);
        for ($i = 0; $i < count($plant); $i++) {
            $data = array(
                'plant' => $plant[$i]['plant'],
            );
            $save = $this->plant->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
}

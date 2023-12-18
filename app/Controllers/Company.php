<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\UserModel;
use App\Models\NavModel;
class Company extends BaseController
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
        $data['title'] = 'Company';
        $data['nav_url'] = 'ADMIN_COMPANY';
        $today = date('Y-m-d');
        if($role_id == 1 || $role_id == 4){
            $data['company'] = $this->company->indexData();
        }
        elseif ($role_id == 2 ){
            $data['company'] = $this->company->getdatatrash();
        }
        $data['content_scripts'][] = '/js/company/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('Company/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'company';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->company->deleteAll();
            if ($delete['status'] == 0){
                $this->company->insertAll($data);
            }
        }
        die();
    }
    public function add()
    {
        $data = array(  
        'no' => $this->request->getVar('no'),
        'name' => $this->request->getVar('name'),
        'address' => $this->request->getVar('address'),
        'npwp' => $this->request->getVar('npwp'),
        'token' => 'Ab42cFQ'
    );
    $response = $this->curl->request('POST', 'company', ["headers"=>["Accept"=>"application/json"],
    'form_params' => $data]);

    // Read response
    $code = $response->getStatusCode();
    $output =$response->getBody();
    $return = json_decode($output,true);
    if($return['status'] == 0){
        $d= array(  
            'company_id' => $return['id'],
            'company_no' => $this->request->getVar('no'),
            'company_name' => $this->request->getVar('name'),
            'company_address' => $this->request->getVar('address'),
            'company_npwp' => $this->request->getVar('npwp'),
        );}
    else {
         $d= array(
            'company_no' => $this->request->getVar('no'),
            'company_name' => $this->request->getVar('name'),
            'company_address' => $this->request->getVar('address'),
            'company_npwp' => $this->request->getVar('npwp'),
         );}
        $this->company->insertData($d);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id =$this->request->getVar('id');
        $data = array(  
            'id'=> $id,
            'no' => $this->request->getVar('no'),
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'npwp' => $this->request->getVar('npwp'),
            'token' => 'Ab42cFQ'
        );
        $response = $this->curl->request('PUT', 'company', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);
    
        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
            $d= array(  
                'company_no' => $this->request->getVar('no'),
                'company_name' => $this->request->getVar('name'),
                'company_address' => $this->request->getVar('address'),
                'company_npwp' => $this->request->getVar('npwp'),
            );
        $this->company->updateData($id, $d);

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
        $response = $this->curl->request('DELETE', 'company', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $delete = $this->company->delete($id);
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
                    $importData[$i]['no'] = $filedata[0];
                    $importData[$i]['name'] = $filedata[1];
                    $importData[$i]['address'] = $filedata[2];
                    $importData[$i]['npwp'] = $filedata[3];
                    
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
        $company = $this->request->getVar('data');
        for ($i = 0; $i < count($company); $i++) {
            $data = array(
                'company_no' => $company[$i]['no'],
                'company_name' => $company[$i]['name'],
                'company_address' => $company[$i]['address'],
                'company_npwp' => $company[$i]['npwp'],
            );
            $save = $this->company->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
}

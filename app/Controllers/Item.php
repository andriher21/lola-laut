<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class Item extends BaseController
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
        $data['title'] = 'Item';
        $data['nav_url'] = 'ADMIN_ITEM';
        $today = date('Y-m-d');
        if($role_id == '1' || $role_id == '4'){
            $data['item'] = $this->item->indexData();
            $data['plant'] = $this->plant->indexData();
        }
        elseif($role_id == '2'){
            $data['item'] = $this->item->getdatatrash();
            $data['plant'] = $this->plant->indexData();
        }
        $data['content_scripts'][] = '/js/item/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('item/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function sync(){
        $endpoint = 'item';
        $params = array('token' => 'Ab42cFQ');
        $url = $endpoint . '?' . http_build_query($params);
        // $client = \Config\Services::curlrequest();
        // Send request
        $response = $this->curl->request('GET', $url);

        // Read response
        $output = $response->getBody();
        $data = json_decode($output,true);
        if(!empty($data)){
            $delete = $this->item->deleteAll();
            if ($delete['status'] == 0){
                $this->item->insertAll($data);
            }
        }
        die();
    }
    public function add()
    {    // Send request
        $data = array(
            'plant' => $this->request->getVar('plant'),
            'material' => $this->request->getVar('material'),
            'beratjenis' => $this->request->getVar('berat_jenis'),
            'harga' => $this->request->getVar('harga'),
            'token' => 'Ab42cFQ'
        );
        $response = $this->curl->request('POST', 'item', ["headers"=>["Accept"=>"application/json"],
        'form_params' => $data]);

        // Read response
        $code = $response->getStatusCode();
        $output =$response->getBody();
        $return = json_decode($output,true);
        if($return['status'] == 0){
        $d = array(
            'item_id' => $return['id'],
            'item_plant' => $this->request->getVar('plant'),
            'item_material' => $this->request->getVar('material'),
            'item_berat_jenis' => $this->request->getVar('berat_jenis'),
            'item_harga' => $this->request->getVar('harga'),
        );
        }
        else {
            $d = array(
                'item_plant' => $this->request->getVar('plant'),
                'item_material' => $this->request->getVar('material'),
                'item_berat_jenis' => $this->request->getVar('berat_jenis'),
                'item_harga' => $this->request->getVar('harga'),
            );
    
        }
        $return = $this->item->insertData($d);
        // var_dump($return);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id =$this->request->getVar('id');
        $data = array(
            'id' =>$id,
            'plant' => $this->request->getVar('plant'),
            'material' => $this->request->getVar('material'),
            'beratjenis' => $this->request->getVar('berat_jenis'),
            'harga' => $this->request->getVar('harga'),
            'token' => 'Ab42cFQ'
        );
        // Send request
        $response = $this->curl->request('PUT', 'item', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $data = array(
            'item_plant' => $this->request->getVar('plant'),
            'item_material' => $this->request->getVar('material'),
            'item_berat_jenis' => $this->request->getVar('berat_jenis'),
            'item_harga' => $this->request->getVar('harga'),
        );
        $this->item->updateData($id, $data);

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
        $response = $this->curl->request('DELETE', 'item', ["headers"=>["Accept"=>"application/json"],
             "form_params" => $data]);
     
             // Read response
         $code = $response->getStatusCode();
         $output =$response->getBody();            
        $return = json_decode($output,true);
        $delete = $this->item->delete($id);
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
                    $importData[$i]['material'] = $filedata[1];
                    $importData[$i]['berat_jenis'] = $filedata[2];
                    $importData[$i]['harga'] = $filedata[3];
                    
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
        $item = $this->request->getVar('data');
        for ($i = 0; $i < count($item); $i++) {
            $data = array(
                'item_plant' => $item[$i]['plant'],
                'item_material' => $item[$i]['material'],
                'item_berat_jenis' => $item[$i]['berat_jenis'],
                'item_harga' => $item[$i]['harga'],
            );
            $save = $this->item->insertData($data);
        }
        // var_dump($data);
        
        die();
    }
}

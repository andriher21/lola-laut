<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\NavModel;
class User extends BaseController
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
        $data['title'] = 'User';
        $data['nav_url'] = 'ADMIN_USER';
        $today = date('Y-m-d');
        $data['users'] = $this->user->indexData();
        $data['roles'] = $this->role->indexData();
        $data['content_scripts'][] = '/js/systems/users/index.js';
        // var_dump($data['count']);
        return view('templates/header')
                . view('templates/sidebar', $data)
                . view('templates/topbar', $data)
                . view('Users/index', $data)
                . view('templates/footer');}
        else {
            return redirect()->to('/');
        }
    }
    public function add()
    {
        $data = array(
        'fullname' => $this->request->getVar('name'),
        'username' => $this->request->getVar('username'),
        'password' =>md5($this->request->getVar('password')),
        'level'=> $this->request->getVar('level'),
        'role_id'=> $this->request->getVar('role'),
    );

        $this->user->insertData($data);
        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }
    public function edit()
    {
        $id = $this->request->getVar('id');
        $data = array(
            'fullname' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' =>md5($this->request->getVar('password')),
            'role_id'=> $this->request->getVar('role'),
        );

        $this->user->updateData($id, $data);

        $uri = $_SERVER['HTTP_REFERER'];
        return redirect()->to($uri);
    }

    public function delete()
    {
        $id = $this->request->getVar('id');
        $delete = $this->user->deleteData($id);
        echo $delete;
        die();
    }

public function readCSV()
{
    $path = 'uploads/';

    $config['upload_path'] = $path;
    $config['allowed_types'] = 'csv';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = 'file';

    $this->load->library('upload', $config);
    if ($this->upload->do_upload("file")) {
        $data = array('upload_data' => $this->upload->data());

        $filename = $data['upload_data']['file_name'];

        $path = $path . '/' . $filename;
        $file = fopen($path, "r");
        $delimiter = detectCSVFileDelimiter($path);
        $products = array();
        while (!feof($file)) {
            $products[] = fgetcsv($file, 0, $delimiter);
        }

        // arrange data
        $header = array('name', 'address');
        $row = 0;
        $data = [];
        foreach ($products as $key => $product) {
            foreach ($header as $key => $head) {
                if (isset($product[$key]) && $product[$key] != 'Name' && $product[$key] != 'Address' && trim($product[$key]) != '') {
                    $data[$row][$head] = $product[$key];
                }
                // if (isset($product[$key]) && $product[$key] != 'NIK' && $product[$key] != 'NAMA'  && trim($product[$key]) != '') {
                //     $data[$row][$head] = $product[$key];
                // }
            }
            $row++;
        }

        if (!empty($data)) {
            $niks = implode(',', array_column($data, 'nik'));
            if (trim($niks) !== '') {
                $sql = "SELECT nik FROM sys_users WHERE nik IN ($niks)";
                $exist_user = $this->db->query($sql)->result_array();
                $exist_user = array_flip(array_column($exist_user, 'nik'));
                foreach ($data as $key => $user) {
                    if (isset($exist_user[$user['nik']])) {
                        unset($data[$key]);
                    }
                }
            }
        }

        fclose($file);
        unlink($path);

        echo json_encode(array_values($data));

        $this->session->set_userdata('import-employee', $data);
    } else {
        echo [
            'error' => $this->upload->display_errors()
        ];
    }
    }
    public function doImport()
    {
        $customer = $this->input->post('data');

        $data = array();
        for ($i = 0; $i < count($customer); $i++) {
            $data[] = array(
                'customername' => $customer[$i]['name'],
                'customeraddr' => $customer[$i]['address'],
                'customerusid' => $this->session->userdata('userid'),
                'customercreate' => date('Y-m-d H:i:s')
            );
        }

        $save = $this->db->insert_batch('5ecustomer', $data);
        echo $save;
        die();
    }
}

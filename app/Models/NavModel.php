<?php

namespace App\Models;

use CodeIgniter\Model;

class NavModel extends Model
{
	protected $table = 'nav';
	protected $primaryKey = 'nav_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['perent_id','role_id','nav_order','nav_index','nav_title','nav_url','nav_icon'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'nav_created';
    protected $updatedField  = 'nav_update';
    protected $deletedField  = 'nav_delete';
	
	// protected $validationRules    = [
    //     'company_name' => 'required|min_length[5]',
    //     'company_address' => 'required|min_length[5]',
    // ];
	
	// protected $validationMessages = [
    //     'customername' => [
    //         'required' => 'Bagian Name Harus diisi',
    //         'min_length' => 'Minimal 5 Karakter'
    //     ],
    //     'customeraddr' => [
    //         'required' => 'Bagian Addr Harus diisi',
    //         'min_length' => 'Minimal 5 Karakter'
    //     ]
    // ];
    protected $skipValidation  = false;
	
	public function indexData()
	{
		$typevcl = new TypeVclModel();
		$data = $typevcl->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$typevcl = new TypeVclModel();
		$data = $typevcl->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$typevcl = new TypeVclModel();
		$insert = $typevcl->insert($data
		);
		
		if ($insert) {
			return ([
			    'status'=> 0,
                'message'=>'new transaction created'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to create new data']);
		}
	}
	
	public function updateData($id,$data)
	{
		$typevcl = new TypeVclModel();
		$update = $typevcl->update($id,$data);
		
		if ($update) {
			return ([
			    'status'=> 0,
                'message'=>'update  done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to update data']);
		}
	}
	
	public function deleteData($id)
	{
		$typevcl = new TypeVclModel();
		$delete= $typevcl->delete($id);
			if ($delete) {
			return ([
			    'status'=> 0,
                'message'=>'delete trans done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to delete trans']);
		}
	}
	
	public function lastData()
	{
		$customer = new CustomerModel();
		$data = $customer->orderBy('customerupdate', 'DESC')->first();
		return $data;
	}
}
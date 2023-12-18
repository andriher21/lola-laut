<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeVclModel extends Model
{
	protected $table = 'type_vehicle';
	protected $primaryKey = 'typevcl_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['type_vcl'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'typevcl_created';
    protected $updatedField  = 'typevcl_update';
    protected $deletedField  = 'typevcl_deleted';
	
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
<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'roles_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['name','description', 'defaulft_page'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'roles_create';
    protected $updatedField  = 'roles_update';
    protected $deletedField  = 'roles_delete';
	
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
		$role = new RoleModel();
		$data = $role->findAll();
		return $data;
	}
	
	public function selectData($data)
	{
		$role = new RoleModel();
		$data = $role->find($data);
		return $data;
	}
	
	public function insertData($data)
	{
		$role = new RoleModel();
		$insert = $role->insert($data
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
		$role = new RoleModel();
		$update = $role->update($id,$data);
		
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
		$role = new RoleModel();
		$delete= $role->delete($id);
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
		$user = new UserModel();
		$data = $customer->orderBy('customerupdate', 'DESC')->first();
		return $data;
	}
}
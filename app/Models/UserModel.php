<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['role_id','fullname', 'username', 'password','level'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'user_create';
    protected $updatedField  = 'user_update';
    protected $deletedField  = 'user_delete';
	
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
		$user = new UserModel();
		$data = $user->findAll();
		return $data;
	}
	
	public function selectData($data)
	{
		$user = new UserModel();
		$data = $user->find($data);
		return $data;
	}
	
	public function insertData($data)
	{
		$user = new UserModel();
		$insert = $user->insert($data
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
		$user = new UserModel();
		$update = $user->update($id,$data);
		
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
		$user = new UserModel();
		$delete= $user->delete($id);
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
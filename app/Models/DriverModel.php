<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
	protected $table = 'driver';
	protected $primaryKey = 'driver_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['driver_id','driver_name','driver_nik', 'driver_address','driver_status'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'driver_created';
    protected $updatedField  = 'driver_update';
    protected $deletedField  = 'driver_deleted';
	
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
		$driver = new DriverModel();
		$data = $driver->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$driver = new DriverModel();
		$data = $driver->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$driver = new DriverModel();
		$insert = $driver->insert($data
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
		$driver = new DriverModel();
		$update = $driver->update($id,$data);
		
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
		$driver = new DriverModel();
		$delete= $driver->delete($id);
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
	public function insertAll($data)
	{
		$driver = new DriverModel();
		$insert = $driver->insertBatch($data
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
	public function deleteAll()
	{
		$builder = $this->db->table('5edriver');
		$delete= $builder->emptyTable('5edriver');
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
	
	public function getdatatrash(){
		$driver = new DriverModel();
		$data = $driver->onlyDeleted()->findAll();
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5edriver')
				 ->set('driver_deleted', null ,true)
				 ->where(['driver_id' =>$id])
				 ->update();
        return ;
	}
}
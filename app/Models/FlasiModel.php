<?php

namespace App\Models;

use CodeIgniter\Model;

class FlasiModel extends Model
{
	protected $table = 'flasi';
	protected $primaryKey = 'flasi_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['flasi_id','flasi_plant','flasi_material','flasi_type_vcl', 'flasi_ton', 'flasi_cm'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'flasi_created';
    protected $updatedField  = 'flasi_update';
    protected $deletedField  = 'flasi_deleted';
	
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
		$flasi = new FlasiModel();
		$data = $flasi->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$flasi = new FlasiModel();
		$data = $flasi->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$flasi = new FlasiModel();
		$insert = $flasi->insert($data);
		
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
	public function insertAll($data)
	{
		$flasi = new FlasiModel();
		$insert = $flasi->insertBatch($data
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
		$flasi = new FlasiModel();
		$update = $flasi->update($id,$data);
		
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
		$flasi = new FlasiModel();
		$delete= $flasi->delete($id);
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
	public function deleteAll()
	{
		$builder = $this->db->table('5eflasi');
		$delete= $builder->emptyTable('5eflasi');
			if ($delete) {
			return ([
			    'status'=> 0,
                'message'=>'delete done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to delete']);
		}
	}
	public function getdatatrash(){
		$flasi = new FlasiModel();
		$data = $flasi->onlyDeleted()->findAll();
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5eflasi')
				 ->set('flasi_deleted', null ,true)
				 ->where(['flasi_id' =>$id])
				 ->update();
        return ;
	}
}
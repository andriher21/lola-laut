<?php

namespace App\Models;

use CodeIgniter\Model;

class TujuanModel extends Model
{
	protected $table = 'tujuan';
	protected $primaryKey = 'tujuan_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['tujuan_id','tujuan_company','alamat_tujuan'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'tujuan_created';
    protected $updatedField  = 'tujuan_update';
    protected $deletedField  = 'tujuan_deleted';
	
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
		$tujuan = new TujuanModel();
		$data = $tujuan ->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$tujuan = new TujuanModel();
		$data = $tujuan ->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$tujuan = new TujuanModel();
		$insert = $tujuan ->insert($data
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
	public function insertAll($data)
	{
		$tujuan = new TujuanModel();
		$insert = $tujuan->insertBatch($data
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
		$tujuan = new TujuanModel();
		$update = $tujuan ->update($id,$data);
		
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
		$tujuan = new TujuanModel();
		$delete= $tujuan ->delete($id);
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
		$builder = $this->db->table('5etujuan');
		$delete= $builder->emptyTable('5etujuan');
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
		$tujuan = new TujuanModel();
		$data = $tujuan->onlyDeleted()->findAll();
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5etujuan')
				 ->set('tujuan_deleted', null ,true)
				 ->where(['tujuan_id' =>$id])
				 ->update();
        return ;
	}
}
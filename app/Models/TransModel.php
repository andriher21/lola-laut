<?php

namespace App\Models;

use CodeIgniter\Model;

class TransModel extends Model
{
	protected $table = 'trans';
	protected $primaryKey = 'trans_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['trans_id','trans_vehicle','trans_company','trans_owner', 'trans_type_vcl','trans_material','trans_long_vcl','trans_wide_vcl','trans_high_vcl',
	'trans_volume_vcl','trans_last_in','trans_created_by', 'trans_index_date','trans_overweight'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'trans_created';
    protected $updatedField  = 'trans_update';
    protected $deletedField  = 'trans_delete';
	
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
		$trans = new TransModel();
		$data = $trans->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$trans = new TransModel();
		$data = $trans->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$trans = new TransModel();
		$insert = $trans->insert($data
		);
		
		if ($insert) {
		   $data = $trans->orderBy('trans_update', 'DESC')->first();
			return ([
			    'status'=> 0,
                'message'=>'new data created',
                'id'=>$data['trans_id']
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to create new data']);
		}
	}
	
	public function updateData($id,$data)
	{
		$trans = new TransModel();
		$update = $trans->update($id,$data);
		
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
	
	public function deleteData($data)
	{
		$trans = new TransModel();
		$delete= $trans->whereIn('trans_id',$data)->delete();;
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
		$trans = new TransModel();
		$insert = $trans->insertBatch($data
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
		$builder = $this->db->table('5etrans');
		$delete= $builder->emptyTable('5etrans');
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
	public function getTrans($offsett)
	{	$limit = 500;
		$trans = new TransModel();
		$data = $trans->findAll($limit,$offsett);
		return $data;
	}
	public function getdatatrash(){
		$trans = new TransModel();	
		$data = $trans->onlyDeleted()->findAll();
       
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5etrans')
				 ->set('trans_delete', null ,true)
				 ->where(['trans_id' =>$id])
				 ->update();
        return ;
	}

}
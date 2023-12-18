<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
	protected $table = 'item';
	protected $primaryKey = 'item_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['item_id','item_plant', 'item_material','item_berat_jenis','item_harga'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'item_created';
    protected $updatedField  = 'item_update';
    protected $deletedField  = 'item_delete';
	
	// protected $validationRules    = [
    //     'materialname' => 'required|min_length[5]',
    //     'materialdesc' => 'required|min_length[5]',
    // ];
	
	// protected $validationMessages = [
    //     'materialname' => [
    //         'required' => 'Bagian Name Harus diisi',
    //         'min_length' => 'Minimal 5 Karakter'
    //     ],
    //     'materialdesc' => [
    //         'required' => 'Bagian Desc Harus diisi',
    //         'min_length' => 'Minimal 5 Karakter'
    //     ]
    // ];
    // protected $skipValidation  = false;
	
	public function indexData()
	{
		$item = new ItemModel();
		$data = $item->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$item = new ItemModel();
		$data = $item->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$item = new ItemModel();
		$insert = $item->insert($data);
		
		if ($insert) {
			   $data = $item->orderBy('item_update', 'DESC')->first();
			return ([
			    'status'=> 0,
                'message'=>'new data created',
                'id'=>$data['item_id']
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to new data']);
		}
	}
	public function insertAll($data)
	{
		$item = new ItemModel();
		$insert = $item->insertBatch($data
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
		$item = new ItemModel();
		$update = $item->update($id, $data);
		
		if ($update) {
			return ([
			    'status'=> 0,
                'message'=>'update data done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to update data']);
		}
	}
	
	public function deleteData($data)
	{
		$item = new ItemModel();
		$delete=$item->whereIn('item_id',$data)->delete();
			if ($delete) {
			return ([
			    'status'=> 0,
                'message'=>'delete data done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to delete data']);
		}
	}
	public function deleteAll()
	{
		$builder = $this->db->table('5eitem');
		$delete= $builder->emptyTable('5eitem');
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
		$item = new ItemModel();	
		$data = $item->onlyDeleted()->findAll();
       
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5eitem')
				 ->set('item_delete', null ,true)
				 ->where(['item_id' =>$id])
				 ->update();
        return ;
	}
}
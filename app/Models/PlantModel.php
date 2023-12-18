<?php

namespace App\Models;

use CodeIgniter\Model;

class PlantModel extends Model
{
	protected $table = 'plant';
	protected $primaryKey = 'plant_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['plant_id','plant'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'plant_created';
    protected $updatedField  = 'plant_update';
    protected $deletedField  = 'plant_deleted';
	
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
		$plant = new PlantModel();
		$data = $plant->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$plant = new PlantModel();
		$data = $plant->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$plant = new PlantModel();
		$insert = $plant->insert($data
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
		$plant = new PlantModel();
		$insert = $plant->insertBatch($data
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
		$plant = new PlantModel();
		$update = $plant->update($id,$data);
		
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
		$plant = new PlantModel();
		$delete= $plant->delete($id);
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
		$builder = $this->db->table('5eplant');
		$delete= $builder->emptyTable('5eplant');
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
		$plant = new PlantModel();
		$data = $plant->onlyDeleted()->findAll();
       
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5eplant')
				 ->set('plant_deleted', null ,true)
				 ->where(['plant_id' =>$id])
				 ->update();
        return ;
	}
}
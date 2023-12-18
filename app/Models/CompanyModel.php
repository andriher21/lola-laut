<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
	protected $table = 'company';
	protected $primaryKey = 'company_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['company_id','company_no','company_name', 'company_address','company_npwp'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'company_created';
    protected $updatedField  = 'company_update';
    protected $deletedField  = 'company_delete';
	
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
		$company = new CompanyModel();
		$data = $company->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$company = new CompanyModel();
		$data =$company->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$company = new CompanyModel();
		$insert = $company->insert($data);
		
		if ($insert) {
			$data = $company->orderBy('company_update', 'DESC')->first();
			return ([
			    'status'=> 0,
                'message'=>'new data created',
                'id'=>$data['company_id']
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to create new data']);
		}
	}
	
	public function updateData($id,$data)
	{
	    $company = new CompanyModel();
		$update = $company->update($id, $data);
		
		if ($update) {
			return ([
			    'status'=> 0,
                'message'=>'update item done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to update item']);
		}
	}
	
	public function deleteData($data)
	{
		$company = new CompanyModel();
		$delete=$company->whereIn('company_id',$data)->delete();
			if ($delete) {
			return ([
			    'status'=> 0,
                'message'=>'delete item done'
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to delete item']);
		}
	}
	public function insertAll($data)
	{
		$company = new CompanyModel();
		$insert = $company->insertBatch($data
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
		$builder = $this->db->table('5ecompany');
		$delete= $builder->emptyTable('5ecompany');
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
		$company = new CompanyModel();
		$data = $company->onlyDeleted()->findAll();
       
        return $data ;
	}
	public function restoreData($id){
		$this->db->table('5ecompany')
				 ->set('company_delete', null ,true)
				 ->where(['company_id' =>$id])
				 ->update();
        return ;
	}
}
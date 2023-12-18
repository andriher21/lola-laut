<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
	protected $table = 'company';
	protected $primaryKey = 'company_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['company_no','company_name', 'company_address','company_npwp'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'company_create';
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
		$customer = new CustomerModel();
		$data = $customer->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$customer = new CustomerModel();
		$data = $customer->find($id);
		return $data;
	}
	
	public function insertData($name, $addr)
	{
		$customer = new CustomerModel();
		$insert = $customer->insert([
			'customername' => $name,
			'customeraddr' => $addr
		]);
		
		if ($insert) {
			return 0;
		} else {
			return -1;
		}
	}
	
	public function updateData($id, $name, $addr)
	{
		$customer = new CustomerModel();
		$update = $customer->update($id, [
			'customername' => $name,
			'customeraddr' => $addr
		]);
		
		if ($update) {
			return 0;
		} else {
			return -1;
		}
	}
	
	public function deleteData($id)
	{
		$customer = new CustomerModel();
		$customer->delete($id);
		return 0;
	}
	
	public function lastData()
	{
		$customer = new CustomerModel();
		$data = $customer->orderBy('customerupdate', 'DESC')->first();
		return $data;
	}
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
	protected $table = 'material';
	protected $primaryKey = 'materialid';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['materialname', 'materialdesc'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'materialcreate';
    protected $updatedField  = 'materialupdate';
    protected $deletedField  = 'materialdelete';
	
	protected $validationRules    = [
        'materialname' => 'required|min_length[5]',
        'materialdesc' => 'required|min_length[5]',
    ];
	
	protected $validationMessages = [
        'materialname' => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 5 Karakter'
        ],
        'materialdesc' => [
            'required' => 'Bagian Desc Harus diisi',
            'min_length' => 'Minimal 5 Karakter'
        ]
    ];
    protected $skipValidation  = false;
	
	public function indexData()
	{
		$material = new MaterialModel();
		$data = $material->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$material = new MaterialModel();
		$data = $material->find($id);
		return $data;
	}
	
	public function insertData($name, $desc)
	{
		$material = new MaterialModel();
		$insert = $material->insert([
			'materialname' => $name,
			'materialdesc' => $desc
		]);
		
		if ($insert) {
			return 0;
		} else {
			return -1;
		}
	}
	
	public function updateData($id, $name, $desc)
	{
		$material = new MaterialModel();
		$update = $material->update($id, [
			'materialname' => $name,
			'materialdesc' => $desc
		]);
		
		if ($update) {
			return 0;
		} else {
			return -1;
		}
	}
	
	public function deleteData($id)
	{
		$material = new MaterialModel();
		$material->delete($id);
		return 0;
	}
	
	public function lastData()
	{
		$material = new MaterialModel();
		$data = $material->orderBy('materialupdate', 'DESC')->first();
		return $data;
	}
}
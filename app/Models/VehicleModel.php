<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
	protected $table = 'vehicle';
	protected $primaryKey = 'vehicleid';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['vehiclenumb', 'vehicletype'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'vehiclecreate';
    protected $updatedField  = 'vehicleupdate';
    protected $deletedField  = 'vehicledelete';
	
	protected $validationRules    = [
        'vehiclenumb' => 'required|min_length[5]',
        'vehicletype' => 'required|min_length[5]',
    ];
	
	protected $validationMessages = [
        'vehiclenumb' => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 5 Karakter'
        ],
        'vehicletype' => [
            'required' => 'Bagian Addr Harus diisi',
            'min_length' => 'Minimal 5 Karakter'
        ]
    ];
    protected $skipValidation  = false;
	
	public function indexData()
	{
		$vehicle = new VehicleModel();
		$data = $vehicle->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$vehicle = new VehicleModel();
		$data = $vehicle->find($id);
		return $data;
	}
	
	public function insertData($numb, $type)
	{
		$vehicle = new VehicleModel();
		$insert = $vehicle->insert([
			'vehiclenumb' => $numb,
			'vehicletype' => $type
		]);
		
		if ($insert) {
			return 0;
		} else {
			return -1;
		}
	}
	
	public function updateData($id, $numb, $type)
	{
		$vehicle = new VehicleModel();
		$update = $vehicle->update($id, [
			'vehiclenumb' => $numb,
			'vehicletype' => $type
		]);
		
		if ($update) {
			return 0;
		} else {
			return -1;
		}
	}
	
	public function deleteData($id)
	{
		$vehicle = new VehicleModel();
		$vehicle->delete($id);
		return 0;
	}
	
	public function lastData()
	{
		$vehicle = new VehicleModel();
		$data = $vehicle->orderBy('vehicleupdate', 'DESC')->first();
		return $data;
	}
}
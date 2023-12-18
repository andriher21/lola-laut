<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientidModel extends Model
{
	protected $table = 'client';
	protected $primaryKey = 'clientid';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['clientnumb', 'clientname','whitelist'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'clientcreate';
    protected $updatedField  = 'clientupdate';
    protected $deletedField  = 'clientdelete';
	
	// protected $validationRules    = [
    //     'clientnumb' => 'required|min_length[5]',
    //     'clientname' => 'required|min_length[5]',
    // ];
	
	// protected $validationMessages = [
    //     'clientnumb' => [
    //         'required' => 'Bagian Name Harus diisi',
    //         'min_length' => 'Minimal 5 Karakter'
    //     ],
    //     'clientname' => [
    //         'required' => 'Bagian Addr Harus diisi',
    //         'min_length' => 'Minimal 5 Karakter'
    //     ]
    // ];
    // protected $skipValidation  = false;
	
	public function indexData()
	{
		$client = new ClientidModel();
		$data = $client->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$client = new ClientidModel();
		$data = $client->find($id);
		return $data;
	}
	public function insertData($data)
	{
		$client = new ClientidModel();
		$insert = $client->insert($data);
		
		if ($insert) {
			$data = $client->orderBy('clientupdate', 'DESC')->first();
			return ([
			    'status'=> 0,
                'message'=>'new data created',
                'id'=>$data['clientid']
			    ]);
		} else {
			return ([
			    'status'=> 2,
                    'message' => 'failed to create new data']);
		}
	}
	
	public function updateData($id,$data)
	{
	    $client = new ClientidModel();
		$update = $client->update($id, $data);
		
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
		$client = new ClientidModel();
		$delete=$client->whereIn('clientid',$data)->delete();
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
}
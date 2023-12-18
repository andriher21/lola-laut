<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordModel extends Model
{
	protected $table = 'record';
	protected $primaryKey = 'recordid';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['recordcid','recordcname', 'recordcaddr', 'recordvnumb', 'recordvtype', 'recordmname', 'recordmdesc', 'recordwin', 'recordwout', 'recordnett', 'recorddtin', 'recorddtout'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'recordcreate';
    protected $updatedField  = 'recordupdate';
    protected $deletedField  = 'recorddelete';
	
	protected $validationRules    = [
        'recordcname' => 'required|min_length[5]',
        'recordvnumb' => 'required|min_length[5]',
    ];
	
	protected $validationMessages = [
        'recordcname' => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 5 Karakter'
        ],
        'recordvnumb' => [
            'required' => 'Bagian Desc Harus diisi',
            'min_length' => 'Minimal 5 Karakter'
        ]
    ];
    protected $skipValidation  = false;
	
	public function indexData()
	{
		$record = new RecordModel();
		$data = $record->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$record = new RecordModel();
		$data = $record->find($id);
		return $data;
	}
	
	public function insertData($cname, $caddr, $vnumb, $vtype, $mname, $mdesc, $win, $wout, $nett, $dtin, $dtout)
	{
		$record = new RecordModel();
		$insert = $record->insert([
			'recordcname' => $cname,
			'recordcaddr' => $caddr,
			'recordvnumb' => $vnumb,
			'recordvtype' => $vtype,
			'recordmname' => $mname,
			'recordmdesc' => $mdesc,
			'recordwin' => $win,
			'recordwout' => $wout,
			'recordnett' => $nett,
			'recorddtin' => $dtin,
			'recorddtout' => $dtout
		]);
		
		if ($insert) {
			return 0;
		} else {
			return -1;
		}
	}
	
	/*public function updateData($id, $name, $desc)
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
	}*/
	
	public function deleteData($id)
	{
		$record = new RecordModel();
		$record->delete($id);
		return 0;
	}
	
	public function lastData()
	{
		$record = new RecordModel();
		$data = $record->orderBy('recordupdate', 'DESC')->first();
		return $data;
	}
}
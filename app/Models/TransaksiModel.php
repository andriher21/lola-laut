<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
	protected $table = 'transaksi';
	protected $primaryKey = 'transaksi_id';
	
	protected $returnType = 'array';
	protected $useSoftDeletes = true;
	
	protected $allowedFields = ['qt_id','jenis_transaksi', 'vehicle','company','address','driver','no_ktp',
    'jenis_vcl', 'material','tujuan','kasir_in','kasir_out','no_faktur','no_do','no_do1','no_po','no_segel',
    'panjang_vcl','lebar_vcl','tinggi_vcl','vol_vcl','flasi_ton','falsi_cm','plant','harga_sa_ton','harga_sat_kubik',
    'vol_ton','vol_kubik','subtotal_ton','subtotal_kubik','ppn_total','ppn_kubik','total_ton','total_kubik',
    'date_in','weight_in','date_out','weight_out','nett_weight','created_by','modifed_by','created_from','modifed_from','berat_jenis','bp',
    'potongan', 'selisih_flasi', 'alamat_ktp','date_create'];
	
	protected $useTimestamps = true;
    protected $createdField  = 'transaksi_created';
    protected $updatedField  = 'transaksi_update';
    protected $deletedField  = 'transaksi_delete';

    public function indexData()
	{
		$transaksi = new TransaksiModel();
		$data = $transaksi->findAll();
		return $data;
	}
	
	public function selectData($id)
	{
		$transaksi = new TransaksiModel();
		$data = $transaksi->find($id);
		return $data;
	}
	
	public function insertData($data)
	{
		$transaksi = new TransaksiModel();
		$insert = $transaksi->insert($data);
		
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
		$transaksi = new TransaksiModel();
		$update = $transaksi->update($id,$data);
		
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
		$transaksi = new TransaksiModel();
		$delete= $transaksi->delete($id);
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
	public function getCount(){
		$transaksi = new TransaksiModel();
		$db = db_connect();
		// $date = date('Y-m-d');
		$count= $transaksi->select('COUNT(transaksi_id) as transaksi')->where('transaksi_delete',NULL)->get()->getResult();
		$company=count( $transaksi->select('company')->where('transaksi_delete',NULL)->groupby('company')->get()->getResult());
		$material=count( $transaksi->select('material')->where('transaksi_delete',NULL)->groupby('material')->get()->getResult());
		$vehicle= count($transaksi->select(' vehicle')->where('transaksi_delete',NULL)->groupby('vehicle')->get()->getResult());
		return array(
             'company' => $company,
            'transaction' => $count,
             'material' => $material,
            'vehicle' => $vehicle
        );
	}
	public function getLasttransaction()
    {	$transaksi = new TransaksiModel();
		$lasttransaction = $transaksi->select('*')->where('transaksi_delete',NULL)->orderby('transaksi_created', 'DESC')->limit(5)->get()->getResultArray ();
       
        return $lasttransaction;
    }
	public function getweight()
    {	$transaksi = new TransaksiModel();
		$bigweight = $transaksi->select('vehicle,material, nett_weight,date_out')->where('transaksi_delete',NULL)
							->orderby('nett_weight', 'DESC')->limit(5)->get()->getResultArray ();
       
        return $bigweight ;
    }
	public function gettransaction()
    {  
		$transaksi = new TransaksiModel();
		$transaksi = $transaksi->select('sum(nett_weight) as sumnett,date_out')->where('transaksi_delete',NULL)
							->groupby('date_out')->limit(5)->get()->getResultArray ();
       
        return $transaksi ;
    }
	public function getmaterial()
	{
		$transaksi = new TransaksiModel();
		$material = $transaksi->select('sum(nett_weight) as sumnett,material')->where('transaksi_delete',NULL)
							->groupby('material')->limit(5)->get()->getResultArray ();
       
        return $material ;
	}
	public function getdatatransaction($data)
	{
		$transaksi = new TransaksiModel();
		$transaction = $transaksi->select('*')->where('date_create',$data)->where('transaksi_delete',NULL)
							->orderby('transaksi_id','DESC')->get()->getResultArray();
       
        return $transaction ;
	}
	public function getdatareport($start, $end){
		$transaksi = new TransaksiModel();
		$report = $transaksi->select('*')
							->where("date_create BETWEEN '$start' AND '$end' ")
							->where('transaksi_delete',NULL)
							->orderby('transaksi_id','DESC')->get()->getResultArray();
       
        return $report ;
	}
	public function getdatareporttrash($start, $end){
		$transaksi = new TransaksiModel();
		$report = $transaksi->select('*')
							->where("date_create BETWEEN '$start' AND '$end' ")
							->where('transaksi_delete !=',NULL)
							->orderby('transaksi_id','DESC')->get()->getResultArray();
       
        return $report ;
	}
	public function restoreData($id){
		$this->db->table('5etransaksi')
				 ->set('transaksi_deleted', null ,true)
				 ->where(['transaksi_id' =>$id])
				 ->update();
        return ;
	}
      
}
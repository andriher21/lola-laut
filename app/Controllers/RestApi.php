<?php

namespace App\Controllers;

class RestApi extends BaseController
{
    public function index()
    {
		$result = array();
		
		if ($this->session->has('user'))
		{
			$result['record'] = $this->record->lastData();
			$result['customer'] = $this->customer->lastData();
			$result['vehicle'] = $this->vehicle->lastData();
			$result['material'] = $this->material->lastData();
			
			$temp = $this->record->indexData();
			$result['record']['recordcount'] = count($temp);
			
			$temp = $this->customer->indexData();
			$result['customer']['customercount'] = count($temp);
			
			$temp = $this->vehicle->indexData();
			$result['vehicle']['vehiclecount'] = count($temp);
			
			$temp = $this->material->indexData();
			$result['material']['materialcount'] = count($temp);			
		}
		else
		{
			$result['customer'] = (object)[];
			$result['vehicle'] = (object)[];
			$result['material'] = (object)[];
		}
		
		echo json_encode($result);
    }
	
	public function recordindex()
	{
		// $result = array();
		
		if ($this->session->has('user'))
		{
			$result = $this->record->indexData();
		}
		
		echo json_encode($result);
	}
	
	public function recordget($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->record->selectData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function recorddelete($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->record->deleteData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function companyindex()
	{   
		$token = $this->request->getVar('token');
		$result = array();
		
		if ($token =='Ab42cFQ')
		{
			$result = $this->company->indexData();
		}
		
		echo json_encode($result);
	}
	public function itemindex()
	{   
		$token = $this->request->getVar('token');
		$result = array();
		
		if ($token =='Ab42cFQ')
		{
			$result = $this->item->indexData();
		}
		
		echo json_encode($result);
	}
	
	
	public function customerget($id)
	{
		$result = (object)[];
		
		//if ($this->session->has('user'))
		//{
			$result = $this->customer->selectData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		//}
		
		echo json_encode($result);
	}
	
	public function customerpost()
	{
		$result = (object)[];
		
		$name = $this->request->getPost('name');
		$addr = $this->request->getPost('addr');
		
		if ($this->session->has('user'))
		{
			$result = $this->customer->insertData($name, $addr);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function customerput()
	{
	}
	
	public function customerpatch($id)
	{
		$result = (object)[];
		
		$parameter = $this->request->getRawInput();
		
		if ($this->session->has('user'))
		{
			$result = $this->customer->updateData($id, $parameter['name'], $parameter['addr']);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function customerdelete($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->customer->deleteData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	//vehicle
	
	public function vehicleindex()
	{
		$result = array();
		
		if ($this->session->has('user'))
		{
			$result = $this->vehicle->indexData();
		}
		
		echo json_encode($result);
	}
	
	public function vehicleget($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->vehicle->selectData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function vehiclepost()
	{
		$result = (object)[];
		
		$numb = $this->request->getPost('numb');
		$type = $this->request->getPost('type');
		
		if ($this->session->has('user'))
		{
			$result = $this->vehicle->insertData($numb, $type);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function vehicleput()
	{
	}
	
	public function vehiclepatch($id)
	{
		$result = (object)[];
		
		$parameter = $this->request->getRawInput();
		
		if ($this->session->has('user'))
		{
			$result = $this->vehicle->updateData($id, $parameter['numb'], $parameter['type']);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function vehicledelete($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->vehicle->deleteData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	//material
	
	public function materialindex()
	{
		$result = array();
		
		if ($this->session->has('user'))
		{
			$result = $this->material->indexData();
		}
		
		echo json_encode($result);
	}
	
	public function materialget($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->material->selectData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function materialpost()
	{
		$result = (object)[];
		
		$name = $this->request->getPost('name');
		$desc = $this->request->getPost('desc');
		
		if ($this->session->has('user'))
		{
			$result = $this->material->insertData($name, $desc);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function materialput()
	{
	}
	
	public function materialpatch($id)
	{
		$result = (object)[];
		
		$parameter = $this->request->getRawInput();
		
		if ($this->session->has('user'))
		{
			$result = $this->material->updateData($id, $parameter['name'], $parameter['desc']);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function materialdelete($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->material->deleteData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
	
	public function clientidindex()
	{
		$result = array();
		
		if ($this->session->has('user'))
		{
			$result = $this->clientid->indexData();
		}
		
		echo json_encode($result);
	}
	
	public function clientidget($id)
	{
		$result = (object)[];
		
		if ($this->session->has('user'))
		{
			$result = $this->clientid->selectData($id);
			if (is_null($result))
			{
				$result = (object)[];
			}
		}
		
		echo json_encode($result);
	}
}
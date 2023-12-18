<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
		//echo "INDEX";
		return view('home');
    }
	
	public function test()
	{
		if ($this->session->has('user'))
		{
			echo $this->session->get('user');
		}
		else
		{
			echo 'GUEST';
		}
	}
	
	public function login()
	{
		$this->session->set('user', 'rudy');
		return view('dashboard');
	}
	
	public function logoff()
	{
		$this->session->remove('user');
		return view('home');
	}
	
	public function dashboard()
	{
		if ($this->session->has('user'))
		{
			return view('dashboard');
		}
		else
		{
			return view('dashboard');
		}
	}
	
	public function record()
	{
		if ($this->session->has('user'))
		{
			return view('record');
		}
		else
		{
			return view('record');
		}
	}
	
	public function customer()
	{
		if ($this->session->has('user'))
		{
			return view('customer');
		}
		else
		{
			return view('customer');
		} 
	}
	
	public function vehicle()
	{
		if ($this->session->has('user'))
		{
			return view('vehicle');
		}
		else
		{
			return view('vehicle');
		} 
	}
	
	public function material()
	{
		if ($this->session->has('user'))
		{
			return view('material');
		}
		else
		{
			return view('material');
		} 
	}
	
	public function clientid()
	{
		if ($this->session->has('user'))
		{
			return view('clientid');
		}
		else
		{
			return view('clientid');
		} 
	}
}

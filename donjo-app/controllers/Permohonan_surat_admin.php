<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Permohonan_surat_admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('permohonan_surat_model');
		$this->load->model('referensi_model');
		$this->load->model('header_model');
		$this->modul_ini = 14;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect($this->controller);
	}

	public function index($p = 1, $o = 0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['list_status_permohonan'] = $this->referensi_model->list_kode_array(STATUS_PERMOHONAN);
		$data['paging'] = $this->permohonan_surat_model->paging($p, $o);
		$data['main'] = $this->permohonan_surat_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->permohonan_surat_model->autocomplete();

		$header = $this->header_model->get_data();
		$nav['act'] = 14;
		$nav['act_sub'] = 98;

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('mandiri/permohonan_surat', $data);
		$this->load->view('footer');		
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari']=$cari;
		else unset($_SESSION['cari']);
		redirect($this->controller);
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != '')
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		redirect($this->controller);
	}

	public function periksa($id)
	{
		$header = $this->header_model->get_data();
		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('mandiri/periksa_surat', $data);
		$this->load->view('footer');		
	}

}
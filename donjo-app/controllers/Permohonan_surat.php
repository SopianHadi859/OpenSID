<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Permohonan_surat extends Web_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penduduk_model');
		$this->load->model('keluarga_model');
		$this->load->model('surat_model');
		$this->load->model('keluar_model');
		$this->load->model('config_model');
		$this->load->model('referensi_model');
		$this->load->model('penomoran_surat_model');
	}

	public function form()
	{
		$data = $_POST;
		$surat = $this->db->where('id', $data['id_surat'])
			->get('tweb_surat_format')
			->row_array();
		$data['url'] = $surat['url_surat'];
		$url = $data['url'];

		$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
		$data['individu'] = $this->surat_model->get_penduduk($data['nik']);
		$data['anggota'] = $this->keluarga_model->list_anggota($data['individu']['id_kk']);
		$this->get_data_untuk_form($url, $data);

		$data['surat_url'] = rtrim($_SERVER['REQUEST_URI'], "/clear");
		$data['form_action'] = site_url("surat/cetak/$url");
		$data['views_partial_layout'] = "surat/form_surat.php";
		$data['data'] = $data;
		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	private function get_data_untuk_form($url, &$data)
	{
		$data['surat_terakhir'] = $this->surat_model->get_last_nosurat_log($url);
		$data['surat'] = $this->surat_model->get_surat($url);
		$data['input'] = $this->input->post();
		$data['input']['nomor'] = $data['surat_terakhir']['no_surat_berikutnya'];
		$data['format_nomor_surat'] = $this->penomoran_surat_model->format_penomoran_surat($data);
		$data['lokasi'] = $this->config_model->get_data();
		$data_form = $this->surat_model->get_data_form($url);
		if (is_file($data_form))
			include($data_form);
	}


}
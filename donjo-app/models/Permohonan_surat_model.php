<?php class Permohonan_surat_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
	{
		$outp = $this->db->insert('permohonan_surat', $data);
		return $outp;
	}

}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ppdb_model extends CI_Model
{
	function insert_data($data, $table)
	{
		return $this->db->insert($table, $data);
	}

	function getAll($table)
	{
		return $this->db->get($table);
	}
	function getOneData($data, $table)
	{
		return $this->db->get_where($table, $data);
	}

	function joinTableSiswa($username)
	{
		$this->db->select('tabel_pembayaran.status,tabel_pembayaran.nik,tabel_siswa.*')
			->from('tabel_siswa')
			->join('tabel_pembayaran', 'tabel_siswa.nik_siswa=tabel_pembayaran.nik')
			->where("tabel_siswa.username", $username);
		return	$this->db->get();
	}
	public function uploadFile($name, $path)
	{
		if (!file_exists($path))
			mkdir($path);

		$config = [
			'upload_path'	=> $path,
			'allowed_types' => 'jpg|png|jpeg',
			'overwrite'		=> TRUE,
			'max_size'		=> 1024
		];
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($name)) {
			$eror = "EROR";
			$this->session->set_flashdata('msg', $this->upload->display_errors());
			redirect('daftar-akun');
		}
		$uploaded_data =  $this->upload->data();
		$this->upload->overwrite = TRUE;
		return $uploaded_data;
	}
}

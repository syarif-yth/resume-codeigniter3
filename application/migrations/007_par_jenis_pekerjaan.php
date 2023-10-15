<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_par_jenis_pekerjaan extends CI_migration
{
	private $tb_name;
	private $tb_key;
	private $tb_engine;
	private $tb_field;

	function __construct()
	{
		parent::__construct();
		$this->tb_name = 'par_jenis_pekerjaan';
		$this->tb_key = 'id';
		$this->tb_engine = array('ENGINE' => 'InnoDB');
		$this->tb_field = $this->set_field();
	}

	private function set_field()
	{
		$field = array(
			'id' => array(
				'type' => 'INT',
				'null' => false,
				'auto_increment' => true),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				'null' => false)
		);
		return $field;
	}

	private function set_value()
	{		
		$data = array(
			array('nama' => 'Purnawaktu'),
			array('nama' => 'Paruh Waktu'),
			array('nama' => 'Wiraswasta'),
			array('nama' => 'Pekerja Lepas'),
			array('nama' => 'Kontrak'),
			array('nama' => 'Magang'),
			array('nama' => 'Musiman')
		);
		return $data;
	}

	public function up()
	{
		$exis = $this->db->table_exists($this->tb_name);
		if(!$exis) {
			$this->dbforge->add_field($this->tb_field);
			$this->dbforge->add_key($this->tb_key, TRUE);
			$this->dbforge->create_table($this->tb_name, FALSE, $this->tb_engine);

			$value = $this->set_value();
			$this->load->database();
			$this->db->insert_batch($this->tb_name, $value);
		}
	}

	public function down()
	{
		$this->dbforge->drop_table($this->tb_name);
	}
}
?>

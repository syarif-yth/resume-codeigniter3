<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_navigasi extends CI_migration
{
	private $tb_name;
	private $tb_key;
	private $tb_engine;
	private $tb_field;

	function __construct()
	{
		parent::__construct();
		$this->tb_name = 'navigasi';
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
			'group' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => false),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => 20,
				'null' => false,
				'unique' => true),
			'label' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => false),
			'url' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => true),
			'icon' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => false,
				'default' => 'fa fa-bars'),
			'urutan' => array(
				'type' => 'INT',
				'constraint' => 2,
				'null' => true,
				'unique' => true),
			'tgl_dibuat datetime default CURRENT_TIMESTAMP',
			'tgl_modif datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'
		);
		return $field;
	}

	private function set_value()
	{
		$data[] = array(
			'group' => 'main',
			'nama' => 'dashboard',
			'label' => 'Dashboard',
			'url' => 'dashboard',
			'icon' => 'fa fa-tachometer',
			'urutan' => '1');
		$data[] = array(
			'group' => 'main',
			'nama' => 'profile',
			'label' => 'Profile',
			'url' => 'profile',
			'icon' => 'fa fa-user',
			'urutan' => '2');
		$data[] = array(
			'group' => 'main',
			'nama' => 'resume',
			'label' => 'Resume',
			'url' => 'resume',
			'icon' => 'fa fa-file',
			'urutan' => '3');
		$data[] = array(
			'group' => 'main',
			'nama' => 'users',
			'label' => 'Users',
			'url' => 'users',
			'icon' => 'fa fa-users',
			'urutan' => '4');

		$data[] = array(
			'group' => 'parameters',
			'nama' => 'jenis_pekerjaan',
			'label' => 'Type Work',
			'url' => 'jenis_pekerjaan',
			'icon' => 'fa fa-bars',
			'urutan' => '5');
		$data[] = array(
			'group' => 'parameters',
			'nama' => 'kabupaten',
			'label' => 'Location',
			'url' => 'kabupaten',
			'icon' => 'fa fa-map-marker',
			'urutan' => '6');

		$data[] = array(
			'group' => 'settings',
			'nama' => 'navigation',
			'label' => 'Navigations',
			'url' => 'navigation',
			'icon' => 'fa fa-bars',
			'urutan' => '7');
		$data[] = array(
			'group' => 'settings',
			'nama' => 'classes',
			'label' => 'Classes',
			'url' => 'classes',
			'icon' => 'fa fa-share-alt',
			'urutan' => '8');
		$data[] = array(
			'group' => 'settings',
			'nama' => 'permision',
			'label' => 'Permisions',
			'url' => 'permision',
			'icon' => 'fa fa-shield',
			'urutan' => '9');
		return $data;
	}

	public function up()
	{
		$exis = $this->db->table_exists($this->tb_name);
		if(!$exis) {
			$this->dbforge->add_field($this->tb_field);
			$this->dbforge->add_key($this->tb_key, TRUE);
			$this->dbforge->create_table($this->tb_name, FALSE, $this->tb_engine);

			$this->load->database();
			
			$foreign = 'ALTER TABLE '.$this->tb_name.' ADD FOREIGN KEY (group) REFERENCES group_navigasi(nama)';
			$this->db->query($foreign);

			$value = $this->set_value();
			$this->db->insert_batch($this->tb_name, $value);
		}
	}

	public function down()
	{
		$this->dbforge->drop_table($this->tb_name);
	}
}
?>

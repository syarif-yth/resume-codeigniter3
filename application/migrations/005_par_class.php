<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_par_class extends CI_migration
{
	private $tb_name;
	private $tb_key;
	private $tb_engine;
	private $tb_field;

	function __construct()
	{
		parent::__construct();
		$this->tb_name = 'par_class';
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
				'constraint' => 20,
				'null' => false,
				'unique' => true),
			'label' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => false),
			'is_child' => array(
				'type' => 'ENUM("0","1")',
				'null' => false,
				'default' => '0'),
			'parent' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true,
				'default' => NULL),
			'tgl_dibuat datetime default CURRENT_TIMESTAMP'
		);
		return $field;
	}

	private function set_value()
	{		
		$data = array(
			array('nama' => 'permision',
				'label' => 'Permisions',
				'is_child' => '0'),
			array('nama' => 'navigation',
				'label' => 'Navigations',
				'is_child' => '0'),
			array('nama' => 'classes',
				'label' => 'Classes',
				'is_child' => '0'),
			array('nama' => 'datatable',
				'label' => 'DataTable',
				'is_child' => '1',
				'parent' => 'permision,navigation,classes'),
			array('nama' => 'nav',
				'label' => 'Navigasi',
				'is_child' => '1',
				'parent' => 'permision'),
			array('nama' => 'class',
				'label' => 'Class',
				'is_child' => '1',
				'parent' => 'permision'),
			array('nama' => 'method',
				'label' => 'Method',
				'is_child' => '1',
				'parent' => 'permision'),
			array('nama' => 'detail',
				'label' => 'Detail',
				'is_child' => '1',
				'parent' => 'permision'),
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
			$batch = $this->db->insert_batch($this->tb_name, $value);
			if(!$batch) {
				foreach($value as $val) {
					$this->db->insert($this->tb_name, $val);
				}
			}
		}
	}

	public function down()
	{
		$this->dbforge->drop_table($this->tb_name);
	}
}
?>

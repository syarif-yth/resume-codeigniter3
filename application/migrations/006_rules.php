<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rules extends CI_migration
{
	private $tb_name;
	private $tb_key;
	private $tb_engine;
	private $tb_field;

	function __construct()
	{
		parent::__construct();
		$this->tb_name = 'rules';
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
				'constraint' => 15,
				'null' => false,
				'unique' => true),
			'label' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => false,
				'default' => 'user'),
			'navigasi' => array(
				'type' => 'JSON',
				'null' => true,
				'default' => NULL),
			'class' => array(
				'type' => 'JSON',
				'null' => true,
				'default' => NULL),
			'tgl_dibuat datetime default CURRENT_TIMESTAMP',
			'tgl_modif datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'
		);
		return $field;
	}

	private function set_value()
	{
		$navi = array('navigation','classes','permision');
		$class = array(
			'navigation' => array(
				'aksi' => array('add', 'edit', 'delete'),
				'method' => array('get', 'post', 'put', 'delete'),
				'child' => array('datatable' => array('post'))
			),
			'classes' => array(
				'aksi' => array('add', 'edit', 'delete'),
				'method' => array('get', 'post', 'put', 'delete'),
				'child' => array('datatable' => array('post'))
			),
			'permision' => array(
				'aksi' => array('add', 'edit', 'delete'),
				'method' => array('get', 'post', 'put', 'delete'),
				'child' => array(
					'nav' => array('put'),
					'class' => array('put'),
					'detail' => array('post'),
					'method' => array('put'),
					'datatable' => array('post'),
				)
			)
		);

		$data = array(
			array('nama' => 'admin',
				'label' => 'Administrator',
				'navigasi' => json_encode($navi),
				'class' => json_encode($class)),
			array('nama' => 'user',
				'label' => 'User App')
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

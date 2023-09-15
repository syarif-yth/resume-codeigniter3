<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_users extends CI_migration
{
	private $tb_name;
	private $tb_engine;
	private $tb_field;

	function __construct()
	{
		parent::__construct();
		$this->tb_name = 'users';
		$this->tb_key = 'id';
		$this->tb_engine = array('ENGINE' => 'InnoDB');
		$this->tb_field = $this->set_field();
	}

	private function set_field()
	{
		$field = array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => true),
			'nip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => false,
				'unique' => true),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => false,
				'unique' => true),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => false,
				'unique' => true),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => false),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true,
				'default' => 'NEW USER'),
			'tgl_lahir' => array(
				'type' => 'date',
				'null' => true,
				'default' => NULL),
			'jenis_kelamin' => array(
				'type' => 'ENUM("laki-laki","perempuan","")',
				'null' => true,
				'default' => NULL),
			'no_telp' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => true,
				'default' => NULL),
			'avatar' => array(
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => true,
				'default' => 'avatar-default.jpg'),
			'profesi' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => true,
				'defult' => NULL),
			'online' => array(
				'type' => 'ENUM("0","1")',
				'null' => true,
				'default' => '0'),
			'kode_aktifasi' => array(
				'type' => 'VARCHAR',
				'constraint' => 6,
				'null' => true,
				'default' => NULL),
			'token' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true,
				'default' => NULL),
			'time_email' => array(
				'type' => 'INT',
				'null' => true,
				'default' => NULL),
			'tgl_regist datetime default current_timestamp'
		);
		return $field;
	}

	private function set_value()
	{
		$this->load->helper('input_helper');
		$nip = create_nip();
		$pass = encrypt_pass($nip, 'admin');
		$data[] = array(
			'nip' => $nip,
			'email' => 'syarif.yth@gmail.com',
			'username' => 'admin',
			'password' => $pass,
			'nama' => 'Admin APP');
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

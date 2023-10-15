<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_attr_users extends CI_migration
{
	private $tb_name;
	private $tb_key;
	private $tb_engine;
	private $tb_field;

	function __construct()
	{
		parent::__construct();
		$this->tb_name = 'attr_users';
		$this->tb_key = 'nip';
		$this->tb_engine = array('ENGINE' => 'InnoDB');
		$this->tb_field = $this->set_field();
	}

	private function set_field()
	{
		$field = array(
			'nip' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => false),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				'null' => false,
				'unique' => true),
			'rule' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => false,
				'default' => 'user'),
			'online' => array(
				'type' => 'ENUM("0","1")',
				'null' => true,
				'default' => '0'),
			'kode_aktifasi' => array(
				'type' => 'VARCHAR',
				'constraint' => 6,
				'null' => true,
				'default' => NULL),
			'exp_aktifasi' => array(
				'type' => 'INT',
				'null' => true,
				'default' => NULL),
			'kode_recovery' => array(
				'type' => 'VARCHAR',
				'constraint' => 40,
				'null' => true,
				'default' => NULL),
			'exp_recovery' => array(
				'type' => 'INT',
				'null' => true,
				'default' => NULL),
			'non_aktif' => array(
				'type' => 'ENUM("0","1")',
				'null' => true,
				'default' => '0'),
			'tgl_regist datetime default CURRENT_TIMESTAMP',
			'tgl_modif datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'
		);
		return $field;
	}

	private function set_users($nip, $pass)
	{		
		$data[] = array(
			'nip' => $nip,
			'email' => 'syarif.yth@gmail.com',
			'username' => 'admin_app',
			'password' => $pass,
			'nama' => 'Admin APP');
		return $data;
	}

	private function set_attr($nip)
	{
		$data[] = array(
			'nip' => $nip,
			'email' => 'syarif.yth@gmail.com',
			'rule' => 'admin');
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
			$foreign_nip = 'ALTER TABLE '.$this->tb_name.' ADD FOREIGN KEY (nip) REFERENCES users(nip)';
			$this->db->query($foreign_nip);

			$foreign_email = 'ALTER TABLE '.$this->tb_name.' ADD FOREIGN KEY (email) REFERENCES users(email)';
			$this->db->query($foreign_email);

			$foreign_rule = 'ALTER TABLE '.$this->tb_name.' ADD FOREIGN KEY (rule) REFERENCES rules(nama)';
			$this->db->query($foreign_rule);

			$this->load->helper('input');
			$nip = create_nip();
			$pass = encrypt_pass($nip, 'Adm1n@pp');
			$users = $this->set_users($nip, $pass);
			$attr = $this->set_attr($nip);

			$this->db->insert_batch('users', $users);
			$this->db->insert_batch($this->tb_name, $attr);
		}
	}

	public function down()
	{
		$this->dbforge->drop_table($this->tb_name);
	}
}
?>

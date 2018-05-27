<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Create_contacts_table extends CI_Migration
{
    public function __construct()
	{
	    parent::__construct();
		$this->load->dbforge();
	}

    public function up()
	{
	    $fields = array(
            'id' => array(
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE,
                'auto_increment' => TRUE
            ),
            'honorific_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'birth_date' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'addr_1' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ),
            'addr_2' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ),
            'city_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'postcode' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            ),
            'tel' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 1,
                'default' => 1,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('contacts', TRUE);
    }

	public function down()
	{
	    $this->dbforge->drop_table('contacts', TRUE);
    }
}
/* End of file '20180527122555_create_contacts_table' */
/* Location: ./C:\xampp\htdocs\codeigniter\application\migrations/20180527122555_create_contacts_table.php */

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Create_honorifics_table extends CI_Migration
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('honorifics', TRUE);
    }

	public function down()
	{
	    $this->dbforge->drop_table('honorifics', TRUE);
    }
}
/* End of file '20180527125136_create_honorifics_table' */
/* Location: ./C:\xampp\htdocs\codeigniter\application\migrations/20180527125136_create_honorifics_table.php */

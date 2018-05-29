<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Add_soft_delete_to_contacts extends CI_Migration
{
    public function __construct()
	{
	    parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
	    $fields = array(
            'deleted_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column('contacts', $fields);
    }

	public function down()
	{
	    $this->dbforge->drop_table('contacts', 'deleted_at');
    }
}
/* End of file '20180529171102_add_soft_delete_to_contacts' */
/* Location: ./C:\xampp\htdocs\codeigniter\application\migrations/20180529171102_add_soft_delete_to_contacts.php */

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

// You can find dbforge usage examples here: http://ellislab.com/codeigniter/user-guide/database/forge.html


class Migration_Seed_citys_table extends CI_Migration
{
    public function __construct()
	{
	    parent::__construct();
		$this->load->dbforge();
	}

	public function up()
	{
        $data = array(
            array(
                'name' => 'New York'
            ),
            array(
                'name' => 'Paris'
            )
		);
		$this->db->insert_batch('citys', $data);
    }

	public function down()
	{
	    //$this->dbforge->drop_table('citys', TRUE);
    }
}
/* End of file '20180605194909_seed_honorifics_table' */
/* Location: ./C:\xampp\htdocs\codeigniter\application\migrations/20180605194909_seed_honorifics_table.php */

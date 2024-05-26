<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ticketing extends CI_Migration {

	public function __construct()
	{
		parent::__construct();
	}

	public function up()
	{
		error_log('Migrating ticketing module');

		execute_script(APPPATH . 'migrations/sqlscripts/tickets.sql');

        $this->db->insert('modules', array(
            'module_id' => 'tickets',
            'sort' => 75,
            'desc_lang_key' => 'module_tickets_desc',
            'name_lang_key' => 'module_tickets'
        ));
		
        $this->db->insert('permissions', array(
            'module_id' => 'tickets',
            'permission_id' => 'tickets'
        ));

		error_log('Migrating ticketing module completed');
	}

    public function down()
    {
        // $this->dbforge->drop_table($this->db->dbprefix('devices'));
        // $this->dbforge->drop_table($this->db->dbprefix('tickets'));
        // $this->dbforge->drop_table($this->db->dbprefix('tickets_parts'));

		error_log('Migrating down ticketing module completed');
    }
}

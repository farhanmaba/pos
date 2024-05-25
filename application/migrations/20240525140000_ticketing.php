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

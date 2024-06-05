<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Status extends CI_Migration {

	public function __construct()
	{
		parent::__construct();
	}

	public function up()
	{
		error_log('Migrating status for repair sales');

		execute_script(APPPATH . 'migrations/sqlscripts/status.sql');

		error_log('Migrating status for repair sales completed');
	}

    public function down()
    {
		error_log('Migrating down status for repair sales completed');
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Notes extends CI_Migration {

	public function __construct()
	{
		parent::__construct();
	}

	public function up()
	{
		error_log('Migrating notes for repair sales');

		execute_script(APPPATH . 'migrations/sqlscripts/notes.sql');

		error_log('Migrating notes for repair sales completed');
	}

    public function down()
    {
		error_log('Migrating down notes for repair sales completed');
    }
}

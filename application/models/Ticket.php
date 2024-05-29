<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

// Define the ticket statuses in a table in database to make it expandable
define('TICKET_STATUS', array(
    'NEW' => 0,
    'ASSIGNED' => 1,
    'IN_PROGRESS' => 2,
    'COMPLETED' => 3,
    'CANCELLED' => 4,
    'ON_HOLD' => 5,
    'WAITING_PARTS' => 6,
    'WAITING_PAYMENT' => 7
));

class Ticket extends CI_Model
{
    private $ticket_table = 'tickets';
    private $device_table = 'devices';

    public function all($ids=array())
    {
        $this->db->select('*');
        $this->db->from($this->ticket_table);
        $this->db->join($this->device_table, $this->ticket_table . '.device_id = ' . $this->device_table . '.id');
        
        if (!empty($ids)){
            $this->db->where_in('id', $ids);
        }

        return $this->db->get()->result_array();
    }

    public function save($ticket, $device, $ticket_id=0)
    {
        if ($ticket_id > 0){
        } else {
            if ($this->db->insert($this->device_table, $device)){
                $device_id = $this->db->insert_id();
                $ticket['device_id'] = $device_id;
                $this->db->insert($this->ticket_table, $ticket);
            }
        }
    }
}
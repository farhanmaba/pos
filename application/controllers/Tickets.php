<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Tickets extends Secure_Controller
{
    public function __construct()
    {
        parent::__construct('tickets');
        $this->load->model('Ticket');
        $this->load->model('Employee');
        $this->load->model('Tax');
    }

    public function index()
    {
        $this->_reload();
    }

    public function save($ticket_id = -1)
    {
        $current_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

        // Device Details
        $new_device = array(
            'device_name' => $this->input->post('device_name'),
            'serial_no' => $this->input->post('serial_no'),
            'password' => $this->input->post('password'),
            'modified_by_id' => $current_employee_id,
        );

        $status = $this->input->post('status');

        $due_date = $this->input->post('due_date');
        $due_date = $due_date ? date("Y-m-d H:i:s", strtotime($due_date)) : $due_date;

        $ticket_data = array(
            'status' => $status,
            'problem' => $this->input->post('problem'),
            'initial_diagnosis' => $this->input->post('initial_diagnosis'),
            'due_date' => $due_date,
            'labor_cost' => parse_decimals($this->input->post('labor_cost')),
            'customer_id' => 2, // Need to connect it with customer
            'assignee_id' => $this->input->post('assignee_id'),
            'employee_id' => $current_employee_id,
            'modified_by_id' => $current_employee_id,
        );

        if ($status == TICKET_STATUS['COMPLETED']){
            $ticket_data['completion_date'] = date('Y-m-d H:i:s');
        }

        $this->Ticket->save($ticket_data, $new_device, $ticket_id);
        
        redirect('tickets');
    }

    public function view($ticket_id = -1)
    {
        $tickets = $this->Ticket->all([$ticket_id]);
        $this->_reload(!empty($tickets) ? $tickets[0] : null);
    }
    
    private function _reload($ticket = null)
    {
        $data = array();
        // all employees
        $data['employees'] = array();
        foreach($this->Employee->get_all()->result() as $employee)
        {
            foreach(get_object_vars($employee) as $property => $value)
            {
                $employee->$property = $this->xss_clean($value);
            }
            $data['employees'][$employee->person_id] = $employee->first_name . ' ' . $employee->last_name;
        }
        // all taxes
        $data['taxes'] = array();
        foreach ($this->Tax->search('', 25)->result_array() as $key=>$tax){
            $data['taxes'][$tax['tax_code']] = $tax['tax_code_name'];
        }
        // all ticket status
        $data['statuses'] = array(
            0 => 'NEW',
            1 => 'ASSIGNED',
            2 => 'IN PROGRESS',
            3 => 'COMPLETED',
            4 => 'CANCELLED',
            5 => 'ON HOLD',
            6 => 'WAITING PARTS',
            7 => 'WAITING PAYMENT'
        );
        $data['ticket'] = $ticket;
        $this->load->view("tickets/manage", $data);
    }
}
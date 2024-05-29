<?php $this->load->view("partial/header"); ?>

<?php
if(isset($error)){
    echo "<div class='alert alert-dismissible alert-danger '>".$error."</div>";
}

if(!empty($warning)){
    echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
}

if(isset($success)){
    echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
}
?>

<div id="register_wrapper" class="b-r-4 b-s">

    <?php
        $tabindex = 0;
        $ticket_id = $ticket->id ?? -1; // If ticket is not set, set it to -1 to create a new ticket
    ?>

    <?php echo form_open($controller_name . '/save/' . $ticket_id, array('id'=>'ticket_form', 'class'=>'form-horizontal panel panel-default b-r-0')); ?>
    <div class="panel-body form-group">
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('device_name'), 'device_name', array('class' => 'required')); ?>
            <?php echo form_input(array('name'=>'device_name', 'id'=>'device_name', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('device_serial'), 'serial_no'); ?>
            <?php echo form_input(array('name'=>'serial_no', 'id'=>'serial_no', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('device_password'), 'password'); ?>
            <?php echo form_input(array('name'=>'password', 'id'=>'password', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_due_date'), 'due_date'); ?>
            <?php echo form_input(array('name'=>'due_date', 'id'=>'due_date', 'class'=>'form-control datepicker', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_assignee'), 'assignee_id'); ?>
            <?php echo form_dropdown('assignee_id', $employees, '', array('tabindex'=>++$tabindex, 'class'=>'form-control'));?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_status'), 'status'); ?>
            <?php echo form_dropdown('status', $statuses, '', array('tabindex'=>++$tabindex, 'class'=>'form-control'));?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_labor_cost'), 'labor_cost'); ?>
            <?php echo form_input(array('name'=>'labor_cost', 'id'=>'labor_cost', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'step' => '.01', 'value'=>'', 'type' => 'number')); ?>
        </div>
        <div class="col-sm-6">
            <?php echo form_label($this->lang->line('ticket_initial_diagnosis'), 'initial_diagnosis'); ?>
            <?php echo form_textarea(array('name'=>'initial_diagnosis', 'id'=>'initial_diagnosis', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-6">
            <?php echo form_label($this->lang->line('ticket_problem'), 'problem'); ?>
            <?php echo form_textarea(array('name'=>'problem', 'id'=>'problem', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <?php echo form_submit(array('name' => 'submit_ticket', 'value' => $this->lang->line('common_submit'), 'class' => 'btn btn-primary btn-sm pull-right')); ?>
    </div>
    <?php echo form_close(); ?>
</div>

<?php $this->load->view("partial/footer"); ?>
<?php $this->load->view("partial/header"); ?>

<?php
if(isset($error))
{
    echo "<div class='alert alert-dismissible alert-danger '>".$error."</div>";
}

if(!empty($warning))
{
    echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
}

if(isset($success))
{
    echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
}
?>

<div id="register_wrapper" class="b-r-4 b-s">

    <?php $tabindex = 0; ?>

    <?php echo form_open($controller_name . '/save/' . $ticket->id, array('id'=>'ticket_form', 'class'=>'form-horizontal panel panel-default b-r-0')); ?>
    <div class="panel-body form-group">
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('device_name'), 'device_name', array('class' => 'required')); ?>
            <?php echo form_input(array('name'=>'device_type', 'id'=>'device_type', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('device_serial'), 'device_serial'); ?>
            <?php echo form_input(array('name'=>'device_serial', 'id'=>'device_serial', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('device_password'), 'device_password'); ?>
            <?php echo form_input(array('name'=>'device_password', 'id'=>'device_password', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_due_date'), 'ticket_due_date'); ?>
            <?php echo form_input(array('name'=>'ticket_due_date', 'id'=>'jquery-ui-datepicker', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_tax'), 'ticket_tax_code'); ?>
            <?php echo form_dropdown('ticket_tax_code', $taxes, '', array('tabindex'=>++$tabindex, 'class'=>'form-control'));?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_assignee'), 'ticket_assignee_id'); ?>
            <?php echo form_dropdown('ticket_assignee_id', $employees, '', array('tabindex'=>++$tabindex, 'class'=>'form-control'));?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_status'), 'ticket_status'); ?>
            <?php echo form_dropdown('ticket_status', $statuses, '', array('tabindex'=>++$tabindex, 'class'=>'form-control'));?>
        </div>
        <div class="col-sm-3">
            <?php echo form_label($this->lang->line('ticket_labor_cost'), 'ticket_labor_cost'); ?>
            <?php echo form_input(array('name'=>'ticket_labor_cost', 'id'=>'ticket_labor_cost', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'step' => '.01', 'value'=>'', 'type' => 'number')); ?>
        </div>
        <div class="col-sm-6">
            <?php echo form_label($this->lang->line('ticket_initial_diagnosis'), 'ticket_initial_diagnosis'); ?>
            <?php echo form_textarea(array('name'=>'ticket_initial_diagnosis', 'id'=>'ticket_initial_diagnosis', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <div class="col-sm-6">
            <?php echo form_label($this->lang->line('ticket_problem'), 'ticket_problem'); ?>
            <?php echo form_textarea(array('name'=>'ticket_problem', 'id'=>'ticket_problem', 'class'=>'form-control', 'tabindex'=>++$tabindex, 'value'=>'')); ?>
        </div>
        <?php echo form_submit(array('name' => 'submit_ticket', 'value' => $this->lang->line('common_submit'), 'class' => 'btn btn-primary btn-sm pull-right')); ?>
    </div>
    <?php echo form_close(); ?>

    <!-- daily tickets form    -->
    <form action="" id="mode_form" class="form-horizontal panel panel-default b-r-0" method="post" accept-charset="utf-8">
        <div class="panel-body form-group">
            <ul>
                <li class="pull-right">
                    <button class="btn btn-default btn-sm modal-dlg" id="show_suspended_sales_button" data-href="https://localhost/pos/public/sales/suspended" title="Suspended">
                        <span class="glyphicon glyphicon-align-justify">&nbsp;</span>Suspended
                    </button>
                </li>
                <li class="pull-right">
                    <a href="#" class="btn btn-primary btn-sm" id="sales_takings_button" title="Daily Tickets">
                        <span class="glyphicon glyphicon-list-alt">&nbsp;</span>Daily Tickets
                    </a>
                </li>
            </ul>
        </div>
    </form>

    <!-- scan items   -->
    <form action="" id="add_item_form" class="form-horizontal panel panel-default b-r-0" method="post" accept-charset="utf-8">
        <div class="panel-body form-group">
            <ul>
                <li class="pull-left first_li">
                    <label for="item" class="control-label">Find or Scan Items/Parts</label>
                </li>
                <li class="pull-left">
                    <input type="text" name="item" value="" id="item" class="form-control input-sm ui-autocomplete-input" size="50" tabindex="1" autocomplete="off">
                    <span class="ui-helper-hidden-accessible" role="status"></span>
                </li>
                <li class="pull-right">
                    <button id="new_item_button" class="btn btn-info btn-sm pull-right modal-dlg" data-btn-new="New" data-btn-submit="Submit" data-href="https://localhost/pos/public/items/view" title="New Item">
                        <span class="glyphicon glyphicon-tag">&nbsp;</span>New Item
                    </button>
                </li>
            </ul>
        </div>
    </form>

    <!-- table to show items   -->
    <!--
    <table class="sales_table_100" id="register">
        <thead>
        <tr>
            <th style="width: 5%;">Delete</th>
            <th style="width: 15%;">Item #</th>
            <th style="width: 35%;">Item Name</th>
            <th style="width: 10%;">Price</th>
            <th style="width: 10%;">Quantity</th>
            <th style="width: 10%;">Disc %</th>
            <th style="width: 10%;">Total</th>
            <th style="width: 5%;">Update</th>
        </tr>
        </thead>

        <tbody id="cart_contents">
        <tr>
            <td><a href="https://localhost/pos/public/sales/delete_item/1"><span class="glyphicon glyphicon-trash"></span></a></td>
            <td></td>
            <td style="align: center;">
                123abc<br> [198 in stock]
            </td>
            <td><input type="text" name="price" value="15.00" class="form-control input-sm" tabindex="2" onclick="this.select();"></td>
            <td>
                <input type="text" name="quantity" value="1" class="form-control input-sm" tabindex="3" onclick="this.select();">
            </td>
            <td><input type="text" name="discount" value="0" class="form-control input-sm" tabindex="4" onclick="this.select();"></td>
            <td>$15.00</td>
            <td><a href="javascript:document.getElementById('cart_1').submit();" title="Update"><span class="glyphicon glyphicon-refresh"></span></a></td>
        </tr>
        </tbody>
    </table>
    -->
</div>


<!--  customer panel   -->
<div id="overall_sale" class="panel panel-default b-r-4 b-s">
    <div class="panel-body">
        <form action="" id="select_customer_form" class="form-horizontal" method="post" accept-charset="utf-8">
            <table class="sales_table_100">
                <tbody>
                <tr>
                    <th style="width: 55%;">Name</th>
                    <th style="width: 45%; text-align: right;"><a href="https://localhost/pos/public/customers/view/11" class="modal-dlg" data-btn-submit="Submit" title="Update Customer">Farhan Maba</a></th>
                </tr>
                <tr>
                    <th style="width: 55%;">Email</th>
                    <th style="width: 45%; text-align: right;">mfarhan@hyperaps.com</th>
                </tr>
                <tr>
                    <th style="width: 55%;">Phone Number</th>
                    <th style="width: 45%; text-align: right;">3454636274</th>
                </tr>
                <tr>
                    <th style="width: 55%;">Address</th>
                    <th style="width: 45%; text-align: right;">abc</th>
                </tr>
                <tr>
                    <th style="width: 55%;">Location</th>
                    <th style="width: 45%; text-align: right;">54000 abc</th>
                </tr>
                <tr>
                    <th style="width: 55%;">Discount</th>
                    <th style="width: 45%; text-align: right;">0.00 %</th>
                </tr>
                <tr>
                    <th style="width: 55%;">Total</th>
                    <th style="width: 45%; text-align: right;">$1,714.80</th>
                </tr>
                </tbody>
            </table>

            <a href="" class="btn btn-danger btn-sm" id="remove_customer_button" title="Remove Customer">
                <span class="glyphicon glyphicon-remove">&nbsp;</span>Remove Customer
            </a>
        </form>

        <table class="sales_table_100" id="sale_totals">
            <tbody>
            <tr>
                <th style="width: 55%;">Quantity of 1 Items</th>
                <th style="width: 45%; text-align: right;">1</th>
            </tr>
            <tr>
                <th style="width: 55%;">Subtotal</th>
                <th style="width: 45%; text-align: right;">$15.00</th>
            </tr>
            <tr>
                <th style="width: 55%;">8% Sales Tax</th>
                <th style="width: 45%; text-align: right;">$1.20</th>
            </tr>
            <tr>
                <th style="width: 55%;">Total</th>
                <th style="width: 45%; text-align: right;"><span id="sale_total">$16.20</span></th>
            </tr>
            </tbody>
        </table>

        <table class="sales_table_100" id="payment_totals">
            <tbody>
            <tr>
                <th style="width: 55%;">Payments Total</th>
                <th style="width: 45%; text-align: right;">$0.00</th>
            </tr>
            <tr>
                <th style="width: 55%;">Amount Due</th>
                <th style="width: 45%; text-align: right;"><span id="sale_amount_due">$16.20</span></th>
            </tr>
            </tbody>
        </table>

        <div id="payment_details">
            <form action="" id="add_payment_form" class="form-horizontal" method="post" accept-charset="utf-8">
                <table class="sales_table_100">
                    <tbody>
                    <tr>
                        <td>Payment Type</td>
                        <td>
                            <div class="btn-group bootstrap-select show-menu-arrow fit-width">
                                <button type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown" role="button" data-id="payment_types" title="Cash"><span class="filter-option pull-left">Cash</span>
                                    &nbsp;
                                    <span class="bs-caret"><span class="caret"></span></span>
                                </button>

                                <div class="dropdown-menu open" role="combobox">
                                    <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                        <li data-original-index="0" class="selected">
                                            <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true">
                                                <span class="text">Cash</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                        <li data-original-index="1">
                                            <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                                <span class="text">Debit Card</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                        <li data-original-index="2">
                                            <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                                <span class="text">Credit Card</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                        <li data-original-index="3">
                                            <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                                <span class="text">Due</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                        <li data-original-index="4">
                                            <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                                <span class="text">Check</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                        <li data-original-index="5">
                                            <a tabindex="0" class="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false">
                                                <span class="text">Gift Card</span>
                                                <span class="glyphicon glyphicon-ok check-mark"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <select name="payment_type" id="payment_types" class="selectpicker show-menu-arrow" data-style="btn-default btn-sm" data-width="fit" tabindex="-98">
                                    <option value="Cash">Cash</option>
                                    <option value="Debit Card">Debit Card</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Due">Due</option>
                                    <option value="Check">Check</option>
                                    <option value="Gift Card">Gift Card</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span id="amount_tendered_label">Amount Tendered</span></td>
                        <td>
                            <input type="text" name="amount_tendered" value="16.20" id="amount_tendered" class="form-control input-sm non-giftcard-input" size="5" tabindex="5" onclick="this.select();">
                            <input type="text" name="amount_tendered" value="16.20" id="amount_tendered" class="form-control input-sm giftcard-input ui-autocomplete-input" disabled="disabled" size="5" tabindex="6" autocomplete="off">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>

            <div class="btn btn-sm btn-success pull-right" id="add_payment_button" tabindex="7">
                <span class="glyphicon glyphicon-credit-card">&nbsp;</span>Add Payment
            </div>
        </div>

        <form action="" id="buttons_form" method="post" accept-charset="utf-8">
            <div class="form-group" id="buttons_sale">
                <div class="btn btn-sm btn-default pull-left" id="suspend_sale_button"><span class="glyphicon glyphicon-align-justify">&nbsp;</span>Suspend</div>

                <div class="btn btn-sm btn-danger pull-right" id="cancel_sale_button"><span class="glyphicon glyphicon-remove">&nbsp;</span>Cancel</div>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view("partial/footer"); ?>
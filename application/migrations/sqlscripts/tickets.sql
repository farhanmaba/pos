--
-- Add support for devices
--

-- Table structure for table `ospos_devices`
CREATE TABLE IF NOT EXISTS `ospos_devices` (
  `id` INT(10) NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `serial` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Indexes for table `ospos_devices`
ALTER TABLE `ospos_devices`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `ospos_devices`
ALTER TABLE `ospos_devices`
  MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Add support for tickets
--
-- Table structure for table `ospos_tickets`
CREATE TABLE IF NOT EXISTS `ospos_tickets` (
  `id` INT(10) NOT NULL,
  `status` TINYINT(2) NOT NULL DEFAULT 0,
  `problem` varchar(1024) DEFAULT NULL,
  `initial_diagnosis` VARCHAR(1024) DEFAULT NULL,
  `completion_date` TIMESTAMP NULL,
  `due_date` TIMESTAMP NULL,
  `labor_cost` DECIMAL(15, 2) DEFAULT 0,
  `device_id` INT(10) DEFAULT NULL,
  `customer_id` INT(10) DEFAULT NULL,
  `assignee_id` INT(10) DEFAULT NULL,
  `employee_id` INT(10) NOT NULL,
  `tax_code` varchar(32) NOT NULL,
  `modified_by_id` INT(10) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- status (0:New, 1:Assigned, 2:In Progress, 3:Complete, 4:Cancelled, 5:On Hold, 6:Waiting For Parts,
-- 7:Waiting For Payment)
-- Indexes for table `ospos_tickets`
ALTER TABLE `ospos_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `assignee_id` (`assignee_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `tax_code` (`tax_code`),
  ADD KEY `modified_by_id` (`modified_by_id`);
-- AUTO_INCREMENT for table `ospos_tickets`
ALTER TABLE `ospos_tickets`
  MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
-- Constraints for table `ospos_tickets`
ALTER TABLE `ospos_tickets`
  ADD CONSTRAINT `ospos_tickets_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `ospos_devices` (`id`),
  ADD CONSTRAINT `ospos_tickets_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `ospos_customers` (`person_id`),
  ADD CONSTRAINT `ospos_tickets_ibfk_3` FOREIGN KEY (`assignee_id`) REFERENCES `ospos_employees` (`person_id`),
  ADD CONSTRAINT `ospos_tickets_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `ospos_employees` (`person_id`),
  ADD CONSTRAINT `ospos_tickets_ibfk_5` FOREIGN KEY (`tax_code`) REFERENCES `ospos_tax_codes` (`tax_code`),
  ADD CONSTRAINT `ospos_tickets_ibfk_6` FOREIGN KEY (`modified_by_id`) REFERENCES `ospos_employees` (`person_id`);
-- Table structure for table `ospos_tickets_parts`
CREATE TABLE IF NOT EXISTS `ospos_tickets_parts` (
  `ticket_id` INT(10) NOT NULL,
  `item_id` INT(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Indexes for table `ospos_tickets_parts`
ALTER TABLE `ospos_tickets_parts`
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `item_id` (`item_id`);
-- Constraints for table `ospos_tickets_parts`
ALTER TABLE `ospos_tickets_parts`
  ADD CONSTRAINT `ospos_tickets_parts_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ospos_tickets` (`id`),
  ADD CONSTRAINT `ospos_tickets_parts_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `ospos_items` (`item_id`);
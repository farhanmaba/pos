-- Add support for status to a repair sale

-- Table structure for table `ospos_repair_status`
CREATE TABLE IF NOT EXISTS `ospos_repair_status` (
  `id` INT(10) NOT NULL,
  `sale_id` INT(10) NOT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT "New",
  `employee_id` INT(10) NOT NULL DEFAULT 1,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Indexes for table `ospos_repair_status`
ALTER TABLE `ospos_repair_status`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `ospos_repair_status`
ALTER TABLE `ospos_repair_status`
  MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Indexes for table `ospos_repair_status`
ALTER TABLE `ospos_repair_status`
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `employee_id` (`employee_id`);

-- Constraints for table `ospos_repair_status`
ALTER TABLE `ospos_repair_status`
  ADD CONSTRAINT `ospos_repair_status_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `ospos_sales` (`sale_id`),
  ADD CONSTRAINT `ospos_repair_status_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `ospos_employees` (`person_id`);
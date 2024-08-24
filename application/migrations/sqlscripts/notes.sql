-- Add support for multiple notes connected to a repair sale

-- Table structure for table `ospos_repair_notes`
CREATE TABLE IF NOT EXISTS `ospos_repair_notes` (
  `id` INT(10) NOT NULL,
  `sale_id` INT(10) NOT NULL,
  `note` VARCHAR(255) DEFAULT NULL,
  `employee_id` INT(10) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Indexes for table `ospos_repair_notes`
ALTER TABLE `ospos_repair_notes`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `ospos_repair_notes`
ALTER TABLE `ospos_repair_notes`
  MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Indexes for table `ospos_repair_notes`
ALTER TABLE `ospos_repair_notes`
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `employee_id` (`employee_id`);

-- Constraints for table `ospos_repair_notes`
ALTER TABLE `ospos_repair_notes`
  ADD CONSTRAINT `ospos_repair_notes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `ospos_sales` (`sale_id`),
  ADD CONSTRAINT `ospos_repair_notes_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `ospos_employees` (`person_id`);
# Doctrine Migration File Generated on 2013-01-15 08:01:27
# Migrating from 0 to 20130113192139

# Version 20130113192139
INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'admin123', 'pass123', 'john', 'smith', 'john@smith.com', '0777123456', '1', '1');
INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'user21', 'pass123', 'bob', 'smith', 'bob@smith.com', '0777123456', '1', '0');
INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'user22', 'pass123', 'bob', 'smith', 'bob@smith.com', '0777123456', '1', '0');
INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'user23', 'pass123', 'bob', 'smith', 'bob@smith.com', '0777123456', '1', '0');
INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '1', 'Dr. Fernando 1', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1');
INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '2', 'Dr. Fernando 2', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1');
INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '3', 'Dr. Fernando 3', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1');
INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '4', 'Dr. Fernando 4', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1');
INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '5', 'Dr. Fernando 5', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1');
INSERT INTO `tbl_pharmacys` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '1', 'Pharmacy 1', '65, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_pharmacys` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '2', 'Pharmacy 2', '65, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_pharmacys` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '3', 'Pharmacy 3', '65, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_pharmacys` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '4', 'Pharmacy 4', '65, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_pharmacys` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '5', 'Pharmacy 5', '65, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_salons` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '1', 'Salon 1', '37, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_salons` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '2', 'Salon 2', '37, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_salons` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '3', 'Salon 3', '37, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_salons` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '4', 'Salon 4', '37, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_salons` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '5', 'Salon 5', '37, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_supermarkets` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '1', 'SuperMarket 1', '23, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_supermarkets` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '2', 'SuperMarket 2', '23, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_supermarkets` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '3', 'SuperMarket 3', '23, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_supermarkets` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '4', 'SuperMarket 4', '23, New Town', '0756123456, 011456345', '---', '1');
INSERT INTO `tbl_supermarkets` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '5', 'SuperMarket 5', '23, New Town', '0756123456, 011456345', '---', '1');
ALTER TABLE `cities` ADD INDEX ( `name` );
ALTER TABLE `entries` ADD INDEX ( `cat` );
ALTER TABLE `entries` ADD INDEX ( `area` );
ALTER TABLE `entries` ADD INDEX ( `city` );
CREATE TABLE test (username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL) ENGINE = InnoDB;

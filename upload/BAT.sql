/*
Navicat MySQL Data Transfer

Source Server         : APSIS SERVER
Source Server Version : 50532
Source Host           : 192.168.1.106:3306
Source Database       : BAT

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-09-18 18:41:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `area`
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `area_id` int(10) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(50) NOT NULL,
  `upazila_id` int(10) DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`area_id`),
  KEY `fk_a_upazila_id` (`upazila_id`),
  CONSTRAINT `fk_a_upazila_id` FOREIGN KEY (`upazila_id`) REFERENCES `upazila` (`upazila_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO `area` VALUES ('1', 'Bonani', '1', '0', '2014-09-16 19:06:01', null, null, 'Active');

-- ----------------------------
-- Table structure for `bank`
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `bank_id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`bank_id`),
  UNIQUE KEY `u_bank_name` (`bank_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank
-- ----------------------------
INSERT INTO `bank` VALUES ('1', 'Sonali Bank', '0', null, null, null, 'Active');
INSERT INTO `bank` VALUES ('2', 'Rupali Bank', '0', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `bank_branch`
-- ----------------------------
DROP TABLE IF EXISTS `bank_branch`;
CREATE TABLE `bank_branch` (
  `bank_branch_id` int(10) NOT NULL AUTO_INCREMENT,
  `bank_branch_name` varchar(100) NOT NULL,
  `bank_id` int(10) NOT NULL,
  `address` text,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`bank_branch_id`),
  KEY `fk_bank` (`bank_id`),
  CONSTRAINT `bank_branch_ibfk_1` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank_branch
-- ----------------------------
INSERT INTO `bank_branch` VALUES ('1', 'Gulshan 1 Branch', '1', null, '0', null, null, null, 'Active');
INSERT INTO `bank_branch` VALUES ('3', 'Banani Branch', '1', null, '0', null, null, null, 'Active');
INSERT INTO `bank_branch` VALUES ('4', 'Banani Branch', '2', null, '0', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `shop_name` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `route_id` int(10) NOT NULL,
  `address` text,
  `customer_type_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `u_mb_number` (`mobile_number`) USING BTREE,
  KEY `fk_cust_type` (`customer_type_id`),
  KEY `fk_route` (`route_id`),
  CONSTRAINT `fk_cust_type` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_type` (`customer_type_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('4', 'Jolil mia', 'Jolil Store', '24356u', 'Jolil@efgsgb.com', '1', 'afwrg', '1', '1', '0000-00-00 00:00:00', null, '2014-09-16 19:51:24', 'Active');
INSERT INTO `customer` VALUES ('5', 'Zaman Kabir', 'Zaman Store', 'dasdasd', 'a@sss.com', '1', 'asdasdasda', '1', '1', '0000-00-00 00:00:00', null, '2014-09-16 19:51:47', 'Active');

-- ----------------------------
-- Table structure for `customer_type`
-- ----------------------------
DROP TABLE IF EXISTS `customer_type`;
CREATE TABLE `customer_type` (
  `customer_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_type_name` varchar(50) NOT NULL COMMENT 'Whole Saler, Retailer etc',
  `description` text,
  `comission` int(10) DEFAULT '0' COMMENT 'int value for percent calculate',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`customer_type_id`),
  UNIQUE KEY `u_cust_name` (`customer_type_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer_type
-- ----------------------------
INSERT INTO `customer_type` VALUES ('1', 'Wholesaler', null, '0', '0', null, '1', '2014-09-17 16:42:49', 'Active');
INSERT INTO `customer_type` VALUES ('2', 'Retailer', null, '0', '1', '0000-00-00 00:00:00', '1', '2014-09-17 16:42:39', 'Active');

-- ----------------------------
-- Table structure for `distributor_area`
-- ----------------------------
DROP TABLE IF EXISTS `distributor_area`;
CREATE TABLE `distributor_area` (
  `distributor_area_id` int(10) NOT NULL AUTO_INCREMENT,
  `distributor_area_name` varchar(50) NOT NULL,
  `distributor_region_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`distributor_area_id`),
  KEY `fk_da_region_id` (`distributor_region_id`),
  KEY `distributor_area_id` (`distributor_area_id`,`distributor_region_id`),
  CONSTRAINT `fk_da_region_id` FOREIGN KEY (`distributor_region_id`) REFERENCES `distributor_region` (`distributor_region_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of distributor_area
-- ----------------------------

-- ----------------------------
-- Table structure for `distributor_region`
-- ----------------------------
DROP TABLE IF EXISTS `distributor_region`;
CREATE TABLE `distributor_region` (
  `distributor_region_id` int(10) NOT NULL AUTO_INCREMENT,
  `distributor_region_name` varchar(50) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`distributor_region_id`),
  UNIQUE KEY `u_region_name` (`distributor_region_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of distributor_region
-- ----------------------------

-- ----------------------------
-- Table structure for `distributor_teritory`
-- ----------------------------
DROP TABLE IF EXISTS `distributor_teritory`;
CREATE TABLE `distributor_teritory` (
  `distributor_teritory_id` int(10) NOT NULL AUTO_INCREMENT,
  `distributor_teritory_name` varchar(50) NOT NULL,
  `distributor_area_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`distributor_teritory_id`),
  KEY `fk_dt_area_id` (`distributor_area_id`),
  CONSTRAINT `fk_dt_area_id` FOREIGN KEY (`distributor_area_id`) REFERENCES `distributor_area` (`distributor_area_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of distributor_teritory
-- ----------------------------

-- ----------------------------
-- Table structure for `district`
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `district_id` int(10) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(50) NOT NULL COMMENT 'District Name,y,Y,N,,20,1',
  `division_id` int(10) NOT NULL COMMENT 'Division,y,Y,N,,20,2',
  `created_by` int(10) NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`district_id`),
  KEY `fk_d_division_id` (`division_id`),
  CONSTRAINT `fk_d_division_id` FOREIGN KEY (`division_id`) REFERENCES `division` (`division_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES ('1', 'BARGUNA', '1', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('2', 'BARISAL', '1', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('3', 'BHOLA', '1', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('4', 'JHALOKATI', '1', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('5', 'PATUAKHALI', '1', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('6', 'PIROJPUR', '1', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('7', 'BANDARBAN', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('8', 'BRAHMANBARIA', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('9', 'CHANDPUR', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('10', 'CHITTAGONG', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('11', 'COMILLA', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('12', 'COX\'S BAZAR', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('13', 'FENI', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('14', 'KHAGRACHHARI', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('15', 'LAKSHMIPUR', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('16', 'NOAKHALI', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('17', 'RANGAMATI', '2', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('18', 'DHAKA', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('19', 'FARIDPUR', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('20', 'GAZIPUR', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('21', 'GOPALGANJ', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('22', 'JAMALPUR', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('23', 'KISHOREGONJ', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('24', 'MADARIPUR', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('25', 'MANIKGANJ', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('26', 'MUNSHIGANJ', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('27', 'MYMENSINGH', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('28', 'NARAYANGANJ', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('29', 'NARSINGDI', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('30', 'NETRAKONA', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('31', 'RAJBARI', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('32', 'SHARIATPUR', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('33', 'SHERPUR', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('34', 'TANGAIL', '3', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('35', 'BAGERHAT', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('36', 'CHUADANGA', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('37', 'JESSORE', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('38', 'JHENAIDAH', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('39', 'KHULNA', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('40', 'KUSHTIA', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('41', 'MAGURA', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('42', 'MEHERPUR', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('43', 'NARAIL', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('44', 'SATKHIRA', '4', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('45', 'BOGRA', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('46', 'CHAPAINABABGANJ', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('47', 'JOYPURHAT', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('48', 'PABNA', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('49', 'NAOGAON', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('50', 'NATORE', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('51', 'RAJSHAHI', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('52', 'SIRAJGANJ', '5', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('53', 'DINAJPUR', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('54', 'GAIBANDHA', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('55', 'KURIGRAM', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('56', 'LALMONIRHAT', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('57', 'NILPHAMARI', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('58', 'PANCHAGARH', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('59', 'RANGPUR', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('60', 'THAKURGAON', '6', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('61', 'HABIGANJ', '7', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('62', 'MAULVIBAZAR', '7', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('63', 'SUNAMGANJ', '7', '1', null, null, null, 'Active');
INSERT INTO `district` VALUES ('64', 'SYLHET', '7', '1', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `division`
-- ----------------------------
DROP TABLE IF EXISTS `division`;
CREATE TABLE `division` (
  `division_id` int(10) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(50) DEFAULT NULL COMMENT 'Division Name,y,Y,N,,20,1',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of division
-- ----------------------------
INSERT INTO `division` VALUES ('1', 'BARISAL', '0', null, null, null, 'Active');
INSERT INTO `division` VALUES ('2', 'CHITTAGONG', '0', null, null, null, 'Active');
INSERT INTO `division` VALUES ('3', 'DHAKA', '0', null, null, null, 'Active');
INSERT INTO `division` VALUES ('4', 'KHULNA', '0', null, null, null, 'Active');
INSERT INTO `division` VALUES ('5', 'RAJSHAHI', '0', null, null, null, 'Active');
INSERT INTO `division` VALUES ('6', 'RANGPUR', '0', null, null, null, 'Active');
INSERT INTO `division` VALUES ('7', 'SYLHET', '0', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `identification_type`
-- ----------------------------
DROP TABLE IF EXISTS `identification_type`;
CREATE TABLE `identification_type` (
  `identification_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `identification_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`identification_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of identification_type
-- ----------------------------
INSERT INTO `identification_type` VALUES ('1', 'Passport');
INSERT INTO `identification_type` VALUES ('2', 'Driving License');
INSERT INTO `identification_type` VALUES ('3', 'National ID Card');

-- ----------------------------
-- Table structure for `invoice`
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id` varchar(20) NOT NULL COMMENT 'year_routeid_userid_slnumber',
  `invoice_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_due_date` timestamp NULL DEFAULT NULL COMMENT 'last date of payment',
  `description` text,
  `special_note` text,
  `customer_id` bigint(20) NOT NULL,
  `salesman_id` int(10) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `payment_mode_id` int(10) NOT NULL,
  `terms_id` int(10) DEFAULT NULL,
  `cash_sale_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `credit_sale_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `total_cash_paid` decimal(10,0) NOT NULL DEFAULT '0',
  `total_due_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `cheque_number` varchar(20) DEFAULT NULL,
  `cheque_bank_branch_id` int(10) DEFAULT NULL,
  `cheque_clearence_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_customer_id` (`customer_id`),
  KEY `fk_salesman_id` (`salesman_id`),
  KEY `fk_terms_id` (`terms_id`),
  CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_salesman_id` FOREIGN KEY (`salesman_id`) REFERENCES `user` (`user_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_terms_id` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`terms_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of invoice
-- ----------------------------

-- ----------------------------
-- Table structure for `invoice_details`
-- ----------------------------
DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE `invoice_details` (
  `invoice_id` varchar(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(4) NOT NULL,
  `current_rate` decimal(10,0) NOT NULL,
  `current_vat` decimal(10,0) NOT NULL DEFAULT '0',
  `current_tax` decimal(10,0) NOT NULL DEFAULT '0',
  `vat_tax_calculation_id` int(2) DEFAULT NULL,
  `net_value` decimal(10,0) NOT NULL DEFAULT '0',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  KEY `fk_invoice_id` (`invoice_id`),
  KEY `fk_product_id` (`product_id`),
  KEY `fk_vat_tax_calc_id` (`vat_tax_calculation_id`),
  CONSTRAINT `fk_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_vat_tax_calc_id` FOREIGN KEY (`vat_tax_calculation_id`) REFERENCES `vat_tax_calculation` (`vat_tax_calculation_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of invoice_details
-- ----------------------------

-- ----------------------------
-- Table structure for `master_entry`
-- ----------------------------
DROP TABLE IF EXISTS `master_entry`;
CREATE TABLE `master_entry` (
  `master_entry_table_name` varchar(50) NOT NULL,
  `field_name` varchar(50) NOT NULL,
  `input_type` varchar(30) NOT NULL COMMENT 'ex. text, combo, textarea etc',
  `required_field` varchar(10) NOT NULL,
  `sql` text,
  `comma_separated_value` text,
  `show_grid` tinyint(1) NOT NULL DEFAULT '0',
  `sorting` int(10) DEFAULT NULL,
  `label_name` varchar(50) NOT NULL,
  `placeholder` varchar(50) DEFAULT NULL,
  `field_key` varchar(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `join_with` varchar(50) DEFAULT NULL,
  `join_with_fk_name` varchar(50) DEFAULT NULL,
  UNIQUE KEY `unique_master_entry` (`master_entry_table_name`,`field_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of master_entry
-- ----------------------------
INSERT INTO `master_entry` VALUES ('customer', 'address', 'textarea', 'required', '', '', '1', '3', 'ADDRESS', 'Type address', '', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:30', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer', 'customer_name', 'var', 'required', '', '', '1', '2', 'CUSTOMER NAME', 'Type customer name', '', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:30', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer', 'customer_type_id', 'int', '', '', '', '1', '0', 'CUSTOMER TYPE', 'Type customer type', 'MUL', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:21', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer', 'email', 'email', '', '', '', '1', '6', 'EMAIL', 'Type email', '', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:27', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer', 'mobile_number', 'var', '', '', '', '1', '4', 'MOBILE NUMBER', 'Type mobile number', 'UNI', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:30', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer', 'route_id', 'int', '', '', '', '1', '5', 'ROUTE', 'Type route', 'MUL', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:30', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer', 'shop_name', 'var', 'required', '', '', '1', '1', 'SHOP NAME', 'Type shop name', '', '0', '2014-09-16 19:23:01', null, '2014-09-17 16:47:30', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('customer_type', 'customer_type_name', 'text', '', '', '', '1', null, 'CUSTOMER TYPE NAME', 'Type customer type name', 'UNI', '0', '2014-09-16 18:42:07', null, null, 'Active', null, null);
INSERT INTO `master_entry` VALUES ('master_entry_table', 'master_entry_table_name', 'select', '', 'select table_name,table_name from information_schema.tables WHERE TABLE_SCHEMA=\"BAT\"', '', '1', '0', 'MASTER ENTRY TABLE NAME', 'Type master entry table name', 'UNI', '0', '2014-09-15 17:00:18', null, '2014-09-15 17:11:34', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('master_entry_table', 'table_sql', 'tex', '', '', '', '1', '1', 'TABLE SQL', 'Type table sql', '', '0', '2014-09-15 17:00:18', null, '2014-09-15 17:11:34', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('product', 'description', 'tex', '', '', '', '1', '2', 'DESCRIPTION', 'Type description', '', '0', '2014-09-16 16:41:36', null, '2014-09-16 16:44:04', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('product', 'product_name', 'var', 'required', '', '', '1', '0', 'PRODUCT NAME', 'Type product name', '', '0', '2014-09-16 16:41:36', null, '2014-09-16 16:43:58', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('product', 'status', 'checkbox', '', '', '', '1', '5', 'STATUS', 'Type status', '', '0', '2014-09-16 16:41:36', null, '2014-09-16 16:44:02', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('product', 'tax', 'dec', '', '', '', '1', '3', 'TAX', 'Type tax', '', '0', '2014-09-16 16:41:36', null, '2014-09-16 16:44:04', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('product', 'unit_price', 'dec', 'required', '', '', '1', '1', 'UNIT PRICE', 'Type unit price', '', '0', '2014-09-16 16:41:36', null, '2014-09-16 16:44:04', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('product', 'vat', 'dec', '', '', '', '1', '4', 'VAT', 'Type vat', '', '0', '2014-09-16 16:41:36', null, '2014-09-16 16:44:02', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user', 'contact_number', 'var', '', '', '', '1', '3', 'CONTACT NUMBER', 'Type contact number', 'UNI', '0', '2014-09-15 18:13:05', null, '2014-09-15 18:18:55', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user', 'email', 'var', '', '', '', '1', '4', 'EMAIL', 'Type email', 'UNI', '0', '2014-09-15 18:13:05', null, '2014-09-15 18:18:55', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user', 'first_name', 'var', '', '', '', '1', '0', 'FIRST NAME', 'Type first name', '', '0', '2014-09-15 18:13:05', null, '2014-09-15 18:29:47', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user', 'last_name', 'var', '', '', '', '1', '1', 'LAST NAME', 'Type last name', '', '0', '2014-09-15 18:13:05', null, '2014-09-15 18:29:48', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user', 'username', 'var', '', '', '', '1', '2', 'USERNAME', 'Type username', 'UNI', '0', '2014-09-15 18:13:05', null, '2014-09-15 18:29:48', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user', 'user_level_id', 'select', 'required', 'SELECT user_level_id, user_level_name FROM user_level WHERE user_level_id NOT IN (1,7,8)', null, '0', '5', 'Level Privilege', null, '', '1', '2014-09-15 14:13:48', null, '2014-09-15 18:32:07', 'Active', 'privilege_level', 'user_id');
INSERT INTO `master_entry` VALUES ('user_level', 'all_privilege', 'checkbox', '', '', '', '1', '5', 'ALL PRIVILEGE', 'Type all privilege', '', '0', '2014-09-15 16:57:17', null, '2014-09-15 16:57:31', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user_level', 'privilege_add', 'checkbox', '', '', '', '1', '3', 'PRIVILEGE ADD', 'Type privilege add', '', '0', '2014-09-15 16:57:16', null, '2014-09-15 16:57:36', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user_level', 'privilege_delete', 'checkbox', '', '', '', '1', '2', 'PRIVILEGE DELETE', 'Type privilege delete', '', '0', '2014-09-15 16:57:16', null, '2014-09-15 16:57:36', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user_level', 'privilege_edit', 'checkbox', '', '', '', '1', '1', 'PRIVILEGE EDIT', 'Type privilege edit', '', '0', '2014-09-15 16:57:16', null, '2014-09-15 16:57:35', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user_level', 'privilege_view_all', 'checkbox', '', '', '', '1', '4', 'PRIVILEGE VIEW ALL', 'Type privilege view all', '', '0', '2014-09-15 16:57:17', null, '2014-09-15 16:57:31', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user_level', 'status', 'select', '', '', 'Active', '1', '6', 'STATUS', 'Type status', '', '0', '2014-09-15 16:57:16', null, '2014-09-15 16:57:26', 'Active', null, null);
INSERT INTO `master_entry` VALUES ('user_level', 'user_level_name', 'text', 'required', '', '', '1', '0', 'USER LEVEL NAME', 'Type user level name', 'UNI', '0', '2014-09-15 16:57:16', null, '2014-09-15 16:57:28', 'Active', null, null);

-- ----------------------------
-- Table structure for `master_entry_table`
-- ----------------------------
DROP TABLE IF EXISTS `master_entry_table`;
CREATE TABLE `master_entry_table` (
  `master_entry_table_id` int(10) NOT NULL AUTO_INCREMENT,
  `master_entry_table_name` varchar(50) NOT NULL,
  `table_sql` text NOT NULL COMMENT 'possible select query to read this table',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`master_entry_table_id`),
  UNIQUE KEY `u_table_name` (`master_entry_table_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of master_entry_table
-- ----------------------------
INSERT INTO `master_entry_table` VALUES ('1', 'department', '', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('2', 'bank', 'SELECT * from bank', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('3', 'menu', '', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('4', 'district', '', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('5', 'division', '', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('6', 'designation', 'SELECT designation_id,designation_name,description FROM designation', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('7', 'religion', 'employee.username,', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('8', 'status', 'employee.`password`,', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('9', 'upazila', 'designation.designation_name,', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('10', 'master_entry_table', 'SELECT master_entry_table_id,master_entry_table_name,table_sql FROM master_entry_table', '0', null, '1', '2014-09-15 17:03:02', 'Active');
INSERT INTO `master_entry_table` VALUES ('11', 'identification_type', 'FROM', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('17', 'user_level', 'SELECT * FROM user_level', '0', null, '1', '2014-09-15 17:12:45', 'Active');
INSERT INTO `master_entry_table` VALUES ('18', 'user_type', 'SELECT user_type.*,user_level.user_level_name FROM user_type INNER JOIN user_level ON user_type.user_level_id=user_level.user_level_id', '0', null, null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('19', 'user', 'SELECT user.*,module.module_name  as default_module_name FROM user INNER JOIN module ON `user`.default_module_id = module.module_id', '1', '0000-00-00 00:00:00', '1', '2014-09-01 14:47:31', 'Active');
INSERT INTO `master_entry_table` VALUES ('20', 'privilege_level', 'SELECT * FROM privilege_level', '1', '0000-00-00 00:00:00', null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('21', 'product', 'SELECT * FROM product', '1', '0000-00-00 00:00:00', '1', '2014-09-16 16:43:40', 'Active');
INSERT INTO `master_entry_table` VALUES ('22', 'customer', 'SELECT\r\ncustomer.customer_id,\r\ncustomer.customer_name,\r\ncustomer.shop_name,\r\ncustomer.mobile_number,\r\ncustomer.email,\r\ncustomer.address,\r\ncustomer.created_by,\r\ncustomer.created,\r\ncustomer.updated_by,\r\ncustomer.updated,\r\ncustomer.`status`,\r\nroute.route_id,\r\nroute.route_name,\r\nroute.description,\r\nroute.area_id,\r\nroute.created_by,\r\nroute.created,\r\nroute.updated_by,\r\nroute.updated,\r\nroute.`status`,\r\ncustomer_type.customer_type_id,\r\ncustomer_type.customer_type_name,\r\ncustomer_type.description,\r\ncustomer_type.created_by,\r\ncustomer_type.created,\r\ncustomer_type.updated_by,\r\ncustomer_type.updated,\r\ncustomer_type.`status`\r\nFROM\r\ncustomer\r\nINNER JOIN route ON customer.route_id = route.route_id\r\nINNER JOIN customer_type ON customer.customer_type_id = customer_type.customer_type_id\r\n', '1', '0000-00-00 00:00:00', '1', '2014-09-16 19:22:37', 'Active');
INSERT INTO `master_entry_table` VALUES ('23', 'customer_type', 'SELECT * FROM customer_type', '1', '0000-00-00 00:00:00', null, null, 'Active');
INSERT INTO `master_entry_table` VALUES ('24', 'product_price', 'SELECT\r\nproduct_price.product_id,\r\nproduct_price.product_price,\r\nproduct_price.vat,\r\nproduct_price.tax,\r\nproduct_price.discount,\r\nproduct.product_id,\r\nproduct.product_name,\r\nproduct.description,\r\nproduct.unit_price,\r\nproduct.vat_tax_calculation_id,\r\nproduct.product_category_id,\r\nproduct.unit_type_id,\r\nproduct.created_by,\r\nproduct.created,\r\nproduct.updated_by,\r\nproduct.updated,\r\nproduct.`status`\r\nFROM\r\nproduct_price\r\nINNER JOIN product ON product.product_id = product_price.product_id', '1', '0000-00-00 00:00:00', '1', '2014-09-17 12:01:22', 'Active');

-- ----------------------------
-- Table structure for `memo`
-- ----------------------------
DROP TABLE IF EXISTS `memo`;
CREATE TABLE `memo` (
  `memo_id` varchar(20) NOT NULL,
  `salesman_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`memo_id`),
  KEY `fk_m_salesman_id` (`salesman_id`),
  CONSTRAINT `fk_m_salesman_id` FOREIGN KEY (`salesman_id`) REFERENCES `user` (`user_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of memo
-- ----------------------------

-- ----------------------------
-- Table structure for `memo_details`
-- ----------------------------
DROP TABLE IF EXISTS `memo_details`;
CREATE TABLE `memo_details` (
  `memo_id` varchar(20) NOT NULL,
  `product_id` int(10) NOT NULL,
  `taken_quantity` int(10) NOT NULL,
  `return_quantity` int(10) DEFAULT NULL,
  `sold_quantity` int(10) NOT NULL DEFAULT '0',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  KEY `fk_md_memo_id` (`memo_id`),
  CONSTRAINT `fk_md_memo_id` FOREIGN KEY (`memo_id`) REFERENCES `memo` (`memo_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of memo_details
-- ----------------------------

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `menu_type` enum('Main','Sub') NOT NULL,
  `parent_menu_id` int(10) DEFAULT NULL,
  `module_id` int(10) DEFAULT NULL,
  `icon_class` varchar(50) DEFAULT NULL,
  `menu_url` varchar(100) DEFAULT NULL,
  `sort_number` int(2) NOT NULL DEFAULT '0',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`menu_id`),
  KEY `fk_module_id` (`module_id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Master Entry Manager', 'Main', '0', '1', '', 'master/show_master/master_entry_table', '1', '0', '0000-00-00 00:00:00', null, '2014-09-14 12:42:59', 'Active');
INSERT INTO `menu` VALUES ('2', 'Table Manager', 'Sub', '1', '1', '', 'master/show_master/master_entry_table', '0', '0', '0000-00-00 00:00:00', null, '0000-00-00 00:00:00', 'Active');
INSERT INTO `menu` VALUES ('3', 'Create Master Entry', 'Sub', '1', '1', '', 'master', '1', '0', '0000-00-00 00:00:00', null, '2014-08-30 15:53:29', 'Active');
INSERT INTO `menu` VALUES ('4', 'Menu Manager', 'Main', '0', '1', '', 'master/menu_list', '2', '0', '0000-00-00 00:00:00', null, '2014-09-16 15:38:56', 'Active');
INSERT INTO `menu` VALUES ('5', 'Create Menu', 'Sub', '4', '1', '', 'master/menu_assign', '0', '0', '0000-00-00 00:00:00', null, '0000-00-00 00:00:00', 'Active');
INSERT INTO `menu` VALUES ('6', 'User Manager', 'Main', '0', '1', '', 'master/show_master/user', '3', '0', '0000-00-00 00:00:00', null, '2014-09-16 15:38:56', 'Active');
INSERT INTO `menu` VALUES ('7', 'Create User', 'Sub', '6', '1', '', 'master/show_master/user', '0', '0', '0000-00-00 00:00:00', null, '2014-09-01 14:50:55', 'Active');
INSERT INTO `menu` VALUES ('8', 'User Level', 'Sub', '2', '1', '', 'master/show_master/user_level', '4', '0', '0000-00-00 00:00:00', null, '2014-09-16 16:53:49', 'Active');
INSERT INTO `menu` VALUES ('10', 'Menu Privilege', 'Sub', '6', '1', '', 'master/get_menu_for_level', '4', '0', '0000-00-00 00:00:00', null, '2014-09-15 18:43:57', 'Active');
INSERT INTO `menu` VALUES ('14', 'User List', 'Sub', '13', '1', '', 'user/user_list', '0', '0', '0000-00-00 00:00:00', null, '2014-09-15 11:59:01', 'Active');
INSERT INTO `menu` VALUES ('16', 'User Level Settings', 'Sub', '6', '1', '', 'master/user_level_assign', '2', '0', '0000-00-00 00:00:00', null, '2014-09-01 12:20:16', 'Active');
INSERT INTO `menu` VALUES ('19', 'My Package', 'Sub', '18', '1', '', 'user/my_package', '0', '0', '0000-00-00 00:00:00', null, '2014-09-15 11:58:46', 'Active');
INSERT INTO `menu` VALUES ('20', 'My Account', 'Sub', '18', '1', '', 'user/my_account', '1', '0', '0000-00-00 00:00:00', null, '2014-09-15 11:58:49', 'Active');
INSERT INTO `menu` VALUES ('25', 'Home', 'Main', '0', '1', '', '', '0', '0', '0000-00-00 00:00:00', null, '0000-00-00 00:00:00', 'Active');
INSERT INTO `menu` VALUES ('27', 'Create/Input Item', 'Main', '0', '1', '', 'bat_distribution/create_invoice', '4', '0', null, null, '2014-09-16 16:56:41', 'Active');
INSERT INTO `menu` VALUES ('28', 'Create Product', 'Sub', '27', '1', '', 'master/show_master/product', '2', '0', null, null, '2014-09-16 16:51:40', 'Active');
INSERT INTO `menu` VALUES ('29', 'Create Distributor', 'Main', '0', '1', '', 'bat_distribution/create_distributor', '5', '0', null, null, '2014-09-18 16:01:32', 'Active');
INSERT INTO `menu` VALUES ('30', 'Create Invoice', 'Sub', '27', '1', '', 'bat_distribution/create_invoice', '0', '0', null, null, '2014-09-16 16:56:45', 'Active');
INSERT INTO `menu` VALUES ('31', 'Product Return', 'Sub', '27', '1', '', 'bat_distribution/bat_return', '3', '0', null, null, '2014-09-16 16:55:41', 'Active');
INSERT INTO `menu` VALUES ('32', 'Create Memo', 'Sub', '27', '1', '', 'bat_distribution/sale_product', '1', '0', null, null, '2014-09-17 11:36:50', 'Active');
INSERT INTO `menu` VALUES ('34', 'Create Customer Type', 'Sub', '27', '1', null, 'master/show_master/customer_type', '0', '0', null, null, null, 'Active');
INSERT INTO `menu` VALUES ('35', 'Creat Customer', 'Sub', '27', '1', null, 'master/show_master/customer', '0', '0', null, null, '2014-09-16 19:09:21', 'Active');

-- ----------------------------
-- Table structure for `module`
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `module_id` int(10) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `description` text,
  `home_url` varchar(100) DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', 'Apsis Developer CMS', 'A great way to develop CMS easily.', null, '0', null, null, '2014-09-15 11:31:03', 'Active');
INSERT INTO `module` VALUES ('2', 'Master Config', 'All kind of master entry settings for any module', null, '0', null, null, null, 'Active');
INSERT INTO `module` VALUES ('3', 'BAT Distributer Sales', 'Hotel Management Software', null, '0', null, null, '2014-09-15 17:56:28', 'Active');

-- ----------------------------
-- Table structure for `payment_mode`
-- ----------------------------
DROP TABLE IF EXISTS `payment_mode`;
CREATE TABLE `payment_mode` (
  `payment_mode_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_mode_name` varchar(50) NOT NULL COMMENT 'cash sale, credit sale, partial credit etc',
  `description` text,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`payment_mode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment_mode
-- ----------------------------

-- ----------------------------
-- Table structure for `payment_recieve`
-- ----------------------------
DROP TABLE IF EXISTS `payment_recieve`;
CREATE TABLE `payment_recieve` (
  `invoice_id` varchar(20) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL DEFAULT '0',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  KEY `fk_inv_id` (`invoice_id`),
  CONSTRAINT `fk_inv_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment_recieve
-- ----------------------------

-- ----------------------------
-- Table structure for `privilege_level`
-- ----------------------------
DROP TABLE IF EXISTS `privilege_level`;
CREATE TABLE `privilege_level` (
  `user_id` int(10) DEFAULT NULL,
  `user_level_id` int(10) DEFAULT NULL,
  UNIQUE KEY `u_entry` (`user_id`,`user_level_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilege_level
-- ----------------------------
INSERT INTO `privilege_level` VALUES ('1', '1');
INSERT INTO `privilege_level` VALUES ('3', '7');
INSERT INTO `privilege_level` VALUES ('4', null);
INSERT INTO `privilege_level` VALUES ('7', '8');
INSERT INTO `privilege_level` VALUES ('8', '11');

-- ----------------------------
-- Table structure for `privilege_menu`
-- ----------------------------
DROP TABLE IF EXISTS `privilege_menu`;
CREATE TABLE `privilege_menu` (
  `menu_id` int(10) NOT NULL,
  `user_level_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  UNIQUE KEY `u_privilege_menu` (`menu_id`,`user_level_id`) USING BTREE,
  CONSTRAINT `privilege_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilege_menu
-- ----------------------------
INSERT INTO `privilege_menu` VALUES ('25', '8', null);
INSERT INTO `privilege_menu` VALUES ('27', '8', null);
INSERT INTO `privilege_menu` VALUES ('34', '8', null);
INSERT INTO `privilege_menu` VALUES ('30', '8', null);
INSERT INTO `privilege_menu` VALUES ('35', '8', null);
INSERT INTO `privilege_menu` VALUES ('32', '8', null);
INSERT INTO `privilege_menu` VALUES ('28', '8', null);
INSERT INTO `privilege_menu` VALUES ('31', '8', null);
INSERT INTO `privilege_menu` VALUES ('25', '11', null);
INSERT INTO `privilege_menu` VALUES ('27', '11', null);
INSERT INTO `privilege_menu` VALUES ('34', '11', null);
INSERT INTO `privilege_menu` VALUES ('30', '11', null);
INSERT INTO `privilege_menu` VALUES ('35', '11', null);
INSERT INTO `privilege_menu` VALUES ('32', '11', null);
INSERT INTO `privilege_menu` VALUES ('31', '11', null);
INSERT INTO `privilege_menu` VALUES ('25', '12', null);
INSERT INTO `privilege_menu` VALUES ('27', '12', null);
INSERT INTO `privilege_menu` VALUES ('34', '12', null);
INSERT INTO `privilege_menu` VALUES ('30', '12', null);
INSERT INTO `privilege_menu` VALUES ('35', '12', null);
INSERT INTO `privilege_menu` VALUES ('31', '12', null);
INSERT INTO `privilege_menu` VALUES ('25', '10', null);
INSERT INTO `privilege_menu` VALUES ('27', '10', null);
INSERT INTO `privilege_menu` VALUES ('34', '10', null);
INSERT INTO `privilege_menu` VALUES ('30', '10', null);
INSERT INTO `privilege_menu` VALUES ('35', '10', null);
INSERT INTO `privilege_menu` VALUES ('32', '10', null);
INSERT INTO `privilege_menu` VALUES ('28', '10', null);
INSERT INTO `privilege_menu` VALUES ('31', '10', null);
INSERT INTO `privilege_menu` VALUES ('25', '1', null);
INSERT INTO `privilege_menu` VALUES ('1', '1', null);
INSERT INTO `privilege_menu` VALUES ('2', '1', null);
INSERT INTO `privilege_menu` VALUES ('8', '1', null);
INSERT INTO `privilege_menu` VALUES ('29', '1', null);
INSERT INTO `privilege_menu` VALUES ('3', '1', null);
INSERT INTO `privilege_menu` VALUES ('4', '1', null);
INSERT INTO `privilege_menu` VALUES ('5', '1', null);
INSERT INTO `privilege_menu` VALUES ('6', '1', null);
INSERT INTO `privilege_menu` VALUES ('7', '1', null);
INSERT INTO `privilege_menu` VALUES ('16', '1', null);
INSERT INTO `privilege_menu` VALUES ('10', '1', null);
INSERT INTO `privilege_menu` VALUES ('27', '1', null);
INSERT INTO `privilege_menu` VALUES ('34', '1', null);
INSERT INTO `privilege_menu` VALUES ('30', '1', null);
INSERT INTO `privilege_menu` VALUES ('35', '1', null);
INSERT INTO `privilege_menu` VALUES ('32', '1', null);
INSERT INTO `privilege_menu` VALUES ('28', '1', null);
INSERT INTO `privilege_menu` VALUES ('31', '1', null);
INSERT INTO `privilege_menu` VALUES ('25', '7', null);
INSERT INTO `privilege_menu` VALUES ('27', '7', null);
INSERT INTO `privilege_menu` VALUES ('34', '7', null);
INSERT INTO `privilege_menu` VALUES ('30', '7', null);
INSERT INTO `privilege_menu` VALUES ('35', '7', null);
INSERT INTO `privilege_menu` VALUES ('32', '7', null);
INSERT INTO `privilege_menu` VALUES ('28', '7', null);
INSERT INTO `privilege_menu` VALUES ('31', '7', null);
INSERT INTO `privilege_menu` VALUES ('29', '7', null);

-- ----------------------------
-- Table structure for `privilege_module`
-- ----------------------------
DROP TABLE IF EXISTS `privilege_module`;
CREATE TABLE `privilege_module` (
  `user_id` int(10) NOT NULL,
  `user_module_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilege_module
-- ----------------------------

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `unit_price` decimal(10,0) NOT NULL DEFAULT '0',
  `vat_tax_calculation_id` int(2) DEFAULT '0',
  `product_category_id` int(10) DEFAULT NULL,
  `unit_type_id` int(11) DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') CHARACTER SET utf8 DEFAULT 'Active',
  `vat` int(50) DEFAULT NULL,
  `tax` int(50) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'Benson & Hedges', null, '200', '0', null, null, '0', null, null, '2014-09-16 10:46:44', 'Active', null, null);
INSERT INTO `product` VALUES ('2', 'Gold Leaf', null, '100', '0', null, null, '0', null, null, '2014-09-16 10:47:03', 'Active', null, null);
INSERT INTO `product` VALUES ('3', 'Dunhill', null, '250', '0', null, null, '0', null, null, '2014-09-16 10:48:07', 'Active', null, null);
INSERT INTO `product` VALUES ('4', 'Marlborro', null, '200', '0', null, null, '0', null, null, '2014-09-16 10:48:35', 'Active', null, null);
INSERT INTO `product` VALUES ('6', '555', '', '300', '0', null, null, '1', '0000-00-00 00:00:00', null, null, 'Active', null, null);

-- ----------------------------
-- Table structure for `product_category`
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `product_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(50) NOT NULL,
  `description` text,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_category
-- ----------------------------

-- ----------------------------
-- Table structure for `product_price`
-- ----------------------------
DROP TABLE IF EXISTS `product_price`;
CREATE TABLE `product_price` (
  `product_id` int(10) NOT NULL,
  `product_price` int(100) NOT NULL,
  `vat` int(50) DEFAULT NULL,
  `tax` int(50) DEFAULT NULL,
  `discount` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_price
-- ----------------------------
INSERT INTO `product_price` VALUES ('1', '0', '50', null, null);
INSERT INTO `product_price` VALUES ('2', '0', '50', null, null);

-- ----------------------------
-- Table structure for `religion`
-- ----------------------------
DROP TABLE IF EXISTS `religion`;
CREATE TABLE `religion` (
  `religion_id` int(10) NOT NULL AUTO_INCREMENT,
  `religion_name` varchar(30) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`religion_id`),
  UNIQUE KEY `u_rel_name` (`religion_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of religion
-- ----------------------------
INSERT INTO `religion` VALUES ('1', 'Islam', '0', null, null, null, 'Active');
INSERT INTO `religion` VALUES ('2', 'Hindu', '0', null, null, null, 'Active');
INSERT INTO `religion` VALUES ('3', 'Buddhist', '0', null, null, null, 'Active');
INSERT INTO `religion` VALUES ('4', 'Chirstian', '0', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `route`
-- ----------------------------
DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` varchar(50) NOT NULL,
  `description` text,
  `area_id` int(10) DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`route_id`),
  KEY `fk_r_area_id` (`area_id`),
  CONSTRAINT `fk_r_area_id` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of route
-- ----------------------------
INSERT INTO `route` VALUES ('1', 'Bonani - 11', null, '1', '0', null, null, '2014-09-16 19:05:39', 'Active');

-- ----------------------------
-- Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) NOT NULL,
  `description` text,
  `group_status_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'Prospect Customer', 'All status related with prospect customers.', null);
INSERT INTO `status` VALUES ('2', 'Hopeful', null, '1');
INSERT INTO `status` VALUES ('3', 'No Hope', null, '1');
INSERT INTO `status` VALUES ('4', 'Become Customer', null, '1');
INSERT INTO `status` VALUES ('5', 'Positive Response', null, '1');
INSERT INTO `status` VALUES ('6', 'Negetive Response', null, '1');
INSERT INTO `status` VALUES ('7', 'Wait for Contact', null, '1');
INSERT INTO `status` VALUES ('8', 'Finally Closed', null, '1');
INSERT INTO `status` VALUES ('9', 'Withdrawl', 'Customer request for withdraw money', null);
INSERT INTO `status` VALUES ('10', 'Pending for Approval', 'for admin', '9');
INSERT INTO `status` VALUES ('11', 'Approved', 'for account', '9');
INSERT INTO `status` VALUES ('12', 'Canceled', 'cancelled', '9');
INSERT INTO `status` VALUES ('13', 'Transaction Completed', 'completed', '9');

-- ----------------------------
-- Table structure for `terms`
-- ----------------------------
DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `terms_id` int(10) NOT NULL AUTO_INCREMENT,
  `terms_name` varchar(50) NOT NULL COMMENT 'Net 30 days, Net 60 days etc',
  `number_of_days` int(2) NOT NULL DEFAULT '1',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`terms_id`),
  UNIQUE KEY `u_terms_name` (`terms_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of terms
-- ----------------------------
INSERT INTO `terms` VALUES ('1', '', '1', '0', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `unit_type`
-- ----------------------------
DROP TABLE IF EXISTS `unit_type`;
CREATE TABLE `unit_type` (
  `unit_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `unit_type_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Ex.. box, Carton etc',
  `unit_standard` varchar(10) NOT NULL COMMENT 'pcs, kg, meter etc',
  `description` text CHARACTER SET utf8,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') CHARACTER SET utf8 NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`unit_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit_type
-- ----------------------------

-- ----------------------------
-- Table structure for `upazila`
-- ----------------------------
DROP TABLE IF EXISTS `upazila`;
CREATE TABLE `upazila` (
  `upazila_id` int(10) NOT NULL AUTO_INCREMENT,
  `upazila_name` varchar(100) DEFAULT NULL COMMENT 'Upazila / Thana,y,Y,N,,20,1',
  `district_id` int(10) NOT NULL COMMENT 'Districts,y,Y,N,,20,2',
  `post_code` varchar(4) DEFAULT NULL COMMENT 'Post Code,y,N,N,,20,1',
  `created_by` int(10) NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`upazila_id`),
  KEY `fk_u_district_id` (`district_id`),
  CONSTRAINT `fk_u_district_id` FOREIGN KEY (`district_id`) REFERENCES `district` (`district_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=510 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of upazila
-- ----------------------------
INSERT INTO `upazila` VALUES ('1', 'Dhamrai Upazila', '18', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('2', 'Dohar Upazila', '18', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('3', 'Keraniganj Upazila', '18', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('4', 'Nawabganj Upazila', '18', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('5', 'Savar Upazila', '18', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('6', 'Alfadanga Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('7', 'Bhanga Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('8', 'Boalmari Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('9', 'Charbhadrasan Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('10', 'Faridpur Sadar Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('11', 'Madhukhali Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('12', 'Nagarkanda Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('13', 'Sadarpur Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('14', 'Saltha Upazila', '19', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('15', 'Gazipur Sadar Upazila', '20', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('16', 'Kaliakair Upazila', '20', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('17', 'Kaliganj Upazila', '20', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('18', 'Kapasia Upazila', '20', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('19', 'Sreepur Upazila', '20', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('20', 'Gopalganj Sadar Upazila', '21', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('21', 'Kashiani Upazila', '21', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('22', 'Kotalipara Upazila', '21', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('23', 'Muksudpur Upazila', '21', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('24', 'Tungipara Upazila', '21', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('25', 'Baksiganj Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('26', 'Dewanganj Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('27', 'Islampur Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('28', 'Jamalpur Sadar Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('29', 'Madarganj Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('30', 'Melandaha Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('31', 'Sarishabari Upazila', '22', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('32', 'Astagram Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('33', 'Bajitpur Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('34', 'Bhairab Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('35', 'Hossainpur Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('36', 'Itna Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('37', 'Karimganj Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('38', 'Katiadi Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('39', 'Kishoreganj Sadar Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('40', 'Kuliarchar Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('41', 'Mithamain Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('42', 'Nikli Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('43', 'Pakundia Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('44', 'Tarail Upazila', '23', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('45', 'Rajoir Upazila', '24', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('46', 'Madaripur Sadar Upazila', '24', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('47', 'Kalkini Upazila', '24', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('48', 'Shibchar Upazila', '24', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('49', 'Daulatpur Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('50', 'Ghior Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('51', 'Harirampur Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('52', 'Manikgonj Sadar Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('53', 'Saturia Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('54', 'Shivalaya Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('55', 'Singair Upazila', '25', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('56', 'Gazaria Upazila', '26', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('57', 'Lohajang Upazila', '26', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('58', 'Munshiganj Sadar Upazila', '26', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('59', 'Sirajdikhan Upazila', '26', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('60', 'Sreenagar Upazila', '26', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('61', 'Tongibari Upazila', '26', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('62', 'Bhaluka Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('63', 'Dhobaura Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('64', 'Fulbaria Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('65', 'Gaffargaon Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('66', 'Gauripur Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('67', 'Haluaghat Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('68', 'Ishwarganj Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('69', 'Mymensingh Sadar Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('70', 'Muktagachha Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('71', 'Nandail Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('72', 'Phulpur Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('73', 'Trishal Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('74', 'Tara Khanda Upazila', '27', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('75', 'Araihazar Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('76', 'Bandar Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('77', 'Narayanganj Sadar Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('78', 'Rupganj Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('79', 'Sonargaon Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('80', 'Fatullah Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('81', 'Siddhirganj Upazila', '28', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('82', 'Atpara Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('83', 'Barhatta Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('84', 'Durgapur Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('85', 'Khaliajuri Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('86', 'Kalmakanda Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('87', 'Kendua Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('88', 'Madan Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('89', 'Mohanganj Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('90', 'Netrokona Sadar Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('91', 'Purbadhala Upazila', '30', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('92', 'Baliakandi Upazila', '31', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('93', 'Goalandaghat Upazila', '31', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('94', 'Pangsha Upazila', '31', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('95', 'Rajbari Sadar Upazila', '31', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('96', 'Kalukhali Upazila', '31', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('97', 'Bhedarganj Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('98', 'Damudya Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('99', 'Gosairhat Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('100', 'Naria Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('101', 'Shariatpur Sadar Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('102', 'Zanjira Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('103', 'Shakhipur Upazila', '32', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('104', 'Jhenaigati Upazila', '33', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('105', 'Nakla Upazila', '33', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('106', 'Nalitabari Upazila', '33', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('107', 'Sherpur Sadar Upazila', '33', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('108', 'Sreebardi Upazila', '33', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('109', 'Gopalpur Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('110', 'Basail Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('111', 'Bhuapur Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('112', 'Delduar Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('113', 'Ghatail Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('114', 'Kalihati Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('115', 'Madhupur Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('116', 'Mirzapur Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('117', 'Nagarpur Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('118', 'Sakhipur Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('119', 'Dhanbari Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('120', 'Tangail Sadar Upazila', '34', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('121', 'Narsingdi Sadar Upazila', '29', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('122', 'Belabo Upazila', '29', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('123', 'Monohardi Upazila', '29', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('124', 'Palash Upazila', '29', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('125', 'Raipura Upazila', '29', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('126', 'Shibpur Upazila', '29', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('127', 'Adamdighi Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('128', 'Bogra Sadar Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('129', 'Dhunat Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('130', 'Dhupchanchia Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('131', 'Gabtali Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('132', 'Kahaloo Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('133', 'Nandigram Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('134', 'Sariakandi Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('135', 'Sahajanpur Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('136', 'Sherpur Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('137', 'Shibganj Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('138', 'Sonatola Upazila', '45', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('139', 'Akkelpur Upazila', '47', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('140', 'Joypurhat Sadar Upazila', '47', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('141', 'Kalai Upazila', '47', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('142', 'Khetlal Upazila', '47', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('143', 'Panchbibi Upazila', '47', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('144', 'Atrai Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('145', 'Badalgachhi Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('146', 'Manda Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('147', 'Dhamoirhat Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('148', 'Mohadevpur Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('149', 'Naogaon Sadar Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('150', 'Niamatpur Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('151', 'Patnitala Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('152', 'Porsha Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('153', 'Raninagar Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('154', 'Sapahar Upazila', '49', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('155', 'Bagatipara Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('156', 'Baraigram Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('157', 'Gurudaspur Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('158', 'Lalpur Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('159', 'Natore Sadar Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('160', 'Singra Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('161', 'Naldanga Upazila', '50', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('162', 'Bholahat Upazila', '46', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('163', 'Gomastapur Upazila', '46', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('164', 'Nachole Upazila', '46', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('165', 'Nawabganj Sadar Upazila', '46', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('166', 'Shibganj Upazila', '46', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('167', 'Atgharia Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('168', 'Bera Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('169', 'Bhangura Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('170', 'Chatmohar Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('171', 'Faridpur Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('172', 'Ishwardi Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('173', 'Pabna Sadar Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('174', 'Santhia Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('175', 'Sujanagar Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('176', 'Ataikula Upazila', '48', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('177', 'Bagha Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('178', 'Bagmara Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('179', 'Charghat Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('180', 'Durgapur Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('181', 'Godagari Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('182', 'Mohanpur Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('183', 'Paba Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('184', 'Puthia Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('185', 'Tanore Upazila', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('186', 'Boalia Thana', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('187', 'Matihar Thana', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('188', 'Rajpara Thana', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('189', 'Shah Mokdum Thana', '51', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('190', 'Belkuchi Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('191', 'Chauhali Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('192', 'Kamarkhanda Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('193', 'Kazipur Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('194', 'Raiganj Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('195', 'Shahjadpur Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('196', 'Sirajganj Sadar Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('197', 'Tarash Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('198', 'Ullahpara Upazila', '52', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('199', 'Birampur Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('200', 'Birganj Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('201', 'Biral Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('202', 'Bochaganj Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('203', 'Chirirbandar Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('204', 'Phulbari Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('205', 'Ghoraghat Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('206', 'Hakimpur Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('207', 'Kaharole Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('208', 'Khansama Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('209', 'Dinajpur Sadar Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('210', 'Nawabganj Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('211', 'Parbatipur Upazila', '53', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('212', 'Phulchhari Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('213', 'Gaibandha Sadar Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('214', 'Gobindaganj Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('215', 'Palashbari Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('216', 'Sadullapur Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('217', 'Sughatta Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('218', 'Sundarganj Upazila', '54', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('219', 'Bhurungamari Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('220', 'Char Rajibpur Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('221', 'Chilmari Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('222', 'Phulbari Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('223', 'Kurigram Sadar Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('224', 'Nageshwari Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('225', 'Rajarhat Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('226', 'Raomari Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('227', 'Ulipur Upazila', '55', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('228', 'Aditmari Upazila', '56', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('229', 'Hatibandha Upazila', '56', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('230', 'Kaliganj Upazila', '56', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('231', 'Lalmonirhat Sadar Upazila', '56', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('232', 'Patgram Upazila', '56', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('233', 'Dimla Upazila', '57', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('234', 'Domar Upazila', '57', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('235', 'Jaldhaka Upazila', '57', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('236', 'Kishoreganj Upazila', '57', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('237', 'Nilphamari Sadar Upazila', '57', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('238', 'Saidpur Upazila', '57', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('239', 'Atwari Upazila', '58', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('240', 'Boda Upazila', '58', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('241', 'Debiganj Upazila', '58', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('242', 'Panchagarh Sadar Upazila', '58', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('243', 'Tetulia Upazila', '58', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('244', 'Badarganj Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('245', 'Gangachhara Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('246', 'Kaunia Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('247', 'Rangpur Sadar Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('248', 'Mithapukur Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('249', 'Pirgachha Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('250', 'Pirganj Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('251', 'Taraganj Upazila', '59', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('252', 'Baliadangi Upazila', '60', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('253', 'Haripur Upazila', '60', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('254', 'Pirganj Upazila', '60', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('255', 'Ranisankail Upazila', '60', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('256', 'Thakurgaon Sadar Upazila', '60', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('257', 'Amtali Upazila', '1', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('258', 'Bamna Upazila', '1', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('259', 'Barguna Sadar Upazila', '1', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('260', 'Betagi Upazila', '1', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('261', 'Patharghata Upazila', '1', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('262', 'Taltoli Upazila', '1', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('263', 'Agailjhara Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('264', 'Babuganj Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('265', 'Bakerganj Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('266', 'Banaripara Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('267', 'Gaurnadi Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('268', 'Hizla Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('269', 'Barisal Sadar Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('270', 'Mehendiganj Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('271', 'Muladi Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('272', 'Wazirpur Upazila', '2', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('273', 'Bhola Sadar Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('274', 'Burhanuddin Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('275', 'Char Fasson Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('276', 'Daulatkhan Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('277', 'Lalmohan Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('278', 'Manpura Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('279', 'Tazumuddin Upazila', '3', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('280', 'Jhalokati Sadar Upazila', '4', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('281', 'Kathalia Upazila', '4', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('282', 'Nalchity Upazila', '4', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('283', 'Rajapur Upazila', '4', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('284', 'Bauphal Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('285', 'Dashmina Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('286', 'Galachipa Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('287', 'Kalapara Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('288', 'Mirzaganj Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('289', 'Patuakhali Sadar Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('290', 'Rangabali Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('291', 'Dumki Upazila', '5', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('292', 'Bhandaria Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('293', 'Kawkhali Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('294', 'Mathbaria Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('295', 'Nazirpur Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('296', 'Pirojpur Sadar Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('297', 'Nesarabad (Swarupkati) Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('298', 'Zianagor Upazila', '6', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('299', 'Ali Kadam Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('300', 'Bandarban Sadar Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('301', 'Lama Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('302', 'Naikhongchhari Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('303', 'Rowangchhari Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('304', 'Ruma Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('305', 'Thanchi Upazila', '7', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('306', 'Akhaura Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('307', 'Bancharampur Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('308', 'Brahmanbaria Sadar Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('309', 'Kasba Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('310', 'Nabinagar Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('311', 'Nasirnagar Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('312', 'Sarail Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('313', 'Ashuganj Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('314', 'Bijoynagar Upazila', '8', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('315', 'Chandpur Sadar Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('316', 'Faridganj Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('317', 'Haimchar Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('318', 'Haziganj Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('319', 'Kachua Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('320', 'Matlab Dakshin Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('321', 'Matlab Uttar Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('322', 'Shahrasti Upazila', '9', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('323', 'Anwara Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('324', 'Banshkhali Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('325', 'Boalkhali Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('326', 'Chandanaish Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('327', 'Fatikchhari Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('328', 'Hathazari Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('329', 'Lohagara Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('330', 'Mirsharai Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('331', 'Patiya Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('332', 'Rangunia Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('333', 'Raozan Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('334', 'Sandwip Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('335', 'Satkania Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('336', 'Sitakunda Upazila', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('337', 'Bandor (Chittagong Port) Thana', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('338', 'Chandgaon Thana', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('339', 'Double Morring Thana', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('340', 'Kotwali Thana', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('341', 'Pahartali Thana', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('342', 'Panchlaish Thana', '10', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('343', 'Barura Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('344', 'Brahmanpara Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('345', 'Burichong Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('346', 'Chandina Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('347', 'Chauddagram Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('348', 'Daudkandi Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('349', 'Debidwar Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('350', 'Homna Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('351', 'Laksam Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('352', 'Muradnagar Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('353', 'Nangalkot Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('354', 'Comilla Sadar Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('355', 'Meghna Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('356', 'Titas Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('357', 'Monohargonj Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('358', 'Sadar South Upazila', '11', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('359', 'Chakaria Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('360', 'Cox\'s Bazar Sadar Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('361', 'Kutubdia Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('362', 'Maheshkhali Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('363', 'Ramu Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('364', 'Teknaf Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('365', 'Ukhia Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('366', 'Pekua Upazila', '12', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('367', 'Chhagalnaiya Upazila', '13', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('368', 'Daganbhuiyan Upazila', '13', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('369', 'Feni Sadar Upazila', '13', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('370', 'Parshuram Upazila', '13', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('371', 'Sonagazi Upazila', '13', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('372', 'Fulgazi Upazila', '13', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('373', 'Dighinala Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('374', 'Khagrachhari Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('375', 'Lakshmichhari Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('376', 'Mahalchhari Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('377', 'Manikchhari Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('378', 'Matiranga Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('379', 'Panchhari Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('380', 'Ramgarh Upazila', '14', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('381', 'Lakshmipur Sadar Upazila', '15', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('382', 'Raipur Upazila', '15', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('383', 'Ramganj Upazila', '15', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('384', 'Ramgati Upazila', '15', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('385', 'Komolnagar Upazila', '15', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('386', 'Begumganj Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('387', 'Noakhali Sadar Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('388', 'Chatkhil Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('389', 'Companiganj Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('390', 'Hatiya Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('391', 'Senbagh Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('392', 'Sonaimuri Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('393', 'Subarnachar Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('394', 'Kabirhat Upazila', '16', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('395', 'Bagaichhari Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('396', 'Barkal Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('397', 'Kawkhali (Betbunia) Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('398', 'Belaichhari Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('399', 'Kaptai Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('400', 'Juraichhari Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('401', 'Langadu Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('402', 'Naniyachar Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('403', 'Rajasthali Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('404', 'Rangamati Sadar Upazila', '17', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('405', 'Ajmiriganj Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('406', 'Bahubal Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('407', 'Baniyachong Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('408', 'Chunarughat Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('409', 'Habiganj Sadar Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('410', 'Lakhai Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('411', 'Madhabpur Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('412', 'Nabiganj Upazila', '61', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('413', 'Barlekha Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('414', 'Kamalganj Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('415', 'Kulaura Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('416', 'Moulvibazar Sadar Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('417', 'Rajnagar Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('418', 'Sreemangal Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('419', 'Juri Upazila', '62', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('420', 'Bishwamvarpur Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('421', 'Chhatak Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('422', 'Derai Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('423', 'Dharampasha Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('424', 'Dowarabazar Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('425', 'Jagannathpur Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('426', 'Jamalganj Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('427', 'Sullah Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('428', 'Sunamganj Sadar Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('429', 'Tahirpur Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('430', 'South Sunamganj Upazila', '63', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('431', 'Balaganj Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('432', 'Beanibazar Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('433', 'Bishwanath Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('434', 'Companigonj Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('435', 'Fenchuganj Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('436', 'Golapganj Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('437', 'Gowainghat Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('438', 'Jaintiapur Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('439', 'Kanaighat Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('440', 'Sylhet Sadar Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('441', 'Zakiganj Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('442', 'South Shurma Upazila', '64', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('443', 'Bagerhat Sadar Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('444', 'Chitalmari Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('445', 'Fakirhat Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('446', 'Kachua Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('447', 'Mollahat Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('448', 'Mongla Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('449', 'Morrelganj Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('450', 'Rampal Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('451', 'Sarankhola Upazila', '35', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('452', 'Alamdanga Upazila', '36', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('453', 'Chuadanga Sadar Upazila', '36', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('454', 'Damurhuda Upazila', '36', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('455', 'Jibannagar Upazila', '36', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('456', 'Abhaynagar Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('457', 'Bagherpara Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('458', 'Chaugachha Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('459', 'Jhikargachha Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('460', 'Keshabpur Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('461', 'Jessore Sadar Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('462', 'Manirampur Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('463', 'Sharsha Upazila', '37', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('464', 'Harinakunda Upazila', '38', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('465', 'Jhenaidah Sadar Upazila', '38', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('466', 'Kaliganj Upazila', '38', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('467', 'Kotchandpur Upazila', '38', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('468', 'Maheshpur Upazila', '38', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('469', 'Shailkupa Upazila', '38', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('470', 'Batiaghata Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('471', 'Dacope Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('472', 'Dumuria Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('473', 'Dighalia Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('474', 'Koyra Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('475', 'Paikgachha Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('476', 'Phultala Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('477', 'Rupsha Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('478', 'Terokhada Upazila', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('479', 'Daulatpur Thana', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('480', 'Khalishpur Thana', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('481', 'Khan Jahan Ali Thana', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('482', 'Kotwali Thana', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('483', 'Sonadanga Thana', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('484', 'Harintana Thana', '39', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('485', 'Bheramara Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('486', 'Daulatpur Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('487', 'Khoksa Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('488', 'Kumarkhali Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('489', 'Kushtia Sadar Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('490', 'Mirpur Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('491', 'Shekhpara Upazila', '40', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('492', 'Magura Sadar Upazila', '41', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('493', 'Mohammadpur Upazila', '41', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('494', 'Shalikha Upazila', '41', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('495', 'Sreepur Upazila', '41', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('496', 'Gangni Upazila', '42', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('497', 'Meherpur Sadar Upazila', '42', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('498', 'Mujibnagar Upazila', '42', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('499', 'Kalia Upazila', '43', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('500', 'Lohagara Upazila', '43', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('501', 'Narail Sadar Upazila', '43', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('502', 'Naragati Thana', '43', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('503', 'Assasuni Upazila', '44', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('504', 'Debhata Upazila', '44', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('505', 'Kalaroa Upazila', '44', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('506', 'Kaliganj Upazila', '44', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('507', 'Satkhira Sadar Upazila', '44', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('508', 'Shyamnagar Upazila', '44', null, '1', null, null, null, 'Active');
INSERT INTO `upazila` VALUES ('509', 'Tala Upazila', '44', null, '1', null, null, null, 'Active');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT 'e10adc3949ba59abbe56e057f20f883e' COMMENT 'encoded in md5 format',
  `secret_question_1` varchar(100) DEFAULT NULL,
  `secret_question_2` varchar(100) DEFAULT NULL,
  `secret_question_ans_1` varchar(100) DEFAULT NULL,
  `secret_question_ans_2` varchar(100) DEFAULT NULL,
  `identification_type_id` int(10) DEFAULT NULL,
  `identification_number` varchar(30) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `religion_id` int(10) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(30) DEFAULT NULL,
  `bank_branch_id` int(10) DEFAULT NULL,
  `last_login_date_time` timestamp NULL DEFAULT NULL,
  `default_module_id` int(10) DEFAULT '3',
  `is_module_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_distributor` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `user_image` varchar(100) DEFAULT 'images/default/avatar.jpg',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `u_username` (`username`) USING BTREE,
  UNIQUE KEY `u_email` (`email`) USING BTREE,
  UNIQUE KEY `u_contact_number` (`contact_number`) USING BTREE,
  KEY `fk_religion` (`religion_id`),
  KEY `fk_identification_id` (`identification_type_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`identification_type_id`) REFERENCES `identification_type` (`identification_type_id`) ON UPDATE NO ACTION,
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`religion_id`) REFERENCES `religion` (`religion_id`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'Apsis', 'Solutions Limited', 'n@gmail.com', '01818777444', 'admin', '7cda7e1bb5950164c1169d9a4cfe0cfb', 'Sec Question 13', 'Apsis Sec Question 22', 'Sec Answer 13', 'Admin ans', '1', '11335577', '2014-08-14', 'Male', null, null, null, null, null, '0000-00-00 00:00:00', '3', '0', '0', '0', null, '1', '2014-09-15 18:20:55', 'Active', 'images/user/1_Apsis.jpg');
INSERT INTO `user` VALUES ('3', 'Nirjhar', 'Mandal', 'nijhu.tulip@gmail.com', '123456789', 'nirjhar', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '3', '0', '0', '1', '0000-00-00 00:00:00', '1', '2014-09-15 18:20:32', 'Active', 'images/default/avatar.jpg');
INSERT INTO `user` VALUES ('4', 'Zaman Store', '', 'zzman@gmail.com', '23', 'zaman', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '3', '0', '0', '0', null, null, '2014-09-16 17:11:32', 'Active', 'images/default/avatar.jpg');
INSERT INTO `user` VALUES ('7', 'Munir', 'Zaman', 'a@sss.com', '01818677444', 'munir', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '3', '0', '0', '1', '0000-00-00 00:00:00', null, '2014-09-17 15:39:56', 'Active', 'images/default/avatar.jpg');
INSERT INTO `user` VALUES ('8', 'Salam', 'Ahmed', 'sa@sss.com', '6789', 'salam', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '3', '0', '0', '1', '0000-00-00 00:00:00', null, null, 'Active', 'images/default/avatar.jpg');

-- ----------------------------
-- Table structure for `user_level`
-- ----------------------------
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE `user_level` (
  `user_level_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_level_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `privilege_edit` tinyint(1) NOT NULL DEFAULT '0',
  `privilege_delete` tinyint(1) NOT NULL DEFAULT '0',
  `privilege_add` tinyint(1) NOT NULL DEFAULT '0',
  `privilege_view_all` tinyint(1) NOT NULL DEFAULT '0',
  `all_privilege` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_level_id`),
  UNIQUE KEY `u_level_name` (`user_level_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_level
-- ----------------------------
INSERT INTO `user_level` VALUES ('1', 'Developer', 'For testing', '1', '2014-08-31 12:06:38', '1', '2014-09-11 11:51:38', null, '1', '1', '1', '1', '1');
INSERT INTO `user_level` VALUES ('7', 'BAT_Admin', '', '1', '0000-00-00 00:00:00', null, null, 'Active', '1', '1', '1', '1', '1');
INSERT INTO `user_level` VALUES ('8', 'Distributor Admin', '', '1', '0000-00-00 00:00:00', null, null, 'Active', '1', '1', '1', '1', '1');
INSERT INTO `user_level` VALUES ('9', 'SKU Manager', '', '1', '0000-00-00 00:00:00', null, null, 'Active', '1', '0', '0', '1', '0');
INSERT INTO `user_level` VALUES ('10', 'Store Keeper', '', '1', '0000-00-00 00:00:00', null, null, 'Active', '0', '0', '0', '0', '0');
INSERT INTO `user_level` VALUES ('11', 'Sales Manager', '', '1', '0000-00-00 00:00:00', null, '2014-09-17 15:56:46', 'Active', '1', '1', '1', '1', '1');
INSERT INTO `user_level` VALUES ('12', 'Salesman', '', '1', '0000-00-00 00:00:00', null, null, 'Active', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `vat_tax_calculation`
-- ----------------------------
DROP TABLE IF EXISTS `vat_tax_calculation`;
CREATE TABLE `vat_tax_calculation` (
  `vat_tax_calculation_id` int(2) NOT NULL AUTO_INCREMENT,
  `vat_tax_calculation_details` varchar(100) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`vat_tax_calculation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vat_tax_calculation
-- ----------------------------

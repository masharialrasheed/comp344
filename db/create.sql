
-- Model online store schema for use in COMP344, "E-Commerce Technologies"


SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema store3.3
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `store3.3` ;

-- -----------------------------------------------------
-- Schema store3.3
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `store3.3` DEFAULT CHARACTER SET latin1 ;
USE `store3.3` ;

-- -----------------------------------------------------
-- Table `store3.3`.`Product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Product` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Product` (
  `prod_id` INT NOT NULL AUTO_INCREMENT,
  `prod_name` VARCHAR(40) NOT NULL,
  `prod_desc` VARCHAR(128) NULL DEFAULT NULL,
  `prod_img_url` VARCHAR(128) NULL DEFAULT NULL,
  `prod_long_desc` VARCHAR(256) NULL DEFAULT NULL,
  `prod_sku` CHAR(16) NULL DEFAULT NULL,
  `prod_disp_cmd` VARCHAR(128) NULL DEFAULT NULL,
  `prod_weight` DECIMAL(6,2) NULL,
  `prod_l` INT NULL,
  `prod_w` INT NULL,
  `prod_h` INT NULL,
  PRIMARY KEY (`prod_id`),
  INDEX `prod_name` (`prod_name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1
COMMENT = 'Key product information.';


-- -----------------------------------------------------
-- Table `store3.3`.`Attribute`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Attribute` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Attribute` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `Product_prod_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_Attribute_Product1_idx` (`Product_prod_id` ASC),
  CONSTRAINT `fk_product_id`
    FOREIGN KEY (`Product_prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1
COMMENT = 'Product attribute name and type information';


-- -----------------------------------------------------
-- Table `store3.3`.`AttributeValue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`AttributeValue` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`AttributeValue` (
  `AttrVal_id` INT NOT NULL AUTO_INCREMENT,
  `AttrVal_Value` VARCHAR(45) NOT NULL,
  `AttrVal_Attr_id` INT NOT NULL,
  `AttrVal_Prod_id` INT NOT NULL,
  `AttrVal_Price` DECIMAL(10,2) NULL,
  PRIMARY KEY (`AttrVal_id`),
  UNIQUE INDEX `id_UNIQUE` (`AttrVal_id` ASC),
  INDEX `fk_AttributeValue_Attribute_idx` (`AttrVal_Attr_id` ASC),
  INDEX `fk_Prod_id_idx` (`AttrVal_Prod_id` ASC),
  CONSTRAINT `fk_Attr_Id`
    FOREIGN KEY (`AttrVal_Attr_id`)
    REFERENCES `store3.3`.`Attribute` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prod_id`
    FOREIGN KEY (`AttrVal_Prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Product attribute value information.';


-- -----------------------------------------------------
-- Table `store3.3`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Category` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Category` (
  `cat_id` INT NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(40) NOT NULL,
  `cat_desc` VARCHAR(128) NULL DEFAULT NULL,
  `cat_img_url` VARCHAR(128) NULL DEFAULT NULL,
  `cat_disp_cmd` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  INDEX `cat_name` (`cat_name` ASC),
  UNIQUE INDEX `cat_name_UNIQUE` (`cat_name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = latin1
COMMENT = 'Product category information for store catalogue.';


-- -----------------------------------------------------
-- Table `store3.3`.`CgPrRel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`CgPrRel` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`CgPrRel` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `CgPr_cat_id` INT NOT NULL,
  `CgPr_prod_id` INT NOT NULL,
  PRIMARY KEY (`Id`),
  INDEX `pk_parent_cat_idx` (`CgPr_cat_id` ASC),
  INDEX `pk_child_prod_idx` (`CgPr_prod_id` ASC),
  CONSTRAINT `pk_parent_cat`
    FOREIGN KEY (`CgPr_cat_id`)
    REFERENCES `store3.3`.`Category` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `pk_child_prod`
    FOREIGN KEY (`CgPr_prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `store3.3`.`CgryRel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`CgryRel` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`CgryRel` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `cgryrel_id_parent` INT NOT NULL,
  `cgryrel_id_child` INT NOT NULL,
  `cgryrel_sequence` INT NULL,
  PRIMARY KEY (`Id`),
  INDEX `pk_parent_cat_idx` (`cgryrel_id_parent` ASC),
  INDEX `pk_child_cat_idx` (`cgryrel_id_child` ASC),
  CONSTRAINT `fk_parent_cat`
    FOREIGN KEY (`cgryrel_id_parent`)
    REFERENCES `store3.3`.`Category` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_child_cat`
    FOREIGN KEY (`cgryrel_id_child`)
    REFERENCES `store3.3`.`Category` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `store3.3`.`ShopperGroup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`ShopperGroup` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`ShopperGroup` (
  `ShopGrp_id` INT NOT NULL,
  `ShopGrp_Name` VARCHAR(45) NOT NULL,
  `ShopGrp_Description` VARCHAR(256) NULL,
  PRIMARY KEY (`ShopGrp_id`),
  CONSTRAINT `fk_ShopperGroup_Shopper1`
    FOREIGN KEY (`ShopGrp_id`)
    REFERENCES `store3.3`.`Shopper` (`sh_shopgrp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Shopper`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Shopper` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Shopper` (
  `shopper_id` INT NOT NULL AUTO_INCREMENT,
  `sh_username` VARCHAR(30) NOT NULL,
  `sh_password` CHAR(60) NOT NULL,
  `sh_email` VARCHAR(64) NOT NULL,
  `sh_phone` VARCHAR(45) NULL DEFAULT NULL,
  `sh_type` CHAR(1) NOT NULL,
  `sh_shopgrp` INT NULL DEFAULT NULL,
  `sh_field1` VARCHAR(128) NULL DEFAULT NULL,
  `sh_field2` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`shopper_id`),
  INDEX `sh_username` (`sh_username` ASC),
  INDEX `fk_Shopper_ShopperGroup1_idx` (`sh_shopgrp` ASC),
  CONSTRAINT `fk_Shopper_ShopperGroup1`
    FOREIGN KEY (`sh_shopgrp`)
    REFERENCES `store3.3`.`ShopperGroup` (`ShopGrp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1
COMMENT = 'Information about a registered shopper and or user.';


-- -----------------------------------------------------
-- Table `store3.3`.`Shaddr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Shaddr` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Shaddr` (
  `shaddr_id` INT(11) NOT NULL AUTO_INCREMENT,
  `shopper_id` INT(11) NOT NULL,
  `sh_title` CHAR(8) NULL DEFAULT NULL,
  `sh_firstname` VARCHAR(20) NULL DEFAULT NULL,
  `sh_familyname` VARCHAR(30) NULL DEFAULT NULL,
  `sh_street1` VARCHAR(64) NULL DEFAULT NULL,
  `sh_street2` VARCHAR(64) NULL DEFAULT NULL,
  `sh_city` VARCHAR(32) NULL DEFAULT NULL,
  `sh_state` VARCHAR(8) NULL DEFAULT NULL,
  `sh_postcode` VARCHAR(10) NULL DEFAULT NULL,
  `sh_country` VARCHAR(32) NULL DEFAULT NULL,
  PRIMARY KEY (`shaddr_id`),
  INDEX `shopper_id` (`shopper_id` ASC),
  CONSTRAINT `fk_shopper_id`
    FOREIGN KEY (`shopper_id`)
    REFERENCES `store3.3`.`Shopper` (`shopper_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = latin1
COMMENT = 'A shopper can have multiple shipping or other addresses.';


-- -----------------------------------------------------
-- Table `store3.3`.`Order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Order` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Order` (
  `Order_id` INT NOT NULL AUTO_INCREMENT,
  `Order_Shopper` INT NOT NULL,
  `Order_Shaddr` INT NOT NULL,
  `Order_TimeStamp` TIMESTAMP NULL,
  `Order_PayMethod` CHAR NULL,
  `Order_Payment_PAN` VARCHAR(20) NULL,
  `Order_PaymentAuthorized` TINYINT(1) NULL,
  `Order_Picked` TINYINT(1) NULL,
  `Order_Shipped` TINYINT(1) NULL,
  `Order_ShipDate` DATE NULL,
  `Order_Paid` TINYINT(1) NULL,
  `Order_PayDate` DATE NULL,
  `Order_ShippingAmount` DECIMAL(10,2) NULL,
  `Order_TaxAmount` DECIMAL(10,2) NULL,
  `Order_ProductAmount` DECIMAL(10,2) NULL,
  `Order_Total` DECIMAL(10,2) NULL,
  PRIMARY KEY (`Order_id`),
  INDEX `fk_Shopper_idx` (`Order_Shopper` ASC),
  INDEX `fk_Order_Shaddr_idx` (`Order_Shaddr` ASC),
  CONSTRAINT `fk_Shopper`
    FOREIGN KEY (`Order_Shopper`)
    REFERENCES `store3.3`.`Shopper` (`shopper_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Shaddr`
    FOREIGN KEY (`Order_Shaddr`)
    REFERENCES `store3.3`.`Shaddr` (`shaddr_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`OrderProduct`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`OrderProduct` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`OrderProduct` (
  `OP_id` INT NOT NULL AUTO_INCREMENT,
  `OP_Order_id` INT NOT NULL,
  `OP_prod_id` INT NOT NULL,
  `OP_qty` INT NULL,
  PRIMARY KEY (`OP_id`),
  INDEX `fk_Order_has_Product_Product1_idx` (`OP_prod_id` ASC),
  INDEX `fk_OrderProduct_Order1_idx` (`OP_Order_id` ASC),
  CONSTRAINT `fk_OP_Product`
    FOREIGN KEY (`OP_prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderProduct_Order1`
    FOREIGN KEY (`OP_Order_id`)
    REFERENCES `store3.3`.`Order` (`Order_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`OrderProductAttributeValues`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`OrderProductAttributeValues` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`OrderProductAttributeValues` (
  `OPAttr_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `OPAttr_op_id` INT NOT NULL,
  `OPAttr_Attr_id` INT NOT NULL,
  `OPAttr_AttrVal_id` INT NOT NULL,
  PRIMARY KEY (`OPAttr_id`, `OPAttr_op_id`),
  INDEX `fk_Order_has_Product_has_AttributeValue_AttributeValue1_idx` (`OPAttr_AttrVal_id` ASC),
  INDEX `fk_Order_has_Product_has_AttributeValue_Order_has_Product1_idx` (`OPAttr_op_id` ASC),
  CONSTRAINT `fk_Order_has_Product_has_AttributeValue_Order_has_Product1`
    FOREIGN KEY (`OPAttr_op_id`)
    REFERENCES `store3.3`.`OrderProduct` (`OP_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_has_Product_has_AttributeValue_AttributeValue1`
    FOREIGN KEY (`OPAttr_AttrVal_id`)
    REFERENCES `store3.3`.`AttributeValue` (`AttrVal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderProductAttributeValues_Attribute1`
    FOREIGN KEY (`OPAttr_op_id`)
    REFERENCES `store3.3`.`Attribute` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`AccessGroup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`AccessGroup` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`AccessGroup` (
  `AG_id` INT NOT NULL AUTO_INCREMENT,
  `AG_name` VARCHAR(45) NULL,
  `AG_desc` VARCHAR(255) NULL,
  PRIMARY KEY (`AG_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Commands`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Commands` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Commands` (
  `Cmd_id` INT NOT NULL AUTO_INCREMENT,
  `Cmd_name` VARCHAR(45) NULL,
  `Cmd_URL` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Cmd_id`),
  UNIQUE INDEX `Cmd_id_UNIQUE` (`Cmd_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`AccessUserGroup`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`AccessUserGroup` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`AccessUserGroup` (
  `AUG_id` INT NOT NULL AUTO_INCREMENT,
  `AUG_Shopper_id` INT NOT NULL,
  `AUG_AG_id` INT NOT NULL,
  PRIMARY KEY (`AUG_id`),
  INDEX `fk_Shopper_id_idx` (`AUG_Shopper_id` ASC),
  INDEX `fk_AG_id_idx` (`AUG_AG_id` ASC),
  CONSTRAINT `fk__AUG_Shopper_id`
    FOREIGN KEY (`AUG_Shopper_id`)
    REFERENCES `store3.3`.`Shopper` (`shopper_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk__AUG_AG_id`
    FOREIGN KEY (`AUG_AG_id`)
    REFERENCES `store3.3`.`AccessGroup` (`AG_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Maps a user to an access control group.';


-- -----------------------------------------------------
-- Table `store3.3`.`AccessGroupCommands`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`AccessGroupCommands` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`AccessGroupCommands` (
  `AGC_id` INT NOT NULL AUTO_INCREMENT,
  `AGC_AG_id` INT NOT NULL,
  `AGC_Cmd_id` INT NOT NULL,
  `AGC_desc` VARCHAR(255) NULL,
  PRIMARY KEY (`AGC_id`),
  INDEX `fk_Cmd_id_idx` (`AGC_Cmd_id` ASC),
  INDEX `fk_AG_id_idx` (`AGC_AG_id` ASC),
  CONSTRAINT `fk_AGC_AG_id`
    FOREIGN KEY (`AGC_AG_id`)
    REFERENCES `store3.3`.`AccessGroup` (`AG_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AGC_Cmd_id`
    FOREIGN KEY (`AGC_Cmd_id`)
    REFERENCES `store3.3`.`Commands` (`Cmd_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Session`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Session` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Session` (
  `id` CHAR(32) NOT NULL,
  `Shopper_id` INT NULL,
  `data` MEDIUMBLOB NULL,
  `time` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_t` (`time` ASC),
  CONSTRAINT `fk_sess_shopper_id`
    FOREIGN KEY (`Shopper_id`)
    REFERENCES `store3.3`.`Shopper` (`shopper_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Rating` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Rating` (
  `Rating_id` INT NOT NULL,
  `Rating_Shopper_id` INT NULL,
  `Rating_Product_id` INT NULL,
  `Rating_Value` INT NULL,
  `Rating_Review` MEDIUMBLOB NULL,
  `Rating_Recommend` FLOAT NULL,
  PRIMARY KEY (`Rating_id`),
  INDEX `fk_Rvw_Shopper_id_idx` (`Rating_Shopper_id` ASC),
  INDEX `fk_Rvw_Product_id_idx` (`Rating_Product_id` ASC),
  CONSTRAINT `fk_Rvw_Shopper_id`
    FOREIGN KEY (`Rating_Shopper_id`)
    REFERENCES `store3.3`.`Shopper` (`shopper_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rvw_Product_id`
    FOREIGN KEY (`Rating_Product_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Stock` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Stock` (
  `id` INT NOT NULL,
  `Stock_Prod_id` INT NULL,
  `Stock_Prod_AttrValue_id` INT NULL,
  `Stock_Qty` INT NULL,
  `Stock_SKU` VARCHAR(60) NULL,
  `Stock_Location` VARCHAR(60) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Stock_Prod_id_idx` (`Stock_Prod_id` ASC),
  INDEX `fk_Stock_ProdAttrValue_id_idx` (`Stock_Prod_AttrValue_id` ASC),
  CONSTRAINT `fk_Stock_Prod_id`
    FOREIGN KEY (`Stock_Prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Stock_ProdAttrValue_id`
    FOREIGN KEY (`Stock_Prod_AttrValue_id`)
    REFERENCES `store3.3`.`AttributeValue` (`AttrVal_Prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Specials`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Specials` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Specials` (
  `id` INT NOT NULL,
  `Special_Product_id` INT NOT NULL,
  `Special_ProdAttrVal` INT NULL,
  `Special_ProdPrices_id` INT NULL,
  `Special_Start_Date` DATE NOT NULL,
  `Special_End_Date` DATE NOT NULL,
  `Special_Comment` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Specials_Prod_id_idx` (`Special_Product_id` ASC),
  INDEX `fk_Specials_ProdAttrVal_id_idx` (`Special_ProdAttrVal` ASC),
  CONSTRAINT `fk_Specials_Prod_id`
    FOREIGN KEY (`Special_Product_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Specials_ProdAttrVal_id`
    FOREIGN KEY (`Special_ProdAttrVal`)
    REFERENCES `store3.3`.`AttributeValue` (`AttrVal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`Log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`Log` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`Log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Log_Shopper_id` INT NULL,
  `Log_Cmd_id` INT NULL,
  `Log_Cat_id` INT NULL DEFAULT NULL,
  `Log_Prod_id` INT NULL DEFAULT NULL,
  `Log_TimeStamp` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Shopper_id_idx` (`Log_Shopper_id` ASC),
  INDEX `fk_Log_Cmd_id_idx` (`Log_Cmd_id` ASC),
  INDEX `fk_Log_Cat_id_idx` (`Log_Cat_id` ASC),
  INDEX `fk_Log_Prod_id_idx` (`Log_Prod_id` ASC),
  CONSTRAINT `fk_Log_Shopper_id`
    FOREIGN KEY (`Log_Shopper_id`)
    REFERENCES `store3.3`.`Shopper` (`shopper_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Log_Cmd_id`
    FOREIGN KEY (`Log_Cmd_id`)
    REFERENCES `store3.3`.`Commands` (`Cmd_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Log_Cat_id`
    FOREIGN KEY (`Log_Cat_id`)
    REFERENCES `store3.3`.`Category` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Log_Prod_id`
    FOREIGN KEY (`Log_Prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `store3.3`.`ProdPrices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `store3.3`.`ProdPrices` ;

CREATE TABLE IF NOT EXISTS `store3.3`.`ProdPrices` (
  `PrPr_id` INT NOT NULL AUTO_INCREMENT,
  `PrPr_Prod_id` INT NOT NULL,
  `PrPr_ShopGrp` INT NOT NULL,
  `PrPr_Price` DECIMAL(10,2) NULL,
  INDEX `fk_ProdPrices_Product1_idx` (`PrPr_Prod_id` ASC),
  PRIMARY KEY (`PrPr_id`),
  INDEX `fk_Prod_ShGrp` (`PrPr_Prod_id` ASC, `PrPr_ShopGrp` ASC),
  CONSTRAINT `fk_ProdPrices_Product1`
    FOREIGN KEY (`PrPr_Prod_id`)
    REFERENCES `store3.3`.`Product` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

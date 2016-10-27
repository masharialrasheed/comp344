USE rbac;

/* Drop tables if exist */
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `ShopperGroup`;
DROP TABLE IF EXISTS `Shopper`;
DROP TABLE IF EXISTS `AccessGroup`;
DROP TABLE IF EXISTS `AccessUserGroup`;
DROP TABLE IF EXISTS `Commands`;
DROP TABLE IF EXISTS `AccessGroupCommands`;
DROP TABLE IF EXISTS `Log`;
DROP TABLE IF EXISTS `Session`;
SET FOREIGN_KEY_CHECKS=1;


/* Create tables */
CREATE TABLE `ShopperGroup` (
  ShopGrp_id          INT             NOT NULL AUTO_INCREMENT,
  ShopGrp_Name        VARCHAR(45),
  ShopGrp_Description VARCHAR(256),

  PRIMARY KEY (ShopGrp_id)
);

CREATE TABLE `Shopper` (
  shopper_id      INT             NOT NULL AUTO_INCREMENT,
  sh_username     VARCHAR(30),
  sh_password     CHAR(60),
  sh_email        VARCHAR(64),
  sh_phone        VARCHAR(45),
  sh_type         CHAR(1),
  sh_shopgrp      INT,
  sh_field1       VARCHAR(128),
  sh_field2       VARCHAR(128),

  PRIMARY KEY (shopper_id),

  FOREIGN KEY fk_shopgrp_sh(sh_shopgrp)
    REFERENCES ShopperGroup(shopgrp_id)
    ON DELETE CASCADE
);

CREATE TABLE `AccessGroup` (
  AG_id     INT             NOT NULL AUTO_INCREMENT,
  AG_name   VARCHAR(45),
  AG_desc   VARCHAR(255),

  PRIMARY KEY (ag_id)
);

CREATE TABLE `AccessUserGroup` (
  AUG_id          INT             NOT NULL AUTO_INCREMENT,
  AUG_Shopper_id  INT,
  AUG_AG_id       INT,

  PRIMARY KEY (AUG_id),

  FOREIGN KEY fk_sh_aug(AUG_Shopper_id)
    REFERENCES Shopper(shopper_id)
    ON DELETE CASCADE,

  FOREIGN KEY fk_ag_aug(AUG_AG_id)
    REFERENCES AccessGroup(AG_id)
    ON DELETE CASCADE
);

CREATE TABLE `Commands` (
  Cmd_id          INT             NOT NULL AUTO_INCREMENT,
  Cmd_name        VARCHAR(45),
  Cmd_URL         VARCHAR(255),

  PRIMARY KEY (Cmd_id)
);

CREATE TABLE `AccessGroupCommands` (
  AGC_id          INT             NOT NULL AUTO_INCREMENT,
  AGC_AG_id       INT,
  AGC_Cmd_id      INT,
  AGC_desc        VARCHAR(255),

  PRIMARY KEY (AGC_id),

  FOREIGN KEY fk_ag_agc(AGC_AG_id)
    REFERENCES AccessGroup(AG_id)
    ON DELETE CASCADE,

  FOREIGN KEY fk_cmd_agc(AGC_Cmd_id)
    REFERENCES Commands(Cmd_id)
    ON DELETE CASCADE
);

CREATE TABLE `Log` (
  id              INT             NOT NULL AUTO_INCREMENT,
  Log_Shopper_id  INT,
  Log_Cmd_id      INT,
  -- log_cat_id      INT,
  -- log_prod_id     INT,
  Log_TimeStamp   TIMESTAMP,

  PRIMARY KEY (id),

  FOREIGN KEY fk_sh_log(Log_Shopper_id)
      REFERENCES Shopper(shopper_id)
      ON DELETE CASCADE,

  FOREIGN KEY fk_cmd_log(Log_Cmd_id)
      REFERENCES Commands(Cmd_id)
      ON DELETE CASCADE

  -- FOREIGN KEY fk_cat_log(log_cat_id)
  --     REFERENCES Catalogue(cat_id)
  --     ON DELETE CASCADE,
  --
  -- FOREIGN KEY fk_prod_log(log_prod_id)
  --     REFERENCES Product(prod_id)
  --     ON DELETE CASCADE
);

CREATE TABLE `Session` (
    id          CHAR(32)        NOT NULL,
    Shopper_id  INT,
    data        MEDIUMBLOB,
    `time`      TIMESTAMP,

    PRIMARY KEY (id),

    FOREIGN KEY fk_sh_ssh(Shopper_id)
        REFERENCES Shopper(shopper_id)
        ON DELETE CASCADE
);

ALTER TABLE `AccessUserGroup` ADD UNIQUE `composite_index`(AUG_Shopper_id, AUG_AG_id);

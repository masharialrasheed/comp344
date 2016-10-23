/* Drop tables if exist */
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `Shopper`;
DROP TABLE IF EXISTS `AccessGroup`;
DROP TABLE IF EXISTS `AccessUserGroup`;
DROP TABLE IF EXISTS `Command`;
DROP TABLE IF EXISTS `AccessGroupCommand`;
DROP TABLE IF EXISTS `Log`;
DROP TABLE IF EXISTS `Session`;
SET FOREIGN_KEY_CHECKS=1;

/* Create tables */
CREATE TABLE `Shopper` (
    sh_id           INT             NOT NULL AUTO_INCREMENT,
    sh_username     VARCHAR(30),
    sh_password     CHAR(60),
    sh_email        VARCHAR(64),
    sh_phone        VARCHAR(45),
    sh_type         CHAR(1),
    -- sh_shopgrp      INT,
    -- sh_field1       VARCHAR(128),
    -- sh_field2       VARCHAR(128),

    PRIMARY KEY (sh_id)

    -- FOREIGN KEY fk_shopgrp_sh(sh_shopgrp)
    --     REFERENCES ShopperGroup(shopgrp_id)
    --     ON DELETE CASCADE
);

CREATE TABLE `AccessGroup` (
    ag_id           INT             NOT NULL AUTO_INCREMENT,
    ag_name         VARCHAR(45),
    ag_desc         VARCHAR(255),

    PRIMARY KEY (ag_id)
);

CREATE TABLE `AccessUserGroup` (
    aug_id          INT             NOT NULL AUTO_INCREMENT,
    aug_sh_id       INT,
    aug_ag_id       INT,

    PRIMARY KEY (aug_id),

    FOREIGN KEY fk_sh_aug(aug_sh_id)
        REFERENCES Shopper(sh_id)
        ON DELETE CASCADE,

    FOREIGN KEY fk_ag_aug(aug_ag_id)
        REFERENCES AccessGroup(ag_id)
        ON DELETE CASCADE
);

CREATE TABLE `Command` (
    cmd_id          INT             NOT NULL AUTO_INCREMENT,
    cmd_name        VARCHAR(45),
    cmd_url         VARCHAR(255),

    PRIMARY KEY (cmd_id)
);

CREATE TABLE `AccessGroupCommand` (
    agc_id          INT             NOT NULL AUTO_INCREMENT,
    agc_ag_id       INT,
    agc_cmd_id      INT,
    agc_desc        VARCHAR(255),

    PRIMARY KEY (agc_id),

    FOREIGN KEY fk_ag_agc(agc_ag_id)
        REFERENCES AccessGroup(ag_id)
        ON DELETE CASCADE,

    FOREIGN KEY fk_cmd_agc(agc_cmd_id)
        REFERENCES Command(cmd_id)
        ON DELETE CASCADE
);

CREATE TABLE `Log` (
    log_id          INT             NOT NULL AUTO_INCREMENT,
    log_sh_id       INT,
    log_cmd_id      INT,
    -- log_cat_id      INT,
    -- log_prod_id     INT,
    log_timestamp   TIMESTAMP,

    PRIMARY KEY (log_id),

    FOREIGN KEY fk_sh_log(log_sh_id)
        REFERENCES Shopper(sh_id)
        ON DELETE CASCADE,

    FOREIGN KEY fk_cmd_log(log_cmd_id)
        REFERENCES Command(cmd_id)
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
    ssh_id          CHAR(32)        NOT NULL,
    ssh_sh_id       INT,
    ssh_data        MEDIUMBLOB,
    ssh_time        TIMESTAMP,

    PRIMARY KEY (ssh_id),

    FOREIGN KEY fk_sh_ssh(ssh_sh_id)
        REFERENCES Shopper(sh_id)
        ON DELETE CASCADE
);

ALTER TABLE `AccessUserGroup` ADD UNIQUE `composite_index`(`aug_sh_id`, `aug_ag_id`);

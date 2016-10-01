/* Drop tables if exists */
DROP TABLE IF EXISTS Shopper;
DROP TABLE IF EXISTS AccessGroup;
DROP TABLE IF EXISTS AccessUserGroup;
DROP TABLE IF EXISTS Command;
DROP TABLE IF EXISTS AccessGroupCommand;
DROP TABLE IF EXISTS Log;
DROP TABLE IF EXISTS Session;

/* Create tables */
CREATE TABLE Shopper (
    sh_id           INT             AUTO_INCREMENT PRIMARY KEY,
    sh_username     VARCHAR(30),
    sh_password     CHAR(60),
    sh_email        VARCHAR(64),
    sh_phone        VARCHAR(45),
    sh_type         CHAR(1),
    sh_shopgrp      INT,
    sh_field1       VARCHAR(128),
    sh_field2       VARCHAR(128)
);
CREATE TABLE AccessGroup (
    ag_id           INT             AUTO_INCREMENT PRIMARY KEY,
    ag_name         VARCHAR(45),
    ag_desc         VARCHAR(255)
);
CREATE TABLE AccessUserGroup (
    aug_id          INT             AUTO_INCREMENT PRIMARY KEY,
    aug_sh_id       INT,
    aug_ag_id       INT
);
CREATE TABLE Command (
    cmd_id          INT             AUTO_INCREMENT PRIMARY KEY,
    cmd_name        VARCHAR(45),
    cmd_url         VARCHAR(255)
);
CREATE TABLE AccessGroupCommand (
    agc_id          INT             AUTO_INCREMENT PRIMARY KEY,
    agc_ag_id       INT,
    agc_cmd_id      INT,
    agc_desc        VARCHAR(255)
);
CREATE TABLE Log (
    log_id          INT             AUTO_INCREMENT PRIMARY KEY,
    log_sh_id       INT,
    log_cmd_id      INT,
    log_cat_id      INT,
    log_prod_id     INT,
    log_timestamp   TIMESTAMP
);
CREATE TABLE Session (
    ssh_id          CHAR(32)        PRIMARY KEY,
    ssh_sh_id       INT,
    ssh_data        MEDIUMBLOB,
    ssh_time        TIMESTAMP
)

/* Drop tables if exists */
DROP TABLE IF EXISTS shopper;
DROP TABLE IF EXISTS log;
DROP TABLE IF EXISTS commands;
DROP TABLE IF EXISTS accessgroupcommands;
DROP TABLE IF EXISTS accessgroup;
DROP TABLE IF EXISTS accessusergroup;


/* Create tables */
CREATE TABLE shopper (
    shopper_id      INT             AUTO_INCREMENT PRIMARY KEY,
    sh_username     VARCHAR(30),
    sh_password     CHAR(60),
    sh_email        VARCHAR(64),
    sh_phone        VARCHAR(45),
    sh_type         CHAR(1),
    sh_shopgrp      INT,
    sh_field1       VARCHAR(128),
    sh_field2       VARCHAR(128)
);
CREATE TABLE log (
    id              INT             AUTO_INCREMENT PRIMARY KEY,
    log_shopper_id  INT,
    log_cmd_id      INT,
    log_cat_id      INT,
    log_prod_id     INT,
    log_timestamp   TIMESTAMP
);
CREATE TABLE commands (
    cmd_id          INT             AUTO_INCREMENT PRIMARY KEY,
    cmd_name        VARCHAR(45),
    cmd_url         VARCHAR(255)
);
CREATE TABLE accessgroupcommands (
    agc_id          INT             AUTO_INCREMENT PRIMARY KEY,
    agc_ag_id       INT,
    agc_cmd_id      INT,
    agc_desc        VARCHAR(255)
);
CREATE TABLE accessgroup (
    ag_id           INT             AUTO_INCREMENT PRIMARY KEY,
    ag_name         VARCHAR(45),
    ag_desc         VARCHAR(255)
);
CREATE TABLE accessusergroup (
    aug_id          INT             AUTO_INCREMENT PRIMARY KEY,
    aug_shopper_id  INT,
    aug_ag_id       INT
);

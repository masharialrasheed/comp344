/* Drop tables if exists */
BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE shopper';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE log';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE commands';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE accessgroupcommands';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE accessgroup';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/
BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE accessusergroup';
EXCEPTION
   WHEN OTHERS THEN NULL;
END;
/



/* Create tables */
CREATE TABLE shopper (
    shopper_id INT,
    sh_username VARCHAR2(30),
    sh_password CHAR(60),
    sh_email VARCHAR2(64),
    sh_phone VARCHAR2(45),
    sh_type CHAR(1),
    sh_shopgrp INT,
    sh_field1 VARCHAR2(128),
    sh_field2 VARCHAR2(128),
    CONSTRAINT shopper_pk PRIMARY KEY (shopper_id)
);
CREATE TABLE log (
    id INT,
    log_shopper_id INT,
    log_cmd_id INT,
    log_cat_id INT,
    log_prod_id INT,
    log_timestamp TIMESTAMP,
    CONSTRAINT log_pk PRIMARY KEY (id)
);
CREATE TABLE commands (
    cmd_id INT,
    cmd_name VARCHAR2(45),
    cmd_url VARCHAR2(255),
    CONSTRAINT cmd_pk PRIMARY KEY (cmd_id)
);
CREATE TABLE accessgroupcommands (
    agc_id INT,
    agc_ag_id INT,
    agc_cmd_id INT,
    agc_desc VARCHAR2(255),
    CONSTRAINT agc_pk PRIMARY KEY (AGC_id)
);
CREATE TABLE accessgroup (
    ag_id INT,
    ag_name VARCHAR2(45),
    ag_desc VARCHAR2(255),
    CONSTRAINT ag_pk PRIMARY KEY (ag_id)
);
CREATE TABLE accessusergroup (
    aug_id INT,
    aug_shopper_id INT,
    aug_ag_id INT,
    CONSTRAINT aug_pk PRIMARY KEY (aug_id)
);


/* Shopper Data */
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
  -- , sh_type, sh_shopgrp, sh_field1, sh_field2)
VALUES (1, 'superadmin', 'superpassword', 'superadmin@example.com', '0491 570 110');

/* AccessGroup Data */
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (1, 'Super-Administrator', 'Allocates user roles');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (2, 'Catalogue Manager', 'Oversees product and category details');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (3, 'Customer Service Manager', 'Deals with orders and customer enquiries');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (4, 'Warehouse Staff', 'Fulfills orders and marks them as shipped');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (5, 'Manager', 'Uses analytics to maximize profit and business operations');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (6, 'Registered Shopper', 'Registered customer');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (7, 'Guest', 'User that is not signed in');

/* AccessUserGroup Data */
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (1, 1, 1);

/* Commands Data */
INSERT INTO Commands (cmd_id, cmd_name, cmd_url)
VALUES (1, 'superadmin', 'superadmin.php');
INSERT INTO Commands (cmd_id, cmd_name, cmd_url)
VALUES (2, 'setroles', 'setroles.php');

/* AccessGroupCommands Data */
INSERT INTO AccessGroupCommands (agc_id, agc_ag_id, agc_cmd_id, agc_desc)
VALUES (1, 1, 1, 'Access page to allocate user roles');
INSERT INTO AccessGroupCommands (agc_id, agc_ag_id, agc_cmd_id, agc_desc)
VALUES (2, 1, 2, 'Allocate user roles');

/* Log Data */
-- INSERT INTO Log (id, log_shopper_id, log_cmd_id, log_cat_id, log_prod_id, log_timestamp)
-- VALUES (1, );

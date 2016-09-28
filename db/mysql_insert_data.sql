/* Shopper Data */
-- Special AccessGroup Examples
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (1, 'superadmin', 'sapassword', 'superadmin@example.com', '0491 570 110');
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (2, 'cataloguemanager', 'cmpassword', 'cataloguemanager@example.com', '0491 570 110');
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (3, 'customerservicemanager', 'csmpassword', 'customerservicemanager@example.com', '0491 570 110');
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (4, 'warehousestaff', 'wspassword', '@example.com', '0491 570 110');
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (5, 'manager', 'mpassword', 'manager@example.com', '0491 570 110');
-- Registered Shoppers
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (NULL, 'rakimmayers', 'rakimpassword', 'rakimmayers@example.com', '0491 570 110');


/* AccessGroup Data */
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (1, 'Super Administrator', 'Allocates user roles');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (2, 'Catalogue Manager', 'Oversees product and category details');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (3, 'Customer Service Manager', 'Deals with orders and customer enquiries');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (4, 'Warehouse Staff', 'Fulfills orders and marks them as shipped');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (5, 'Manager', 'Uses analytics to maximize profit and business operations');
-- INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
-- VALUES (5, 'Registered Shopper', 'Registered customer');
-- INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
-- VALUES (6, 'Guest', 'User that is not signed in');


/* AccessUserGroup Data - should probably be called UserAccessGroup? */
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 1, 1);
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 2, 2);
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 3, 3);
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 4, 4);
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 5, 5);


/* Commands Data */
INSERT INTO Commands (cmd_id, cmd_name, cmd_url)
VALUES (1, 'superadmin', 'superadmin.php');
INSERT INTO Commands (cmd_id, cmd_name, cmd_url)
VALUES (2, 'roles', 'roles.php');


/* AccessGroupCommands Data */
INSERT INTO AccessGroupCommands (agc_id, agc_ag_id, agc_cmd_id, agc_desc)
VALUES (NULL, 1, 1, 'Access page to allocate user roles');
INSERT INTO AccessGroupCommands (agc_id, agc_ag_id, agc_cmd_id, agc_desc)
VALUES (NULL, 1, 2, 'Add/remove AccessGroups from User');


/* Log Data */
-- INSERT INTO Log (id, log_shopper_id, log_cmd_id, log_cat_id, log_prod_id, log_timestamp)
-- VALUES (1, );

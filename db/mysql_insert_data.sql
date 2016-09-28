/* Shopper Data */
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
  -- , sh_type, sh_shopgrp, sh_field1, sh_field2)
VALUES (NULL, 'superadmin', 'superpassword', 'superadmin@example.com', '0491 570 110');
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone)
VALUES (NULL, 'rakimmayers', 'rakimpassword', 'rakimmayers@example.com', '0491 570 110');

/* AccessGroup Data */
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (NULL, 'Super Administrator', 'Allocates user roles');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (NULL, 'Catalogue Manager', 'Oversees product and category details');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (NULL, 'Customer Service Manager', 'Deals with orders and customer enquiries');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (NULL, 'Warehouse Staff', 'Fulfills orders and marks them as shipped');
INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
VALUES (NULL, 'Manager', 'Uses analytics to maximize profit and business operations');
-- INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
-- VALUES (5, 'Registered Shopper', 'Registered customer');
-- INSERT INTO AccessGroup (ag_id, ag_name, ag_desc)
-- VALUES (6, 'Guest', 'User that is not signed in');

/* AccessUserGroup Data */
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 1, 1);
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 2, 2);
INSERT INTO AccessUserGroup (aug_id, aug_shopper_id, aug_ag_id)
VALUES (NULL, 2, 3);

/* Commands Data */
INSERT INTO Commands (cmd_id, cmd_name, cmd_url)
VALUES (NULL, 'superadmin', 'superadmin.php');
INSERT INTO Commands (cmd_id, cmd_name, cmd_url)
VALUES (NULL, 'setroles', 'setroles.php');

/* AccessGroupCommands Data */
INSERT INTO AccessGroupCommands (agc_id, agc_ag_id, agc_cmd_id, agc_desc)
VALUES (NULL, 1, 1, 'Access page to allocate user roles');
INSERT INTO AccessGroupCommands (agc_id, agc_ag_id, agc_cmd_id, agc_desc)
VALUES (NULL, 1, 2, 'Allocate user roles');

/* Log Data */
-- INSERT INTO Log (id, log_shopper_id, log_cmd_id, log_cat_id, log_prod_id, log_timestamp)
-- VALUES (1, );

/* Shopper Data */
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone) VALUES
-- Special AccessGroup Examples
  (1,  'superadmin',  'sapassword',   'superadmin@example.com',              '0491 570 110'),
  (2,  'cmuser',      'cmpassword',   'cataloguemanager@example.com',        '0491 570 110'),
  (3,  'csmuser',     'csmpassword',  'customerservicemanager@example.com',  '0491 570 110'),
  (4,  'wsuser',      'wspassword',   'warehousestaff@example.com',          '0491 570 110'),
  (5,  'muser',       'mpassword',    'manager@example.com',                 '0491 570 110'),
-- Registered Shoppers
  (6,  'rakim',       'rpassword',    'rakimmayers@example.com',             '0491 570 110');


/* AccessGroup Data */
INSERT INTO AccessGroup (AG_id, AG_name, AG_desc) VALUES
  (1,  'Super Administrator',       'Allocates user roles'),
  (2,  'Catalogue Manager',         'Oversees product and category details'),
  (3,  'Customer Service Manager',  'Deals with orders and customer enquiries'),
  (4,  'Warehouse Staff',           'Fulfills orders and marks them as shipped'),
  (5,  'Manager',                   'Uses analytics to maximize profit and business operations');


/* AccessUserGroup Data */
INSERT INTO AccessUserGroup (AUG_Shopper_id, AUG_AG_id) VALUES
  (1, 1),
  (1, 2),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5);


/* Command Data */
INSERT INTO Commands (Cmd_id, Cmd_name, Cmd_URL) VALUES
  (1,  'superadmin',  'superadmin.php'),
  (2,  'roles',       'roles.php');


/* AccessGroupCommand Data */
INSERT INTO AccessGroupCommands (AGC_AG_id, AGC_Cmd_id, AGC_desc) VALUES
  (1, 1, 'Access page to allocate user roles'),
  (1, 2, 'Add/remove AccessGroups from User');

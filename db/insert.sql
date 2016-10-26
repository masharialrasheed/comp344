/* Shopper Data */
INSERT INTO Shopper (shopper_id, sh_username, sh_password, sh_email, sh_phone) VALUES
-- Special AccessGroup Examples
-- sapassword, cmpassword, csmpassword, wspassword, mpassword, rpassword
  (1,  'superadmin',  '$2y$10$1SiwD7lF7tSbP2QE4tRNKerND8ae.iN3Ls1rvczDn8jLllDtLP7V6',   'superadmin@example.com',              '0491 570 110'),
  (2,  'cmuser',      '$2y$10$nbnsY1JBA4PhGKmFzthTUOnySMwhUUnWp5nwPiutARFHzJHosT8K.',   'cataloguemanager@example.com',        '0491 570 110'),
  (3,  'csmuser',     '$2y$10$spic.9dApCvldTYZpkoVz.yU8VOnTmIdyDmwFl.H3q6YpGbFnXiHG',  'customerservicemanager@example.com',  '0491 570 110'),
  (4,  'wsuser',      '$2y$10$KW.B9EZ7ImGdheYJeu37NOFnym2HVa.xZ87.ToOP24Ghp.ZuWqPgq',   'warehousestaff@example.com',          '0491 570 110'),
  (5,  'muser',       '$2y$10$DED.AJ/7lmSvEBzRY5b/T.jyPNTccNlLdLBZjPJ.AAygEW5z7m0Nu',    'manager@example.com',                 '0491 570 110'),
-- Registered Shoppers
  (6,  'rakim',       '$2y$10$rsJxrvZN8iV13a4uhL1squ2qGZtOZEHrw1BMv.JvXIaM0mP1jwUL.',    'rakimmayers@example.com',             '0491 570 110');


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
  (1,  'Administrate Users',         'AdminUsers.php'),
  (2,  'Administrate AccessGroups',  'AdminAccessGroups.php'),
  (3,  'Administrate Commands',      'AdminCommands.php'),
  (4,  'Add Category', 'AddCategory.php'),
  (5,  'Add Product',  'AddProduct.php'),
  (6,  'Display Picklist', 'DisplayPickList.php');


/* AccessGroupCommand Data */
INSERT INTO AccessGroupCommands (AGC_AG_id, AGC_Cmd_id, AGC_desc) VALUES
  (1, 1, 'Access page to allocate user\'s AccessGroups'),
  (1, 2, 'Access page to create/delete AccessGroups'),
  (1, 3, 'Access page to create/delete Commands'),
  (2, 4, 'Add a category to the store'),
  (2, 5, 'Add a product to the store'),
  (4, 6, 'Display the picklist');

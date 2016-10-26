# RBAC


<hr>
### Setup
1. Setup PHP & MySQL environment
2. Create php/databaseConfig.php with your MySQL credentials as follows
```
<?php
return array(
  'user' => '',
  'pass' => '',
  'name' => '',
  'host' => ''
);
?>
```
3. Run db/create.sql then db/insert.sql
   (add a `USE dbname;` at the start of each if not running through a tool such as phpmyadmin)
4. Run local server and open public/ in your web browser


<hr>
### To Do
- Add/remove Users/Shoppers from AccessGroups
- Functionality: Command table with add/remove
- Functionality: AccessGroup table with add/remove
- Figure out commands and integration


<hr>
### Done
- Auth/RBAC


<hr>
### Known Bugs
- None (uh oh)


<hr>
### UML

![](docs/rbac_usecase.png)

![](docs/rbac_activity.png)


<hr>
### Database Schema (v.3.3)
<br>
![Re-aligned v3.3 schema](http://i.imgur.com/Njxyfwd.png)


<hr>
### Commands
| Role Name  | Command | URL |
| ---------- | ------- | --- |
| Guest | Display Category | DisplayCategory.php |
|       | Display Products | DisplayProducts.php |
|       | Display Product | DisplayProduct.php |
| Registered Shopper  | Pay? | Pay? |
| Super Administrator | Administrate Users        | AdminUsers.php        |
|                     | Administrate AccessGroups | AdminAccessGroups.php |
|                     | Administrate Commands     | AdminCommands.php     |
| Catalogue Manager | Add Category | AddCategory.php |
|                   | Add Product  | AddProduct.php  |
| Warehouse Staff | Display Pick List | DisplayPickList.php |
| Customer Service Manager | |  |
| Manager | |  |

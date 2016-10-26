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
| Role Name                | Command | URL                 |
| ------------------------ | ------- | ------------------- |
| Guest                    |         |                .php |
| Registered Shopper       |         |                .php |
| Super Administrator      |         |                .php |
| Catalogue Manager        |         |                .php |
| Customer Service Manager |         |                .php |
| Manager                  |         |                .php |

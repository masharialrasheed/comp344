# RBAC


<hr>
### Design
- Everyone has Guest permissions
- Anyone logged in has Registered Shopper permissions
- The superadmin page assumes that there will not be many
  Super Administrators working concurrently and they will work with care.
  Thus caching is appropriate.


<hr>
### To Do
- Functionality: Command table with add/remove
- Functionality: AccessGroup table with add/remove
- Functionality: Auth and auth API
- ORACLE support
- Figure out commands and integration


<hr>
### Done
- Add/remove Users/Shoppers from AccessGroups


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

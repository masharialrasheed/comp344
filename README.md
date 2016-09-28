# RBAC

### Commands
| Role Name                | Command | URL                 |
| ------------------------ | ------- | ------------------- |
| Guest                    |         |                .php |
| Registered Shopper       |         |                .php |
| Super Administrator      |         |                .php |
| Catalogue Manager        |         |                .php |
| Customer Service Manager |         |                .php |
| Manager                  |         |                .php |


<hr>
### Design
- Everyone has Guest permissions
- Anyone logged in has Registered Shopper permissions


<hr>
### To Do
- Functionality: Command table
- Functionality: AccessGroup table
- Functionality: Add/remove accessgroups from system
- Redesign table (should there be multivalued col? popup buttons? more data? no changes?)
- rename php/ to api/ ?


<hr>
### Known Bugs
- When trying to remove all roles at once, nothing happens


<hr>
### Database Schema (v.3.3)
<br>
![Re-aligned v3.3 schema](http://i.imgur.com/Njxyfwd.png)


<hr>

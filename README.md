# Database-Project
Semester Long Database Group Project for Uma Ramamurthy COSC3380

## Installation instructions:
This project is currently being run on https://projectmanagementcosc3380team6.azurewebsites.net/, however if you would like to start up a local server on your computer, you will need to use XAMPP (Link to download: https://www.apachefriends.org/download.html). After installing xampp you will need to navigate to the xampp folder that will have been created. You will then need to locate the htdocs folder and copy the repo for this project directly into the folder. you will then need to install the mssql drivers required to run the application (Installing intructions: https://learn.microsoft.com/en-us/iis/application-frameworks/install-and-configure-php-on-iis/install-the-sql-server-driver-for-php), Once that is done run xampp and click start for apache. You can then navigate to localhost/database-project on a browser and be able to access the website locally.


## How to use:
You may create an account by signing up, or simply use one the sample logins.

When logged in, navigate through the website by clicking the links in the navigation bar. Visibility will vary depending on the role that is logged in.
The following instructions will assume a manager is logged in for learning purposes.


### Manage Page:
View all the employee accounts in your team. You can add an employee to your team by simply selecting in the dropdown and view their information by 
clicking view profile. You can also view tasks given to this employee and assign new ones by clicking assign tasks and filling in the info.


### Logs Page:
View important updates for projects with the time and date. You have the option to delete them.


### Projects Page:
View all the projects that are currently active. You can quickly isolate one by searching through ID. While any manager can add a project,
you can only update and delete projects you manage by selecting with the dropbox.


### Reports Page:
Select a type of report you would like to see. Dates are always required, but there are optional parameters, such as specifying department ID or
filtering by budget amount. Reports always query by joining multiple tables.


### Messages Page:
Displays important notifications with a date such as changes in salary


### Profile Page:
View and edit information about yourself


NOTE:
The admin can view an admin page that can view, add, update, and delete departments. They can also have more freedom, such as viewing all employees in
the manage page.

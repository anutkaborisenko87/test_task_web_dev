## About this project
The project is a page that displays a table of users (if they are in the database), a button for creating a new user. By clicking on it, a modal window pops up with a form to fill out, the form is validated for filling in all fields. To select a position in the form, there is a select, the data for which is taken from the positions table.
If there are users in the table, user data and buttons for calling modal windows for editing and deleting users will be displayed.
All changes made are fixed in the database by ajax request without reloading the page.


## Instructions for checking this project:

To check the functionality of the project, you need to clone the project:

```
git clone https://github.com/anutkaborisenko87/test_task_web_dev

```

enter the console command while in the root folder of the project

```
composer install 
```

- this command initializes autoload of classes and include of additional files that ensure the workability
  of the project
- create a database for the project
- export the script [create_tables_database.sql](https://github.com/anutkaborisenko87/test_task_web_dev/blob/main/create_tables_database.sql) to
  the created database (it will create the main project table)
- To set up a connection to the database, you need to enter the appropriate settings in the
  file [app/helpers/helpers.php](https://github.com/anutkaborisenko87/test_task_web_dev/blob/main/app/helpers/helpers.php)
  in
  method [config](https://github.com/anutkaborisenko87/test_task_web_dev/blob/main/app/helpers/helpers.php#L47)
  in array $config
- to check the display of the query result from part 2 of the test task, export to your database [example.sql](https://github.com/anutkaborisenko87/test_task_web_dev/blob/main/example.sql)
### My github profile

Here you can see examples of my other work. Even though these are just test tasks, they can be used to understand my
approach to completing tasks.

- [Anna Borisenko](https://github.com/anutkaborisenko87/)

### Contacts

- **Linkedin: [Anna Borisenko](https://www.linkedin.com/in/anna-borisenko-695837213/)**
- **Telegram: [Anna Borisenko](https://t.me/AnutkaBorisenko)**
- **email: [anutkaborisenko87@gmail.com](anutkaborisenko87@gmail.com)**
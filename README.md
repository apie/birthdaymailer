# birthdaymailer
Send e-mails on birthdays.
Frontend in php. Mailer in python.
Multi part messages are supported (and enabled).

## Setup
1. Create a file `birthday_settings.py` in the folder `mailer` and specify the following settings:
```
c_config_id = <id of the config you would like to use>
birthday_db=<db filename>
real_from_address=<email address of this host, could be useful if you are not permitted to send as just any email address>
```
2. Create a folder `files` in `mailer` and put the picture you would like to add to the email in here.
3. Create the database and the tables: `$ sqlite3 birthday.db < schema.sql`
4. Set the config and the users using the web configuration or by hand using `sqlite3 birthday.db` and then typing some queries 😀 or using https://sqlitebrowser.org/
5. Put the mailer (`mailer/birthdaymailer.py`) in a cronjob and run it every day.

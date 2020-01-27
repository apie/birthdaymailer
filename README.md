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
2. Create a folder `files` in `mailer` and put the picture you would like to add to the email in here. Make sure to specify it in the config. 
3. Put the mailer in a cronjob and run it every day.

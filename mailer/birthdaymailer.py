#!/usr/bin/env python3
# Check in database whose birthday it currently is.
# Send those people a customized message.
# By D.J. Murray (apie), 2016-10-27

import birthday_data
import birthday_mail
import datetime
from birthday_settings import c_config_id

if __name__ == '__main__':
  configuration = birthday_data.birthday_getconfiguration(c_config_id)
  birthdays = birthday_data.birthday_getbirthdays(configuration['config_id'])
  if len(birthdays) > 0:
    print('Birthday today:')
  # Print users which have their birthday today. then email them.
  for user in birthdays:
    print(" %s <%s>" % (user['name'], user['email']))
    if user['email']=='':
      raise ValueError('No email set for user %s' % (user['name']))

  if len(birthdays) > 0:
    print('Sending the e-mails:')
  for user in birthdays:
      print(' Sending to %s' % (user['name']))
      birthday_mail.mail_birthday(configuration, user)


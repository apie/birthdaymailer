#!/usr/bin/env python2
# By D.J. Murray (apie), 2016-10-27
try:
  from MySQLdb import connect as mysql_connect
except ImportError:
  from mysql.connector import connect as mysql_connect

import datetime
import birthday_settings

def connect_birthday():
    db = mysql_connect(host   = birthday_settings.birthday_host,
                       user   = birthday_settings.birthday_user,
                       passwd = birthday_settings.birthday_passwd,
                       db     = birthday_settings.birthday_db)
    return db

def birthday_getconfiguration(config_id):
    db = connect_birthday()
    # you must create a Cursor object. It will let
    #  you execute all the queries you need
    cur = db.cursor()

    # Use all the SQL you like
    query="SELECT config_id, config_name, from_name, from_address, bcc_address, topic, line1, age_line, noage_line, picture_file "\
    "FROM config "\
    "WHERE config_id='%d'" % (config_id)
    cur.execute(query)

    configuration = {}
    for config_id, config_name, from_name, from_address, bcc_address, topic, line1, age_line, noage_line, picture_file in cur.fetchall():
        configuration['config_id']    = config_id
        configuration['config_name']  = config_name
        configuration['from_name']    = from_name
        configuration['from_address'] = from_address
        configuration['bcc_address']  = bcc_address
        configuration['topic']        = topic
        configuration['line1']        = line1
        configuration['age_line']     = age_line
        configuration['noage_line']   = noage_line
        configuration['picture_file'] = picture_file

    cur.close()
    db.close()

    return configuration

def birthday_getbirthdays(config_id):
    today = datetime.date.isoformat(datetime.date.today())

    db = connect_birthday()
    # you must create a Cursor object. It will let
    #  you execute all the queries you need
    cur = db.cursor()

    # Use all the SQL you like
    query="SELECT name, email, birthday, CURDATE() as curdate "\
    "FROM users "\
    "WHERE config_id = '%d' "\
    "AND EXTRACT(MONTH FROM birthday)=EXTRACT(MONTH FROM CURDATE()) AND EXTRACT(DAY FROM birthday)=EXTRACT(DAY FROM CURDATE())" % (config_id)
    cur.execute(query)

    birthdays = []
    for name,email,birthday,curdate in cur.fetchall():
        age = ((curdate.year-birthday.year))
        user = {}
        user['name']     = name
        user['email']    = email
        user['birthday'] = birthday
        user['age']      = age

        birthdays.append(user)

    cur.close()
    db.close()

    return birthdays


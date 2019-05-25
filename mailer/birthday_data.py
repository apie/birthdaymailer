#!/usr/bin/env python3
# By D.J. Murray (apie), 2016-10-27
import sqlite3 as lite

import os
import datetime
import birthday_settings

SCRIPT_DIR = os.path.dirname(os.path.realpath(__file__))


def connect_birthday():
    return lite.connect(os.path.join(SCRIPT_DIR, birthday_settings.birthday_db))

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
    db = connect_birthday()
    cur = db.cursor()

    # Use all the SQL you like
    query="SELECT name, email, birthday, DATE('now') as curdate "\
    "FROM users "\
    "WHERE config_id = '{}' "\
    "AND strftime('%m', birthday)=strftime('%m', curdate) AND strftime('%d', birthday)=strftime('%d', curdate)".format(config_id)
    cur.execute(query)

    birthdays = []
    for name, email, birthday_str, curdate_str in cur.fetchall():
        birthday = datetime.datetime.strptime(birthday_str, '%Y-%m-%d')
        curdate = datetime.datetime.strptime(curdate_str, '%Y-%m-%d')
        age = (curdate.year-birthday.year)
        user = {}
        user['name']     = name
        user['email']    = email
        user['birthday'] = birthday
        user['age']      = age

        birthdays.append(user)

    cur.close()
    db.close()

    return birthdays


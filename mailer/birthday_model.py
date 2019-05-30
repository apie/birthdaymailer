import os
import sys
import sqlite3
import datetime

import birthday_settings

SCRIPT_DIR = os.path.dirname(os.path.realpath(__file__))
DB_PATH = os.path.join(SCRIPT_DIR, birthday_settings.birthday_db)

class ContactModel(object):
    def __init__(self):
        self._db = sqlite3.connect(DB_PATH, detect_types=sqlite3.PARSE_DECLTYPES)
        self._db.row_factory = sqlite3.Row

        self._db.cursor().execute('''
            CREATE TABLE IF NOT EXISTS config (
                config_id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                config_name	varchar(80) NOT NULL,
                from_name	varchar(80) NOT NULL,
                from_address	varchar(80) NOT NULL,
                bcc_address	varchar(80) NOT NULL,
                topic   	varchar(80) NOT NULL,
                line1   	varchar(80) NOT NULL,
                age_line	varchar(80) NOT NULL,
                noage_line	varchar(80) NOT NULL,
                picture_file	varchar(80) NOT NULL
            );
            ''')
        self._db.cursor().execute('''
            CREATE TABLE IF NOT EXISTS users (
                user_id	    integer NOT NULL PRIMARY KEY AUTOINCREMENT,
                config_id   integer NOT NULL,
                name	    varchar(20) NOT NULL,
                email	    varchar(40) NOT NULL,
                birthday    date NOT NULL,
                FOREIGN KEY (config_id) REFERENCES config(config_id)
            );
        ''')
        self._db.commit()

        # Current contact when editing.
        self.current_id = None

    def add(self, contact):
        self._db.cursor().execute('''
            INSERT INTO users(config_id, name, email, birthday)
            VALUES(:config_id, :name, :email, :birthday)''',
            contact)
        self._db.commit()

    def get_summary(self):
        return self._db.cursor().execute(
            "SELECT name, user_id from users").fetchall()

    def get_contact(self, contact_id):
        r = self._db.cursor().execute(
            "SELECT * from users WHERE user_id=:id", {"id": contact_id}).fetchone()
        return r

    def get_current_contact(self):
        if self.current_id is None:
            return {"config_id": 1, "name": "", "email": "", "birthday": datetime.date(year=1900, month=1, day=1)}
        return self.get_contact(self.current_id)

    def update_current_contact(self, details):
        if self.current_id is None:
            self.add(details)
        else:
            self._db.cursor().execute('''
                UPDATE users SET
                name=:name, email=:email, birthday=:birthday WHERE user_id=:user_id''',
                details)
            self._db.commit()

    def delete_contact(self, contact_id):
        self._db.cursor().execute('''
            DELETE FROM users WHERE user_id=:id''', {"id": contact_id})
        self._db.commit()

if __name__ == '__main__':
    c = ContactModel()
    for x in c.get_summary():
        print(x['name'])


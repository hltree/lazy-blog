# Reading readme.md

import os

host =  # {your_host}
password =  # {your_password}
user =  # {your_user}


class Setup_Config:
    DEBUG = True

    SQLALCHEMY_DATABASE_URI = 'mysql+pymysql://{user}:{password}@{host}/site_db?charset=utf8'.format(
        **{
            'user': os.getenv('DB_USER', user),
            'password': os.getenv('DB_PASSWORD', password),
            'host': os.getenv('DB_HOST', host)
        }
    )
    SQLALCHEMY_TRACK_MODIFICATIONS = False
    SQLALCHEMY_ECHO = False

Config = Setup_Config

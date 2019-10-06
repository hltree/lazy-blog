import os
key = os.urandom(24)

SQLALCHEMY_DATABASE_URI = 'sqlite:///fr.db'
SECRET_KEY = key
from flask import Flask
from flask.ext.sqlAlchemy import SQLAlchemy

app = flask(__name__)
app.config.from_object('src.config')

db = SQLAlchemy(app)

import src.views
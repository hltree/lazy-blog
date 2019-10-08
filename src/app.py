from flask import Flask

from src.db import init_db

def createApp():
    app = Flask(__name__)
    app.config.from_object('src.config.Config')

    init_db(app)

    return app

app = createApp()
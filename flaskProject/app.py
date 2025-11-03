import os
import sqlite3
from flask import Flask, g, render_template

app = Flask(__name__)

app . config . from_object ( __name__ )
- + x
# load config from this file app . py
# Load default config and override config from an environment variable
app . config . from_mapping (
DATABASE = os . path . join ( app . root_path , ' flaskr . db ') ,
SECRET_KEY = ' development key ' ,
USERNAME = ' admin ' ,
PASSWORD = ' default '
)
app . config . from_envvar ( ' FLASKR_SETTINGS ' , silent = True )




@app.route('/')
def register():
     return render_template('register.html')

# @app.route('/bonjour/<string:name>')
# def bonjour(name: str):
#      return render_template('bonjour.html', name=name)


if __name__ == "__main__":
     app.run(debug=True)
     
     
     
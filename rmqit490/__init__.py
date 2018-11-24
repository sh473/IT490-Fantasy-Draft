from flask import Flask #Import Flask info...
from flask import render_template #send captured data to HTML
from flask import request
from flask import redirect
from flask import url_for

from nba_api_constants import TEAM_NAME_TO_ID
from nba_api_constants import TEAM_ID_TO_NAME
from nba_api_constants import TEAM_ID_DATA
from nba_api_constants import CITY_TO_TEAM

# NBA Api libraries
import nba_py
from nba_py.constants import CURRENT_SEASON
from nba_py.constants import TEAMS
from nba_py import constants
from nba_py import game
from nba_py import player
from nba_py import team
from nba_py import league
from nba_py import draftcombine

import collections
import datetime
import dateutil.parser
import pytz
import requests
import time

#Api Client
#from apiclient.discovery import build
#from apiclient.errors import HttpError
#from oauth2client.tools import argparser

from bs4 import BeautifulSoup

#from datetime import datetime #get times of games

app = Flask(__name__) #use the Flask server
#Time zone that determines when the next day occurs
eastern = pytz.timezone("US/Eastern")

@app.route("/")
def index():
    #Renders today's games on the front page

    datetime_today = datetime.datetime.now(eastern)
    datestring_today = datetime_today.strftime("%b %d, %Y")
    games = get_games(datetime_today)

    return render_template("index.html",
                            title="Daily scores",
                            games=games,
                            datestring_today=datestring_today) #sending title to the html file
@app.route('/standings')
def standings():
    """Default standings page.
    """
    scoreboard = nba_py.Scoreboard()
    east_standings = scoreboard.east_conf_standings_by_day()
    west_standings = scoreboard.west_conf_standings_by_day()

    return render_template("standings.html",
                           title="standings",
                           east_standings=enumerate(east_standings, 1),
                           west_standings=enumerate(west_standings, 1),
                           team=CITY_TO_TEAM)
def get_games(date):
    ##Get list of games for the day
    ##Arg: datetime object of the day that we want games
    #Returns: An array of dictionaries of the games that were played today
    scoreboard = nba_py.Scoreboard(month=date.month,
                                    day=date.day,
                                    year=date.year)
    line_score = scoreboard.line_score()
    game_header = scoreboard.game_header()

    #List of games
    games = []
    #Dictionary of current game we're looking at
    current_game = {}

    current_game_sequence = 0
    game_sequence_counter = 0

    for team in line_score:
        if (team["GAME_SEQUENCE"] != current_game_sequence):
            current_game["TEAM_1_ABBREVIATION"] = team["TEAM_ABBREVIATION"]
            current_game["TEAM_1_WINS_LOSSES"] = team["TEAM_WINS_LOSSES"]

            current_game["TEAM_1_PTS"] = team["PTS"]
            current_game["TEAM_1_ID"] = team["TEAM_ID"]

            current_game_sequence = team["GAME_SEQUENCE"]
            game_sequence_counter += 1
        elif (game_sequence_counter == 1):
            current_game["TEAM_2_ABBREVIATION"] = team["TEAM_ABBREVIATION"]
            current_game["TEAM_2_WINS_LOSSES"] = team["TEAM_WINS_LOSSES"]

            current_game["TEAM_2_PTS"] = team["PTS"]
            current_game["TEAM_2_ID"] = team["TEAM_ID"]

            current_game["GAME_ID"] = team["GAME_ID"]

            games.append(current_game)

            current_game = {}
            game_sequence_counter = 0

    return games
if (__name__=="__main__"):
    app.run(host="0.0.0.0", port=8080, threaded=True, debug=True)
    #use Flask
    #at localhost port 80 in debugging

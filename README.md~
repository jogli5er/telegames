## API Clients-Server

### GET game/join

Response:

    {
        "teams": [
            { "id": 0, "name": "red" },
            { "id": 1, "name": "blue" },
        ],
        "currentMoveTTL": INTEGER
    }

### POST game/join

Data (id of selected Team):

    1

Response:

    {
        "sessionId": "irgendetwas",
        "startingTeamId": "givesUsBackTheStartingTeam",
        "currentMoveTTL": INTEGER
    }

### GET game/move

Response:

    {
        "moves": [
            { "id": 0, "name": "Column 1" },
            { "id": 1, "name": "Column 2" },
            { "id": 2, "name": "Column 3" },
        ],
        "currentMoveTTL": 23,
        "currentTeamId":"givesUsBackTheCurrentPlayingTeam",
        "isFinished" : false
    }


### POST game/move/user/{user_id}

Data (id of selected move):

    2

Response:

    {
        "moves": [
            { "id": 0, "name": "Column 1" },
            { "id": 1, "name": "Column 2" },
            { "id": 2, "name": "Column 3" },
        ],
        "currentMoveTTL": 21
    }

## Teletext-API

### Spielbrett-Vorschlag

    ======================================
              T E L E G A M E
    ======================================
          It's o's move (not x's)

          1   2   3   4   5   6   7
        +---+---+---+---+---+---+---+
        I   I x I   I   I   I   I   I
        +---+---+---+---+---+---+---+
        I o I o I   I   I   I   I   I
        +---+---+---+---+---+---+---+
        I o I o I   I   I   I   I   I
        +---+---+---+---+---+---+---+
        I x I x I x I   I   I   I   I
        +---+---+---+---+---+---+---+
        I o I x I o I   I   I x I   I
        +---+---+---+---+---+---+---+
        I o I x I o I x I o I o I x I
        +---+---+---+---+---+---+---+
        I o I o I o I x I o I o I o I
        +---+---+---+---+---+---+---+


### Zeichen, die von der Teletext-API akteptiert werden:
!?=_-/+§°"#*'><;.I

### Zeichen, die von der Teletext-API nicht akteptiert werden:

    \ => /
    | => /
    @ => §
    ¬ => -
    ~ => -
    [ => <
    ] => >
    { => <
    } => >
    « => "
    » => "

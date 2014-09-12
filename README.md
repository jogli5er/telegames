## API Clients-Server

### GET game/join

Response:

    {
        "teams": [
            { "id": 0, "name": "red" },
            { "id": 1, "name": "blue" },
        ]
    }

### POST game/join

Data (id of selected Team):

    1

Response:

    {
        "sessionId": "irgendetwas"
    }

### GET game/move

Response:

    {
        "moves": [
            { "id": 0, "name": "Column 1" },
            { "id": 1, "name": "Column 2" },
            { "id": 2, "name": "Column 3" },
        ],
        "currentMoveTTL": 23
    }


### POST game/move

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

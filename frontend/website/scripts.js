(function(w, $) {

    var state = 'join';
    var container = w.document.getElementById('mainContainer');

    var changeState = function() {

        if (state === 'join') {

            // TODO: GET game/join
            var data = {
                "teams": [
                    { "id": 0, "name": "red" },
                    { "id": 1, "name": "blue" },
                ]
            };

            var html = '<div class="teamSelection">';
            html += '<h2>Choose your team</h2>';
            var t;
            for (var i = 0, len = data.teams.length; i < len; i++) {
                t = data.teams[i];
                html += '<button type="button" class="btn btn-primary" data-value="' + t.id + '">' + t.name + '</button>' + "\n";
            }
            html += '</div>';

            container.innerHTML = html;



        }

        if (state === 'move') {
            var data = {
                "moves": [
                    { "id": 0, "name": "Column 1" },
                    { "id": 1, "name": "Column 2" },
                    { "id": 2, "name": "Column 3" },
                    { "id": 3, "name": "Column 4" },
                    { "id": 4, "name": "Column 5" },
                    { "id": 5, "name": "Column 6" },
                    { "id": 6, "name": "Column 7" },
                    { "id": 7, "name": "Column 8" }
                ],
                "currentMoveTTL": 23
            }

            var html = '<div class="moveSelection">';
            html += '<h2>Choose your move</h2>';
            var m;
            for (var i = 0, len = data.moves.length; i < len; i++) {
                m = data.moves[i];
                html += '<button type="button" class="btn btn-primary" data-value="' + m.id + '">' + m.name + '</button>' + "\n";
            }
            html += '</div>';

            container.innerHTML = html;
        }
    }



    $(document).on('click', '.teamSelection button', function() {
        var selectedTeam = $(this).attr('data-value');

        // TODO: POST game/join

        state = 'move';
        changeState();

    });


    $(document).on('click', '.moveSelection button', function() {
        var selectedMove = $(this).attr('data-value');

        // TODO: POST game/move

        alert('Oh, ein überragender Zug!');
    });


    changeState();

}(window, jQuery));

(function(w, $) {
    var BASE_URL = 'http://10.201.3.43/sites/telegames/backend/web/app_dev.php';
    var URL_GAME_JOIN = '/game/join';
    var URL_GAME_MOVE = '/game/move';
    var appState = {
        sessionId: 'somewrongid',
        currentView: 'join', //there is another view for not 
        nextView: 'join',
        selectedTeamId: 0,
        userId: 0,
        time:{
            serverCurrentTime: 'unixtimestring', //Unix timestamp
            clientCurrentTime: 'unixtimestring', //Unix timestamp
            remainingTime: 60, //Seconds
            timeoutId: null
        }
    };
    var container = w.document.getElementById('mainContainer');

    var changeState = function(data) {

        if (appState.nextView === 'join') {

            appState.currentView = 'join';
            // TODO: GET game/join

            var html = '<div class="teamSelection">';
            html += '<h2>Choose your team</h2>';
            html += '<div class="teamSelectionBtnGroup">';
            html += '<div class="btn-group" id="teamSelectionButtons">';
            var t;
            for (var i = 0, len = data.teams.length; i < len; i++) {
                t = data.teams[i];
                html += '<button type="button" class="btn btn-primary" data-value="' + t.id + '">' + t.name + '</button>' + "\n";
            }
            html += '</div>';
            html += '</div>';
            html += '</div>';

            container.innerHTML = html;



        }

        else if (appState.nextView === 'move') {
            appState.currentView  = 'move';
            var html = '<div class="moveSelection">';
            html += '<h2>Choose your move</h2>';
            html += '<div class="roundStartsIn">';
            html += 'Next turn starts in: <span class="timer"></span></div>';
            html += 'Total Users: ';
            var m;
            for (var i = 0, len = data.moves.length; i < len; i++) {
                html += '<div class="moveSelectionBtnGroup">'
                m = data.moves[i];
                html += '<button type="button" class="btn btn-primary" data-value="' + m.id + '">' + m.name + '</button>' + "\n";
                html += '<div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="'+getPercentages();+'" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            '+getPercentages+'
                          </div>
                        </div>';
                html += '</div>';
            }
            html += '</div>';

            container.innerHTML = html;
        }
        else if (appState.nextView === 'waiting'){
            appState.currentView = 'waiting';
            var html = '<div class="waiting">';
            html += '<h4>Wait until the other team finished this turn</h4>';
            container.innerHTML = html;
        }
    }

//TIMING CLASSES
    var setTimer = function(){
        appState.time.timeoutId = setTimeout(function(){
            appState.time.remainingTime = appState.time.remainingTime - 1;
            if( appState.time.remainingTime >= 1 )
                setTimer();
            else
            {
                if(appState.nextView==='join')
                    getTeams();
                else
                    getNext();
            }
            $(".timer").html(appState.time.remainingTime);
        },1000);
    }

    var setRemainingTime = function(newRemainer){
        window.clearTimeout(appState.time.timeoutId);
        appState.time.remainingTime = newRemainer;
    }

//VIEW CLASSES

    var getNext = function(){
        console.log("Get next view from server");
        $.get(
            BASE_URL + URL_GAME_MOVE,
            function(data){
                if(data.isFinished)
                {
                    appState.nextView  = 'join';
                    getTeams();
                    return ;
                }
                else{
                /*    if(data.currentTeamId == appState.selectedTeam)
                        appState.nextView  = 'move';
                    else
                        appState.nextView = 'waiting';*/
                    appState.nextView = 'move';
                }
                changeState(data);
                setRemainingTime(data.currentMoveTTL);
                setTimer();
            }
        );
    }

    var getPercentages = function(){
        return 60;
    }

    var getTeams = function(){
        appState.nextView = 'join';
        $.get(
            BASE_URL + URL_GAME_JOIN,
            function(data){
                console.log(data.teams);
                changeState(data);
                setRemainingTime(data.currentMoveTTL);
                setTimer();
            }
        );
    }


    $(document).on('click', '.teamSelection button', function() {
        var selectedTeam = $(this).attr('data-value');
        $('#teamSelectionButtons').hide();
        var html = '<div class="roundStartsIn">';
        html += 'Next turn starts in: <span class="timer"></span></div>';
        $('.teamSelection').append(html); 
        appState.selectedTeam = selectedTeam;
        var jqxhr = $.post( BASE_URL + URL_GAME_JOIN, selectedTeam, function(data){
            appState.nextView = 'move';
            appState.userId = data.id;
            setRemainingTime(data.currentMoveTTL);
            setTimer();
        });
    });


    $(document).on('click', '.moveSelection button', function() {
        var selectedMove = $(this).attr('data-value');
        var jqxhr = $.post(BASE_URL + URL_GAME_MOVE + "/user/"+appState.userId , selectedMove, function(data){
            appState.nextView = 'move';
            setRemainingTime(data.currentMoveTTL);
            setTimer();
        }
        );
    });

    var main = function() {
        setTimer();
        getTeams();
    }

    main();

}(window, jQuery));

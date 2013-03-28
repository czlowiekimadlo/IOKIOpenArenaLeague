
$(document).ready(function () {
    $('#season #teams #teamsAverageScore').hide();
    $('#season #teams #teamsTotalScore').hide();

    $('#season #teams select').on('change', function () {
        $('#season #teams ol').hide();
        $('#season #teams #' + $(this).val()).show();
    });

    $('#season #players ol').hide();
    $('#season #players #getAverageScore').show();

    $('#season #players select').on('change', function () {
        $('#season #players ol').hide();
        $('#season #players #' + $(this).val()).show();
    });

    $('#match .team1 h2').on('click', function () {
        $(this).next('.playerStats').toggle();
    });
    $('#match .team2 h2').on('click', function () {
        $(this).next('.playerStats').toggle();
    });
});
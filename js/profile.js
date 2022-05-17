function ratinghandler(e, movieId) {
    var eFname = document.getElementById('e-fname');
    var eFname = document.getElementById('e-lname');
    var eFname = document.getElementById('e-email');
    var eFname = document.getElementById('e-password');
    var eFname = document.getElementById('e-fname');


    booknow.addEventListener('click', e => {

    })

    $.post("rating.php", { movieId: movieId, rating: rating },
        function (res) {
            if (res == 1)
                window.location.replace("movie.php?id=" + movieId);
            else
                alert("Error occured!");
        });
}
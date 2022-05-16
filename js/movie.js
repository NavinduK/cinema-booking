datePickerId.min = new Date().toISOString().split("T")[0];

function ratinghandler(e, movieId) {
    var rating = e.value;

    // alert(rating + " | "+ movieId)
    $.post("rating.php", { movieId: movieId, rating: rating },
        function (res) {
            if (res == 1)
                window.location.replace("movie.php?id=" + movieId);
            else
                alert("Error occured!");
        });
}
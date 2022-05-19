const container = document.querySelector('.container-b');
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const count = document.getElementById('count');
const total = document.getElementById('total');
const booknow = document.getElementById('booknow');
const movieSelect = document.getElementById('movie');

let ticketPrice = 20;
var selectedSeatsCount = 0;
populateUI();

// Save selected movie index and price
// function setMovieData(movieIndex, moviePrice) {
//   localStorage.setItem('selectedMovieIndex', movieIndex);
//   localStorage.setItem('selectedMoviePrice', moviePrice);
// }

// Update total and count
function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll('.row .seat.selected');

  const seatsIndex = [...selectedSeats].map(seat => [...seats].indexOf(seat));

  localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

  selectedSeatsCount = selectedSeats.length;
  if (selectedSeatsCount <= 0) {
    booknow.disabled = true;
  } else {
    booknow.disabled = false;
  }

  count.innerText = selectedSeatsCount;
  total.innerText = selectedSeatsCount * ticketPrice;
}

// Get data from localstorage and populate UI
function populateUI() {
  if (!("user" in localStorage))
    $('#loginModal').modal('show');

  const occupiedSeats = JSON.parse(localStorage.getItem('occupiedSeats'));

  if (occupiedSeats !== null && occupiedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (occupiedSeats.indexOf(index) > -1) {
        seat.classList.add('occupied');
      }
    });
  }

  // const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

  // if (selectedSeats !== null && selectedSeats.length > 0) {
  //   seats.forEach((seat, index) => {
  //     if (selectedSeats.indexOf(index) > -1) {
  //       seat.classList.add('selected');
  //     }
  //   });
  // }

  // const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

  // if (selectedMovieIndex !== null) {
  //   movieSelect.selectedIndex = selectedMovieIndex;
  // }

  // Initial count and total set
  updateSelectedCount();
}

// Movie select event
// movieSelect.addEventListener('change', e => {
//   ticketPrice = +e.target.value;
//   setMovieData(e.target.selectedIndex, e.target.value);
//   updateSelectedCount();
// });

// Seat click event
container.addEventListener('click', e => {
  if (
    e.target.classList.contains('seat') &&
    !e.target.classList.contains('occupied')
  ) {
    e.target.classList.toggle('selected');

    updateSelectedCount();
  }
});

// Seat click event
booknow.addEventListener('click', e => {
  var seats = localStorage.getItem('selectedSeats').replace('[', '').replace(']', '');
  if (!("user" in localStorage))
    $('#loginModal').modal('show');
  else if (accBalance < (selectedSeatsCount * ticketPrice))
    alert('Credit Not enough, Please topup first!');
  else
    $.post('bookNow.php', { movieId: movieId, movieDate: movieDate, seats: seats, total : (selectedSeatsCount * ticketPrice) },
      function (res) {
        if (res == 1)
          window.location.replace("movie.php?id=" + movieId);
        else
          alert("Error occured!");
      });
});
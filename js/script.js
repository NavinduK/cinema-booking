const container = document.querySelector('.container-b');
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const count = document.getElementById('count');
const total = document.getElementById('total');
const booknow = document.getElementById('booknow');
const movieSelect = document.getElementById('movie');

let ticketPrice = 20;

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
  console.log(JSON.stringify(seatsIndex));

  localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

  const selectedSeatsCount = selectedSeats.length;

  count.innerText = selectedSeatsCount;
  total.innerText = selectedSeatsCount * ticketPrice;
}

// Get data from localstorage and populate UI
function populateUI() {
  if (!("user" in localStorage))
    $('#loginModal').modal('show');

  const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add('selected');
      }
    });
  }

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
  $.post('logIn.php', { postName: userName, postPassword: password },
    function (data) {
      if (data.split(",")[0] == 1) {
        localStorage.setItem('user', data.split(",")[1]);
        window.location.replace("adminpage.php");
      } else if (data.split(",")[0] == 2) {
        localStorage.setItem('user', data.split(",")[1]);
        location.reload();
      } else {
        shakeModal("Wrong Username or Password");
      }
    });
});
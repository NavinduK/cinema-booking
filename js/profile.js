var eFname = document.getElementById('e-fname');
var eLname = document.getElementById('e-lname');
var eEmail = document.getElementById('e-email');
var ePassword = document.getElementById('e-password');
var updateProfile = document.getElementById('updateP');

eFname.addEventListener('click', e => {
    document.getElementById('fname-u').disabled = false;
})
eLname.addEventListener('click', e => {
    document.getElementById('lname-u').disabled = false;
})
eEmail.addEventListener('click', e => {
    document.getElementById('email-u').disabled = false;
})
ePassword.addEventListener('click', e => {
    document.getElementById('password-u').disabled = false;
})

updateProfile.addEventListener('click', e => {
    var fname = document.getElementById('fname-u').value;
    var lname = document.getElementById('lname-u').value;
    var email = document.getElementById('email-u').value;
    var password = document.getElementById('password-u').value;

    $.post("updateProfile.php", { fname: fname, lname: lname, email: email, password: password },
        function (res) {
            if (res == 1)
                window.location.replace("profile.php");
            else
                alert("Error occured!");
        });
})

function submitForm() {
    document.getElementById("profilePic").submit();
  }
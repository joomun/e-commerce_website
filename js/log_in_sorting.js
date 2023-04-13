let lowerCase = document.getElementById('lower');
let upperCase = document.getElementById('upper');
let digit = document.getElementById('number');
let specialChar = document.getElementById('special');
let minLength = document.getElementById('length');


function checkPassword(data) {
  const lower = new RegExp('(?=.*[a-z])');
  const upper = new RegExp('(?=.*[A-Z])');
  const number = new RegExp('(?=.*[0-9])');
  const special = new RegExp('(?=.*[!@#\$%\^$\*])');
  const length = new RegExp('(?=.{8,})');
  var password = document.getElementById("password-signup").value;
  var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

  function checkPassword_2() {
    const password = document.getElementById("password-signup").value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  
    if (!passwordRegex.test(password)) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password should contain at least 1 lowercase letter, 1 uppercase letter, 1 number, 1 special character, and be at least 8 characters long!',
      });
      return false;
    }
  
    return true;
  }
  //lower case test
  if (lower.test(data)) {
    lowerCase.classList.add('valid');

  } else {
    lowerCase.classList.remove('valid');
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  }

  //upper case test
  if (upper.test(data)) {
    upperCase.classList.add('valid');
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  } else {
    upperCase.classList.remove('valid');
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  }

  //number test
  if (number.test(data)) {
    digit.classList.add('valid');
  } else {
    digit.classList.remove('valid');
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  }

  //special character

  if (special.test(data)) {
    specialChar.classList.add('valid');
  } else {
    specialChar.classList.remove('valid');
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  }

  //length check 

  if (length.test(data)) {
    minLength.classList.add('valid');
  } else {
    minLength.classList.remove('valid');
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  }

  if ((length.test(data)) && (special.test(data)) && (number.test(data)) && (upper.test(data)) && (lower.test(data))) {
    document.getElementById("submit").disabled = false;
    document.getElementById("submit").style.backgroundColor = "#5995fd";
  }

  return true

  
} 

function checkusername(data) {
  var username = document.getElementById("username-signup").value;

  if (document.getElementById("username-signup").value.length == 0) {
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").style.backgroundColor = "#ff000044";
  }

  return true
}

function save() {
  var username = $("#username-signup").val();
  var email = $("#email-signup").val();
  var password = $("#password-signup").val();
  var address = $("#Address-signup").val();

  if (username == "" || email == "" || address == "" || password == "") {
    // If any of the input fields are empty, show an error message
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Please fill in all the required fields.",
    });
    return;
  }

  // Send POST request to server to save user data
  $.ajax({
    type: "POST",
    url: "./php/server/save.php",
    data: {
      username: username,
      email: email,
      password: password,
      address: address,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        // Registration successful
        Swal.fire({
          icon: "success",
          title: "Success!",
          text: response.message,showConfirmButton: false
        }).then(() => {
          // Redirect the user to the index page
          window.location.href = 'log_in.php';
        });

      } else {
        // Registration failed
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message,
        });
      }
    },
    error: function (xhr, status, error) {
      // Handle error
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Registration failed. Please try again later.",
      });
    },
  });
}



function log_in() {
  let username = $('#username-signin').val();
  let password = $('#Password-signin').val();

  if (username === '' || password === '') {
    // If any of the input fields are empty, show an error message
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Please fill in all the required fields.',
    });
  } else {
    // Send a POST request to the server to perform the login
    $.ajax({
      type: 'POST',
      url: './php/server/check_user.php',
      data: {
        username: username,
        password: password,
      },
      success: function (response) {
        console.log(response); // Log the response to the console
        let data = JSON.parse(response);
        if (data.success) {
          // Login successful, retrieve the user ID and name from the server response
          let user_id = data.id.$oid; // retrieve the Object ID of the user
          let username_logged_in = data.name;
      
          // Store the user ID and name in the session storage
          let logged_in_object = {
            id: user_id,
            name: username_logged_in,
          };
          sessionStorage.setItem('currentloggedin', JSON.stringify(logged_in_object));
      
          Swal.fire({
            icon: 'success',
            title: 'Welcome!',
            text: 'You have successfully logged in.',
            timer: 3000, // 3 seconds
            timerProgressBar: true,
            showConfirmButton: false
          }).then(() => {
            // Redirect the user to the index page
            window.location.href = 'index.php';
          });
          
        } else {
          // Login failed, show an error message
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message,
            timer: 3000, // 3 seconds
            timerProgressBar: true,
          });
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Login failed. Please try again later.',
        });
      },
    });
  }
}
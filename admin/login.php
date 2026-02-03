<html>
  <head>
    <title>Admin Login - Optical Shop Management</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('../admin/images.jpg') no-repeat center center fixed; /* Replace with your image URL */
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      #loginForm {
        background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
      }

      #loginForm h2 {
        margin-bottom: 20px;
      }

      #loginForm label {
        display: block;
        margin: 10px 0 5px;
      }

      #loginForm input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      #loginForm button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      #loginForm button:hover {
        background-color: #0056b3;
      }

      #errorMessage {
        color: red;
        margin-top: 10px;
        display: none;
      }
    </style>
  </head>
  <body>
    <form id="loginForm" onsubmit="return validateLogin()">
      <h2> Optical Shop Management System</h2>
      <h3>Login</h3>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
      <p id="errorMessage">Invalid username or password</p>
    </form>

    <script>
      function validateLogin() {
        // Dummy credentials validation
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        if (username === "T&C" && password === "admin123") {
          // Redirect to dashboard on successful login
          window.location.href = "dashboard.php"; // Assuming you have this page
          return false; // Prevent form submission
        } else {
          // Show error message on invalid credentials
          document.getElementById('errorMessage').style.display = "block";
          return false; // Prevent form submission
        }
      }
    </script>
  </body>
</html>
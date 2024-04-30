<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Website Register or Login Page</title>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: url('2.jpg') center/cover no-repeat;
    /* Replace 'background-image.jpg' with your image path */
    /* background-color: #FFFFFF; /* White fallback */
    color: #FFFFFF; /* White */
    background-blend-mode: overlay;
    height: 100vh;
  }

  .overlay {
    background-color: rgba(0, 0, 0, 0.5); /* Overlay color with 50% opacity */
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 1; /* Ensure overlay is above the background */
  }

  .container {
    position: relative;
    z-index: 2; /* Ensure container is above the overlay */
  }

  h1 {
    font-size: 3rem;
    margin-bottom: 20px;
  }

  p {
    font-size: 1.2rem;
    margin-bottom: 30px;
  }

  .btn {
    display: inline-block;
    padding: 30px 75px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;
    text-decoration: none;
    color: #rosybrown; /* White */
    background-color: #FFFFFF; /* Blue */
    transition: background-color 0.3s ease;
  }

  .btn-login:hover {
    background-color: yellow; 
    box-shadow: 2px;

  }
 
  .btn-register {
    background-color: cyan; 
    margin-left: 20px;
  }

  .btn-register:hover {
    background-color: #666666; /* Darker Black */
  }

</style>
</head>
<body style="background-image: url('./Images/image4..jpg');background-repeat: no-repeat;background-size: cover;">

<div class="overlay">
  <div class="container">
    <h1 style="color:greenyellow;">WELCOME TO library</h1>

    <a href="login.html" class="btn btn-login">Login</a>
    <a href="register.html" class="btn btn-register">Register</a>
  </div>
</div>

</body>
</html>
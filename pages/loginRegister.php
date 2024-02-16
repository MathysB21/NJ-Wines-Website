<?php
// Start session if it has not been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect('localhost', 'root', '', 'nj_wines');

// Check if the form is submitted
if (isset($_POST['signin'])) {
    // Retrieve the input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debugging: Check connection success and echo result
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connection successful";
    }

    // Perform necessary operations with the input values
    // Prepare the SQL statement
    $sql = "SELECT * FROM customers WHERE email=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the rows from the result
    $rows = mysqli_fetch_assoc($result);

    // You can then use the $rows variable to access the fetched data
    $_SESSION['email'] = $email;

    $string = json_encode($rows);
    $_SESSION['user_info'] = $string;

    $_SESSION['user_id'] = $rows['id'];

    if (mysqli_num_rows($result) == 1) {
        // Login successful, add the email to the session for dashboard to access, open the dashboard
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;

        header('Location: cart.php');
        exit(); // Important: Stop executing the rest of the code after redirecting
    } else {
        // Login failed, show failure message
        $loginError = "Your email or password is incorrect. Please try again.";
        echo $loginError;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

if (isset($_POST['signup'])) {
    // Retrieve the input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debugging: Check connection success and echo result
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connection successful";
    }

    // Perform necessary operations with the input values
    // Prepare the SQL statement
    $sql = "INSERT INTO customers (first_name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Prepare the SQL statement
    $sql = "SELECT * FROM customers WHERE email=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the rows from the result
    $rows = mysqli_fetch_assoc($result);

    // You can then use the $rows variable to access the fetched data
    $_SESSION['email'] = $email;

    $string = json_encode($rows);
    $_SESSION['user_info'] = $string;

    $_SESSION['user_id'] = $rows['id'];

    if (mysqli_num_rows($result) == 1) {
        // Login successful, add the email to the session for dashboard to access, open the dashboard
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = true;

        header('Location: cart.php');
        exit(); // Important: Stop executing the rest of the code after redirecting
    } else {
        // Login failed, show failure message
        $loginError = "Your email or password is incorrect. Please try again.";
        echo $loginError;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Close the statement
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niel Joubert Wines</title>
    <link rel="icon" type="image/png" href="../images/logo-min.png">
    <link rel="stylesheet" href="../css/styles.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loginStyles.css">
</head>

<body>
    <div class="drawer bg-[#2C3136]">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col bg-white">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300 fixed z-50">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">
                    <img src="../images/logo.png" alt="Niel Joubert Wines" class="max-h-14 my-2">
                </div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="wines.html">Our Wines</a></li>
                        <li><a href="loginRegister.php">Login</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page content here -->
            <div class="login-contain" id="login-contain">
                <div class="form-container sign-up-container">
                    <form method="POST" action="loginRegister.php" class="text-black">
                        <h1>Create Account</h1>
                        <input type="text" placeholder="Name" class="text-black" name="name"/>
                        <input type="email" placeholder="Email" name="email"/>
                        <input type="password" placeholder="Password" name="password" required/>
                        <button type="submit" name="signup">Sign Up</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <form method="POST" action="loginRegister.php">
                        <h1>Sign in</h1>
                        <input type="email" placeholder="Email" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <a href="#">Forgot your password?</a>
                        <button type="submit" name="signin">Sign In</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-darken">
                            <div class="overlay-panel overlay-left">
                                <h1 class="overlay-message">Welcome!</h1>
                                <p>To keep connected with us please sign up with your personal info</p>
                                <button class="ghost" id="signIn">Sign In</button>
                            </div>
                            <div class="overlay-panel overlay-right">
                                <h1 class="overlay-message">Hi There!</h1>
                                <p>Enter your details and continue your journey with us</p>
                                <button class="ghost" id="signUp">Sign Up</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="drawer-side">
            <label for="my-drawer-3" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 bg-base-100">
                <!-- Sidebar content here -->
                <li><a href="index.html">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="wines.html">Our Wines</a></li>
                <li><a href="loginRegister.php">Login</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>

        </div>

    </div>

    <script src="loginScript.js"></script>
</body>

</html>
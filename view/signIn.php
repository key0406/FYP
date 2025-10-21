<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOOS-12 Progress Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8e8f1;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #d3d3d3;
            border: none;
            color: black;
        }
        .btn-custom:hover {
            background-color: #c0c0c0;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error-input {
            border: 2px solid red !important;
            background-color: #ffebeb !important;
        }
    </style>
</head>
<body>
<div class="container mt-5" id="signin">
    <h2 class="text-center mb-4">SignIn</h2>

    <?php
        session_start();
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
    ?>

    <form method="POST" action="../controller/signInController.php" id="signInForm">
        <div class="mb-3">
            <input type="text" class="form-control <?php echo isset($_SESSION['error_username']) ? 'error-input' : ''; ?>" 
                   name="username" id="username" placeholder="Username" required>
            <?php
            if (isset($_SESSION['error_username'])) {
                echo '<div class="error-message">'.$_SESSION['error_username'].'</div>';
                unset($_SESSION['error_username']);
            }
            ?>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control <?php echo isset($_SESSION['error_email']) ? 'error-input' : ''; ?>" 
                   name="email" id="email" placeholder="Email" required>
            <?php
            if (isset($_SESSION['error_email'])) {
                echo '<div class="error-message">'.$_SESSION['error_email'].'</div>';
                unset($_SESSION['error_email']);
            }
            ?>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="d-flex justify-content-center mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="patient" value="patient" required>
                <label class="form-check-label" for="patient">Patient</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="doctor" value="doctor" required>
                <label class="form-check-label" for="doctor">Doctor</label>
            </div>
        </div>
        <div class="text-end mb-3">
            <a class="text-decoration-none" href="login.php">Already have an account?</a>
        </div>
        <button type="submit" class="btn btn-custom w-100">Submit</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let emailError = document.querySelector(".error-message");
        let usernameError = document.querySelector(".error-message");

        if (emailError) {
            document.getElementById("email").focus();
        } else if (usernameError) {
            document.getElementById("username").focus();
        }
    });
</script>

</body>
</html>

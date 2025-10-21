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
        .header-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
        .form-check-inline .form-check-input {
            margin-top: 0;
        }

    </style>
</head>
<body>
<?php session_start(); ?>


<div class="container mt-5" id="login">
    <h2 class="text-center mb-4">Login</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['role_error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['role_error']; ?>
        </div>
        <?php unset($_SESSION['role_error']); ?>
    <?php endif; ?>

    <form class="h-adr" method="post" action="../controller/loginController.php">
        <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>  
        </div>
       
        <div class="d-flex justify-content-center mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input <?php if (isset($_SESSION['selected_role']) && $_SESSION['selected_role'] !== '') echo 'role-error'; ?>" type="radio" name="role" id="patient-login" value="patient" 
                <?php if (isset($_SESSION['selected_role']) && $_SESSION['selected_role'] === 'patient') echo 'checked'; ?> required>
                <label class="form-check-label" for="patient-login">Patient</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input <?php if (isset($_SESSION['selected_role']) && $_SESSION['selected_role'] !== '') echo 'role-error'; ?>" type="radio" name="role" id="doctor-login" value="doctor" 
                <?php if (isset($_SESSION['selected_role']) && $_SESSION['selected_role'] === 'doctor') echo 'checked'; ?> required>
                <label class="form-check-label" for="doctor-login">Doctor</label>
            </div>
        </div>


<div class="text-end mb-3">
    <a class="text-decoration-none" href="signIn.php">Don't have an account yet?</a>
</div>
<button type="submit" class="btn btn-custom w-100">Login</button>
</form> 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let roleError = document.querySelector(".error-message");

        if (roleError) {
            let roleInput = document.querySelector("input[name='role']");
            if (roleInput) {
                roleInput.focus();
            }
        }
    });
</script>
</body>
</html>

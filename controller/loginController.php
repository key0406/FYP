<style>
  .text-custom {
    font-size: 80px; 
  }
  @media (min-width: 992px) {
    .text-custom {
      font-size: initial;
    }
  }
</style>

<?php
require_once("sql.php");
require_once("../model/login2.php");

session_start();

if(isset($_POST["email"])){
  $email = $_POST["email"];
}
else{
  $email = "";
}
if(isset($_POST["password"])){
  $password = $_POST["password"];
}
else{
  $password = "";
}
if(isset($_POST["role"])){
  $role = $_POST["role"];
}
else{
  $role = "";
}



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<h1 class="text-custom">Unauthorized Access</h1>';
    exit();
}

session_start();

// Clear any existing session data for roles
unset($_SESSION['auth_patient'], $_SESSION['auth_doctor']);

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$selected_role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

// Fetch user from database
$user = getLogin($email);
//var_dump($user);
//exit();


if ($user) {
    $hashed_password = $user->password;
    $role = $user->role;

    //var_dump($user);
    //var_dump($hashed_password);
    //var_dump($role);
    //var_dump($password);
    //exit();

    //This is the error log for the password verification
    error_log("Entered password: " . $password);
    error_log("Stored hashed password: " . $hashed_password);
    // Verify password
    if (password_verify($password, $hashed_password)) {
      if ($selected_role != $role) {
        $_SESSION['role_error'] = "The selected role does not match the registered role.";
        $_SESSION['selected_role'] = $selected_role;
        header("Location: ../view/login.php");
        exit();
    }
      error_log("Password verification successful");
      //session_regenerate_id(true); // Regenerate session ID
      $_SESSION['sender_id'] = $user->email;

      // Set session based on role
      if ($role === 'patient') {
          $_SESSION['auth_patient'] = ['id' => $user->id, 'email' => $user->email];
          header("Location: ../view/index.php");
      } elseif ($role === 'doctor') {
          $_SESSION['auth_doctor'] = ['id' => $user->id, 'email' => $user->email];
          header("Location: ../view/patient_detail.php");
      }
      exit();
    }else{
      error_log("Password verification failed");
    }
}

echo '<h1>Invalid username or password</h1>';
exit();
?>

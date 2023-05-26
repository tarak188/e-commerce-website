<?php
include('connection.php');
$name = $_POST['name'];
$prenom = $_POST['prenom'];
$password = $_POST['password'];
$email = $_POST['email'];
function validateUser($email, $password, $connection) {
    // Escape the user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    // SQL query to check if the user exists
    $query = "SELECT * FROM client WHERE email = '$email'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if any row is returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the row
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // User credentials are valid
            return true;
        }
    }

    // User credentials are invalid
    return false;
}

function createUser($name, $prenom, $password, $email, $connection) {
    if (validateUser($email, $password, $connection)) {
        // User already exists
        return false;
    } else {
        // Escape the user inputs to prevent SQL injection
        $name = mysqli_real_escape_string($connection, $name);
        $prenom = mysqli_real_escape_string($connection, $prenom);
        $password = mysqli_real_escape_string($connection, $password);
        $email = mysqli_real_escape_string($connection, $email);

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert a new user into the client table
        $query = "INSERT INTO client (name, prenom, password, email) 
                  VALUES ('$name', '$prenom', '$hashedPassword', '$email')";

        // Execute the query
        $result = mysqli_query($connection, $query);

        // Check if the query was successful
        if ($result) {
            // User registration was successful
            return true;
        } else {
            // User registration failed
            return false;
        }
    }
}



if (createUser($name, $prenom, $password, $email, $connection)) {
    // User registration is successful
    // Redirect to a success page, display a success message, etc.
    echo "User registration successful";
} else {
    // User registration failed
    // Redirect back to the sign-up page, display an error message, etc.
    echo "User registration failed";
}
?>

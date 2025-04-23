<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $entered_otp = $_POST['otp'];

    // Fetch OTP and expiry time from the database
    $query = "SELECT otp, otp_expiry FROM newdata WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_otp = $row['otp'];
        $otp_expiry = $row['otp_expiry'];

        // Check if OTP matches and is not expired
        if ($entered_otp == $stored_otp && time() <= $otp_expiry) {
            // OTP is correct and valid
            echo "Email verified successfully!";
            // Update user status to verified, for example:
            $update_query = "UPDATE newdata SET verified = 1 WHERE email = ?";
            $stmt_update = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt_update, "s", $email);
            mysqli_stmt_execute($stmt_update);

            header('Location: login.php'); // Redirect to login page after successful verification
        } else {
            echo "Invalid OTP or OTP expired.";
        }
    } else {
        echo "No record found for this email.";
    }
}
?>

<!-- OTP Verification Form -->
<form action="" method="POST">
    <label for="otp">Enter OTP</label>
    <input type="text" name="otp" required>
    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
    <input type="submit" value="Verify OTP">
</form>

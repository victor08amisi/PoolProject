<!--  the PHP section to validate-->


<?php
//code to track errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $topic = htmlspecialchars($_POST["topic"]);
    $message = htmlspecialchars($_POST["message"]);
    $phone = htmlspecialchars($_POST["phone"]);

    /* validating the required fields */
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('All fields marked with * are required!'); window.history.back();</script>"; 
        exit;
    }


//  ================THIS SECTION IS FOR TESTING with LOCAL SERVER =============================

//since it's running with VS code, and not on the real server, need to use XAMPP and apache
    //Make sure the project is inside C:\xampp\htdocs. copy and put the whole pools folder there.
    //NEED TO MODIFY SETTINGS IN PHP.INI and sendmail.ini TO TEST LOCALLY and PREVENT THE EMAILS FROM BEING REJECTED OR GOING TO SPAM. 

    $to = "jonathan3j28@hotmail.com";  // Michael, Vicki -replace with your email for testing
    $subject = "Testing Inquiry from $name - $topic";
    $body = "You have received a new inquiry.\n\n" .
            "Topic: $topic\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n" .
            "Message:\n$message";

// Use your own email as "From" for reliable testing
    $headers = "From: jonathan3j28@hotmail.com\r\n";   
    $headers .= "Reply-To: $email\r\n";  
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// ===================== END LOCAL TESTING PART =========================================


// ==============FROM HERE IS THE DEPLOYMENT ON CLIENT'S SERVER ============================
    

// from here it continues with the section at the bottom - sending email and instant feedback to client to let him know if submitted.
//starts with  if(mail($to....))
// Delete the testing section from: $to ="yourwonemail@example.com all the way to: $header .=...UTF-8\r\n";
// and UNCOMMENT THE SECTION BELOW 


 
    
    // $to = "info@aquapunta.com.uy";  // MICHAEL TO REPLACE with your real emailenter the email you want inquiries to go to 
    // $subject = "New Inquiry from $name - $topic";
    // $body = "You have received a new inquiry.\n\n".
    //        "Topic: $topic\n".
    //        "Name: $name\n".
    //        "Email: $email\n".
    //        "Phone: $phone\n".
    //        "Message:\n$message";

    // $headers = "From: info@aquapunta.com.uy\r\n";           // Michael, check address //
    // $headers .="Reply-To: $email\r\n";       // to reply directly to the client's email
    // $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email and notify the client if the form was sent  
if (mail($to, $subject, $body, $headers)) {
        echo "<script>
            alert('Your inquiry was sent successfully!');
            window.location.href='inquiry.html';
         </script>";
    } else {
        echo "<script>
            alert('Failed to send inquiry. Please try again.'); 
            window.history.back();
         </script>";
    }
    ?>



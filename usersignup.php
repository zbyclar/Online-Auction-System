<?php
    session_start();
    include('connect.php');
    $user_name = $_POST['username_ini'];
    $email = $_POST['email'];
    $password = $_POST['password_ini'];
    if($_POST['gender']=="male"){
        $gender = 1;
    }else{
        $gender = 0;
    }
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $dob = (string)$year."-".(string)$month."-".(string)$day;
    $issub = $_POST['issub'];
    $link = mysqli_connect('localhost','zby','root','Database_Project');
    if($user_name=="Username"||$password=="Password"){
        header('location:../registerwarning.php');
    } else {
        $password = sha1($password);
        $result1 = mysqli_query($link,"SELECT user_email FROM tbl_user WHERE user_email='$email'");
        $result2 = mysqli_query($link,"SELECT user_name FROM tbl_user WHERE user_name='$user_name'");
        $num1 = mysqli_num_rows($result1);
        $num2 = mysqli_num_rows($result2);
        if($num1 > 0){
            header('location:../registerwarning.php');
            
        } else if($num2 > 0){
            header('location:../registerwarning.php');
        } else {
            mysqli_query($link,"INSERT INTO tbl_user(user_name,user_email,user_pwd,user_dob,user_gender,user_issub)
            VALUES('$user_name','$email','$password','$dob','$gender','$issub')");
            $_SESSION['loginname'] = $user_name;
            $_SESSION['loginemail'] = $email;
            $_SESSION['logindob'] = $dob;
            $_SESSION['logingender'] = $gender;
            $_SESSION['loginissub'] = $issub;
                         
                         
            require 'PHPMailerAutoload.php';
                         
            $mail = new PHPMailer;
                         

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'webserviceucl@gmail.com';                 // SMTP username
            $mail->Password = 'ucl123456';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            $mail->setFrom('webserviceucl@gmail.com', 'Web Service');
            $mail->addAddress($email, $user_name);     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Register Successfully';
            $mail->Body    = 'Congradulations,'.$user_name.', right now you can enjoy our web service';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header('location: ../index.php?register=success');
            }
           
            
        }
    }
    mysqli_close($link,"SELECT * FROM tbl_user WHERE user_email = '$email'");
    mysqli_close($link,"SELECT * FROM tbl_user WHERE user_name = '$user_name'");
    mysqli_close($link,"INSERT INTO tbl_user(user_name,user_email,user_pwd,user_dob,user_gender,user_issub)
                                    VALUES('$user_name','$email','$password','$dob','$gender','$issub')");
?>

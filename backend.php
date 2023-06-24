<?php

$db_name = 'mysql:host=localhost;dbname=contact_db';
$user_name='root';
$user_password='';


$conn = new PDO($db_name,$user_name,$user_password);

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $courses = $_POST['courses'];
    $courses = filter_var($courses, FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);

    $select_contact =$conn->prepare("SELECT * FROM 'contact_form' WHERE name = ? AND email = ? AND number = ? AND courses = ? AND gender = ?");
    $select_contact->execute([$name, $email, $number, $courses, $gender]);

    if($select_contact->rowCount() > 0){
        $message[] = 'already sent message!';
    }else{
        $insert_message  = $conn->prepare("INSERT INTO 'contact_form'(name, email, number, courses, gender) VALUES(?,?,?,?,?)");
        $insert_message->execute([$name, $email, $number, $courses, $gender]);
        $message[] = 'message sent successfully!';

    }
}


?>
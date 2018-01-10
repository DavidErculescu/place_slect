<?php
include "functions.php";

$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data

if (empty($_POST['name']))
    $errors['name'] = 'Name is required.';
if (empty($_POST['drinks']))
    $errors['drinks'] = 'Drinks is required.';
if (empty($_POST['foods']))
    $errors['foods'] = 'Foods is required.';

if ( ! empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';

    $obj['name'] = $_POST['name'];
    $obj['foods'] = $_POST['foods'];
    $obj['drinks'] = $_POST['drinks'];
    $function = 'add_'.$_POST['type'];
    $function($_POST['tkid'], $obj);
}
// return all our data to an AJAX call
echo json_encode($data);


?>
<?php
require_once('../../../wp-load.php');

print "POST: <xmp>";
	print_r($_POST);
print "</xmp>";
die();

if(!empty($_POST["Email"]) && $_POST["Email"] != "") {
	
	if(!function_exists('wp_handle_upload')) {
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
	}
	
	$file_upload_arr 	= array();
	$attachment_1 		= $_FILES['attachment_1'];
	$upload_overrides 	= array( 'test_form' => false );
	
	$file_upload_arr 	= wp_handle_upload($attachment_1, $upload_overrides);

	if($file_upload_arr && ! isset( $file_upload_arr['error'])) {
		$attachment_1_url = $file_upload_arr['url'];
	} else {
		$attachment_1_url = '';
	}
				
	$messages 	 = "<p>A new request has been received from the webform form.</p>";
	$messages 	.= "<p><strong>Ticket Type:</strong> ".$_POST['Ticket_Type']."</p>";
	$messages 	.= "<p><strong>First Name:</strong> ".$_POST['First_Name']."</p>";
	$messages 	.= "<p><strong>Contact Name:</strong> ".$_POST['Contact_Name']."</p>";
	$messages 	.= "<p><strong>Email ID:</strong> ".$_POST['Email']."</p>";
	$messages 	.= "<p><strong>Email Subject:</strong> ".$_POST['Subject']."</p>";
	$messages 	.= "<p><strong>Email Description:</strong> ".$_POST['Description']."</p>";
	$messages 	.= "<p><strong>MC Number DOT Number:</strong> ".$_POST['MC_NUMBER/_DOT_NUMBER']."</p>";
	$messages 	.= "<p><strong>Carrier Name:</strong> ".$_POST['CARRIER_NAME']."</p>";
	$messages 	.= "<p><strong>Dispatcher Name:</strong> ".$_POST['DISPATCHER_NAME']."</p>";
	$messages 	.= "<p><strong>Dispatcher Email ID:</strong> ".$_POST['DISPATCHER_EMAIL_ID']."</p>";
	$messages 	.= "<p><strong>Dispatcher Contact Number:</strong> ".$_POST['DISPATCHER_CONTACT_NUMBER']."</p>";
	$messages 	.= "<p><strong>Type of Truck or Container:</strong> ".$_POST['TYPE_OF_TRUCK_OR_CONTAINER']."</p>";
	$messages 	.= "<p><strong>Total Number of Loads:</strong> ".$_POST['TOTAL_NUMBER_OF_LOADS']."</p>";
	$messages 	.= "<p><strong>Commodity:</strong> ".$_POST['COMMODITY']."</p>";
	$messages 	.= "<p><strong>Shipment to and Form:</strong> ".$_POST['SHIPMENT_TO_AND_FROM']."</p>";
	$messages 	.= "<p><strong>Cargo Value:</strong> ".$_POST['CARGO_VALUE']."</p>";
	$messages 	.= "<p><strong>VIN:</strong> ".$_POST['VIN']."</p>";
	$messages 	.= "<p><strong>Loading Date:</strong> ".$_POST['LOADING_DATE']."</p>";
	$messages 	.= "<p><strong>Delivery Date:</strong> ".$_POST['DELIVERY_DATE']."</p>";
	$messages 	.= "<p><strong>Attachment:</strong> ".$file_upload_arr['url']."</p>";
	//$messages 	.= "<p><strong>Hazmat Certificate Status:</strong> ".$_POST['Hazmat_Certificate_Status']."</p>";
	//$messages 	.= "<p><strong>Driver Name and Phone Number:</strong> ".$_POST['DRIVER_NAME_AND_PHONE_NO_']."</p>";
	//$messages 	.= "<p><strong>Status:</strong> ".$_POST['Status']."</p>";
	
	print "Msg: <xmp>";
		print_r($messages);
	print "</xmp>";

				
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: S & S Brokerage Inc <info@sandsbrokerageinc.com>" . "\r\n";
	$headers .= "BCC: naseem@aristasystems.in";
	
	$subject 	 = "Thank You for Reaching Out";
				
	if(mail($_POST["Email"], $subject, $messages, $headers)) {
		echo $result ='success';
	}
} ?>
<?php

	// Mail settings
	$to        = "web-master72@yandex.ru";
	$subject   = "Risotto Booking Form";
	$autoReply = "Your booking has been submitted. Our manager will contact you shortly.";

	// You can put here your email
	$header = "From: noreply@risotto.com\r\n";
	$header.= "MIME-Version: 1.0\r\n";
	$header.= "Content-Type: text/plain; charset=utf-8\r\n";
	$header.= "X-Priority: 1\r\n";

	if ( isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["date"]) && isset($_POST["time"]) ) {

		$content  = "Name: "     . $_POST["name"]    . "\r\n";
		$content .= "Phone: "    . $_POST["phone"]   . "\r\n";
		$content .= "Email: "    . $_POST["email"]   . "\r\n";
		$content .= "People: "   . $_POST["people"]  . "\r\n";
		$content .= "Date: "     . $_POST["date"]    . "\r\n";
		$content .= "Time: "     . $_POST["time"]    . "\r\n";
		$content .= "Message: "  . "\r\n" . $_POST["comment"];

		if (mail($to, $subject, $content, $header)) {
			// Auto Responder
			mail($_POST["email"], $subject, $autoReply, $header);
			$result = array(
				"message"    => "Your booking has been submitted. Check your email.",
				"sendstatus" => 1
			);
			echo json_encode($result);
		} else {
			$result = array(
				"message"    => "Sorry, something is wrong.",
				"sendstatus" => 0
			);
			echo json_encode($result);
		}

	}

?>
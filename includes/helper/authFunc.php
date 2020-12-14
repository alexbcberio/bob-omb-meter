<?php

define("USERS_XML_PATH", realpath(__DIR__ . "/../../xml/users.xml"));

function initXML() {
	$xml = fopen(__DIR__ . "/../../xml/users.xml", "w");
	fwrite($xml, "<?xml version=\"1.0\"?><users></users>");
	fclose($xml);
}

function openXML() {
  if (!file_exists(USERS_XML_PATH)) {
    initXML();
  }
  return simplexml_load_file(USERS_XML_PATH);
}

function formatXml($simpleXMLElement) {
  $xmlDocument = new DOMDocument('1.0');
  $xmlDocument->preserveWhiteSpace = false;
  $xmlDocument->formatOutput = true;
  $xmlDocument->loadXML($simpleXMLElement->asXML());

  return $xmlDocument->saveXML();
}

function saveXML($xml) {
  $xmlFormatted = new SimpleXMLElement(formatXml($xml));
  $xmlFormatted->asXML(USERS_XML_PATH);
}

function addUser($email, $pass) {
		$users = openXML();

		foreach ($users as $user) {
			if ($user->email == $email) {
				return false;
			}
		}

		$XMLuser = $users->addChild('user');
		$XMLuser->addChild('email', $email);
		$XMLuser->addChild('pass', password_hash($pass, PASSWORD_DEFAULT));

		saveXML($users);

		return true;
}

function checkUser($email, $pass) {
	$users = openXML();

	foreach ($users as $user) {
		if ($user->email == $email) {
			return password_verify($pass, $user->pass);
		}
	}

	return false;
}
?>
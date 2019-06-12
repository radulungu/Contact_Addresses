<?php
use JeroenDesloovere\VCard\VCard;

$list = unserialize(urldecode($_GET['data']));

if (isset($_GET['type'])) {

	$type = $_GET['type'];

	if ($type == 'csv') {

		function array2csv(array &$array)
		{
		   if (count($array) == 0) {
			 return null;
		   }
		   ob_start();
		   $df = fopen("php://output", 'w');
		   fputcsv($df, array_keys(reset($array)));
		   foreach ($array as $row) {
			  fputcsv($df, $row);
		   }
		   fclose($df);
		   return ob_get_clean();
		}

		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=file.csv");
		header("Content-Transfer-Encoding: binary");

		echo array2csv($list);

	}elseif ($type == 'vcard') {

		class VcardExport
		{

			public function contactVcardExportService($contactResult)
			{
				require_once 'vendor/Behat-Transliterator/Transliterator.php';
				require_once 'vendor/jeroendesloovere-vcard/VCard.php';
				// define vcard
				$vcardObj = new VCard();

				// add personal data
				$vcardObj->addName($contactResult[0]["first_name"] . " " . $contactResult[0]["last_name"]);
				$vcardObj->addBirthday($contactResult[0]["age"]);
				$vcardObj->addEmail($contactResult[0]["email"]);
				$vcardObj->addPhoneNumber($contactResult[0]["phone_number"]);
				$vcardObj->addAddress($contactResult[0]["web_address"]);
				
				return $vcardObj->download();
			}
		}

		$vcard = new VcardExport;
		$vcard->contactVcardExportService($list);
		
	}elseif ($type == 'atom') {
		
		header("Content-Type: text/plain");
		require "DOM_Helper.php";
		
		function makeAtom($atom, $feed, $results) {

			foreach($results as $result) {
				
					$name = $result["first_name"];
				$last_name = $result["last_name"];
				$link = "http://localhost:8181/" . "?id=" . $result["id"];
				$id = $result["id"];
				$age = $result["age"];
				$phone = $result["phone_number"];
				$descriere = $result["email"] ." ". $result["city"]   ." ". $result["phone_number"];
				$entry = myCreateChild($atom, $feed, "entry");
				$title = myCreateEntry($atom, $entry, "name", $last_name . " " . $name);
				$id = myCreateEntry($atom, $entry, "id", $id);
				$phone = myCreateEntry($atom, $entry, "phone", $phone);
				$age = myCreateEntry($atom, $entry, "age", $age);
				$summary = myCreateEntry($atom, $entry, "summary", $descriere);
			}
				
		}
		
		#init atom
		$atom = new DOMDocument('1.0', 'utf-8');
		$atom->formatOutput = true;
		#creare feed
		$feed = myCreateChild($atom, $atom, "feed");
		#creare header
		myCreateEntry($atom, $feed, "title", "My contacts");


		
		$results = $list;
		
		makeAtom($atom, $feed, $results);
		
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=file.xml");
		header("Content-Transfer-Encoding: binary");
		echo $atom->saveXML();

		
	}
	
	exit;
	
}

?>
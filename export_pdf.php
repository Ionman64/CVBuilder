<?php
	function GUID() {
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	$html = isset($_POST["html"]) ? $_POST["html"] : die (json_encode(array("success"=>false)));
	
	require_once '../thirdParty/mpdf60/mpdf.php';
	$mpdf = new Mpdf();
	$mpdf->setTitle("cv.pdf");
	$mpdf->WriteHTML(file_get_contents('css/paper.css'),1);
	$mpdf->WriteHTML('<section page-num="1" class="sheet">' . $html . '</section>');
	$guid = GUID();
	$mpdf->Output("pdf/$guid.pdf");
	die (json_encode(array("success"=>true, "guid"=>$guid)));
?>

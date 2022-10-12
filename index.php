<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" fileContent="IE=edge">
    <meta name="viewport" fileContent="width=device-width, initial-scale=1.0">
    <title>csvToJson</title>
</head>
<body>
<form enctype="multipart/form-data" method="POST">
    CSV file: <input name="userfile" type="file" accept=".csv" />
    <input type="submit" value="Send File" />
</form>

<?php

if (isset($_FILES['userfile']['tmp_name'])) {



$fileToConvert = file_get_Contents($_FILES['userfile']['tmp_name']  , true);

$fileContent = array_map("str_getcsv", explode("\n", $fileToConvert));

$headers = $fileContent[0];

echo csvToJson($fileContent, $headers); }

function csvToJson($fileContent, $headers) {

$json = [];

 foreach ($fileContent as $row_index => $row_data) {
	if($row_index === 0) continue;

	foreach ($row_data as $col_idx => $col_val) {
		$label = $headers[$col_idx];
		$json[$row_index][$label] = $col_val;
	}
}

return json_encode($json, JSON_PRETTY_PRINT);

}


//}

?>
</body>
</html>

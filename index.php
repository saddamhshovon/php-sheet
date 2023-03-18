<?php 

require __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new \Google\Client();
$client->setApplicationName('PHP_SHEET');
$client->setScopes([\Google\Service\Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/auth.json');

$service = new \Google\Service\Sheets($client);
$spreadsheetId = $_ENV["SHEET_ID"];

$range = "php-sheet"; // Sheet name

$values = [
	['Test', 'One'],
];

$body = new \Google\Service\Sheets\ValueRange([
	'values' => $values
]);

$params = [
	'valueInputOption' => 'RAW'
];

$result = $service->spreadsheets_values->append(
	$spreadsheetId,
	$range,
	$body,
	$params
);

if($result->updates->updatedRows == 1){
	echo "Success";
} else {
	echo "Fail";
}
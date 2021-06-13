<?php declare(strict_types=1);

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Template Name: Page Invoice Api
 */

use Recurly\Service\InvoiceService;

if(array_key_exists('sha', $_GET) === false) {
	exit;
}

$data = base64_decode( $_GET['sha']);

if($data === false) {
	exit;
}

$data = json_decode($data, true);

if($data === null) {
	exit;
}

$fileName = $data['fileName'] ?? null;
$userId   = $data['userId'] ?? null;

if($fileName === null || $userId === null) {
	exit;
}

if($userId !== wp_get_current_user()->ID) {
	exit;
}

$filePath = (new InvoiceService)->generateInvoicePdfUrl($fileName);

header("Content-type:application/pdf");
// It will be called downloaded.pdf
header("Content-Disposition:attachment;filename=downloaded.pdf");
// The PDF source is in original.pdf
readfile($filePath);

<?php

namespace App;


use Exception;
use PHPZxing\PHPZxingDecoder;
use PHPZxing\ZxingBarNotFound;
use PHPZxing\ZxingImage;

class BarcodeScanner
{
    public function scan(string $imagePath) : ScanResult
    {
        try {
            $decoder = new PHPZxingDecoder();

            $decodedData = current($decoder->decode($imagePath));

            if ($decodedData instanceof ZxingImage) {
                return ScanResult::barcode($decodedData->getImageValue(), $decodedData->getType(), $decodedData->getFormat());
            }

            if ($decodedData instanceof ZxingBarNotFound) {
                return ScanResult::error($decodedData->getErrorMessage());
            }

            return ScanResult::error(print_r($decodedData, true));
        } catch (Exception $exception) {
            return ScanResult::error($exception->getMessage());
        }
    }
}

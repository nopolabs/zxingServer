<?php

namespace App;


use PHPZxing\PHPZxingDecoder;
use PHPZxing\ZxingBarNotFound;
use PHPZxing\ZxingImage;

class IsbnScanner
{
    public function scan(string $imagePath) : ScanResult
    {
        $decoder = new PHPZxingDecoder();
        $decodedData = current($decoder->decode($imagePath));

        if ($decodedData instanceof ZxingImage) {
            return ScanResult::isbn($decodedData->getImageValue(), $decodedData->getType(), $decodedData->getFormat());
        }

        if ($decodedData instanceof ZxingBarNotFound) {
            return ScanResult::error($decodedData->getErrorMessage());
        }

        return ScanResult::error(print_r($decodedData, true));
    }
}

<?php

namespace app;


class ScanResult
{
    private $code;
    private $type;
    private $format;
    private $errorMessage;

    public static function barcode(string $code, string $type, string $format) : ScanResult
    {
        $result = new self();
        $result->code = $code;
        $result->type = $type;
        $result->format = $format;

        return $result;
    }

    public static function error(string $message) : ScanResult
    {
        $result = new self();
        $result->errorMessage = $message;

        return $result;
    }

    public function isSuccess() : bool
    {
        return $this->code !== null;
    }

    public function isFailure() : bool
    {
        return $this->code === null;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function toArray() : array
    {
        if ($this->isSuccess()) {
            return [
                'code' => $this->getCode(),
                'type' => $this->getType(),
                'format' => $this->getFormat(),
            ];
        }

        return ['errorMessage' => $this->getErrorMessage()];
    }

    public function toJson() : string
    {
        return json_encode($this->toArray());
    }
}
<?php


namespace App\Service\Normalizer;


class JsonEncoder extends Encoder
{
    public function encode(array $data) : string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getExtension() : string
    {
        return 'json';
    }
}
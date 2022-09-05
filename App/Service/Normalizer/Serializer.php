<?php


namespace App\Service\Normalizer;


class Serializer
{
    /**  @var Normalizer */
    private $normalizer;

    /** @var Encoder */
    private $encoder;

    public function __construct(Normalizer $normalizer, Encoder $encoder)
    {
        $this->normalizer = $normalizer;
        $this->encoder = $encoder;
    }

    public function encode(array $data) : string
    {
        return $this->encoder->encode($data);
    }

    public function normalize(array $data) : array
    {
        return $this->normalizer->normalize($data);
    }

    public function getExtension() : string
    {
        return $this->encoder->getExtension();
    }

    public function serialize($data) : string
    {
        return $this->encode($this->normalize($data));
    }
}
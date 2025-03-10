<?php

namespace App\Factories;

class ParserFactory
{
    protected array $parsers;

    public function __construct(array $parsers)
    {
        $this->parsers = $parsers;
    }

    public function getParser(string $format)
    {
        return $this->parsers[$format] ?? null;
    }
}

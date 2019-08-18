<?php

namespace Supermetrics\Service;

use Supermetrics\Service\Interfaces\MetricsCalculator;
use Supermetrics\ValueObject\Post;

class JsonOutput implements \JsonSerializable
{
    /**
     * @var array
     */
    private $data;

    /**
     * JsonOutput constructor.
     *
     * @param array ...$data
     */
    public function __construct(array ...$data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $output = [];

        foreach ($this->data as $metrics){
            $output[$metrics['type']] = $metrics['data'];
        }

        return $output;
    }}
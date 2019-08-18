<?php

namespace Supermetrics\Service\Interfaces;

interface MetricsCalculator
{
    public function calculate();
    public function getType();
}
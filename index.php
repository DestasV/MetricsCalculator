<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Exception\GuzzleException;
use Supermetrics\Client\Client;
use Supermetrics\Service\DataFetcher;
use Supermetrics\Service\JsonOutput;
use Supermetrics\Service\MonthlyMetricsCalculator;
use Supermetrics\Service\WeeklyMetricsCalculator;
use Supermetrics\ValueObject\User;

$client = new Client('https://api.supermetrics.com');
$user = new User('ju16a6m81mhid5ue1z3v2g0uh', 'Your Name', 'your@email.address');
$dataFetcher = new DataFetcher($client, $user);

try {
    $posts = $dataFetcher->fetchPosts();
    $monthlyMetricsCalculator = new MonthlyMetricsCalculator($posts);
    $weeklyMetricsCalculator = new WeeklyMetricsCalculator($posts);
    $output = new JsonOutput(
        ['type' => $monthlyMetricsCalculator->getType(), 'data' => $monthlyMetricsCalculator->calculate()],
        ['type' => $weeklyMetricsCalculator->getType(), 'data' => $weeklyMetricsCalculator->calculate()]
    );

    echo json_encode($output->jsonSerialize());
} catch (Exception $e) {
    echo $e->getMessage();
} catch (GuzzleException $e) {
    echo $e->getMessage();
}
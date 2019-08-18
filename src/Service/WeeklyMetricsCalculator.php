<?php

namespace Supermetrics\Service;

use Supermetrics\Service\Interfaces\MetricsCalculator;
use Supermetrics\ValueObject\Post;

/**
 * Class WeeklyMetricsCalculator
 */
class WeeklyMetricsCalculator implements MetricsCalculator
{
    private const WEEKLY = 'weekly';

    /**
     * @var Post[]
     */
    private $posts;

    /**
     * WeeklyMetricsCalculator constructor.
     *
     * @param array $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @return array
     */
    public function calculate(): array
    {
        $metrics = [
            'totalPostByWeek' => [],
        ];

        foreach ($this->posts as $post) {
            $week = $post->getCreatedAt()->format('YW');
            if (!array_key_exists($week, $metrics['totalPostByWeek'])) {
                $metrics['totalPostByWeek'][$week] = 1;
            } else {
                $metrics['totalPostByWeek'][$week] += 1;
            }
        }

        return $metrics;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::WEEKLY;
    }

}
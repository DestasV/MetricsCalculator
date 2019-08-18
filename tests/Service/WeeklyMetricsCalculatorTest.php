<?php

namespace Supermetrics\Tests\Service;

use PHPUnit\Framework\TestCase;
use Supermetrics\Service\WeeklyMetricsCalculator;
use Supermetrics\ValueObject\Post;

class WeeklyMetricsCalculatorTest extends TestCase
{
    public function testCalculatesReturnCorrectMetrics(): void
    {
        $post1 = new Post(
          'post_1',
          'user_1',
          'user_name',
          'status',
          new \DateTime('2019-01-01'),
            'test_message_1'
        );

        $post2 = new Post(
            'post_2',
            'user_1',
            'user_name',
            'status',
            new \DateTime('2019-01-02'),
            'test_message_1'
        );

        $post3 = new Post(
            'post_3',
            'user_1',
            'user_name',
            'status',
            new \DateTime('2019-01-09'),
            'test_message_1'
        );

        $weeklyMetricsCalculator = new WeeklyMetricsCalculator([$post1, $post2, $post3]);

        $this->assertSame(2, $weeklyMetricsCalculator->calculate()['totalPostByWeek']['201901']);
        $this->assertSame(1, $weeklyMetricsCalculator->calculate()['totalPostByWeek']['201902']);
    }
}
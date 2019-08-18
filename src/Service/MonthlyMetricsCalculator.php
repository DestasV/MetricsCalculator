<?php

namespace Supermetrics\Service;

use Supermetrics\Service\Interfaces\MetricsCalculator;
use Supermetrics\ValueObject\Post;

/**
 * Class MonthlyMetricsCalculator
 */
class MonthlyMetricsCalculator implements MetricsCalculator
{
    private const MONTHLY = 'monthly';

    /**
     * @var Post[]
     */
    private $posts;

    /**
     * MonthlyMetricsCalculator constructor.
     *
     * @param array $posts
     */
    public function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    public function calculate(): array
    {
        $metrics = [
            'averageCharacterLengthPerPost' => [],
            'postsPerMonth' => [],
            'longestPostByCharacterLength' => [],
            'averageNumberOfPostsPerUser' => [],
        ];

        foreach ($this->posts as $post) {
            $month = $post->getCreatedAt()->format('Y-m');
            $metrics = $this->calculateCharacterLengthPerPost($month, $metrics, $post);
            $metrics = $this->calculateLongestPostByCharacterLength($month, $metrics, $post);
            $metrics = $this->calculateNumberOfPostsPerUser($post, $metrics);
        }

        $metrics = $this->calculateAverageCharacterLengthPerPost($metrics);
        $metrics = $this->calculateAverageNumerOfPostPerUser($metrics);
        unset($metrics['postsPerMonth']);

        return $metrics;
    }

    /**
     * @param array $metrics
     *
     * @return array
     */
    private function calculateAverageCharacterLengthPerPost(array $metrics): array
    {
        foreach ($metrics['averageCharacterLengthPerPost'] as $key => $value) {
            $metrics['averageCharacterLengthPerPost'][$key] = round($value / $metrics['postsPerMonth'][$key]);
        }

        return $metrics;
    }

    /**
     * @param array $metrics
     *
     * @return array
     */
    private function calculateAverageNumerOfPostPerUser(array $metrics): array
    {
        foreach ($metrics['averageNumberOfPostsPerUser'] as $key => $userPostsCount) {
            $metrics['averageNumberOfPostsPerUser'][$key] = round(
                $userPostsCount / count($metrics['averageCharacterLengthPerPost'])
            );
        }

        return $metrics;
    }

    /**
     * @param string $month
     * @param array  $metrics
     * @param Post   $post
     *
     * @return array
     */
    private function calculateCharacterLengthPerPost(string $month, array $metrics, Post $post): array
    {
        if (!array_key_exists($month, $metrics['averageCharacterLengthPerPost'])) {
            $metrics['averageCharacterLengthPerPost'][$month] = strlen($post->getMessage());
        } else {
            $metrics['averageCharacterLengthPerPost'][$month] += strlen($post->getMessage());
        }

        if (!array_key_exists($month, $metrics['postsPerMonth'])) {
            $metrics['postsPerMonth'][$month] = 1;
        } else {
            $metrics['postsPerMonth'][$month] += 1;
        }

        return $metrics;
    }

    /**
     * @param string $month
     * @param array  $metrics
     * @param Post   $post
     *
     * @return array
     */
    private function calculateLongestPostByCharacterLength(string $month, array $metrics, Post $post): array
    {
        if (!array_key_exists($month, $metrics['longestPostByCharacterLength'])) {
            $metrics['longestPostByCharacterLength'][$month] = strlen($post->getMessage());
        } else {
            $metrics['longestPostByCharacterLength'][$month] < strlen($post->getMessage()) ?
                $metrics['longestPostByCharacterLength'][$month] = strlen($post->getMessage()) :
                $metrics['longestPostByCharacterLength'][$month];
        }

        return $metrics;
    }

    /**
     * @param Post  $post
     * @param array $metrics
     *
     * @return array
     */
    private function calculateNumberOfPostsPerUser(Post $post, array $metrics): array
    {
        if (!array_key_exists($post->getFromId(), $metrics['averageNumberOfPostsPerUser'])) {
            $metrics['averageNumberOfPostsPerUser'][$post->getFromId()] = 1;
        } else {
            $metrics['averageNumberOfPostsPerUser'][$post->getFromId()] += 1;
        }

        return $metrics;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::MONTHLY;
    }
}
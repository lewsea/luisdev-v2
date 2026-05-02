<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class GitHubPinned extends Composer
{
  /**
   * The username whose pinned repos we want.
   */
  protected const USERNAME = 'lewsea';

  /**
   * Cache key for the WordPress transient.
   */
  protected const CACHE_KEY = 'gh_recent_lewsea_v1';

  /**
   * Cache lifetime in seconds (1 hour).
   */
  protected const CACHE_TTL = 3600;

  /**
   * List of views served by this composer.
   *
   * @var array
   */
  protected static $views = [
    'partials.bento.github',
  ];

  /**
   * Data to be passed to the view.
   */
  public function with(): array
  {
    return [
      'repos' => $this->fetchPinnedRepos(),
    ];
  }

  /**
   * Common GitHub language colours (subset).
   */
  protected const LANGUAGE_COLORS = [
    'JavaScript' => '#f1e05a',
    'TypeScript' => '#3178c6',
    'PHP'        => '#4F5D95',
    'Python'     => '#3572A5',
    'CSS'        => '#563d7c',
    'HTML'       => '#e34c26',
    'Vue'        => '#41b883',
    'Rust'       => '#dea584',
    'Go'         => '#00ADD8',
    'Ruby'       => '#701516',
    'Swift'      => '#F05138',
    'Kotlin'     => '#A97BFF',
    'Java'       => '#b07219',
    'C#'         => '#178600',
    'C++'        => '#f34b7d',
    'Shell'      => '#89e051',
    'Blade'      => '#f7523f',
  ];

  /**
   * Fetch the 6 most-recently-pushed public repos via the GitHub REST API,
   * cached in a WordPress transient.
   *
   * Falls back to an empty array on error so the view degrades gracefully.
   */
  protected function fetchPinnedRepos(): array
  {
    $cached = get_transient(self::CACHE_KEY);
    if ($cached !== false) {
      return $cached;
    }

    $endpoint = 'https://api.github.com/users/' . self::USERNAME . '/repos?sort=pushed&direction=desc&per_page=6&type=public';

    $response = wp_remote_get($endpoint, [
      'timeout' => 5,
      'headers' => [
        'Accept'     => 'application/vnd.github+json',
        'User-Agent' => 'WordPress/' . get_bloginfo('version'),
      ],
    ]);

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
      set_transient(self::CACHE_KEY, [], 5 * MINUTE_IN_SECONDS);
      return [];
    }

    $body = wp_remote_retrieve_body($response);
    $raw  = json_decode($body, true);

    if (! is_array($raw)) {
      return [];
    }

    // Normalise GitHub REST shape → view shape.
    $data = array_map(function (array $item): array {
      $lang = $item['language'] ?? '';

      return [
        'name'          => $item['name'] ?? '',
        'url'           => $item['html_url'] ?? "https://github.com/" . self::USERNAME . "/" . ($item['name'] ?? ''),
        'description'   => $item['description'] ?? '',
        'language'      => $lang,
        'languageColor' => self::LANGUAGE_COLORS[$lang] ?? '#9eff00',
        'stars'         => $item['stargazers_count'] ?? 0,
        'forks'         => $item['forks_count'] ?? 0,
      ];
    }, $raw);

    set_transient(self::CACHE_KEY, $data, self::CACHE_TTL);

    return $data;
  }
}

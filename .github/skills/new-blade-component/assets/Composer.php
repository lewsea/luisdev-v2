<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class MyComponent extends Composer
{
  /**
   * List of views served by this composer.
   * Use dot-notation: 'components.my-component'
   *
   * @var array
   */
  protected static $views = [
    'components.my-component',
  ];

  /**
   * Each public method becomes a variable in the view.
   * e.g. $items is available in the template.
   */
  public function items(): array
  {
    return [];
  }
}

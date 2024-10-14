<?php

declare(strict_types=1);

namespace Drupal\custom_blogs;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a blogs entity type.
 */
interface BlogsInterface extends ContentEntityInterface, EntityChangedInterface {

}

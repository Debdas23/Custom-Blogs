<?php

declare(strict_types=1);

namespace Drupal\custom_blogs;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides a list controller for the blogs entity type.
 */
final class BlogsListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['id'] = $this->t('ID');
    $header['title'] = $this->t('Title');
    $header['description'] = $this->t('Description');
    $header['created'] = $this->t('Created');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\custom_blogs\BlogsInterface $entity */
    $url = Url::fromRoute('entity.custom_blogs_blogs.canonical', ['custom_blogs_blogs' => $entity->id()]);
    $link = Link::fromTextAndUrl($entity->get('title')->value, $url)->toString();

    $desc = Link::fromTextAndUrl(strip_tags($entity->get('description')->value), $url)->toString();

    $row['id'] = $entity->id();
    $row['title'] = $row['title'] = $link;
    $row['description'] = $desc;
    $row['created']['data'] = $entity->get('created')->view(['label' => 'hidden']);
    return $row + parent::buildRow($entity);
  }

}

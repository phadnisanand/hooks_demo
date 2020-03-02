<?php

namespace Drupal\servicedemo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\servicedemo\ApiDemoInterface;

/**
 * Provides a 'Api' Block.
 *
 * @Block(
 *   id = "api_block",
 *   admin_label = @Translation("Api Block"),
 *   category = @Translation("Api Block"),
 * )
 */
class ApiBlock extends BlockBase implements ContainerFactoryPluginInterface {


  /**
   * @var $account \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('servicedemo.api_demo')
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountProxyInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition,
  	AccountProxyInterface $account, ApiDemoInterface $api_obj) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
    $this->api_obj = $api_obj;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

        $items = array(
            'Cell 1',
            'Cell 2',
            'Cell 3',
        );

        $item_list = [
          '#theme' => 'service_event',
          '#items' => $items,
        ];
        $output = $item_list;

         /*$foo = array(
          '#type' => 'link',
          '#attributes' => array('id' => 'bar'),
          '#title' => t('My link'),
          '#href' => 'http://drupal.org',
          '#theme_wrappers' => array('container'), // Um... where do I set the #attributes for my container?
        );

        $output = \Drupal::service('renderer')->render($foo);
        die($output);*/
        return $output;
  
  }

}

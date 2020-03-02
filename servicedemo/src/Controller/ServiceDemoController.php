<?php

namespace Drupal\servicedemo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceDemoController extends ControllerBase {

  private $my_service;

  public static function create(ContainerInterface $container) {
    $my_service = $container->get('servicedemo.api_demo');
    return new static($my_service);
  }

  public function __construct($my_service) {
  	$this->my_service = $my_service;
  }

	public function outputTree() {

		   $serviceData = $this->my_service->getApiDataFromService();

       $items = array(
            'Cell 1',
            'Cell 2',
            'Cell 3',
        );

          // alter hook drupal 8
         \Drupal::moduleHandler()->alter('flot_examples_toc', $items);
      
          // hook drupal 8
        $items = \Drupal::moduleHandler()->invokeAll('flot_examples_toc',  array($items));

       
         // echo 'hi'; exit;
        $item_list = [
          '#theme' => 'service_event',
          '#events' => $items,
        ];

      

        //Turns a render array into a HTML string.
        $message = \Drupal::service('renderer')->render($item_list);
        \Drupal::messenger()->addStatus($message);

        return $item_list;
	}

}

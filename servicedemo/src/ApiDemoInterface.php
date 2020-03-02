<?php

namespace Drupal\servicedemo;


interface ApiDemoInterface {

	public function getApiDataFromService();

	public function getApiDataFromServiceInBlock();

	public function getApiDataFromServiceInPlugin();
}
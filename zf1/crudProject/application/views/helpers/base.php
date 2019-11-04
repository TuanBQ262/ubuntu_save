<?php
class Zend_view_Helper_BaseUrl {

      function baseUrl() {
      $fc = Zend_controller_front::getInstance();
      return $fc->getBaseUrl();
      }

}
<?php

class sfResourceSerializerJson extends sfResourceSerializer
{
  public function getContentType()
  {
    return 'application/json';
  }

  public function serialize($array, $rootNodeName = 'data', $collection = true)
  {
    $array = $this->_camelizeArray($array);
    return json_encode($array);
  }

  public function unserialize($payload)
  {
    $array = json_decode($payload, true);
    $array = $this->_uncamelizeArray($array);
    return $array;
  }

  protected function _camelizeArray($array)
  {
    foreach ($array as $key => $value)
    {
      unset($array[$key]);
      $key = $this->camelize($key);

      if (is_array($value)) {
        $array[$key] = $this->_camelizeArray($value);
      } else {
        $array[$key] = $value;
      }
    }

    return $array;
  }

  protected function _uncamelizeArray($array)
  {
    foreach ($array as $key => $value)
    {
      unset($array[$key]);
      $key = sfInflector::underscore($key);

      if (is_array($value)) {
        $array[$key] = $this->_uncamelizeArray($value);
      } else {
        $array[$key] = $value;
      }
    }

    return $array;
  }
}

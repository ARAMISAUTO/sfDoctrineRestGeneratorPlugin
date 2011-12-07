<?php

class sfResourceSerializerJson extends sfResourceSerializer
{
  public function getContentType()
  {
    return 'application/json';
  }

  public function serialize($array, $rootNodeName = 'data', $collection = true)
  {
    $array = $this->camelizeArray($array);
    return json_encode($array);
  }

  public function unserialize($payload)
  {
    return json_decode($payload, true);
  }

  protected function camelizeArray($array)
  {
    foreach ($array as $key => $value)
    {
      unset($array[$key]);
      $key = $this->camelize($key);

      if (is_array($value)) {
        $array[$key] = camelize($value);
      } else {
        $array[$key] = $value;
      }
    }

    return $array;
  }
}

  protected function redirectToShow($resourceId)
  {
    // Set a Location header with the path to the new / updated object
    $this->getResponse()->setHttpHeader('Location', $this->getController()->genUrl(
      array_merge(array(
        'sf_route' => '<?php echo $this->getModuleName(); ?>_show',
        'sf_format' => $this->getFormat(),
      ), $resourceId)
    ));

    return sfView::NONE;
  }

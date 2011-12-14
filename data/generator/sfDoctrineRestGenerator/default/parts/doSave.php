  protected function doSave()
  {
    $this->object->save();

    $this->dispatcher->notify(
      new sfEvent(
        $this->object,
        'sfDoctrineRestGenerator.<?php echo $this->getModuleName(); ?>.save.post'
      )
    );

    // Set a Location header with the path to the new / updated object
    $this->getResponse()->setHttpHeader('Location', $this->getController()->genUrl(
      array_merge(array(
        'sf_route' => '<?php echo $this->getModuleName(); ?>_show',
        'sf_format' => $this->getFormat(),
      ), $this->object->identifier())
    ));

    return sfView::NONE;
  }

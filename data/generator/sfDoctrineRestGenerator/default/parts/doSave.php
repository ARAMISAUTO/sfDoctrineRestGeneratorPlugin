  protected function doSave()
  {
    $this->object->save();

    $this->dispatcher->notify(
      new sfEvent(
        $this->object,
        'sfDoctrineRestGenerator.<?php echo $this->getModuleName(); ?>.save.post'
      )
    );
  }

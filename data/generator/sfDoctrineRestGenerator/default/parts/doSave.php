  protected function doSave()
  {
    $this->object->save();

    if ($this->_redirect)
    {
      return $this->redirectToShow($this->object->identifier());
    }
  }

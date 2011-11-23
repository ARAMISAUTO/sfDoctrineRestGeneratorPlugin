  /**
   * Returns the list of validators for an update request.
   * @return  array  an array of validators
   */
  public function getUpdateValidators()
  {
    return <?php echo $this->getUpdateValidatorsArray($this); ?>;
  }

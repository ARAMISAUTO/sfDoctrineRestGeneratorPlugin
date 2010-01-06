  /**
   * Returns the list of validators for a get request.
   * @return  array
   */
  public function getIndexValidators()
  {
  	$validators = array();
<?php foreach ($this->getColumns() as $column): ?>
    $validators['<?php echo $column->getFieldName() ?>'] = new <?php echo $this->getIndexValidatorClassForColumn($column) ?>(<?php echo $this->getIndexValidatorOptionsForColumn($column) ?>);
<?php endforeach; ?>
<?php
$pagination_custom_page_size = $this->configuration->getValue('get.pagination_custom_page_size');
$pagination_enabled = $this->configuration->getValue('get.pagination_enabled');
$max_items = $this->configuration->getValue('get.max_items'); ?>
<?php if ($pagination_enabled): ?>
    $validators['page'] = new sfValidatorInteger(array('min' => 1, 'required' => false));
<?php if ($pagination_custom_page_size && ($max_items > 0)): ?>
    $params = array(
      'min' => 1,
      'max' => <?php echo $max_items ?>,
      'required' => false
    );
    $validators['page_size'] = new sfValidatorInteger($params);
<?php endif; ?>
<?php endif; ?>
<?php $sort_enabled = $this->configuration->getValue('get.sort_enabled'); ?>
<?php if ($sort_enabled): ?>
    $validators['sort_by'] = new sfValidatorChoice(array('choices' => <?php echo var_export($this->table->getColumnNames()) ?>, 'required' => false));
    $validators['sort_order'] = new sfValidatorChoice(array('choices' => array('asc', 'desc'), 'required' => false));
<?php endif; ?>

    return $validators;
  }
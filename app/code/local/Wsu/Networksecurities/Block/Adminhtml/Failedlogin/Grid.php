<?php
class Wsu_Networksecurities_Block_Adminhtml_Failedlogin_Grid extends Mage_Adminhtml_Block_Widget_Grid {
  public function __construct() {
      parent::__construct();
      $this->setId('failedloginGrid');
      $this->setDefaultSort('created_at');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }
  protected function _prepareCollection() {
      $collection = Mage::getModel('wsu_networksecurities/failedlogin')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }
  protected function _prepareColumns() {  
      $this->addColumn('failedlogin_id', array(
          'header'    => Mage::helper('wsu_networksecurities')->__('Login ID'),
          'align'     =>'left',
          'index'     => 'failedlogin_id',
      ));
      $this->addColumn('password', array(
          'header'    => Mage::helper('wsu_networksecurities')->__('Password'),
          'align'     =>'left',
          'index'     => 'password',
      ));
      $this->addColumn('created_at', array(
          'header'    => Mage::helper('wsu_networksecurities')->__('Failed Date'),
          'align'     =>'left',
			'type' => 'datetime',
          'index'     => 'created_at',
      ));
      return parent::_prepareColumns();
  }
}
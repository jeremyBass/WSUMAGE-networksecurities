<?php
class Wsu_Networksecurities_Block_Adminhtml_Networksecurities_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	public function __construct() {
	parent::__construct();
		$this->setId('Blacklist');
		$this->setDefaultSort('created_at');
		$this->setDefaultDir('DESC');
		$this->setSaveParametersInSession(true);
	}
	protected function _prepareCollection() {
		$collection = Mage::getModel('wsu_networksecurities/blacklist')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns() {  
		$this->addColumn('blacklist_id', array(
		  'header'    => Mage::helper('wsu_networksecurities')->__('ID'),
		  'align'     =>'left',
		  'index'     => 'blacklist_id',
		));
		$this->addColumn('ip', array(
		  'header'    => Mage::helper('wsu_networksecurities')->__('IP'),
		  'align'     =>'left',
		  'index'     => 'ip',
		));
		$this->addColumn('log_at', array(
		  'header'    => Mage::helper('wsu_networksecurities')->__('Failed Date'),
		  'align'     =>'left',
		  'type' => 'datetime',
		  'index'     => 'log_at',
		));
		$this->addColumn('action',array(
			'header'    => Mage::helper('sales')->__('Actions'),
			'type'      => 'action',
			'getter'     => 'getId',
			'actions'   => array(
				array(
					'caption' => Mage::helper('sales')->__('Delete'),
					'url'     => array('base'=>'*/*/remove'),
					'confirm' => true
				),
			),
			'filter'    => false,
			'sortable'  => false,
			'is_system' => true,
		));
		return parent::_prepareColumns();
	}
}

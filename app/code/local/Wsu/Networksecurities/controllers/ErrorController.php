<?php

class Wsu_Networksecurities_ErrorController extends Mage_Core_Controller_Front_Action {
    public function indexAction() {
		//die("got to the error in _ErrorController");
        $this->loadLayout();
        $this->renderLayout();
    }
}

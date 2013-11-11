<?php
class Wsu_NetworkSecurities_Model_Customer_Observer {
    public function requireLogin($observer) {
        $helper = Mage::helper('wsu_networksecurities');
        $session = Mage::getSingleton('customer/session');

        if (!$session->isLoggedIn() && $helper->isLoginRequired()) {
            $controllerAction = $observer->getEvent()->getControllerAction();
            /* @var $controllerAction Mage_Core_Controller_Front_Action */
            $requestString = $controllerAction->getRequest()->getRequestString();

            if (!preg_match($helper->getWhitelist(), $requestString)) {
                $session->setBeforeAuthUrl($requestString);
                $controllerAction->getResponse()->setRedirect(Mage::getUrl('customer/account/login'));
                $controllerAction->getResponse()->sendResponse();
                exit;
            }
        }
    }
}
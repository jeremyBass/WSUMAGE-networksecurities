<?php
class Wsu_Networksecurities_Model_Sso_Myopenidlogin extends Mage_Core_Model_Abstract {
	public function newProvider() {
		try{
			require_once Mage::getBaseDir('base').DS.'lib'.DS.'OpenId'.DS.'openid.php';
		}catch(Exception $e) {}
		$openid = new LightOpenID(Mage::getUrl());       
		return $openid;
	}
	public function getOpenLoginUrl($identity) {
		$my_id = $this->newProvider();
        $my = $this->setOpenIdlogin($my_id,$identity);
		$loginUrl = $my->authUrl();
		return $loginUrl;
	}
	public function setOpenIdlogin($openid,$identity) {
        $openid->identity = "http://".$identity.".myopenid.com";
        $openid->required = array(
			'namePerson/first',
			'namePerson/last',
			'namePerson/friendly',
			'contact/email',
			'namePerson' 
        );
        $openid->returnUrl = Mage::getUrl('sociallogin/myopenidlogin/login');
		return $openid;
    }
}
  
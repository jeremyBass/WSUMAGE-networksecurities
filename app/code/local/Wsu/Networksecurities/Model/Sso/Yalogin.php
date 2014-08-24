<?php
class Wsu_Networksecurities_Model_Sso_Yalogin extends Mage_Core_Model_Abstract {
	public function __construct() {
		require Mage::getBaseDir('lib').DS.'Yahoo'.DS.'Yahoo.inc';
		error_reporting(E_ALL | E_NOTICE); # do not show notices as library is php4 compatable
		ini_set('display_errors', true);
		YahooLogger::setDebug(true);
		YahooLogger::setDebugDestination('LOG');
		
		// use memcache to store oauth credentials via php native sessions
		ini_set('session.save_handler', 'files');
		session_save_path('/tmp/');
		session_start();
		$request=Mage::app()->getRequest();
		if(isset($request->getParam('logout'))) {
			YahooSession::clearSession();
		}
	}
	
	public function hasSession() {
		$consumerKey = $this->getConsumerKey();
		$consumerSecret = $this->getConsumerSecret();
		$appId = $this->getAppId();
		return YahooSession::hasSession($consumerKey, $consumerSecret, $appId);
	}
	
	public function getAuthUrl() {
		$consumerKey = $this->getConsumerKey();
		$consumerSecret = $this->getConsumerSecret();
		$callback = YahooUtil::current_url().'?in_popup';
		return YahooSession::createAuthorizationUrl($consumerKey, $consumerSecret, $callback);
	}
	
	public function getSession() {
		$consumerKey = $this->getConsumerKey();
		$consumerSecret = $this->getConsumerSecret();
		$appId = $this->getAppId();
		return YahooSession::requireSession($consumerKey, $consumerSecret, $appId);
	}
	
	public function getConsumerKey() {
		return trim(Mage::getStoreConfig('wsu_networksecurities/yalogin/consumer_key'));
	}
	
	public function getConsumerSecret() {
		return trim(Mage::getStoreConfig('wsu_networksecurities/yalogin/consumer_secret'));
	}
	
	public function getAppId() {
		return trim(Mage::getStoreConfig('wsu_networksecurities/yalogin/app_id'));
	}
	
}
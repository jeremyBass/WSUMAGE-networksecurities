<?php
class Wsu_NetworkSecurities_Model_Cron extends Mage_Core_Model_Abstract
{
	public function deleteExpiredLog()
	{
		$failedlogintracker = Mage::getModel('wsu_networksecurities/failedloginlog');
		$failedlogintracker->deleteExpiredLog();
	}
}
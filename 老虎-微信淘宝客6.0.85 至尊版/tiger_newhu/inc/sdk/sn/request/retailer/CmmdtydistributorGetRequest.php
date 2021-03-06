<?php
/**
 * 苏宁开放平台接口 - 
 *
 * @author suning
 * @date   2018-11-30
 */
class CmmdtydistributorGetRequest  extends SuningRequest{
	
	/**
	 * 
	 */
	private $appId;
	
	/**
	 * 
	 */
	private $cmmdtyCode;
	
	/**
	 * 
	 */
	private $storeCode;
	
	/**
	 * 
	 */
	private $merchantCustNo;
	
	public function getAppId() {
		return $this->appId;
	}
	
	public function setAppId($appId) {
		$this->appId = $appId;
		$this->apiParams["appId"] = $appId;
	}
	
	public function getCmmdtyCode() {
		return $this->cmmdtyCode;
	}
	
	public function setCmmdtyCode($cmmdtyCode) {
		$this->cmmdtyCode = $cmmdtyCode;
		$this->apiParams["cmmdtyCode"] = $cmmdtyCode;
	}
	
	public function getStoreCode() {
		return $this->storeCode;
	}
	
	public function setStoreCode($storeCode) {
		$this->storeCode = $storeCode;
		$this->apiParams["storeCode"] = $storeCode;
	}
	
	public function getMerchantCustNo() {
		return $this->merchantCustNo;
	}
	
	public function setMerchantCustNo($merchantCustNo) {
		$this->merchantCustNo = $merchantCustNo;
		$this->apiParams["merchantCustNo"] = $merchantCustNo;
	}
	
	public function getApiMethodName(){
		return 'suning.retailer.distributorcode.get';
	}
	
	public function getApiParams(){
		return $this->apiParams;
	}
	
	public function check(){
		//非空校验
		RequestCheckUtil::checkNotNull($this->appId, 'appId');
		RequestCheckUtil::checkNotNull($this->cmmdtyCode, 'cmmdtyCode');
		RequestCheckUtil::checkNotNull($this->storeCode, 'storeCode');
		RequestCheckUtil::checkNotNull($this->merchantCustNo, 'merchantCustNo');
	}
	
	public function getBizName(){
		return "getCmmdtydistributor";
	}
	
}

?>
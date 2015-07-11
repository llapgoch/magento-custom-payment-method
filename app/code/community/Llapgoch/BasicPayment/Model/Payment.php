<?php
class Llapgoch_BasicPayment_Model_Payment extends Mage_Payment_Model_Method_Abstract{
	// Code to match up with the groups node in system.xml
	protected $_code = "llapgoch_pay";
	// This is the block that's displayed on the checkout
	protected $_formBlockType = 'llapgoch_basicpayment/form_pay';
	// This is the block that's used to add information to the payment info in the admin and previous
	// order screens
	protected $_infoBlockType = 'llapgoch_basicpayment/info_pay';
	
	
	// Use this to set whether the payment method should be available in only certain circumstances
	// This should only allow our payment method for over two items.
	public function isAvailable($quote = null){
		if(!$quote){
			return false;
		}
		
		if($quote->getAllVisibleItems() <= 2){
			return false;
		}
		
		return true;
	}
	
	// Errors are handled as a javascript alert on the client side
	// This method gets run twice - once on the quote payment object, once on the order payment object
	// To make sure the values come across from quote payment to order payment, use the config node sales_convert_quote_payment
    public function validate(){
       parent::validate();
	   
	   // This returns Mage_Sales_Model_Quote_Payment, or the Mage_Sales_Model_Order_Payment
       $info = $this->getInfoInstance();

       $no = $info->getCheckNo();
       $date = $info->getCheckDate();
	   
       if(empty($no) || empty($date)){
           Mage::throwException($this->_getHelper()->__('Check No and Date are required fields'));
       }
	   
	   if(strlen($no) < 5){
		   Mage::throwException($this->_getHelper()->__('Number must be five or more characters'));
	   }
       return $this;
   }
	   
}
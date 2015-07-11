<?php
// This block allows data along with the payment method to be presented on the admin screen and user order screen.
class Llapgoch_BasicPayment_Block_Info_Pay extends Mage_Payment_Block_Info{
    protected function _prepareSpecificInformation($transport = null)
       {
           if (null !== $this->_paymentSpecificInformation) {
               return $this->_paymentSpecificInformation;
           }
           $info = $this->getInfo();
           $transport = new Varien_Object();
           $transport = parent::_prepareSpecificInformation($transport);
           $transport->addData(array(
               Mage::helper('payment')->__('Check No#') => $info->getCheckNo(),
               Mage::helper('payment')->__('Check Date') => $info->getCheckDate()
           ));
           return $transport;
       }
}
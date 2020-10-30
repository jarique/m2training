<?php

namespace Training\CustomerPersonalSite\ViewModel;

class CustomerAttribute implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @param \Magento\Customer\Api\Data\CustomerInterface $customerData
     * @return mixed|string
     */
    public function getPersonalSite(\Magento\Customer\Api\Data\CustomerInterface $customerData)
    {
        $attribute = $customerData->getCustomAttribute('personal_site');
        if ($attribute) {
            return $attribute->getValue();
        }
        return '';
    }
}

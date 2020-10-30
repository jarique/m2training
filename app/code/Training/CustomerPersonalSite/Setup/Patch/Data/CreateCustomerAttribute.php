<?php

namespace Training\CustomerPersonalSite\Setup\Patch\Data;

class CreateCustomerAttribute implements
    \Magento\Framework\Setup\Patch\DataPatchInterface,
    \Magento\Framework\Setup\Patch\PatchRevertableInterface
{
    /** @var \Magento\Framework\Setup\ModuleDataSetupInterface */
    private $moduleDataSetup;

    /** @var \Magento\Customer\Setup\CustomerSetupFactory */
    private $customerSetupFactory;

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * @ingeritdoc
     */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $attributeName = 'personal_site';
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, $attributeName, [
            'type' => 'static',
            'label' => 'Personal Site URL',
            'input' => 'text',
            // add url validation rule twice in different format for utilizing by different forms
            'validate_rules' => '{"max_text_length":250,"input_validation":"url","validate-url":true}',
            'required' => false,
            'system' => false,
            'user_defined' => true,
            'group' => 'General',
            'unique' => true,
            'sort_order' => 300,
            'position' => 300
        ]);
        $attributeId = $customerSetup->getAttributeId(\Magento\Customer\Model\Customer::ENTITY, $attributeName);
        $this->moduleDataSetup->getConnection()
            ->insertMultiple($this->moduleDataSetup->getTable('customer_form_attribute'), [
                ['form_code' => 'adminhtml_customer', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_create', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_edit', 'attribute_id' => $attributeId]
            ]);
    }

    /**
     * @ingeritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @ingeritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Rollback all changes, done by this patch
     *
     * @ingeritdoc
     */
    public function revert()
    {}
}

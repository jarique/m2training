<?php

namespace Training\Test\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\Controller\Result\RawFactory */
    private $resultRawFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        // $this->getResponse()->appendBody('simple text');

        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setContents('simple text');

        return $resultRaw;
    }
}

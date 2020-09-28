<?php

namespace Training\Test\Controller\Action;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\LayoutFactory */
    private $layoutFactory;

    /** @var \Magento\Framework\Controller\Result\RawFactory */
    private $resultRawFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->resultRawFactory = $resultRawFactory;

        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock(\Magento\Framework\View\Element\Template::class);
        $block->setTemplate('Training_Test::test.phtml');

        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents($block->toHtml());
    }
}

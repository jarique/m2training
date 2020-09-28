<?php

namespace Training\Test\Controller\Block;

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
        $output = $this->layoutFactory->create()
            ->createBlock(\Training\Test\Block\Test::class)
            ->toHtml();
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents($output);
    }
}

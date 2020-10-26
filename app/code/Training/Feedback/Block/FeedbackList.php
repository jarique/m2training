<?php

namespace Training\Feedback\Block;

class FeedbackList extends \Magento\Framework\View\Element\Template
{
    const PAGE_SIZE = 3;

    /** @var \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory */
    private $collectionFactory;

    /** @var \Training\Feedback\Model\ResourceModel\Feedback\Collection */
    private $collection;

    /** @var \Magento\Framework\Stdlib\DateTime\Timezone */
    private $timezone;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
        \Magento\Framework\Stdlib\DateTime\Timezone $timezone,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;

        parent::__construct($context, $data);
    }

    /**
     * @return \Training\Feedback\Model\ResourceModel\Feedback\Collection
     */
    public function getCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('create_time', 'DESC');
        }
        return $this->collection;
    }

    /**
     * @return string
     */
    public function getPaginationHtml()
    {
        $pagerBlock = $this->getChildBlock('feedback_list_pager');
        if ($pagerBlock instanceof \Magento\Framework\DataObject) {
            /** @var \Magento\Theme\Block\Html\Pager $pagerBlock */
            $pagerBlock
                ->setUseContainer(false)
                ->setShowPerPage(false)
                ->setShowAmounts(false)
                ->setLimit($this->getLimit())
                ->setCollection($this->getCollection());
            return $pagerBlock->toHtml();
        }
        return '';
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return static::PAGE_SIZE;
    }

    /**
     * @return string
     */
    public function getAddFeedbackUrl()
    {
        return $this->getUrl('training_feedback/index/save');
    }

    /**
     * @param $feedback
     * @return false|string
     */
    public function getFeedbackDate($feedback)
    {
        return $this->timezone->formatDateTime($feedback->getCreateTime());
    }
}

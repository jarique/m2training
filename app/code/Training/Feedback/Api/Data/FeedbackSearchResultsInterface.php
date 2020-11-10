<?php

namespace Training\Feedback\Api\Data;

interface FeedbackSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Feedback list
     *
     * @return FeedbackInterface[]
     */
    public function getItems();

    /**
     * Set Feedback list
     *
     * @param FeedbackInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

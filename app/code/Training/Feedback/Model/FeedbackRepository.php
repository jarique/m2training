<?php

namespace Training\Feedback\Model;

class FeedbackRepository implements \Training\Feedback\Api\FeedbackRepositoryInterface
{
    /**
     * @var \Training\Feedback\Model\ResourceModel\Feedback
     */
    private $feedbackResource;

    /**
     * @var \Training\Feedback\Api\Data\FeedbackInterfaceFactory
     */
    private $feedbackFactory;

    /**
     * @var \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory
     */
    private $feedbackCollectionFactory;

    /**
     * @var \Training\Feedback\Api\Data\FeedbackSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource
     * @param \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory
     * @param \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory $feedbackCollectionFactory
     * @param \Training\Feedback\Api\Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory $feedbackCollectionFactory,
        \Training\Feedback\Api\Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    ) {
        $this->feedbackResource = $feedbackResource;
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackCollectionFactory = $feedbackCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save Feedback data
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Training\Feedback\Api\Data\FeedbackInterface $feedback)
    {
        try {
            $this->feedbackResource->save($feedback);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __('Could not save the feedback: %1', $exception->getMessage()),
                $exception
            );
        }
        return $feedback;
    }

    /**
     * Load Feedback data by given Feedback Identity
     *
     * @param int $feedbackId
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $feedbackId)
    {
        $feedback = $this->feedbackFactory->create();
        $this->feedbackResource->load($feedback, $feedbackId);
        if (!$feedback->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__(
                'Feedback with id "%1" does not exist.',
                $feedbackId
            ));
        }
        return $feedback;
    }

    /**
     * Load Feedback data collection by given search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Training\Feedback\Api\Data\FeedbackSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Training\Feedback\Model\ResourceModel\Feedback\Collection $collection */
        $collection = $this->feedbackCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        /** @var \Training\Feedback\Api\Data\FeedbackSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Feedback
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Training\Feedback\Api\Data\FeedbackInterface $feedback)
    {
        try {
            $this->feedbackResource->delete($feedback);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__(
                'Could not delete the feedback: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Feedback by given Feedback Identity
     *
     * @param int $feedbackId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $feedbackId)
    {
        return $this->delete($this->getById($feedbackId));
    }
}

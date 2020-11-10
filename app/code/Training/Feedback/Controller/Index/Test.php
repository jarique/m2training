<?php

namespace Training\Feedback\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    /** @var \Training\Feedback\Api\Data\FeedbackInterfaceFactory */
    private $feedbackFactory;

    /** @var \Training\Feedback\Api\FeedbackRepositoryInterface */
    private $feedbackRepository;

    /** @var \Magento\Framework\Api\SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var \Magento\Framework\Api\SortOrderBuilder */
    private $sortOrderBuilder;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory
     * @param \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        // Create new item
        $newFeedback = $this->feedbackFactory->create();
        $newFeedback->setAuthorName('Some author');
        $newFeedback->setAuthorEmail('some_author@domain.com');
        $newFeedback->setMessage('Some message');
        $newFeedback->setIsActive(1);
        $this->feedbackRepository->save($newFeedback);

        // Load item by id
        $feedback = $this->feedbackRepository->getById($newFeedback->getId());
        $this->printFeedback($feedback);

        // Delete item
        $this->feedbackRepository->deleteById($feedback->getId());

        // Load multiple items
        $this->searchCriteriaBuilder->addFilter('is_active', 1);

        $sortOrder = $this->sortOrderBuilder
            ->setField('message')
            ->setAscendingDirection()
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);
        foreach ($searchResult->getItems() as $item) {
            $this->printFeedback($item);
        }
        exit();
    }

    /**
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     */
    private function printFeedback(\Training\Feedback\Api\Data\FeedbackInterface $feedback)
    {
        echo $feedback->getId() . ' : '
            . $feedback->getAuthorName()
            . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
    }
}

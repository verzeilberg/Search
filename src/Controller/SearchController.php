<?php

namespace Search\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Authentication\Result;
use Laminas\Uri\Uri;

/**
 * This controller is responsible for letting the user to log in and log out.
 */
class SearchController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    private $searchService;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $searchService) {
        $this->entityManager = $entityManager;
        $this->searchService = $searchService;
    }

    /**
     * Authenticates user given email address and password credentials.     
     */
    public function indexAction() {
        $this->layout('layout/beheer');
        $searchPhrases = $this->searchService->getSearchPhrases();
        return new ViewModel([
            'searchPhrases' => $searchPhrases
        ]);
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('beheer/search');
        }
        if ($this->searchService->deleteSearchPhrase($id)) {
            $this->flashMessenger()->addSuccessMessage('Zoek zin verwijderd');
        } else {
            $this->flashMessenger()->addErrorMessage('Zoek zin niet verwijderd');
        }
        $this->redirect()->toRoute('beheer/search', array('action' => 'index'));
    }

}

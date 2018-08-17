<?php

namespace Search\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Search\Entity\Search;

class searchService implements searchServiceInterface {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    /**
     *
     * Save search phrase
     *
     * @param       searchPhrase  $searchPhrase
     * @param       type  $type
     * @return      boolean
     *
     */
    public function saveSearchPhrase($searchPhrase = NULL, $type = NULL) {
        if (!empty($searchPhrase) && !empty($type)) {

            $search = new Search();
            $search->setSearchPhrase($this->searchPhraseToLowerString($searchPhrase));
            $search->setCount(1);
            $search->setDateSearched(new \DateTime());
            $search->setType($type);

            try {
                $this->em->persist($search);
                $this->em->flush();
            } catch (Exception $e) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * Update search phrase
     *
     * @param       searchPhrase  $searchPhrase
     * @return      boolean
     *
     */
    public function updateSearchPhrase($searchPhrase = NULL) {
        if (!empty($searchPhrase)) {
            $id = $searchPhrase['s_id'];
            $search = $this->em->getRepository(Search::class)
                    ->findOneBy(['id' => $id], []);
            if (empty($search)) {
                return false;
            }
            $count = $search->getCount() + 1;
            $search->setCount($count);
            $search->setDateSearched(new \DateTime());
            $this->em->persist($search);
            $this->em->flush();
        } else {
            return false;
        }
    }

    /**
     *
     * Find search phrase
     *
     * @param       searchPhrase  $searchPhrase
     * @return      object
     *
     */
    public function findSearchPhrase($searchPhrase = NULL) {
        $searchPhrase = trim($searchPhrase);
        if (!empty($searchPhrase)) {
            $qb = $this->em->getRepository('Search\Entity\Search')->createQueryBuilder('s');
            $qb->where('s.searchPhrase = :searchPhrase');
            $qb->setParameter('searchPhrase', $searchPhrase);
            $query = $qb->getQuery();
            $single = $query->getScalarResult();

            if (empty($single)) {
                $this->saveSearchPhrase($searchPhrase, 'blog');
            } else {
                $this->updateSearchPhrase($single[0]);
            }

            return $single;
        } else {
            return false;
        }
    }

    /**
     *
     * Delete search phrase from database
     *
     * @param       id  $id
     * @return      boolean
     *
     */
    public function deleteSearchPhrase($id = NULL) {
        if ($id > 0) {
            $search = $this->em->getRepository(Search::class)
                    ->findOneBy(['id' => $id], []);
            if (empty($search)) {
                return false;
            }
            $this->em->remove($search);
            $this->em->flush();

            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * get search phrases
     *
     * @return      array
     *
     */
    public function getSearchPhrases() {
        $searchPhrases = $this->em->getRepository(Search::class)
                ->findBy([], ['dateSearched' => 'DESC']);
        if (!empty($searchPhrases)) {
            return $searchPhrases;
        } else {
            return null;
        }
    }

    /**
     *
     * get search phrases
     *
     * @return      array
     *
     */
    public function getSearchPhrasesForPaginator() {
        $searchPhrases = $this->em->getRepository('Search\Entity\Search')->createQueryBuilder('s');
        $searchPhrases->select('s');
        if (!empty($searchPhrases)) {
            return $searchPhrases;
        } else {
            return null;
        }
    }

    /**
     *
     * set search string to lower case
     * 
     * @param       searchPhrase  $searchPhrase
     * @return      string
     *
     */
    public function searchPhraseToLowerString($searchPhrase) {
        return strtolower($searchPhrase);
    }

}

<?php

namespace Search\Service;

interface searchServiceInterface {

    /**
     *
     * Save search phrase
     *
     * @param       searchPhrase  $searchPhrase
     * @param       type  $type
     * @return      boolean
     *
     */
    public function saveSearchPhrase($searchPhrase = NULL, $type = NULL);

    /**
     *
     * Update search phrase
     *
     * @param       searchPhrase  $searchPhrase
     * @return      boolean
     *
     */
    public function updateSearchPhrase($searchPhrase = NULL);

    /**
     *
     * Find search phrase
     *
     * @param       searchPhrase  $searchPhrase
     * @return      object
     *
     */
    public function findSearchPhrase($searchPhrase = NULL);

    /**
     *
     * Delete search phrase from database
     *
     * @param       id  $id
     * @return      boolean
     *
     */
    public function deleteSearchPhrase($id = NULL);

    /**
     *
     * get search phrases
     *
     * @return      array
     *
     */
    public function getSearchPhrases();

    /**
     *
     * get search phrases
     *
     * @return      array
     *
     */
    public function getSearchPhrasesForPaginator();

    /**
     *
     * set search string to lower case
     * 
     * @param       searchPhrase  $searchPhrase
     * @return      string
     *
     */
    public function searchPhraseToLowerString($searchPhrase);

}

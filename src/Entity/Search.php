<?php

namespace Search\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Form\Annotation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Searchprases
 *
 * @ORM\Entity
 * @ORM\Table(name="searchphrases")
 */
class Search {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, name="id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="search_phrase", type="string", length=255, nullable=false)
     */
    protected $searchPhrase;

    /**
     * @ORM\Column(name="count", type="integer", length=11, nullable=false)
     */
    protected $count;

    /**
     * @ORM\Column(name="date_searched", type="datetime", nullable=false)
     */
    protected $dateSearched;

    /**
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    protected $type;

    function getId() {
        return $this->id;
    }

    function getSearchPhrase() {
        return $this->searchPhrase;
    }

    function getCount() {
        return $this->count;
    }

    function getDateSearched() {
        return $this->dateSearched;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSearchPhrase($searchPhrase) {
        $this->searchPhrase = $searchPhrase;
    }

    function setCount($count) {
        $this->count = $count;
    }

    function setDateSearched($dateSearched) {
        $this->dateSearched = $dateSearched;
    }
    
    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }



}

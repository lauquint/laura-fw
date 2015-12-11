<?php
namespace Fw\Component\Search;

use Sphinx\SphinxClient;

//include '/var/lib/sphinx/api/sphinxapi.php';

final class Sphinx implements Search
{
    private $sphinx;

    public function __construct(SphinxClient $sphinx)
    {
        $this->sphinx = $sphinx;
    }

    public function SetLimits($page, $max_elements) {
        return $this->sphinx->SetLimits($page, $max_elements);
    }

    public function SetSortMode($mode, $sortby = '')
    {
        return $this->sphinx->SetSortMode($mode, $sortby);
    }

    public  function AddQuery($query, $index) {
        return $this->sphinx->AddQuery( $query, $index);
    }

    public function RunQueries() {
        return $this->sphinx->RunQueries();
    }

    public function getLastError() {
        return $this->sphinx->getLastError();
    }
    public function getLastWarning() {
        return $this->sphinx->getLastWarning();
    }

    public function setFilter($attribute, array $values, $exclude = false)
    {
        return $this->sphinx->setFilter($attribute, $values, $exclude);
    }
}
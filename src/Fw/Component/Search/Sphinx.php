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
        $this->sphinx->SetLimits($page, $max_elements);
    }

    public  function AddQuery($query, $index) {
        $this->sphinx->AddQuery( $query, $index);
    }

    public function RunQueries() {
        return $this->sphinx->RunQueries();
    }

    public function getLastError() {
        $this->sphinx->getLastError();
    }
    public function getLastWarning() {
        $this->sphinx->getLastWarning();
    }

}
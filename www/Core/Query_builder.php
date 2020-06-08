<?php 
namespace App\Core;

use App\Core\Connection\DBInterface;
use App\Core\Connection\PDOConnection;

class QueryBuilder
{
    private $select;
    private $from;
    private $where = [];
    private $group;
    private $order;
    private $limit;
    private $params;
    private $pdo;


    public function __construct(?PDOConnection $pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function select(string ...$fields): self {
        $this->select = $fields;
        return $this;
    }

    public function from (String  $table, string $alias): QueryBuilder
    {

    }

    public function wherre (String $conditions): QueryBuilder
    {

    }

    public function setParameter(string $key, string $values):QueryBuilder
    {

    }

    public function join(string $table, string $aliasTarget, string $fieldSource - "id", string $fieldTarget = "id"):QueryBuilder
    {
        
    }
}
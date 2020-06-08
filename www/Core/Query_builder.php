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

    public function from(string $table, ?string $alias = null): self {
        if($alias) {
            $this->from[$alias] = $table;
        } else {
            $this->from[] = $table;
        }

        return $this;
    }

    public function where(string ...$condition): self {
        $this->where = array_merge($this->where, $condition);
        return $this;
    }

public function count(): int {
        $this->select('COUNT(id)');
        return $this->getQuery()->getValueResult();
    }
public function getQuery() {
        $query = $this->__toString();
        return $this->pdo->query($query);
    }

    public function __toString()
    {
        $parts = ['SELECT'];

        if($this->select) {
            $parts[] = join(', ', $this->select);
        } else {
            $parts[] = '*';
        }

        $parts[] = 'FROM';
        $parts[] = $this->buildFrom();

        if(!empty($this->where)) {
            $parts[] = 'WHERE';
            $parts[] = '('. join(') AND (', $this->where) . ')' ;
        }

        return join(', ', $parts);
    }
}
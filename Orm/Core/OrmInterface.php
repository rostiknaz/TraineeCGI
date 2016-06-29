<?php
namespace Orm\Core;

interface OrmInterface
{
    /**
     * Insert data to db
    */
    public function create();
    public function find();
    public function where($statement);
    public function fetch($count = 'all');
    public function update($where);
    public function delete($where='');
}
<?php
namespace Orm\Core;

interface OrmInterface
{
    /**
     * Insert data to db
    */
//    public function create();
//    public function find();
//    public function where($statement);
//    public function fetch($count = 'all');
//    public function update($where);
//    public function delete($where='');
    /**
     * Load data from database.
     *
     * @param int|string $id Record Id.
     *
     * @return void
     */
    public function load($id);

    /**
     * Get record Id.
     *
     * @return int|string|null
     */
    public function getId();

    /**
     * Save record to database. If the record doesn't exist yet — add it.
     *
     * @return void
     */
    public function save();

    /**
     * Delete record from the database.
     *
     * @return void
     */
    public function delete();
}
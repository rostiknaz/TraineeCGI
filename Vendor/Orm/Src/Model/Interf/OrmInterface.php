<?php
namespace Orm\Interf;

/**
 * Declares methods of orm system
 */
interface OrmInterface
{
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
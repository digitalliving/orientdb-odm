<?php

namespace Doctrine\OrientDB\Query\Command\Vertex;

use Doctrine\OrientDB\Query\Command;

class Delete extends Command
{
    /**
     * @inheritdoc
     */
    public function __construct($from)
    {
        parent::__construct();

        $this->setClass($from);
    }

    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "DELETE VERTEX :Class :Where :Limit";
    }

    /**
     * Sets the query $class.
     *
     * @param string $class
     */
    protected function setClass($class)
    {
        $this->setToken('Class', $class);
    }

    /**
     * Sets the limit to the query.
     *
     * @param int $limit
     *
     * @return Delete
     */
    public function limit($limit)
    {
        $this->setTokenValues('Limit', [$limit], false, false);

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function getTokenFormatters()
    {
        return array_merge(parent::getTokenFormatters(), [
            'Limit' => 'Doctrine\OrientDB\Query\Formatter\Query\Limit',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function canHydrate()
    {
        return false;
    }
}

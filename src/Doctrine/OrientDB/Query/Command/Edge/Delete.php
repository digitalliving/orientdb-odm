<?php

namespace Doctrine\OrientDB\Query\Command\Edge;

use Doctrine\OrientDB\Query\Command;

class Delete extends Command
{

    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "DELETE EDGE :Where";
    }

    /**
     * @inheritdoc
     */
    public function canHydrate()
    {
        return false;
    }
}

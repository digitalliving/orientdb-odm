<?php

/*
 * This file is part of the Doctrine\OrientDB package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This class handles the SQL statement to remove an index from the DB.
 *
 * @package    Doctrine\OrientDB
 * @subpackage Query
 * @author     Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace Doctrine\OrientDB\Query\Command\Index;

use Doctrine\OrientDB\Query\Command\Index;
use Doctrine\OrientDB\Query\Formatter\Query\EmbeddedRid as EmbeddedRidFormatter;
use Doctrine\OrientDB\Query\Formatter\Query\TokenInterface;

class Remove extends Index
{
    /**
     * Remove constructor.
     *
     * @param string              $indexName
     * @param string              $key
     * @param string|null         $rid
     * @param TokenInterface|null $ridFormatter
     */
    public function __construct($indexName, $key, $rid = null, TokenInterface $ridFormatter = null)
    {
        parent::__construct();

        $ridFormatter = $ridFormatter ?: new EmbeddedRidFormatter;
        $this->setToken('Name', $indexName);

        if (!is_null($key)) {
            $this->where("key = ?", $key);
        }

        if ($rid) {
            $rid = $ridFormatter::format([$rid]);
            $method = $key ? 'andWhere' : 'where';

            $this->$method("rid = $rid");
        }
    }

    /**
     * @inheritdoc
     */
    protected function getSchema()
    {
        return "DELETE FROM index::Name :Where";
    }

    /**
     * Returns the formatters for this query's tokens.
     *
     * @return array
     */
    protected function getTokenFormatters()
    {
        return array_merge(parent::getTokenFormatters(), [
            'Name' => 'Doctrine\OrientDB\Query\Formatter\Query\Regular',
        ]);
    }
}

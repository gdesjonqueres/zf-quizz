<?php

namespace Quizz\Dictionnary;

use Quizz\Quizz;
use Quizz\DictionnaryEntry;
use Quizz\Dictionnary;

class File extends Dictionnary
{
    protected $_entries;

    protected $_index;

    /**
     * File adapter
     *
     * @var Quizz\Dictionnary\File\Adapter
     */
    protected $_adapter;

    function __construct($name, File\Adapter $adapter)
    {
        parent::__construct($name);

        $this->_adapter = $adapter;
        $this->_entries = new \ArrayObject();

        $data = $adapter->loadData();
        foreach ($data as $row) {
            $entry = new DictionnaryEntry(
                $row['compare'],
                $row['fulltext'],
                $row['translations']
            );
            $this->_entries[$entry->getWord()] = $entry;
            $this->_entries->ksort();
            $this->_index = array_keys((array) $this->_entries);
        }
    }

    /**
     * Look up for a word in the dictionnary
     * @param string $word
     * @throws \DomainException if word not found
     * @return DictionnaryEntry
     */
     public function lookupWord($word)
     {
        if (isset($this->_entries["$word"])) {
            return $this->_entries["$word"];
        }
        else {
            throw new \DomainException('Word not found');
        }
    }

    public function lookupWordRandomly()
    {
        $i = rand(0, count($this) - 1);
         return $this->_entries[$this->_index[$i]];
    }

    public function count()
    {
        return count($this->_entries);
    }

    public function getIterator()
    {
        return $this->_entries;
    }
}

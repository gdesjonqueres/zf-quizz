<?php

namespace Quizz;

/**
 * Class Quizz
 *
 * @package Quizz
 * @author Guillaume
 *
 */
class Quizz implements \Countable, \IteratorAggregate, \ArrayAccess
{
    /**
     * Time the quizz started
     *
     * @var unknown_type
     */
    protected $_timeStarted;

    /**
     * Time the quizz stopped
     *
     * @var unknown_type
     */
    protected $_timeStopped;

    /**
     * Set of quizz entries
     *
     * @var \ArrayObject
     */
    protected $_quizzSet;

    /**
     * Set of answers
     *
     * @var array
     */
    protected $_answers;

    /**
     * Results of the quizz
     *
     * @var int
     */
    protected $_mark;

    /**
     * Class Constructor. Create a new Quizz
     *
     * @param \ArrayObject $quizzset
     */
    public function __construct(\ArrayObject $quizzset = null)
    {
        if (null !== $quizzset) {
            $this->setQuizzSet($quizzset);
        } else {
            $this->_quizzSet = new \ArrayObject();
        }
    }

    /**
     * Set the quizz set
     *
     * @param \ArrayObject $quizzset
     * @return Quizz
     */
    public function setQuizzSet(\ArrayObject $quizzset)
    {
        $this->_quizzSet = $quizzset;
        return $this;
    }

    /**
     * Get the quizz set
     *
     * @return ArrayObject
     */
    public function getQuizzSet()
    {
        return $this->_quizzSet;
    }

    public function start()
    {
        return $this;
    }

    public function stop()
    {
        return $this;
    }

    /**
     * Set quizz answers
     *
     * @param array $answers
     * @return Quizz
     */
    public function setAnswers(array $answers)
    {
        $this->_answers = $answers;
        $this->_mark = null;
        return $this;
    }

    /**
     * Get quizz answers
     *
     * @return array:
     */
    public function getAnswers()
    {
        return $this->_answers;
    }

    /**
     * Get quizz mark
     *
     * @return number
     */
    public function getMark()
    {
        if (null !== $this->_mark) {
            return $this->_mark;
        } else {
            return $this->_getMark();
        }
    }

    /**
     * Calculate quizz mark
     *
     * @throws \DomainException
     * @return number
     */
    protected function _getMark()
    {
        if (is_null($this->_answers)) {
            throw new \DomainException('Answers not set');
        }
        $this->_mark = 0;
        foreach ($this as $i => $quizzEntry) {
            if ($quizzEntry->checkAnswer($this->_answers[$i])) {
                $this->_mark++;
            }
        }
        return $this->_mark;
    }

    public function count()
    {
        return count($this->_quizzSet);
    }

    public function getIterator()
    {
        return $this->_quizzSet;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_quizzSet[] = $value;
        } else {
            $this->_quizzSet[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->_quizzSet[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->_quizzSet[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->_quizzSet[$offset]) ? $this->_quizzSet[$offset] : null;
    }
}

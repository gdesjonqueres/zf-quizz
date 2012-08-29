<?php

namespace Quizz;

/**
 * Abstract Class for Dictionnary
 *
 * @package Quizz
 * @author Guillaume
 *
 */
abstract class Dictionnary implements \Countable, \IteratorAggregate
{
   /**
    * File adapter classes namespace
    *
    * @var string
    */
    const FILE_ADAPTERS_NS = "Dictionnary\\File\\Adapter";

    /**
     * Dictionnaries classes namespace
     *
     * @var string
     */
    const DICTIONNARIES_NS = "Dictionnary";

    /**
     * Dictionnary name
     *
     * @var string
     */
    protected $_name;

    /**
     * Class Constructor
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Dictionnary
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Look up for a word in the dictionnary
     *
     * @param string $word word to look for
     * @return DictionnaryEntry
     */
    abstract public function lookupWord($word);

    /**
     * Fetch a random word
     *
     * @return DictionnaryEntry
     */
    abstract public function lookupWordRandomly();

    /**
     * Factory to build some Dictionnaries
     *
     * @param array $type pair (dictionnary type => adapter name)
     * @param string $name name of the dictionnary
     * @param array $adapterArgs list of arguments to pass to the adapter constructor
     * @return Dictionnary
     */
    public static function factory(array $type, $name, array $adapterArgs = array())
    {
        $className = key($type);
        $adapterName = current($type);

        $fullClassName = __NAMESPACE__ . "\\" . self::DICTIONNARIES_NS . "\\" . $className;
        if (!class_exists($fullClassName)) {
            throw new \InvalidArgumentException("Class for $fullClassName not defined");
        }

        switch (strtolower($className)) {
            case 'file':
                $fullAdapterName = __NAMESPACE__ . "\\" . self::FILE_ADAPTERS_NS . "\\" . $adapterName;
                try {
                    $reflect = new \ReflectionClass($fullAdapterName);
                    $adapter = $reflect->newInstanceArgs($adapterArgs);
                    return new $fullClassName($name, $adapter);
                } catch (\ReflectionException $e) {
                    // no implementation yet
                }
                break;

            default:
                throw new \InvalidArgumentException("Dictionnary $className not handle");
        }
    }
}

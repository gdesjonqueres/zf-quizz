<?php

namespace Quizz;

/**
 * Class Dictionnary Entry
 *
 * @package Quizz
 * @author Guillaume
 *
 */
class DictionnaryEntry
{
    /**
     * Entry name
     *
     * @var string
     */
    protected $_word;

    /**
     * Sentence for defining the entry
     *
     * @var string
     */
    protected $_definition;

    /**
     * List of translations
     *
     * @var array
     */
    protected $_translations;

    /**
     * Class Constructor. Create new DictionnaryEntry
     *
     * @param string $word
     * @param string $definition
     * @param array $translations
     */
    public function __construct($word, $definition, array $translations)
    {
        $this->_word = $word;
        $this->_definition = $definition;
        $this->_translations = $translations;
    }

    /**
     * Get entry name
     *
     * @return string
     */
    public function getWord()
    {
        return $this->_word;
    }

    /**
     * Get entry definition
     *
     * @return string
     */
    public function getDefinition()
    {
        return $this->_definition;
    }

    /**
     * Get entry translations
     *
     * @return array
     */
    public function getTranslations()
    {
        return $this->_translations;
    }
}

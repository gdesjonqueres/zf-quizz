<?php

namespace Quizz;

/**
 * Class QuizzEntry
 *
 * @package Quizz
 * @author Guillaume
 *
 */
class QuizzEntry
{
    const DEFAULT_NUMBER_OF_PROPOSITIONS = 4;
    const DEFAULT_NUMBER_OF_ENTRIES = 10;

    /**
     * The entry in the dictionnary
     *
     * @var DictionnaryEntry
     */
    protected $_dictionnaryEntry;

    /**
     * Set of proposed translations
     *
     * @var array
     */
    protected $_propositions;

    /**
     * Class Constructor. Create a new QuizzEntry.
     *
     * @param DictionnaryEntry $dicEntry
     */
    public function __construct(DictionnaryEntry $dicEntry = null)
    {
        if ($dicEntry !== null) {
            $this->_dictionnaryEntry = $dicEntry;
        }
    }

    /**
     * Get the corresponding DictionnaryEntry
     *
     * @return DictionnaryEntry
     */
    public function getDictionnaryEntry()
    {
        return $this->_dictionnaryEntry;
    }

    /**
     * Get the set of propositions
     *
     * @return array
     */
    public function getPropositions()
    {
        return $this->_propositions;
    }

    /**
     * @param DictionnaryEntry $_dictionnaryEntry
     */
    public function setDictionnaryEntry(DictionnaryEntry $dictionnaryEntry)
    {
        $this->_dictionnaryEntry = $dictionnaryEntry;
        return $this;
    }

    /**
     * @param array $_propositions
     */
    public function setPropositions(array $propositions)
    {
        $this->_propositions = $propositions;
        return $this;
    }

    /**
     * Return true if the answer given is among the translations
     *
     * @param string $answer
     * @return boolean
     */
    public function checkAnswer($answer)
    {
        return in_array($answer, $this->getDictionnaryEntry()->getTranslations());
    }

    /**
     * Factory for a set of QuizzEntry
     *
     * @param Dictionnary $dic
     * @param array $options
     * @throws \InvalidArgumentException
     * @return \ArrayObject
     */
    public static function factoryMultiple(Dictionnary $dic, array $options = array())
    {
        if (array_key_exists('words', $options)) {
            if (!is_array($options['words']) && !empty($options['words'])) {
                throw new \InvalidArgumentException("Options key 'words' must reference an array");
            }
            $wordsSet = true;
        } else {
            $wordsSet = false;
        }

        $set = new \ArrayObject();
        if ($wordsSet) {
            foreach ($options['words'] as $word) {
                $set[] = self::factory($dic, array_merge($options, array('word' => $word)));
            }
        } else {
            if (array_key_exists('numberOfEntries', $options)) {
                $numberOfEntries = $options['numberOfEntries'];
            } else {
                $numberOfEntries = self::DEFAULT_NUMBER_OF_ENTRIES;
            }
            for ($i = 0; $i < $numberOfEntries; $i++) {
                $set[] = self::factory($dic, $options);
            }
        }
        return $set;
    }

    /**
     * Factory for a QuizsEntry
     *
     * @param Dictionnary $dic
     * @param array $options
     * @return QuizzEntry
     */
    public static function factory(Dictionnary $dic, array $options = array())
    {
        if (array_key_exists('word', $options)) {
            $dicEntry = $dic->lookupWord($options['word']);
        } else {
            $dicEntry = $dic->lookupWordRandomly();
        }
        $entry = new self($dicEntry);

        if (array_key_exists('numberOfPropositions', $options)) {
            $numberOfPropositions = (int) $options['numberOfPropositions'];
        } else {
            $numberOfPropositions = self::DEFAULT_NUMBER_OF_PROPOSITIONS;
        }

        $propositions = array(self::_getRandomTranslation($dicEntry));
        for ($i = 1; $i < $numberOfPropositions; $i++) {
            $propositions[] = self::_getRandomTranslation($dic->lookupWordRandomly());
        }
        shuffle($propositions);
        $entry->setPropositions($propositions);

        return $entry;
    }

    /**
     * Get a random translation of a DictionnaryEntry
     *
     * @param DictionnaryEntry $entry
     * @return string
     */
    private static function _getRandomTranslation(DictionnaryEntry $entry)
    {
        $translations = $entry->getTranslations();
        if (($count = count($translations)) > 1) {
            $i = rand(0, $count - 1);
            return $translations[$i];
        }
        return current($translations);
    }
}

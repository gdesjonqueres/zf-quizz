<?php

namespace Quizz\Dictionnary\File\Adapter;

use Quizz\Dictionnary\File\Adapter;

/**
 *
 * @author Guillaume
 *
 */
class Xml implements Adapter
{
    /**
     * File path pointer points to
     *
     * @var string
     */
    protected $_filePath;

    /**
     */
    function __construct($filepath)
    {
        $this->_filePath = $filepath;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Quizz\Dictionnary\File\Adapter::loadData()
     *
     */
    public function loadData()
    {
        $dictionnary = simplexml_load_file($this->_filePath);

        $data = array();
        foreach ($dictionnary as $entry) {
            $element = array(
                'compare'      => $entry->word,
                'fulltext'     => $entry->word,
                'translations' => array()
            );
            foreach ($entry->translations as $translation) {
                $element['translations'][] = $translation->translation;
            }
            $data[] = $element;
        }
        return $data;
    }
}

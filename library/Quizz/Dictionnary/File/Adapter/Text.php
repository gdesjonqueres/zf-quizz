<?php

namespace Quizz\Dictionnary\File\Adapter;

use Quizz\Dictionnary\File\Adapter;

class Text implements Adapter
{

    /**
     * File pointer
     *
     * @var resource
     */
    protected $_fp;

    /**
     * File path pointer points to
     *
     * @var string
     */
    protected $_filePath;

    public function __construct($filepath)
    {
        $this->_filePath = $filepath;
        $this->_fp         = new \SplFileObject($filepath, 'r');
    }

    /**
     * (non-PHPdoc) @see \Quizz\Dictionnary\File\Adapter::loadData()
     */
    public function loadData()
    {
        $entries = array();
        while (!$this->_fp->eof()) {
            if (trim($this->_fp->current()) != '') {
                @list($left, $right) = explode(';', trim($this->_fp->current()));
                $left  = trim($left);
                $right = trim($right);

                $entry = array('fulltext'       => $left,
                               'compare'        => preg_replace('/\[.*\]/u', '', $left),
                               'translations' => array());
                $right = explode(',', $right);
                foreach ($right as $trans) {
                    $entry['translations'][] = trim($trans);
                }

                $entries[] = $entry;
            }
            $this->_fp->next();
        }
        return $entries;
    }
}

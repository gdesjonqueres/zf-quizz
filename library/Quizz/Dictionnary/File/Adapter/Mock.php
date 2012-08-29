<?php

namespace Quizz\Dictionnary\File\Adapter;

use Quizz\Dictionnary\File\Adapter;

/**
 *
 * @author Guillaume
 *
 */
class Mock implements Adapter
{
    /**
     * (non-PHPdoc)
     *
     * @see \Quizz\Dictionnary\File\Adapter::loadData()
     *
     */
    public function loadData()
    {
        $entries = array(
            array('compare'         => 'ohayou',
                  'fulltext'        => 'ohayou',
                  'translations'    => array('bonjour')),
            array('compare'         => 'sayounara',
                  'fulltext'        => 'sayounara',
                  'translations'    => array('aurevoir'))
        );

        return $entries;
    }
}

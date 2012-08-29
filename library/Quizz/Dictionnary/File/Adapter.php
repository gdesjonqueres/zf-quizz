<?php

namespace Quizz\Dictionnary\File;

interface Adapter
{
    /**
     * Parse data
     *
     * @return array
     */
    public function loadData();
}

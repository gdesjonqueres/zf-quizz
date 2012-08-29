<?php

class QuizzController extends Zend_Controller_Action
{
    /**
     *
     * @var Quizz\Quizz
     */
    private $_quizz;


    public function init()
    {
        /* Initialize action controller here */
    }

    private function _initQuizz()
    {
        $namespace = new Zend_Session_Namespace();
        if (!isset($namespace->quizz)) {
            $dictionnary = Quizz\Dictionnary::factory(
                array('File' => 'Text'),
                'JapaneseToFrench',
                array(APPLICATION_PATH . '/../data/files/' . '[jlpt]_yonkyu_679_mots.txt')
            );
            $this->_quizz = new Quizz\Quizz(
                Quizz\QuizzEntry::factoryMultiple($dictionnary)
            );
            $namespace->quizz = $this->_quizz;
        } else {
            $this->_quizz = $namespace->quizz;
        }
    }

    public function quizzAction()
    {
        $this->_initQuizz();
        $this->view->quizz = $this->_quizz;

        $form = new Application_Form_Quizz($this->_quizz);
        $this->view->form = $form;

//         $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $data = $form->getValues();
                $values = array_values($data);
                $this->_quizz->setAnswers($values);
//                 $flashMessenger->addMessage('Your mark: ' . $this->_quizz->getMark() .
//                                             ' on ' . count($this->_quizz));
                $this->view->mark = 'Your mark: ' . $this->_quizz->getMark()
                                  . ' on ' . count($this->_quizz);

                $keys = array_keys($data);
                foreach ($keys as $i => $eltname) {
                    if ($this->_quizz[$i] InstanceOf Quizz\QuizzEntry
                        && $this->_quizz[$i]->checkAnswer($values[$i]) === false
                    ) {
                        $form->getElement($eltname)->addError(
                             'Answer: ' . implode(', ', $this->_quizz[$i]->getDictionnaryEntry()->getTranslations())
                        );
                    }
                }

                $namespace = new Zend_Session_Namespace();
                unset($namespace->quizz);
                $form->removeElement('submit');
            }
        }

//         if ($flashMessenger->hasMessages()) {
//             $this->view->messages = $flashMessenger->getMessages();
//         }
    }

    public function indexAction()
    {
        $this->_redirect('quizz/quizz');
    }
}

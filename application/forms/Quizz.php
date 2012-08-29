<?php

class Application_Form_Quizz extends Zend_Form
{

    /**
     *
     * @var Quizz\Quizz
     */
    protected $_quizz;

    public function __construct(Quizz\Quizz $quizz)
    {
        $this->_quizz = $quizz;
        parent::__construct();
    }

    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');
        $this->setDecorators(array(
                'FormElements',
                array('HtmlTag', array('tag' => 'ol')),
                'Form',
        ));

        $i = 0;
        foreach($this->_quizz as $quizzEntry) {
            $radio = new Zend_Form_Element_Radio(
                    "word[$i]",
                    array('label' => $quizzEntry->getDictionnaryEntry()->getWord(),
                          'required' => true)
            );
            $radio->setDecorators(array(
                    'ViewHelper',
                    'Errors',
                    array('HtmlTag', array('tag' => 'li')),
                    array(array('OlTag' => 'HtmlTag'), array('tag' => 'ul')),
                    array('Label', array('tag' => 'li', 'class' => 'word')),
            ));
            $radio->setSeparator('</li><li>');

            foreach ($quizzEntry->getPropositions() as $prop) {
                $radio->addMultiOption($prop, $prop);
            }
            $this->addElement($radio);
            $i++;
        }

        // Un bouton d'envoi
        $this->addElement('submit', 'submit', array(
                'ignore'   => true,
                'label'    => 'Get Mark',
        ));
    }
}

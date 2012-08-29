<?php

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * Quizz test case.
 */
class QuizzTest extends PHPUnit_Framework_TestCase
{
	
	/**
	 *
	 * @var Quizz\Quizz
	 */
	private $Quizz;

	/**
	 * 
	 * @var Dictionnary
	 */
	private $Dictionnary;
	
	/**
	 * 
	 * @var Quizz\DictionnaryEntry
	 */
	private $DictionnaryEntry;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();
		
		// TODO Auto-generated QuizzTest::setUp()
		
		$this->Quizz = new Quizz\Quizz(/* parameters */);
		
		$this->DictionnaryEntry = new Quizz\DictionnaryEntry('toto',
															 'tata',
														     array('tutu'));
		
		$this->Dictionnary = $this->getMockForAbstractClass('Quizz\\Dictionnary',
															array('lookupWordRandomly'));
		$this->Dictionnary->expects($this->any())->
							method('lookupWordRandomly')->
							withAnyParameters()->
							will($this->returnValue($this->DictionnaryEntry));
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated QuizzTest::tearDown()
		$this->Quizz = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct()
	{
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests Quizz->__construct()
	 */
	public function test__construct()
	{
		// TODO Auto-generated QuizzTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->Quizz->__construct(/* parameters */);
	}
	
	/**
	 * Tests Quizz->setQuizzSet()
	 */
	public function testSetQuizzSet()
	{
		// TODO Auto-generated QuizzTest->testSetQuizzSet()
		$this->markTestIncomplete ( "setQuizzSet test not implemented" );
		
		$this->Quizz->setQuizzSet(/* parameters */);
	}
	
	/**
	 * Tests Quizz->getQuizzSet()
	 */
	public function testGetQuizzSet()
	{
		// TODO Auto-generated QuizzTest->testGetQuizzSet()
		$this->markTestIncomplete ( "getQuizzSet test not implemented" );
		
		$this->Quizz->getQuizzSet(/* parameters */);
	}
	
	/**
	 * Tests Quizz->start()
	 */
	public function testStart()
	{
		// TODO Auto-generated QuizzTest->testStart()
		$this->markTestIncomplete ( "start test not implemented" );
		
		$this->Quizz->start(/* parameters */);
	}
	
	/**
	 * Tests Quizz->stop()
	 */
	public function testStop()
	{
		// TODO Auto-generated QuizzTest->testStop()
		$this->markTestIncomplete ( "stop test not implemented" );
		
		$this->Quizz->stop(/* parameters */);
	}
	
	/**
	 * Tests Quizz->setAnswers()
	 */
	public function testSetAnswers()
	{
		// TODO Auto-generated QuizzTest->testStop()
		$this->markTestIncomplete ( "stop test not implemented" );
		
		$this->Quizz->setAnswers(/* parameters */);
	}
	
	/**
	 * Tests Quizz->getMark()
	 */
	public function testGetMark()
	{
		$quizzset = new \ArrayObject(array(
						new Quizz\QuizzEntry(new Quizz\DictionnaryEntry('Good morning', '', array('Bonjour'))),
						new Quizz\QuizzEntry(new Quizz\DictionnaryEntry('Good bye', '', array('Aurevoir'))),
						new Quizz\QuizzEntry(new Quizz\DictionnaryEntry('Backpack', '', array('Sac à dos'))),));
		$this->Quizz->setQuizzSet($quizzset);
		$this->Quizz->setAnswers(array('Bonjour',
									   'Aurevoir',
									   'Sac à dos'));
		$this->assertEquals(3, $this->Quizz->getMark());
	}
	
	/**
	 * Tests Quizz->count()
	 */
	public function testCount()
	{
		// TODO Auto-generated QuizzTest->testCount()
		$this->markTestIncomplete ( "count test not implemented" );
		
		$this->Quizz->count(/* parameters */);
	}
	
	/**
	 * Tests Quizz->getIterator()
	 */
	public function testGetIterator()
	{
		// TODO Auto-generated QuizzTest->testGetIterator()
		$this->markTestIncomplete ( "getIterator test not implemented" );
		
		$this->Quizz->getIterator(/* parameters */);
	}
}


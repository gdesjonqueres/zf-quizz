<?php

use Quizz\Dictionnary;
use Quizz\QuizzEntry;
use Quizz\DictionnaryEntry;

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * QuizzEntry test case.
 */
class QuizzEntryTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var QuizzEntry
	 */
	private $QuizzEntry;
	
	/**
	 *
	 * @var Dictionnary
	 */
	private $Dictionnary;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->QuizzEntry = new QuizzEntry(/* parameters */);

		$this->Dictionnary = $this->getMockForAbstractClass('Quizz\\Dictionnary',
															array('lookupWordRandomly',
																  'lookupWord'));
		$this->Dictionnary->expects($this->any())->
									method('lookupWordRandomly')->
									withAnyParameters()->
									will($this->returnValue(new DictionnaryEntry(
																'toto',
																'tata',
																array('tutu'))
															));
		$this->Dictionnary->expects($this->any())->
									method('lookupWord')->
									withAnyParameters()->
									will($this->returnValue(new DictionnaryEntry(
																'titi',
																'tete',
																array('tyty'))
															));
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated QuizzEntryTest::tearDown()
		$this->QuizzEntry = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests QuizzEntry->getDictionnaryEntry()
	 */
	public function testGetDictionnaryEntry() {
		// TODO Auto-generated QuizzEntryTest->testGetDictionnaryEntry()
		$this->markTestIncomplete ( "getDictionnaryEntry test not implemented" );
		
		$this->QuizzEntry->getDictionnaryEntry(/* parameters */);
	}
	
	/**
	 * Tests QuizzEntry->getPropositions()
	 */
	public function testGetPropositions() {
		// TODO Auto-generated QuizzEntryTest->testGetPropositions()
		$this->markTestIncomplete ( "getPropositions test not implemented" );
		
		$this->QuizzEntry->getPropositions(/* parameters */);
	}
	
	/**
	 * Tests QuizzEntry->setDictionnaryEntry()
	 */
	public function testSetDictionnaryEntry() {
		// TODO Auto-generated QuizzEntryTest->testSetDictionnaryEntry()
		$this->markTestIncomplete ( "setDictionnaryEntry test not implemented" );
		
		$this->QuizzEntry->setDictionnaryEntry(/* parameters */);
	}
	
	/**
	 * Tests QuizzEntry->setPropositions()
	 */
	public function testSetPropositions() {
		// TODO Auto-generated QuizzEntryTest->testSetPropositions()
		$this->markTestIncomplete ( "setPropositions test not implemented" );
		
		$this->QuizzEntry->setPropositions(/* parameters */);
	}
	
	public function testCheckAnswer() {
	    $entry = new QuizzEntry();
	    $entry->setDictionnaryEntry(new DictionnaryEntry('toto',
														 'tata',
														 array('tutu', 'titi')));
	    $this->assertTrue($entry->checkAnswer('titi'));
	    $this->assertFalse($entry->checkAnswer('pepe'));
	}
	
	/**
	 * Tests QuizzEntry::factory()
	 */
	public function testFactory() {
		$entry = QuizzEntry::factory($this->Dictionnary);
		$this->assertInstanceOf('Quizz\\QuizzEntry', $entry);
		$this->assertCount(QuizzEntry::DEFAULT_NUMBER_OF_PROPOSITIONS, $entry->getPropositions());
		
		$entry = QuizzEntry::factory($this->Dictionnary, array('numberOfPropositions' => 3));
		$this->assertInstanceOf('Quizz\\QuizzEntry', $entry);
		$this->assertCount(3, $entry->getPropositions());
		
		$entry = QuizzEntry::factory($this->Dictionnary, array('word' => 'titi'));
		$this->assertInstanceOf('Quizz\\QuizzEntry', $entry);
		$this->assertEquals('titi', $entry->getDictionnaryEntry()->getWord());
	}
	
	/**
	 * Tests QuizzEntry::factoryMultiple()
	 */
	public function testFactoryMultiple() {
		
		$entries = QuizzEntry::factoryMultiple($this->Dictionnary);
		$this->assertCount(QuizzEntry::DEFAULT_NUMBER_OF_ENTRIES, $entries);
		
		$entries = QuizzEntry::factoryMultiple($this->Dictionnary,
											   array('words' => array('titi')));
		$this->assertCount(1, $entries);
		$this->assertEquals('titi',	$entries[0]->getDictionnaryEntry()->getWord());
		
		$entries = QuizzEntry::factoryMultiple($this->Dictionnary,
											   array('numberOfEntries' => 5));
		$this->assertCount(5, $entries);
		$this->assertEquals('toto',	$entries[0]->getDictionnaryEntry()->getWord());
	}
}


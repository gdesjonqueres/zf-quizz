<?php

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * DictionnaryEntry test case.
 */
class DictionnaryEntryTest extends PHPUnit_Framework_TestCase
{
	
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
		
		// TODO Auto-generated DictionnaryEntryTest::setUp()
		
		$this->DictionnaryEntry = new Quizz\DictionnaryEntry('toto', 'tata', array('titi', 'tutu'));
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated DictionnaryEntryTest::tearDown()
		$this->DictionnaryEntry = null;
		
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
	 * Tests DictionnaryEntry->getWord()
	 */
	public function testGetWord()
	{
		$this->assertEquals('toto', $this->DictionnaryEntry->getWord());
	}
	
	/**
	 * Tests DictionnaryEntry->getDefinition()
	 */
	public function testGetDefinition()
	{
		$this->assertEquals('tata', $this->DictionnaryEntry->getDefinition());
	}
	
	/**
	 * Tests DictionnaryEntry->getTranslations()
	 */
	public function testGetTranslations()
	{
		$this->assertEquals(array('titi', 'tutu'), $this->DictionnaryEntry->getTranslations());
	}
}


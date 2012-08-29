<?php

use Quizz\Dictionnary\File;
use Quizz\DictionnaryEntry;
use Quizz\Dictionnary\File\Adapter\Mock;

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * File test case.
 */
class FileTest extends PHPUnit_Framework_TestCase
{
	
	const TEST_FILE = "dico.txt";
	
	/**
	 *
	 * @var File
	 */
	private $File;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();

		$this->File = new File('dico', new Mock());
	}
	
	public function assertPreConditions()
	{
		$this->assertEquals($this->File->getName(), 'dico');
		$this->assertEquals(2, count($this->File));
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated FileTest::tearDown()
		$this->File = null;
		
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
	 * Tests File->__construct()
	 */
	public function test__construct()
	{
		// TODO Auto-generated FileTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->File->__construct(/* parameters */);
	}
	
	/**
	 * Tests File->setName()
	 */
	public function testSetName()
	{
		// TODO Auto-generated FileTest->testSetName()
		$this->markTestIncomplete ( "setName test not implemented" );
		
		$this->File->setName(/* parameters */);
	}
	
	/**
	 * Tests File->getName()
	 */
	public function testGetName()
	{
		// TODO Auto-generated FileTest->testGetName()
		$this->markTestIncomplete ( "getName test not implemented" );
		
		$this->File->getName(/* parameters */);
	}
	
	/**
	 * Tests File->lookupWord()
	 */
	public function testLookupWord()
	{
		$word = $this->File->lookupWord('ohayou');
		$this->assertInstanceOf('Quizz\\DictionnaryEntry', $word);
		$this->assertEquals('ohayou', $word->getWord());
		$this->assertContains('bonjour', $word->getTranslations());
	}
	
	/**
	 * Tests File->lookupWord()
	 */
	public function testLookupWordNotExistFails()
	{
		$this->setExpectedException('DomainException');
		$this->File->lookupWord('dfgdqdgf');
	}
	
	/**
	 * Tests File->lookupWordRandomly()
	 */
	public function testLookupWordRandomly()
	{
		$this->assertInstanceOf('Quizz\DictionnaryEntry',
							    $this->File->lookupWordRandomly());
	}
}


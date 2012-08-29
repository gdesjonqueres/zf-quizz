<?php

use Quizz\Dictionnary\File\Adapter\Text;

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * Text test case.
 */
class TextTest extends PHPUnit_Framework_TestCase
{
	const TEST_FILE = "dico.txt";
	
	/**
	 *
	 * @var Text
	 */
	private $Text;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp ();
		
		// TODO Auto-generated TextTest::setUp()
		
		$this->Text = new Text(_FILES_PATH . '/' . self::TEST_FILE, 'dico');
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		// TODO Auto-generated TextTest::tearDown()
		$this->Text = null;
		
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
	 * Tests Text->__construct()
	 */
	public function test__construct()
	{
		// TODO Auto-generated TextTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->Text->__construct(/* parameters */);
	}
	
	/**
	 * Tests Text->loadData()
	 */
	public function testLoadData()
	{	
		$data = $this->Text->loadData();
		$this->assertInternalType('array', $data);
		$entry = current($data);
		$this->assertArrayHasKey('compare', $entry);
		$this->assertArrayHasKey('fulltext', $entry);
		$this->assertArrayHasKey('translations', $entry);
		$this->assertInternalType('array', $entry['translations']);
		$this->assertEquals('ohayou', $entry['compare']);
		$this->assertEquals('ohayou', $entry['fulltext']);
		$this->assertContains('bonjour', $entry['translations']);
	}
}


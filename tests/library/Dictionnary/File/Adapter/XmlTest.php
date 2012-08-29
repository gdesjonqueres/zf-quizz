<?php

use Quizz\Dictionnary\File\Adapter\Xml;

require_once 'PHPUnit\Framework\TestCase.php';

/**
 * Xml test case.
 */
class XmlTest extends PHPUnit_Framework_TestCase
{
	const TEST_FILE = "japanese-french.xml";
	
	/**
	 *
	 * @var Xml
	 */
	private $Xml;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated XmlTest::setUp()
		
		$this->Xml = new Xml(_FILES_PATH . '/' . self::TEST_FILE);
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated XmlTest::tearDown()
		$this->Xml = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests Xml->__construct()
	 */
	public function test__construct() {
		// TODO Auto-generated XmlTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->Xml->__construct(/* parameters */);
	}
	
	/**
	 * Tests Xml->loadData()
	 */
	public function testLoadData() {
		$data = $this->Xml->loadData();
		$this->assertCount(1, $data);
		$this->assertEquals('Ohayou', $data[0]['compare']);
		$this->assertEquals('Bonjour (le matin)', $data[0]['translations'][0]);
	}
}


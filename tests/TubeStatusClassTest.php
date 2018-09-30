<?php
use PHPUnit\Framework\TestCase;
use IanLChapman\TubeStatus\TubeStatus;
use IanLChapman\TubeStatus\Entity as Entity;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use DateTime;

/**
*  Corresponding Class to test Tube Status class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Ian L Chapman
*/
class TubeStatusClassTest extends TestCase
{
	/**
	 * Tests if there is a syntax error with the Tube Status class
	 */
	public function testIsThereAnySyntaxError()
	{
		$var = new TubeStatus;
		$this->assertTrue(is_object($var));
		unset($var);
	}

	/**
	 * Tests if the data processing functionality works - note we are mocking the TFL request
	 */
	public function testCanGetTubeStatus()
	{
		// Mock the guzzle client
		$mock = new MockHandler([new Response(200, [], file_get_contents(__DIR__ . '/Mock/response.json'))]);
		$handler = HandlerStack::create($mock);
		$client = new Client(['handler' => $handler]);

		$var = new TubeStatus;
		$var->setApplicationId('id');
		$var->setApplicationKey('key');
		$this->assertTrue(is_array($var->getTubeStatus($client)));
		$this->assertInstanceOf(Entity\Line::class, $var->getTubeStatus()[0]);
		$this->assertEquals('bakerloo', $var->getTubeStatus()[0]->getId());
		$this->assertInstanceOf(Entity\Status::class, $var->getTubeStatus()[2]->getStatus()[0]);
		$this->assertEquals('Planned Closure', $var->getTubeStatus()[2]->getStatus()[0]->getSeverityDescription());
		$this->assertInstanceOf(Entity\ValidityPeriod::class, $var->getTubeStatus()[2]->getStatus()[0]->getValidityPeriods()[0]);
		$this->assertEquals(Carbon::createFromFormat(DateTime::ATOM, '2018-09-29T04:30:00Z'), $var->getTubeStatus()[2]->getStatus()[0]->getValidityPeriods()[0]->getFromDate());
		unset($var);
	}

	/**
	 * Tests to see if we handle a HTTP Exception correctly
	 */
	public function testCanHandleHttpError()
	{
		// Mock the guzzle client
		$mock = new MockHandler([new Response(500)]);
		$handler = HandlerStack::create($mock);
		$client = new Client(['handler' => $handler]);

		$var = new TubeStatus;
		$var->setApplicationId('id');
		$var->setApplicationKey('key');
		$this->expectException(\RuntimeException::class);
		$this->expectExceptionMessage("Unable to contact TFL API");
		$var->getTubeStatus($client);
		unset($var);
	}

	/**
	 * Test to make sure exception is thrown if parameters are missing
	 */
	public function testMissingApiCredentials()
	{
		$var = new TubeStatus;
		$this->expectException(\RuntimeException::class);
		$this->expectExceptionMessage("Application ID or Application Key is not set");
		$var->getTubeStatus();
		unset($var);
	}
}

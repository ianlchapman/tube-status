<?php 
use PHPUnit\Framework\TestCase;
use IanLChapman\TubeStatus\Entity\Line;
use IanLChapman\TubeStatus\Entity\Status;

/**
*  Corresponding Class to test Line Class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Ian L Chapman
*/
class LineClassTest extends TestCase
{
	
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError()
  {
   $var = new Line;
   $this->assertTrue(is_object($var));
   unset($var);
 }

 /**
  * Test can we set and get the name property on the class
  */
 public function testCanSetAndGetName()
 {
  $var = new Line;
  $this->assertInstanceOf(Line::class, $var->setName('Bakerloo'));
  $this->assertSame('Bakerloo', $var->getName());
  unset($var);
 }

 /**
  * Test can we set and get the id property on the class
  */
 public function testCanSetAndGetId()
 {
  $var = new Line;
  $this->assertInstanceOf(Line::class, $var->setId('bakerloo'));
  $this->assertSame('bakerloo', $var->getId());
  unset($var);
 }

 /**
  * Test getting and setting status of tube line
  */
 public function testCanSetAndGetStatuses()
 {
  $var = new Line;
  $this->assertInstanceOf(Line::class, $var->setStatus($this->statusData()));
  $this->assertEquals($this->statusData(), $var->getStatus());
  unset($var);
 }

 /**
  * Test getting the line colour
  * @dataProvider colourProvider
  */
 public function testCanGetLineColours(string $id, string $expectedColour)
 {
  $val = new Line;
  $val->setId($id);
  $this->assertEquals($expectedColour, $val->getColour());
  unset($val);
 }

/**
 * Data for statuses
 */
 private function statusData()
 {
  $status1 = new Status;
  $status1->setSeverity(10)->setSeverityDescription('Good Service');

  $status2 = new Status;
  $status2->setSeverity(6)->setSeverityDescription('Severe Delays');

  return [$status1, $status2];
 }

 /**
  * Data provider for colours
  */
 public function colourProvider()
 {
  return [
    ['bakerloo', '#B36305'],
    ['central', '#E32017'],
    ['circle', '#FFD300'],
    ['district', '#00782A'],
    ['hammersmith-city', '#F3A9BB'],
    ['jubilee', '#A0A5A9'],
    ['metropolitan', '#9B0056'],
    ['northern', '#000000'],
    ['piccadilly', '#003688'],
    ['victoria', '#0098D4'],
    ['waterloo-city', '#95CDBA']
  ];
 }
}

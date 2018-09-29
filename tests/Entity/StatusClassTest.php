<?php 
use PHPUnit\Framework\TestCase;
use IanLChapman\TubeStatus\Entity\Status;
use IanLChapman\TubeStatus\Entity\ValidityPeriod;

/**
*  Corresponding Class to test Status Class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Ian L Chapman
*/
class StatusClassTest extends TestCase
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
   $var = new Status;
   $this->assertTrue(is_object($var));
   unset($var);
 }

 /**
  * Tests if we can set and get severity properties
  */
 public function testCanSetAndGetSeverityProperties()
 {
  $var = new Status;

  $this->assertInstanceOf(Status::class, $var->setSeverity(10));
  $this->assertSame(10, $var->getSeverity());

  $this->assertInstanceOf(Status::class, $var->setSeverityDescription('Good Service'));
  $this->assertSame('Good Service', $var->getSeverityDescription());

  unset($var);
 }

 /**
  * Tests if we can set and get the reason for disruption
  */
 public function testCanSetAndGetReason()
 {
  $var = new Status;
  $this->assertInstanceOf(Status::class, $var->setReason('Reason Name'));
  $this->assertEquals('Reason Name', $var->getReason());
  unset($var);
 }

 /**
  * Tests if we can set and get the disruption properties
  */
 public function testCanSetAndGetDisruptionProperties()
 {
  $var = new Status;

  $this->assertInstanceOf(Status::class, $var->setDisruptionCategory('PlannedWork'));
  $this->assertEquals('PlannedWork', $var->getDisruptionCategory());

  $this->assertInstanceOf(Status::class, $var->setDisruptionDescription('METROPOLITAN LINE: Saturday 29 and Sunday 30 September'));
  $this->assertEquals('METROPOLITAN LINE: Saturday 29 and Sunday 30 September', $var->getDisruptionDescription());

  $this->assertInstanceOf(Status::class, $var->setClosureText('partClosure'));
  $this->assertEquals('partClosure', $var->getClosureText());

  unset($var);
 }

 /**
  * Tests if we can set and get the validity period properties
  */
 public function testCanSetAndGetValidityPeriods()
 {
  $var = new Status;
  $this->assertInstanceOf(Status::class, $var->setValidityPeriods($this->validityData()));
  $this->assertEquals($this->validityData(), $var->getValidityPeriods());
  unset($var);
 }

/**
 * Data for validity periods
 */
 private function validityData()
 {
  $validityPeriod1 = new ValidityPeriod;
  $validityPeriod1->setFromDate('2018-09-29T04:30:00Z')->setToDate('2018-10-01T01:29:00Z')->setIsNow(true);

  $validityPeriod2 = new ValidityPeriod;
  $validityPeriod2->setFromDate('2017-09-29T04:30:00Z')->setToDate('2017-10-01T01:29:00Z')->setIsNow(false);

  return [$validityPeriod1, $validityPeriod2];
 }
}

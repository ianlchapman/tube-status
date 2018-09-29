<?php 
use PHPUnit\Framework\TestCase;
use Carbon\Carbon;
use IanLChapman\TubeStatus\Entity\ValidityPeriod;

/**
*  Corresponding Class to test Validity Period Class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author Ian L Chapman
*/
class ValidityPeriodClassTest extends TestCase
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
   $var = new ValidityPeriod;
   $this->assertTrue(is_object($var));
   unset($var);
 }

 /**
  * Tests the from date properties and methods
  */
 public function testSetAndGetFromDate()
 {
  $var = new ValidityPeriod;
  $this->assertInstanceOf(ValidityPeriod::class, $var->setFromDate('2018-09-29T04:30:00Z'));
  $this->assertInstanceOf(Carbon::class, $var->getFromDate());
  $this->assertEquals(2018, $var->getFromDate()->year);
  $this->assertEquals(9, $var->getFromDate()->month);
  $this->assertEquals(4, $var->getFromDate()->hour);
  unset($var);
 }

 /**
  * Tests the to date properties and methods
  */
 public function testSetAndGetToDate()
 {
  $var = new ValidityPeriod;
  $this->assertInstanceOf(ValidityPeriod::class, $var->setToDate('2018-09-29T04:30:00Z'));
  $this->assertInstanceOf(Carbon::class, $var->getToDate());
  $this->assertEquals(2018, $var->getToDate()->year);
  $this->assertEquals(9, $var->getToDate()->month);
  $this->assertEquals(4, $var->getToDate()->hour);
  unset($var);
 }

 /**
  * Tests the is now properties and methods
  */
 public function testSetAndGetIsNow()
 {
  $var = new ValidityPeriod;
  $this->assertInstanceOf(ValidityPeriod::class, $var->setIsNow(true));
  $this->assertTrue($var->getIsNow());
  unset($var);
 }
}

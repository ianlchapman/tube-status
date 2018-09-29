<?php namespace IanLChapman\TubeStatus\Entity;

use Carbon\Carbon;
use DateTime;

/**
*  Representation of a tube line status validity period
*
*
*  @author Ian L Chapman
*/
class ValidityPeriod
{
  /**
   * @var Carbon $fromDate Date the validity period starts
   */
  private $fromDate;

  /**
   * @var Carbon $toDate Date the validity period ends
   */
  private $toDate;

  /**
   * @var bool $isNow Whether the API reports that the disruption is active now
   */
  private $isNow;

  /**
   * Gets the date the validty period starts
   * @return Carbon The start date of the validity period
   */
  public function getFromDate(): Carbon
  {
    return $this->fromDate;
  }

  /**
   * Sets the date the validity period starts
   * @param string $date The start date of the validity period (as a string)
   * @return  self The ValidityPeriod object
   */
  public function setFromDate(string $date): self
  {
    $this->fromDate = Carbon::createFromFormat(DateTime::ATOM, $date);
    return $this;
  }

  /**
   * Gets the date the validity period ends
   * @return Carbon The end date of the validity period
   */
  public function getToDate(): Carbon
  {
    return $this->toDate;
  }

  /**
   * Sets the date the validity period ends
   * @param string $date The end date of the validity period (as a string)
   * @return  self The validity period object
   */
  public function setToDate(string $date): self
  {
    $this->toDate = Carbon::createFromFormat(DateTime::ATOM, $date);
    return $this;
  }

  /**
   * Gets whether the API reports if the disruption is active now
   * @return bool If the disruption is active now
   */
  public function getIsNow(): bool
  {
    return $this->isNow;
  }

  /**
   * Sets whether the API reports if the disruption is active now
   * @param bool $isNow Whether the disruption is currently active
   * @return  self The validity period object
   */
  public function setIsNow(bool $isNow): self
  {
    $this->isNow = $isNow;
    return $this;
  }
}
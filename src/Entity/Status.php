<?php namespace IanLChapman\TubeStatus\Entity;

/**
*  Representation of a tube line status
*
*  Represents a single London Underground (TFL) tube line status including details of disruption
*
*  @author Ian L Chapman
*/
class Status
{
  /**
   * @var int $severity The severity of the status
   */
  private $severity;

  /**
   * @var string $severityDescription The severity description of the status
   */
  private $severityDescription;

  /**
   * @var string $reason The reason for any disruption
   */
  private $reason;

  /**
   * @var string $disruptionCategory The disruption category
   */
  private $disruptionCategory;

  /**
   * @var string $disruptionDescription A decription of the disruption
   */
  private $disruptionDescription;

  /**
   * @var string $closureText Provided disclosure text
   */
  private $closureText;

  /**
   * @var ValidityPeriod[] $validityPeriods Array of validity periods
   */
  private $validityPeriods;

  /**
   * Gets the severity status
   * @return int The level of severity in the status (10 is a good service)
   */
  public function getSeverity(): int
  {
    return $this->severity;
  }

  /**
   * Sets the severity status
   * @param int $severity The level of severity of the status
   * @return  self The status object
   */
  public function setSeverity(int $severity): self
  {
    $this->severity = $severity;
    return $this;
  }

  /**
   * Gets the severity status description
   * @return string The description of the severity status
   */
  public function getSeverityDescription(): string
  {
    return $this->severityDescription;
  }

  /**
   * Sets the severity status description
   * @param string $description The description of the severity status
   * @return  self The status object
   */
  public function setSeverityDescription(string $description): self
  {
    $this->severityDescription = $description;
    return $this;
  }

  /**
   * Gets the reason for disruption
   * @return string The reason given for disruption
   */
  public function getReason(): string
  {
    return $this->reason;
  }

  /**
   * Sets the reason for disruption
   * @param string $reason The reason for disruption
   * @return  self The status object
   */
  public function setReason(string $reason): self
  {
    $this->reason = $reason;
    return $this;
  }

  /**
   * Gets the disruption category
   * @return string The disruption category
   */
  public function getDisruptionCategory(): string
  {
    return $this->disruptionCategory;
  }

  /**
   * Sets the disruption category
   * @param string $category The disruption category
   * @return  self The status object
   */
  public function setDisruptionCategory(string $category): self
  {
    $this->disruptionCategory = $category;
    return $this;
  }

  /**
   * Gets the disruption description
   * @return string Human readable disruption description
   */
  public function getDisruptionDescription(): string
  {
    return $this->disruptionDescription;
  }

  /**
   * Sets the disruption description
   * @param string $description Human readable disruption description
   * @return  self The status object
   */
  public function setDisruptionDescription(string $description): self
  {
    $this->disruptionDescription = $description;
    return $this;
  }

  /**
   * Gets the closure text
   * @return string The closure text
   */
  public function getClosureText(): string
  {
    return $this->closureText;
  }

  /**
   * Sets the closure text
   * @param string $closureText The closure text
   * @return  self The status object
   */
  public function setClosureText(string $closureText): self
  {
    $this->closureText = $closureText;
    return $this;
  }

  /**
   * Gets the validity periods for the status
   * @return ValidityPeriod[] Array of validity periods
   */
  public function getValidityPeriods(): array
  {
    return $this->validityPeriods;
  }  

  /**
   * Sets the validity periods for the status
   * @param ValidityPeriod[] $validityPeriods Array of validity periods
   */
  public function setValidityPeriods(array $validityPeriods): self
  {
    $this->validityPeriods = $validityPeriods;
    return $this;
  }
}
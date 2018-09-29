<?php namespace IanLChapman\TubeStatus\Entity;

/**
*  Representation of a tube line
*
*  Represents a single London Underground (TFL) tube line including status objects
*
*  @author Ian L Chapman
*/
class Line
{
  /*
   * @var string $name Name of the tube line
   */
  private $name;

  /*
   * @var string $id Id of the tube line
   */
  private $id;

  /**
   * @var Status[]
   */
  private $status;

  /**
   * Gets the lines name
   * @return string The lines name
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Sets the lines name
   * @param string $name The lines name
   * @return  self The line object
   */
  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets the lines id
   * @return string The lines id
   */
  public function getId(): string
  {
    return $this->id;
  }

  /**
   * Sets the lines id
   * @param string $id The lines id
   * @return  self The line object
   */
  public function setId(string $id): self
  {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets the status of the line
   * @return Status[] List of status objects for the line
   */
  public function getStatus(): array
  {
    return $this->status;
  }

  /**
   * Sets the status of the line
   * @param Status[] $status List of the status objects for the line
   * @return  self The line object
   */
  public function setStatus(array $status): self
  {
    $this->status = $status;
    return $this;
  }

  /**
   * Gets the hexadecimal colour for the line
   * @return string The hexadecimal colour value
   */
  public function getColour(): string
  {
    $colours = [
      'bakerloo' => '#B36305',
      'central' => '#E32017',
      'circle' => '#FFD300',
      'district' => '#00782A',
      'hammersmith-city' => '#F3A9BB',
      'jubilee' => '#A0A5A9',
      'metropolitan' => '#9B0056',
      'northern' => '#000000',
      'piccadilly' => '#003688',
      'victoria' => '#0098D4',
      'waterloo-city' => '#95CDBA'
    ];

    return $colours[$this->getId()];
  }
}
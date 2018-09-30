<?php namespace IanLChapman\TubeStatus;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use IanLChapman\TubeStatus\Entity as Entity;
use RuntimeException;

/**
*  Representation of a tube line
*
*  Represents a single London Underground (TFL) tube line including status objects
*
*  @author Ian L Chapman
*/
class TubeStatus
{
  /**
   * @var string $applicationId The application id for TFL API
   */
  private $applicationId = null;

  /**
   * @var string $applicationKey The API Key for TFL API
   */
  private $applicationKey = null;

  /**
   * @var Entity\Line[] $status The cached status object
   */
  private $status = null;

  /**
   * Sets the Application ID for the TFL API
   * @param string $appId Application ID as generated by the TFL API
   * @return  self The Tube Status object
   */
  public function setApplicationId(string $appId): self
  {
    $this->applicationId = $appId;
    return $this;
  }

  /**
   * Sets the Application key for the TFL API
   * @param string $key Application Key as generated by the TFL API
   * @return  self The Tube Status object
   */
  public function setApplicationKey(string $key): self
  {
    $this->applicationKey = $key;
    return $this;
  }

  /**
   * Gets the current tube status
   * @param  Client $client Guzzle client for making the request
   * @return Entity\Line[] List of tube lines and their current status
   */
  public function getTubeStatus(?Client $client = null)
  {
    if ($this->status) {
      return $this->status;
    }

    $client = $client ?? new Client;
    $response = $this->getStatus($client);
    return $this->status = $this->parseResponse($response);
  }

  /**
   * Gets status from the TFL service
   * @param  Client $client Guzzle client for making the request
   * @return Response The Guzzle response object (PSR7 compatible)
   */
  private function getStatus(Client $client = null): Response
  {
    if ($this->applicationId == null || $this->applicationKey == null) {
      throw new RuntimeException("Application ID or Application Key is not set");
    }

    try {
      $result = $client->request('GET', "https://api.tfl.gov.uk/Line/Mode/tube/Status?app_id=$this->applicationId&app_key=$this->applicationKey");

      if ($result->getStatusCode() != 200) {
        throw new RuntimeException("Unable to contact TFL API");
      }
    } catch (\Exception $e) {
      throw new RuntimeException("Unable to contact TFL API");
    }

    return $result;
  }

  /**
   * Parses the server response and the child objects
   * @param  Response $response The Guzzle response object
   * @return Line[]             Array of line objects and their statuses
   */
  private function parseResponse(Response $response): array
  {
    $responseJson = json_decode($response->getBody());
    return array_map([$this, 'parseLine'], $responseJson);
  }

  /**
   * Parses the line response and child objects
   * @param  object $lineObject array and stdclass (from json_decode) of lines
   * @return Entity\Line             The line object parsed
   */
  private function parseLine(object $lineObject): Entity\Line
  {
    $line = new Entity\Line;
    $line->setName($lineObject->name);
    $line->setId($lineObject->id);
    $line->setStatus(array_map([$this, 'parseStatus'], $lineObject->lineStatuses));

    return $line;
  }

  /**
   * Parses the status response and child objects
   * @param  object $statusObject array and stdclass (from json_decode) of status
   * @return Entity\Status               The status object parsed
   */
  private function parseStatus(object $statusObject): Entity\Status
  {
    $status = new Entity\Status;
    $status->setSeverity($statusObject->statusSeverity);
    $status->setSeverityDescription($statusObject->statusSeverityDescription);
    $status->setReason($statusObject->reason ?? null);
    $status->setDisruptionCategory($statusObject->disruption->category ?? null);
    $status->setDisruptionDescription($statusObject->disruption->categoryDescription ?? null);
    $status->setClosureText($statusObject->disruption->closureText ?? null);
    $status->setValidityPeriods(array_map([$this, 'parseValidityPeriod'], $statusObject->validityPeriods));

    return $status;
  }

  /**
   * Parses the validity object
   * @param  object $validityObject array and stdclass (from json_decode) of validity
   * @return Entity\ValidityPeriod                 The validity period object
   */
  private function parseValidityPeriod(object $validityObject): Entity\ValidityPeriod
  {
    $validityPeriod = new Entity\ValidityPeriod;
    $validityPeriod->setFromDate($validityObject->fromDate);
    $validityPeriod->setToDate($validityObject->toDate);
    $validityPeriod->setIsNow($validityObject->isNow ?? false);

    return $validityPeriod;
  }
}

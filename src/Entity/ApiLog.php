<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApiLogRepository")
 */
class ApiLog
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $endpoint;

	/**
	 * @ORM\Column(type="string", length=10)
	 */
	private $method;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $requestPayload;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $responsePayload;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $statusCode;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $errorMessage;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $timestamp;

	/**
	 * @ORM\Column(type="float", nullable=true)
	 */
	private $duration;

	/**
	 * @param mixed $endpoint
	 * @return ApiLog
	 */
	public function setEndpoint($endpoint): ApiLog
	{
		$this->endpoint = $endpoint;
		return $this;
	}

	/**
	 * @param mixed $method
	 * @return ApiLog
	 */
	public function setMethod($method): ApiLog
	{
		$this->method = $method;
		return $this;
	}

	/**
	 * @param mixed $requestPayload
	 * @return ApiLog
	 */
	public function setRequestPayload($requestPayload): ApiLog
	{
		$this->requestPayload = $requestPayload;
		return $this;
	}

	/**
	 * @param mixed $responsePayload
	 * @return ApiLog
	 */
	public function setResponsePayload($responsePayload): ApiLog
	{
		$this->responsePayload = $responsePayload;
		return $this;
	}

	/**
	 * @param mixed $statusCode
	 * @return ApiLog
	 */
	public function setStatusCode($statusCode): ApiLog
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * @param mixed $errorMessage
	 * @return ApiLog
	 */
	public function setErrorMessage($errorMessage): ApiLog
	{
		$this->errorMessage = $errorMessage;
		return $this;
	}

	/**
	 * @param mixed $timestamp
	 * @return ApiLog
	 */
	public function setTimestamp($timestamp): ApiLog
	{
		$this->timestamp = $timestamp;
		return $this;
	}

	/**
	 * @param mixed $duration
	 * @return ApiLog
	 */
	public function setDuration($duration): ApiLog
	{
		$this->duration = $duration;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEndpoint()
	{
		return $this->endpoint;
	}

	/**
	 * @return mixed
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @return mixed
	 */
	public function getRequestPayload()
	{
		return $this->requestPayload;
	}

	/**
	 * @return mixed
	 */
	public function getResponsePayload()
	{
		return $this->responsePayload;
	}

	/**
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @return mixed
	 */
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}

	/**
	 * @return mixed
	 */
	public function getTimestamp()
	{
		return $this->timestamp;
	}

	/**
	 * @return mixed
	 */
	public function getDuration()
	{
		return $this->duration;
	}
}

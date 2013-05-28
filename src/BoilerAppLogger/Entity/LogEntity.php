<?php
namespace BoilerAppLogger\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\BoilerAppLogger\Repository\LogRepository")
 * @\Doctrine\ORM\Mapping\Table(name="log")
 */
class LogEntity extends \BoilerAppDb\Entity\AbstractEntity{
	/**
	 * @var int
	 * @\Doctrine\ORM\Mapping\Id
	 * @\Doctrine\ORM\Mapping\Column(type="integer")
	 * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
	 */
	protected $log_id;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",unique=true,length=255)
	 */
	protected $log_request_uri;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="logrequestmethodenum")
	 */
	protected $log_request_method;

	/**
	 * @var array
	 * @\Doctrine\ORM\Mapping\Column(type="json_array")
	 */
	protected $log_request_headers;

	/**
	 * @var \BoilerAppUser\Entity\UserEntity
	 * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="BoilerAppUser\Entity\UserEntity")
     * @\Doctrine\ORM\Mapping\JoinColumn(name="log_user_id", referencedColumnName="user_id")
	 */
	protected $log_user;

	/**
	 * @return int
	 */
	public function getLogId(){
		return $this->log_id;
	}

	/**
	 * @param string $sRequestUri
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogRequestUri($sRequestUri){
		$this->log_request_uri = $sRequestUri;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogRequestUri(){
		return $this->log_request_uri;
	}


	/**
	 * @param string $sRequestMethod
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogRequestMethod($sRequestMethod){
		$this->log_request_method = $sRequestMethod;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogRequestMethod(){
		return $this->log_request_method;
	}

	/**
	 * @param array $aRequestHeaders
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogRequestHeaders(array $aRequestHeaders){
		$this->log_request_headers = $aRequestHeaders;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getLogRequestHeaders(){
		return $this->log_request_headers;
	}

	/**
	 * @param \BoilerAppUser\Entity\UserEntity $oUser
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogUser(\BoilerAppUser\Entity\UserEntity $oUser){
		$this->log_user = $oUser;
		return $this;
	}

	/**
	 * @return \BoilerAppUser\Entity\UserEntity
	 */
	public function getLogUser(){
		return $this->log_user;
	}
}
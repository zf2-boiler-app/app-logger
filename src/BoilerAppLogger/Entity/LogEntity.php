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
	 * @\Doctrine\ORM\Mapping\Column(type="string")
	 */
	protected $log_request_uri;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="logrequestmethodenum")
	 */
	protected $log_request_method;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",nullable=true)
	 */
	protected $log_session_id;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="ipaddress",nullable=true)
	 */
	protected $log_ip_address;

	/**
	 * @var \Zend\Http\Headers
	 * @\Doctrine\ORM\Mapping\Column(type="requestheaders")
	 */
	protected $log_request_headers;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",nullable=true)
	 */
	protected $log_matched_route_name;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",nullable=true)
	 */
	protected $log_controller_name;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",nullable=true)
	 */
	protected $log_action_name;

	/**
	 * @var \Doctrine\ORM\PersistentCollection
	 * @\Doctrine\ORM\Mapping\OneToMany(targetEntity="BoilerAppLogger\Entity\LogErrorEntity", mappedBy="log_error_log")
	 */
	protected $log_log_errors;

	/**
	 * @var \BoilerAppAccessControl\Entity\AuthAccessEntity
	 * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="\BoilerAppAccessControl\Entity\AuthAccessEntity")
	 * @\Doctrine\ORM\Mapping\JoinColumn(name="log_auth_access_id", referencedColumnName="auth_access_id")
	 */
	protected $log_auth_access;

	/**
	 * Constructor
	 */
	public function __construct(){
		$this->log_log_errors = new \Doctrine\Common\Collections\ArrayCollection();
	}

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
	 * @param string $sSessionId
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogSessionId($sSessionId){
		$this->log_session_id = $sSessionId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogSessionId(){
		return $this->log_session_id;
	}

	/**
	 * @param string $sIPAddress
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogIPAddress($sIPAddress){
		$this->log_ip_address = $sIPAddress;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogIPAddress(){
		return $this->log_ip_address;
	}

	/**
	 * @param \Zend\Http\Headers $oRequestHeaders
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogRequestHeaders(\Zend\Http\Headers $oRequestHeaders){
		$this->log_request_headers = $oRequestHeaders;
		return $this;
	}

	/**
	 * @return \Zend\Http\Headers
	 */
	public function getLogRequestHeaders(){
		return $this->log_request_headers;
	}

	/**
	 * @param string $sMatchedRouteName
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogMatchedRouteName($sMatchedRouteName){
		$this->log_matched_route_name = $sMatchedRouteName;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getLogMatchedRouteName(){
		return $this->log_matched_route_name;
	}

	/**
	 * @param string $sControllerName
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogControllerName($sControllerName){
		$this->log_controller_name = $sControllerName;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getLogControllerName(){
		return $this->log_controller_name;
	}

	/**
	 * @param string $sActionName
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogActionName($sActionName){
		$this->log_action_name = $sActionName;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getLogActionName(){
		return $this->log_action_name;
	}

	/**
	 * @return \Doctrine\ORM\PersistentCollection
	 */
	public function getLogLogErrors(){
		return $this->log_log_errors;
	}

	/**
	 * @param \BoilerAppAccessControl\Entity\AuthAccessEntity $oAuthAccess
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function setLogAuthAccess(\BoilerAppAccessControl\Entity\AuthAccessEntity $oAuthAccess){
		$this->log_auth_access = $oAuthAccess;
		return $this;
	}

	/**
	 * @return \BoilerAppAccessControl\Entity\AuthAccessEntity
	 */
	public function getLogAuthAccess(){
		return $this->log_auth_access;
	}
}
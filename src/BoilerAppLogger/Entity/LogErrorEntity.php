<?php
namespace BoilerAppLogger\Entity;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="\BoilerAppLogger\Repository\LogErrorRepository")
 * @\Doctrine\ORM\Mapping\Table(name="log_error")
 */
class LogErrorEntity extends \BoilerAppDb\Entity\AbstractEntity{
	/**
	 * @var int
	 * @\Doctrine\ORM\Mapping\Id
	 * @\Doctrine\ORM\Mapping\Column(type="integer")
	 * @\Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
	 */
	protected $log_error_id;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string")
	 */
	protected $log_error_message;

	/**
	 * @var int
	 * @\Doctrine\ORM\Mapping\Column(type="integer")
	 */
	protected $log_error_code;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="string",nullable=true)
	 */
	protected $log_error_file;

	/**
	 * @var int
	 * @\Doctrine\ORM\Mapping\Column(type="integer",nullable=true)
	 */
	protected $log_error_line;

	/**
	 * @var string
	 * @\Doctrine\ORM\Mapping\Column(type="text")
	 */
	protected $log_error_trace;

	/**
	 * @var \BoilerAppLogger\Entity\LogEntity
	 * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="BoilerAppLogger\Entity\LogEntity", inversedBy="log_log_error")
	 * @\Doctrine\ORM\Mapping\JoinColumn(name="log_error_log_id", referencedColumnName="log_id")
	 */
	protected $log_error_log;

	/**
	 * @return int
	 */
	public function getLogErrorId(){
		return $this->log_error_id;
	}

	/**
	 * @return string
	 */
	public function getLogErrorMessage(){
		return $this->log_error_message;
	}

	/**
	 * @param string $sLogErrorMessage
	 * @return \BoilerAppLogger\Entity\LogErrorEntity
	 */
	public function setLogErrorMessage($sLogErrorMessage){
		$this->log_error_message = $sLogErrorMessage;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLogErrorCode(){
		return $this->log_error_code;
	}

	/**
	 * @param int $iLogErrorCode
	 * @return \BoilerAppLogger\Entity\LogErrorEntity
	 */
	public function setLogErrorCode($iLogErrorCode){
		$this->log_error_code = $iLogErrorCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogErrorFile(){
		return $this->log_error_file;
	}

	/**
	 * @param string $sLogErrorFile
	 * @return \BoilerAppLogger\Entity\LogErrorEntity
	 */
	public function setLogErrorFile($sLogErrorFile){
		$this->log_error_file = $sLogErrorFile;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLogErrorLine(){
		return $this->log_error_line;
	}

	/**
	 * @param int $iLogErrorLine
	 * @return \BoilerAppLogger\Entity\LogErrorEntity
	 */
	public function setLogErrorLine($iLogErrorLine){
		$this->log_error_line = $iLogErrorLine;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogErrorTrace(){
		return $this->log_error_trace;
	}

	/**
	 * @param string $sLogErrorTrace
	 * @return \BoilerAppLogger\Entity\LogErrorEntity
	 */
	public function setLogErrorTrace($sLogErrorTrace){
		$this->log_error_trace = $sLogErrorTrace;
		return $this;
	}

	/**
	 * @return \BoilerAppLogger\Entity\LogEntity
	 */
	public function getLogErrorLog(){
		return $this->log_error_log;
	}

	/**
	 * @param \BoilerAppLogger\Entity\LogEntity
	 * @return \BoilerAppLogger\Entity\LogErrorEntity
	 */
	public function setLogErrorLog(\BoilerAppLogger\Entity\LogEntity$oLogErrorLog){
		$this->log_error_log = $oLogErrorLog;
		return $this;
	}
}
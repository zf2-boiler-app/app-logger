<?php
namespace BoilerAppLogger\Repository;
class LogRepository extends \BoilerAppDb\Repository\AbstractEntityRepository{

	/**
	 * @param \BoilerAppAccessControl\Entity\AuthAccessEntity $oAuthAccess
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getLatestActivityLogs(\BoilerAppAccessControl\Entity\AuthAccessEntity $oAuthAccess){
		$oLatestsActivityLogs = new \Doctrine\Common\Collections\ArrayCollection();
		while($oLatestsActivityLogs->count() < 5){
			$oCriteria = new \Doctrine\Common\Collections\Criteria(
				null,//\Doctrine\Common\Collections\Criteria::expr()->eq('log_auth_access_id', $oAuthAccess->getAuthAccessId()),
				array('entity_create' => 'DESC'),
				null,
				1
			);

			$aCriteria = array();
			if($oLatestsActivityLogs->count()){
				$oLastLog = $oLatestsActivityLogs->last();
				$oCriteria
					->andWhere(\Doctrine\Common\Collections\Criteria::expr()->neq('log_session_id', $oLastLog->getLogSessionId()))
					->andWhere(\Doctrine\Common\Collections\Criteria::expr()->lt('entity_create', $oLastLog->getEntityCreate()));
			}
			if(!($oLogs = $this->matching($oCriteria)) || !$oLogs->count())break;
			$oLatestsActivityLogs->add($oLogs->current());
		}
		return $oLatestsActivityLogs;
	}
}
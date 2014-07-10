<?php
namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ChallengeTeamRepository extends EntityRepository
{
	public function findChallengeTeam($idTeamrace)
	{
		$queryString = "
				SELECT challengeTeam, team
					FROM TeamRaceWebBundle:ChallengeTeam challengeTeam 
					JOIN challengeTeam.team team
					WHERE 
						team.teamrace = :idTeamrace
				";
		$query = $this->getEntityManager()
			->createQuery($queryString);
		
		$query->setParameters(array('idTeamrace' => $idTeamrace));
		
		return $query->getResult();
		
	}
	
}
<?php
namespace TeamRace\WebBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserTeamRepository extends EntityRepository
{
	public function findUserTeam($idUser, $idTeamrace)
	{
		$query = $this->getEntityManager()
			->createQuery("
				SELECT userTeam FROM TeamRaceWebBundle:UserTeam userTeam JOIN userTeam.user user
					WHERE 
						user.idUser = :idUser
					AND
						userTeam.team IN 
						(SELECT team FROM TeamRaceWebBundle:Team team JOIN team.teamrace teamrace
							WHERE teamrace.idTeamrace = :idTeamrace)
					");
		
		$query->setParameters(array('idTeamrace' => $idTeamrace, 'idUser' => $idUser));
		
		return $query->getResult();
		
	}
	
	public function getUserAndTeams($idTeamrace) {
		$queryString = "
				SELECT userTeam, team, user
					FROM TeamRaceWebBundle:UserTeam userTeam 
					JOIN userTeam.team team
					JOIN userTeam.user user
					WHERE team IN
						(SELECT team2 
							FROM TeamRaceWebBundle:Team team2 
							JOIN team2.teamrace teamrace
							WHERE teamrace.idTeamrace = :idTeamrace)
				";
		
		$query = $this->getEntityManager()->createQuery($queryString);
		$query->setParameters(array('idTeamrace' => $idTeamrace));
		
		return $query->getResult();
	}
}
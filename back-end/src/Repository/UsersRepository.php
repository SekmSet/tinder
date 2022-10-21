<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Users>
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function save(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Users[] Returns an array all Users has no math a user
     */
    public function findUserNotMatch($idUser, $params = []): array
    {
        $exlude_users = $this->createQueryBuilder('u_exclude')
            ->select("identity(matchA.userB)")
            ->innerJoin("u_exclude.userMatchesA", "matchA", "with", "matchA.userA = $idUser")
            ->getDQL();

        $query = $this->createQueryBuilder('u')
            ->where("u.id not in ($exlude_users)")
            ->andWhere("u.id != $idUser");

        foreach($params as $key => $param) {
            $query->andWhere("u.$key = '${param}'");
        }

        return $query
            ->orderBy('u.id')
            ->getQuery()
            ->getResult();
    }


    public function getMyMatch($idUser): array {
        return $this->createQueryBuilder('u')
            ->select("identity(matchA.userB)")
            ->innerJoin("u.userMatchesA", "matchA", "with", "matchA.action in ('like', 'super like')")
            ->innerJoin("u.userMatchesB", "matchB", "with", "matchB.action in ('like', 'super like')")
            ->andWhere("matchA.userB = matchB.userA")
            ->andWhere("u.id = $idUser")
            ->orderBy('u.id')
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Users[] Returns an array of Users objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Users
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

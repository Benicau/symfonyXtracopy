<?php

namespace App\Repository;

use App\Entity\PriceTypePaper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PriceTypePaper>
 *
 * @method PriceTypePaper|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceTypePaper|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceTypePaper[]    findAll()
 * @method PriceTypePaper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceTypePaperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceTypePaper::class);
    }

    public function save(PriceTypePaper $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PriceTypePaper $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PriceTypePaper[] Returns an array of PriceTypePaper objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PriceTypePaper
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cart $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Cart[] Returns an array of Cart objects
     */
    public function showCart($value): array
    {
        return $this->createQueryBuilder('c')
            ->select('p.id, p.image, p.productname, p.productprice, c.quantity, p.productprice*c.quantity as total')
            ->innerJoin('c.product', 'p')
            ->Where('c.user = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult();
    }
    

        /**
     * @return Cart[] Returns an array of Cart objects
     */
    public function findCart($value): array
    {
        return $this->createQueryBuilder('c')
            ->select('p.id, c.quantity, p.productprice*c.quantity as total')
            ->innerJoin('c.product', 'p')
            ->Where('c.user = :id')
            ->setParameter('id', $value)
            ->getQuery()
            ->getResult();
    }

    

    // SELECT p.image, p.productname, p.productprice, p.id, c.user_id, c.quantity, p.productprice*c.quantity as total 
    // FROM cart as c INNER JOIN product as p ON c.product_id = p.id 
    // WHERE c.user_id = 2;

    //    /**
    //     * @return Cart[] Returns an array of Cart objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Cart
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

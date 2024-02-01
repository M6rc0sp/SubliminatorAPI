<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findAll(string $term = '', int $page = 1, int $pageSize = 10)
    {
        $query = $this->createQueryBuilder('o')
            ->where('o.status LIKE :term OR o.customer LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery();

        $paginator = new Paginator($query);

        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page - 1)) // Define o índice do primeiro resultado
            ->setMaxResults($pageSize); // Define o número máximo de resultados

        return $paginator;
    }

    public function cancelOrder($id)
    {
        $order = $this->find($id);

        if (!$order) {
            throw $this->createNotFoundException('Order not found');
        }

        $order->setStatus('cancelled');

        $this->_em->persist($order);
        $this->_em->flush();
    }
//    /**
//     * @return Order[] Returns an array of Order objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Order
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

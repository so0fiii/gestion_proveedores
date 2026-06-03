<?php

namespace App\Repository;

use App\Entity\Proveedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProveedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proveedor::class);
    }

    /**
     * @return Proveedor[]
     */
    public function findAllOrderedByName(): array
    {
        return $this->createQueryBuilder('proveedor')
            ->orderBy('proveedor.nombre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

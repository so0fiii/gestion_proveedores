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

    /**
     * @return Proveedor[]
     */
      public function findByFilters(?string $busqueda, ?string $tipo, ?string $estado): array
    {
        $qb = $this->createQueryBuilder('proveedor');

        if ($busqueda !== null && $busqueda !== ''){
            $qb
                ->andWhere('proveedor.nombre LIKE :busqueda or proveedor.email LIKE :busqueda or proveedor.telefono LIKE :busqueda')
                ->setParameter('busqueda', '%' . $busqueda . '%')
            ;
        }

        if ($tipo !== null && $tipo !== ''){
            $qb
                ->andWhere('proveedor.tipo = :tipo')
                ->setParameter('tipo', $tipo)
            ;
        }

        if ($estado === 'activo'){
            $qb
                ->andWhere('proveedor.activo = :activo')
                ->setParameter('activo', true)
            ;
        }

        if ($estado === 'inactivo'){
            $qb
                ->andWhere('proveedor.activo = :activo')
                ->setParameter('activo', false)
            ;
        }

        return $qb
            ->orderBy('proveedor.nombre', 'ASC')
            ->addOrderBy('proveedor.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;

    }
}

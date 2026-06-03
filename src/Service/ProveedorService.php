<?php

namespace App\Service;

use App\Entity\Proveedor;
use Doctrine\ORM\EntityManagerInterface;

class ProveedorService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function guardar(Proveedor $proveedor): void
    {
        $this->entityManager->persist($proveedor);
        $this->entityManager->flush();
    }

    public function eliminar(Proveedor $proveedor): void
    {
        $this->entityManager->remove($proveedor);
        $this->entityManager->flush();
    }
}

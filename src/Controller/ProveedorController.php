<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Repository\ProveedorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/proveedores', name: 'proveedor_')]
class ProveedorController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(ProveedorRepository $proveedorRepository): Response
    {
        return $this->render('proveedor/listado.html.twig', [
            'proveedores' => $proveedorRepository->findAllOrderedByName(),
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Proveedor $proveedor): Response
    {
        return $this->render('proveedor/detalle.html.twig', [
            'proveedor' => $proveedor,
        ]);
    }
}

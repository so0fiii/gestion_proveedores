<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Repository\ProveedorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ProveedorFormType;
use App\Service\ProveedorService;
use Symfony\Component\HttpFoundation\Request;

#[Route('/proveedores', name: 'proveedor_')]
class ProveedorController extends AbstractController
{
    #[Route('', name: 'listado', methods: ['GET'])]
    public function index(ProveedorRepository $proveedorRepository): Response
    {
        return $this->render('proveedor/listado.html.twig', [
            'proveedores' => $proveedorRepository->findAllOrderedByName(),
        ]);
    }

    #[Route('/{id}', name: 'detalle', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Proveedor $proveedor): Response
    {
        return $this->render('proveedor/detalle.html.twig', [
            'proveedor' => $proveedor,
        ]);
    }

    // Ruta GET y POST /proveedores/nuevo.
    // Muestra y procesa el formulario para crear un proveedor.
    #[Route('/nuevo', name: 'nuevo', methods: ['GET', 'POST'])]
    public function nuevo(Request $request, ProveedorService $proveedorService): Response
    {
        $proveedor = new Proveedor();

        $form = $this->createForm(ProveedorFormType::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proveedorService->guardar($proveedor);

            $this->addFlash('success', 'Proveedor creado correctamente.');

            return $this->redirectToRoute('proveedor_listado');
        }

        return $this->render('proveedor/formulario.html.twig', [
            'form' => $form,
            'titulo' => 'Nuevo proveedor',
            'texto_boton' => 'Crear proveedor',
        ]);
    }

    // Ruta GET y POST /proveedores/{id}/editar.
    // Muestra y procesa el formulario para editar un proveedor existente.
    #[Route('/{id}/editar', name: 'editar', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function editar(Request $request, Proveedor $proveedor, ProveedorService $proveedorService): Response
    {
        $form = $this->createForm(ProveedorFormType::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proveedorService->guardar($proveedor);

            $this->addFlash('success', 'Proveedor actualizado correctamente.');

            return $this->redirectToRoute('proveedor_detalle', [
                'id' => $proveedor->getId(),
            ]);
        }

        return $this->render('proveedor/formulario.html.twig', [
            'form' => $form,
            'titulo' => 'Editar proveedor',
            'texto_boton' => 'Guardar cambios',
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Proveedor;
use App\Enum\TipoProveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo electronico',
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Telefono de contacto',
            ])
            ->add('tipo', ChoiceType::class, [
                'label' => 'Tipo de proveedor',
                'choices' => TipoProveedor::cases(),
                'choice_label' => fn (TipoProveedor $tipo): string => $tipo->label(),
                'choice_value' => fn (?TipoProveedor $tipo): ?string => $tipo?->value,
                'placeholder' => 'Selecciona un tipo',
            ])
            ->add('activo', CheckboxType::class, [
                'label' => 'Proveedor activo',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}

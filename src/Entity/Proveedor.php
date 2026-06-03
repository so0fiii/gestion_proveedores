<?php

namespace App\Entity;

use App\Enum\TipoProveedor;
use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Proveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: 'El nombre es obligatorio.')]
    #[Assert\Length(max: 150, maxMessage: 'El nombre no puede superar los {{ limit }} caracteres.')]
    private ?string $nombre = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: 'El correo electronico es obligatorio.')]
    #[Assert\Email(message: 'Introduce un correo electronico valido.')]
    #[Assert\Length(max: 180, maxMessage: 'El correo electronico no puede superar los {{ limit }} caracteres.')]
    private ?string $email = null;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: 'El telefono es obligatorio.')]
    #[Assert\Length(max: 30, maxMessage: 'El telefono no puede superar los {{ limit }} caracteres.')]
    private ?string $telefono = null;

    #[ORM\Column(enumType: TipoProveedor::class)]
    #[Assert\NotNull(message: 'Selecciona un tipo de proveedor.')]
    private ?TipoProveedor $tipo = null;

    #[ORM\Column]
    private bool $activo = true;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipo(): ?TipoProveedor
    {
        return $this->tipo;
    }

    public function setTipo(TipoProveedor $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function isActivo(): bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    //metodo que ejecuta doctrine antes de insertar el proveedor por primera vez
    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $now = new \DateTimeImmutable();

        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    //metodo que ejecuta doctrine cada vez que se actualiza el proveedor
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}

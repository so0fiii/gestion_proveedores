<?php

namespace App\Command;

use App\Entity\Proveedor;
use App\Enum\TipoProveedor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generar-proveedores',
    description: 'Genera proveedores de prueba para validar filtros y paginacion.',
)]
class GenerateProvidersCommand extends Command
{
    private const NOMBRES = [
        'Costa Azul',
        'Mediterraneo',
        'Atlantico',
        'Pirineos',
        'Sierra Norte',
        'Sol y Mar',
        'Aventura Park',
        'Horizonte',
        'Bahia Central',
        'Valle Blanco',
    ];

    private const TELEFONOS_PREFIJO = [
        '91',
        '93',
        '95',
        '96',
        '97',
        '98',
    ];

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('cantidad', InputArgument::REQUIRED, 'Numero de proveedores a generar.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $cantidad = (int) $input->getArgument('cantidad');

        if ($cantidad <= 0) {
            $output->writeln('<error>La cantidad debe ser mayor que cero.</error>');

            return Command::FAILURE;
        }

        $tipos = TipoProveedor::cases();

        for ($i = 1; $i <= $cantidad; $i++) {
            $tipo = $tipos[array_rand($tipos)];
            $nombre = $this->generarNombre($tipo, $i);

            $proveedor = new Proveedor();
            $proveedor
                ->setNombre($nombre)
                ->setEmail($this->generarEmail($nombre, $i))
                ->setTelefono($this->generarTelefono())
                ->setTipo($tipo)
                ->setActivo((bool) random_int(0, 1))
            ;

            $this->entityManager->persist($proveedor);

            if ($i % 50 === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
        }

        $this->entityManager->flush();

        $output->writeln(sprintf('<info>%d proveedores de prueba generados correctamente.</info>', $cantidad));

        return Command::SUCCESS;
    }

    private function generarNombre(TipoProveedor $tipo, int $numero): string
    {
        $nombreBase = self::NOMBRES[array_rand(self::NOMBRES)];

        $prefijo = match ($tipo) {
            TipoProveedor::Hotel => 'Hotel',
            TipoProveedor::Crucero => 'Crucero',
            TipoProveedor::EstacionEsqui => 'Estacion de esqui',
            TipoProveedor::ParqueTematico => 'Parque tematico',
        };

        return sprintf('%s %s %03d', $prefijo, $nombreBase, $numero);
    }

    private function generarEmail(string $nombre, int $numero): string
    {
        $slug = strtolower($nombre);
        $slug = str_replace(' ', '.', $slug);

        return sprintf('%s.%03d@example.com', $slug, $numero);
    }

    private function generarTelefono(): string
    {
        $prefijo = self::TELEFONOS_PREFIJO[array_rand(self::TELEFONOS_PREFIJO)];

        return $prefijo . (string) random_int(1000000, 9999999);
    }
}

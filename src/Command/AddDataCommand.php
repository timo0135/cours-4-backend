<?php

namespace App\Command;

use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'add:data',
    description: 'Add random data to the personne table',
)]
class AddDataCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('count', InputArgument::OPTIONAL, 'Number of records to add', 10)
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = (int) $input->getArgument('count');
        $faker = Factory::create();

        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getClassMetadata(Personne::class);
        $schemaManager = $this->entityManager->getConnection()->getSchemaManager();

        if (!$schemaManager->tablesExist([$metadata->getTableName()])) {
            $schemaTool->createSchema([$metadata]);
            $io->success('The personne table has been created.');
        }

        for ($i = 0; $i < $count; $i++) {
            $personne = new Personne();
            $personne->setName($faker->name);
            $personne->setTel($faker->phoneNumber);
            $personne->setEmail($faker->email);
            $personne->setAddress($faker->address);

            $this->entityManager->persist($personne);
        }

        $this->entityManager->flush();

        $io->success(sprintf('Successfully added %d records to the personne table.', $count));

        return Command::SUCCESS;
    }
}

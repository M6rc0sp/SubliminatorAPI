<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Order;

#[AsCommand(name: 'app:import-data',description: 'Import json data to a MySQL table')]
class ImportJsonCommand extends Command
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $json = file_get_contents(__DIR__ . '\orders.json');
        $data = json_decode($json, true);
    
        foreach ($data as $item) {
            $order = new Order();
            $order->setId($item['id']);
            $order->setDate(new \DateTime($item['date']));
            $order->setCustomer($item['customer']);
            $order->setAddress1($item['address1']);
            $order->setCity($item['city']);
            $order->setPostcode($item['postcode']);
            $order->setCountry($item['country']);
            $order->setAmount($item['amount']);
            $order->setStatus($item['status']);
            $order->setDeleted($item['deleted'] === 'Yes');
            $order->setLastModified(new \DateTime($item['last_modified']));
    
            $this->entityManager->persist($order);
        }
    
        $this->entityManager->flush();
    
        return Command::SUCCESS;
    }
}
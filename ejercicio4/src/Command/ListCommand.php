<?php

namespace App\Command;

use Acme\KeyStorage\KeyFileStorage;
use Acme\TopSecret\AES256Crypter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:list')
            ->setDescription('Lista todos los registros.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $keyfile = "keyfile";

        $key = $helper->ask($input, $output, new Question("key: "));

        $crypter = new AES256Crypter($key);

        $keyStorage = new KeyFileStorage($crypter, $keyfile);

        print_r($keyStorage->getAll());
    }
}

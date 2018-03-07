<?php

namespace App\Command;

use Acme\KeyStorage\KeyFileStorage;
use Acme\KeyStorage\KeyRegister;
use Acme\TopSecret\AES256Crypter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AddCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:add')
            ->setDescription('Crea un nuevo registro.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        
        $keyfile = "keyfile";
       
        $name = $helper->ask($input, $output, new Question('name:'));
        $username = $helper->ask($input, $output, new Question('username:'));
        $password = $helper->ask($input, $output, new Question('password:'));
        $comment = $helper->ask($input, $output, new Question('comment:'));;
        $key = $helper->ask($input, $output, new Question('key:'));

        $crypter = new AES256Crypter($key);

        $register = KeyRegister::createFromArray($name, [
            'username' => $username,
            'password' => $password,
            'comment' => $comment,
        ]);

        $keyStorage = new KeyFileStorage($crypter, $keyfile);

        if ($keyStorage->add($register)) {
            $output->writeln("Registro añadido correctamente");
        } else {
            $output->writeln("No he podido añadir el registro");;
        }

    }
}

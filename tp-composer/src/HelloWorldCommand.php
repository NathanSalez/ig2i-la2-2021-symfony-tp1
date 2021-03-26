<?php
namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class HelloWorldCommand extends Command
{

    // add records to the log
    protected static $defaultName = 'app:hello-world';
    private Logger $log;
    protected function configure()
    {
        // create a log channel
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler('logs/console.log', Logger::INFO));
        $this
            // configure an argument
            ->addArgument('name', InputArgument::OPTIONAL, 'Name of the user greeting.')// ...
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // outputs a message without adding a "\n" at the end of the line
        $output->write('Hello ');
        $name = $input->getArgument('name');
        if( $name === null) {
            $this->log->warning('Salut c\'est moi');
            $name = "World";
        }
        $output->writeln($name.'!');
        $this->log->info('Salut c\'est moi');
        return Command::SUCCESS;
    }
}
?>

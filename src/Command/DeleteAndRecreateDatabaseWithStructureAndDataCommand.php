<?php

namespace App\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeleteAndRecreateDatabaseWithStructureAndDataCommand extends Command
{
    protected static $defaultName = 'app:clean-db';
 
    protected function configure():void
    { 
        $this
            ->setDescription('supprime et recrée la base de donnée avec sa structure et ses jeux de fausses données')
           
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->section('suppression et recreation');
       
        $this->runSymfonyCommand($input,$output,'doctrine:database:drop',true);
        $this->runSymfonyCommand($input,$output,'doctrine:database:create');
        $this->runSymfonyCommand($input,$output,'doctrine:migration:migrate');
        $this->runSymfonyCommand($input,$output,'doctrine:fixtures:load');

        $io->success('ras base toute neuve');

        return Command::SUCCESS;
    }
    public function runSymfonyCommand(
        InputInterface $input,
        OutputInterface $output,
        string $command,
        bool $forceOptions=false):void{
        
            $application=$this->getApplication();
            if(!$application){
                throw new \logicException("No application : (");
            }
            $command=$application->find($command);
            if($forceOptions){
                $input=new ArrayInput(
                    [
                        '--force' =>true
                    ]
                    );
            }
            $input->setInteractive(false);
            $command->run($input,$output);

    }
}

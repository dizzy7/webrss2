<?php

namespace AppBundle\Command;

use AppBundle\Document\Feed;
use AppBundle\Interfaces\RssFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchFeedCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('rss:fetch')
            ->setDescription('Fetch all feeds');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $documentManager = $container->get('doctrine.odm.mongodb.document_manager');

        $feeds = $documentManager->getRepository('AppBundle:Feed')->findAll();


        $rssFetcherService = $container->getParameter('rss_fetcher');
        /** @var RssFetcherInterface $rssFetcherService */
        $rssFetcherService = $this->getContainer()->get($rssFetcherService);

        foreach ($feeds as $feed) {
            $rssFetcherService->fetchFeed($feed);
        }
    }
}

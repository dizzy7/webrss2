<?php

namespace AppBundle\Service;

use AppBundle\Exception\FeedFetchFailedException;
use AppBundle\Interfaces\RssFetcherInterface;
use DateTime;
use AppBundle\Document\Feed;
use AppBundle\Document\Post;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;

class SimplePieFetcher implements RssFetcherInterface
{

    private $documentManager;
    private $simplePie;
    private $log;

    public function __construct(DocumentManager $documentManager, SimplePie $simplePie, LoggerInterface $log)
    {
        $this->documentManager = $documentManager;
        $this->simplePie = $simplePie;
        $this->log = $log;
    }

    public function fetchFeed(Feed $feed)
    {
        try {
            $items = $this->simplePie->fetchFeed($feed->getUrl());

            foreach ($items as $item) {
                $itemDate = DateTime::createFromFormat('Y-m-d H:i:s', $item->get_date('Y-m-d H:i:s'));
                if ($itemDate >= $feed->getLastCheckedAt()) {
                    $post = new Post();
                    $post->setTitle($item->get_title());
                    $post->setContent($item->get_content());
                    $post->setUrl($item->get_link());
                    $post->setCreatedAt($itemDate);
                    $post->setFeed($feed);

                    $feed->addPost($post);

                    $this->documentManager->persist($post);
                    $this->documentManager->flush();
                }
            }

            $feed->setLastCheckedAt(new \DateTime());
            $this->documentManager->flush();
        } catch (FeedFetchFailedException $e) {
            $this->log->warning('Can`t fetch feed ' . $feed->getName());
        }
    }
}

<?php

namespace AppBundle\Document;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Feed", mappedBy="users")
     * @var Collection
     */
    private $feeds;

    public function __construct()
    {
        parent::__construct();

        $this->feeds = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add feed
     *
     * @param AppBundle\Document\Feed $feed
     */
    public function addFeed(\AppBundle\Document\Feed $feed)
    {
        $this->feeds[] = $feed;
    }

    /**
     * Remove feed
     *
     * @param AppBundle\Document\Feed $feed
     */
    public function removeFeed(\AppBundle\Document\Feed $feed)
    {
        $this->feeds->removeElement($feed);
    }

    /**
     * Get feeds
     *
     * @return \Doctrine\Common\Collections\Collection $feeds
     */
    public function getFeeds()
    {
        return $this->feeds;
    }
}

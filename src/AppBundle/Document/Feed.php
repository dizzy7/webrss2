<?php

namespace AppBundle\Document;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Feed
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @MongoDB\String
     */
    private $name;

    /**
     * @MongoDB\Date(nullable=true)
     */
    private $lastCheckedAt;

    /**
     * @MongoDB\Date
     */
    private $createdAt;

    /**
     * @MongoDB\String
     */
    private $url;

    /**
     * @MongoDB\ReferenceMany(targetDocument="User", inversedBy="feeds")
     */
    private $users;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Post", inversedBy="feed")
     */
    private $posts;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastCheckedAt
     *
     * @param \DateTime $lastCheckedAt
     * @return self
     */
    public function setLastCheckedAt(\DateTime $lastCheckedAt = null)
    {
        $this->lastCheckedAt = $lastCheckedAt;
        return $this;
    }

    /**
     * Get lastCheckedAt
     *
     * @return date $lastCheckedAt
     */
    public function getLastCheckedAt()
    {
        return $this->lastCheckedAt;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add user
     *
     * @param AppBundle\Document\User $user
     */
    public function addUser(\AppBundle\Document\User $user)
    {
        $this->users[] = $user;
    }

    /**
     * Remove user
     *
     * @param AppBundle\Document\User $user
     */
    public function removeUser(\AppBundle\Document\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection $users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add post
     *
     * @param AppBundle\Document\Post $post
     */
    public function addPost(\AppBundle\Document\Post $post)
    {
        $this->posts[] = $post;
    }

    /**
     * Remove post
     *
     * @param AppBundle\Document\Post $post
     */
    public function removePost(\AppBundle\Document\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }
}

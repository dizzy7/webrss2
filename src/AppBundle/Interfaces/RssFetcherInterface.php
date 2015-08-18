<?php

namespace AppBundle\Interfaces;

use AppBundle\Document\Feed;

interface RssFetcherInterface
{
    public function fetchFeed(Feed $feed);
}

<?php

namespace AppBundle\Service;

use AppBundle\Exception\FeedFetchFailedException;

class SimplePie
{
    /**
     * @param $url
     * @return \SimplePie_Item[]|null
     * @throws FeedFetchFailedException
     */
    public function fetchFeed($url)
    {
        $sp = new \SimplePie();
        $sp->enable_cache(false);
        $sp->set_feed_url($url);

        try {
            $result = $sp->init();

            if ($result) {
                return $sp->get_items();
            } else {
                throw new FeedFetchFailedException($sp->error());
            }
        } catch (\Exception $e) {
            throw new FeedFetchFailedException($e->getMessage());
        }
    }
}
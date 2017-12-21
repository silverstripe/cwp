<?php

namespace CWP\CWP\PageTypes;

use PageController;

class BaseHomePageController extends PageController
{
    public function getNewsPage()
    {
        return NewsHolder::get_one(NewsHolder::class);
    }

    /**
     * @param int $amount The amount of items to provide.
     */
    public function getNewsItems($amount = 2)
    {
        $newsHolder = $this->getNewsPage();
        if ($newsHolder) {
            $controller = NewsHolderController::create($newsHolder);
            return $controller->Updates()->limit($amount);
        }
    }
}

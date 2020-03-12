<?php


namespace App\Presentation;


use App\Http\IRouting;
use App\Http\LinkFabric;

class Pagination implements IRouting
{
    const WARNING = 'bg-warning';
    const SUCCESS = 'bg-success';
    const INFO = 'bg-info';
    const SKIPPED = '..';
    /**
     * @var int
     */
    private $before;
    /**
     * @var int
     */
    private $after;
    /**
     * @var array
     */
    private $places;
    /**
     * @var array
     */
    private $intent;

    public function __construct(
        int $before = 10, int $after = 10)
    {
        $this->before = $before;
        $this->after = $after;
    }

    public function compose(
        int $current, int $amount, int $capacity): array
    {
        $link = new LinkFabric($capacity);
        $this->places = [];
        $this->intent = [];

        $pagesBefore = $this->getBefore();
        $pagesAfter = $this->getAfter();
        $placesGap = $this->getGap();
        $usePredefined = ($current - $placesGap - $pagesBefore) > 0;
        if ($usePredefined) {
            $this->usePredefinedForStrating($link);
        }

        $total = (int)ceil($amount / $capacity);
        $gotIt = false;
        if (!$usePredefined) {
            $gotIt = $this->fillStartingPlaces($current, $total, $link);
        }

        $this->fillPlacesBeforeCurrent($current, $total, $link);

        if (!$gotIt && !key_exists($current, $this->intent)) {
            $this->placeLinkToCurrentPage($current, $link);
        }

        $this->fillPlacesAfterCurrent($current, $total, $link);

        $usePredefined =
            ($current + $placesGap + $pagesAfter) < $total - 1;
        if ($usePredefined && !key_exists($total - 1, $this->intent)
            && !key_exists($total - 2, $this->intent)) {

            $this->usePredefinedForFinishing($link, $total);
        }

        if (!$usePredefined) {
            $this->fillFinishingPlaces($current, $total, $link);
        }

        return $this->places;
    }

    /**
     * @return int
     */
    private function getBefore(): int
    {
        return $this->before;
    }

    /**
     * @return int
     */
    private function getAfter(): int
    {
        return $this->after;
    }

    /**
     * @return int
     */
    private function getGap(): int
    {
        return 2;
    }

    /**
     * @param LinkFabric $link
     */
    public function usePredefinedForStrating(LinkFabric $link)
    {
        $this->places[] = PageLink::make(
            $link->toPage(0), 1, self::WARNING);
        $this->places[] = PageLink::make(
            '', self::SKIPPED, self::WARNING);
        $this->intent[0] = true;
        $this->intent[1] = true;
    }

    /**
     * @param int $current
     * @param int $total
     * @param LinkFabric $link
     * @return bool
     */
    public function fillStartingPlaces(
        int $current, int $total, LinkFabric $link): bool
    {
        $pageOccur = false;
        for ($index = 0; $index < 2; $index++) {
            $addLink = ($index < $total)
                && !key_exists($index, $this->intent);
            if ($addLink && $current !== $index) {
                $this->places[] = PageLink::make(
                    $link->toPage($index),
                    $index + 1, self::WARNING);
                $this->intent[$index] = true;
            }
            if ($addLink && $current === $index
                && !key_exists($index, $this->intent)) {

                $this->places[] = PageLink::make(
                    $link->toPage($current),
                    $current + 1, self::SUCCESS);
                $pageOccur = true;
                $this->intent[$current] = true;
            }
        }

        return $pageOccur;
    }

    /**
     * @param int $current
     * @param int $total
     * @param LinkFabric $link
     */
    public function fillPlacesBeforeCurrent(
        int $current, int $total, LinkFabric $link)
    {
        $pagesBefore = $this->getBefore();
        for ($index = 0; $index < $pagesBefore; $index++) {
            $currentPage = $index - $pagesBefore + $current;
            $addLink = ($currentPage < $total) && ($currentPage > -1)
                && !key_exists($currentPage, $this->intent);
            if ($addLink) {
                $this->places[] = PageLink::make(
                    $link->toPage($currentPage),
                    $currentPage + 1, self::INFO);
                $this->intent[$currentPage] = true;
            }
        }
    }

    /**
     * @param int $current
     * @param LinkFabric $link
     */
    public function placeLinkToCurrentPage(
        int $current, LinkFabric $link)
    {
        $this->places[] = PageLink::make(
            $link->toPage($current),
            $current + 1, self::SUCCESS);
        $this->intent[$current] = true;
    }

    /**
     * @param int $current
     * @param int $total
     * @param LinkFabric $link
     * @return void
     */
    public function fillPlacesAfterCurrent(
        int $current, int $total, LinkFabric $link)
    {
        $pagesBefore = $this->getBefore();
        $pagesAfter = $this->getAfter();
        for ($index = 1; $index < $pagesAfter + 1; $index++) {

            $currentPage = $index + $pagesBefore
                - $pagesAfter + $current;
            $addLink = ($currentPage < $total) && ($currentPage > -1)
                && !key_exists($currentPage, $this->intent);
            if ($addLink) {
                $this->places[] = PageLink::make(
                    $link->toPage($currentPage),
                    $currentPage + 1, self::INFO);
                $this->intent[$currentPage] = true;
            }
        }
    }

    /**
     * @param LinkFabric $link
     * @param int $total
     */
    public function usePredefinedForFinishing(
        LinkFabric $link, int $total)
    {
        $this->places[] = PageLink::make(
            '', self::SKIPPED, self::WARNING);
        $this->places[] = PageLink::make(
            $link->toPage($total - 1),
            $total - 1 + 1, self::WARNING);
        $this->intent[$total - 2] = true;
        $this->intent[$total - 1] = true;
    }

    /**
     * @param int $current
     * @param int $total
     * @param LinkFabric $link
     */
    public function fillFinishingPlaces(
        int $current, int $total, LinkFabric $link)
    {
        for ($index = 0; $index < 2; $index++) {

            $pageIndex = ($total - 2 + $index);
            $addLink = ($pageIndex < $total)
                && !key_exists($pageIndex, $this->intent);
            if ($addLink && $current !== $index) {
                $this->places[] = PageLink::make(
                    $link->toPage($pageIndex),
                    $pageIndex + 1, self::WARNING);
                $this->intent[$pageIndex] = true;
            }
            if ($addLink && $current === $pageIndex
                && !key_exists($pageIndex, $this->intent)) {
                $this->places[] = PageLink::make(
                    $link->toPage($current),
                    $current + 1, self::SUCCESS);
                $this->intent[$current] = true;
            }
        }
    }
}
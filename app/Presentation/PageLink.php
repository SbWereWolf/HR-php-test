<?php


namespace App\Presentation;


class PageLink
{
    /**
     * @var string
     */
    private $link;
    /**
     * @var string
     */
    private $caption;
    /**
     * @var string
     */
    private $class;

    private function __construct(
        string $link, string $caption, string $class)
    {
        $this->link = $link;
        $this->caption = $caption;
        $this->class = $class;
    }

    public static function make($link, $caption, $class)
    {
        return new static(
            (string)$link, (string)$caption, (string)$class);
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
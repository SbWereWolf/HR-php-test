<?php


namespace App\Http;


class LinkFabric implements IRouting
{
    /**
     * @var int
     */
    private $capacity;

    public function __construct(int $capacity = 20)
    {
        $this->capacity = $capacity;
    }

    public function toPage(int $page)
    {
        $link = route(self::LIST,
            [self::PAGE => $page, self::LIMIT => $this->capacity]);

        return $link;
    }
}
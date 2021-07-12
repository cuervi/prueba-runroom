<?php

namespace Runroom\GildedRose;

class Item 
{

    public string $name;
    public int $sell_in;
    public int $quality;

    /**
     * 
     * @param string $name
     * @param int $sell_in
     * @param int $quality
     */
    function __construct(string $name, int $sell_in, int $quality) 
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() 
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

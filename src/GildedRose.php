<?php

namespace Runroom\GildedRose;

use Runroom\GildedRose\Item;

class GildedRose 
{

    /**
     * @var array<Item>
     */
    private $items;

    /**
     * @param array<Item> $items
     */
    function __construct(array $items) 
    {
        $this->items = $items;
    }

    function updateQuality(): void
    {
        foreach ($this->items as $item) {
            
            //Cuando es "Sulfuras, Hand of Ragnaros no se modifica nada
            if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                continue;
            }

            //Modificaciones que se aplican a 'Aged Brie' y 'Backstage passes to TAFKAL80ETC Concert'
            if ($item->name == 'Aged Brie' or $item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                
                if ($item->quality < 50) {
                    
                    $item->quality = $item->quality + 1;
                    
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        
                        if ($item->sell_in < 11 and $item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                        
                        if ($item->sell_in < 6 and $item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                        
                    }
                }
                
                //Codigo que se ejecuta en ambos independientemente del valor de Quality
                $item->sell_in = $item->sell_in - 1;
                
                if ($item->sell_in < 0 and $item->name == 'Aged Brie' and $item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
                
                if ($item->sell_in < 0 and $item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    $item->quality = $item->quality - $item->quality;
                }  
                
                continue;
            }
            
            //Codigo para el resto de opciones
            $item->sell_in = $item->sell_in - 1;
            
            if ($item->quality > 0) {
                $item->quality = $item->quality - 1;
                //Si sell_in vale menos de 0 y quality sigue valiendo más de 0 lo volvemos a decrecer una vez más
                if ($item->sell_in < 0 and $item->quality > 0) {
                    $item->quality = $item->quality - 1;
                }
            }
        }
    }
}

<?php

namespace Jalez\SportCalender\Entity;

class Location {
    public int $id;
    public string $address;
    
    function __construct(int $id, string $address) {
        $this->id = $id ;
        $this->address = $address;
    }
}

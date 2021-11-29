<?php

namespace Jalez\SportCalender\Entity;

class Team {
    public int $id;
    public string $name;
    public string $homecity;

    function __construct(int $id, string $name, string $homecity) {
        $this->id = $id ;
        $this->name = $name;
        $this->homecity = $homecity; 
    }
}

<?php

namespace Jalez\SportCalender\Entity;

class Team {
    public int $id;
    public string $name;
    public int $number;

    function __construct(int $id, string $name, int $numb) {
        $this->id = $id ;
        $this->name = $name;
        $this->numb = $numb; 
    }
}

?>
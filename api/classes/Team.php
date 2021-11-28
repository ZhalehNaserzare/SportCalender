<?php
class Team{
    public int $id;
    public string $name;
    public int $number;

    function __construct($id, $name, $numb)
    {
        $this->id = $id ;
        $this->name = $name;
        $this->numb = $numb; 
    }
}

?>
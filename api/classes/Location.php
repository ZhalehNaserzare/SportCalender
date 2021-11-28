<?php
class Location{
    public int $id;
    public string $address;
    
    function __construct($id, $address)
    {
        $this->id = $id ;
        $this->address = $address;
    }
}

?>
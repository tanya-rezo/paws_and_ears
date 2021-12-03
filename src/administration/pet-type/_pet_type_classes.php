<?php

// TODO Manager

class PetType extends Entity
{
    public $name;
    public $sale_name;

    public function load($db_data)
    {
        $this->id = $db_data["pet_type_id"];
        $this->name = $db_data["pet_type_name"];
        $this->sale_name = $db_data["pet_type_sale_name"];
    }
}

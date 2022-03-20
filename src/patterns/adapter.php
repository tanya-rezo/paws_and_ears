<?php
class Person
{
    function __construct($name)
    {
        $this->name = $name;
    }

    protected $name;

    function get_name()
    {
        return $this->name;
    }
}

class FrenchPerson
{
    function __construct($le_nom)
    {
        $this->le_nom = $le_nom;
    }

    protected $le_nom;

    function get_le_nom()
    {
        return $this->le_nom;
    }
}


class FrenchPersonAdapter extends Person
{
    function __construct($la_person)
    {
        $this->la_person = $la_person;
    }

    protected $la_person;

    function get_name()
    {
        return $this->la_person->get_le_nom();
    }
}

class NamePrinter
{
    function print_name($person)
    {
        echo $person->get_name();
    }
}

$printer = new NamePrinter();

$person = new Person("Arthur");
$la_person = new FrenchPerson("Maria");

$printer->print_name($person);
$printer->print_name(new FrenchPersonAdapter($la_person));

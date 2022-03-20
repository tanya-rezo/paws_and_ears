<?php

// интерфейс должен быть реализован структурой, поддерживающей перебор своих данных
interface IAggregate
{
    function get_iterator();
}

// интерфейс итератора
interface IIterator
{
    function move_next();
    function get_current();
}

class DbQuery implements IAggregate
{
    public function __construct($max_rows)
    {
        $this->max_rows = $max_rows;
    }

    protected $max_rows;

    function get_iterator()
    {
        // тут будет создание SQL запроса с ограничением количества строк вывода с учётом $max_rows
        $items = [];
        return new DbQueryIterator($items);
    }
}

class DbQueryIterator implements IIterator
{
    public function __construct($items)
    {
        $this->items = $items;
    }

    protected $current;
    protected $items = array();
    public $position = 0;

    function get_current()
    {
        return $this->current;
    }

    function move_next()
    {
        $this->position = $this->position + 1;
        $this->current = $this->items[$this->position];

        return $this->current;
    }
}

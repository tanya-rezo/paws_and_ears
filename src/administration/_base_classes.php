<?php
// абстрактный менеджер сущностей
abstract class EntityManager
{
    public abstract function getAll($conn);
}

// абстрактная сущность
abstract class Entity
{
    public $id;

    public abstract function load($db_data);
}

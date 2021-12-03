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

    public abstract function load($row); // загрузить данные

    public abstract function create($conn); // создать
    public abstract function save($conn); // сохранить
    public abstract function delete($conn); // удлить
}

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

    public abstract function load($row); // загрузить данные из массива данных

    public abstract function create($conn); // создать
    public abstract function refresh($conn); // обновить объект данными из БД (id должен быть указан)
    public abstract function save($conn); // обновить БД данными из объекта (сохранить по id)
    public abstract function delete($conn); // удалить (по id)
}

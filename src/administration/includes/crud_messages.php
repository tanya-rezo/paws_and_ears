<?php if (isset($_GET["save"])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Данные сохранены!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (isset($_GET["create"])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Объект успешно создан!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (isset($_GET["delete-success"])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Удаление произошло успешно!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (isset($_GET["delete-error"])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ошибка при удалении! Необходимо удалить все связанные объекты!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php endif ?>
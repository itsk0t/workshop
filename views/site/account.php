<?php foreach ($myapplications as $el) { ?>
    <div class="card w-100 mb-3">
        <div class="card-body shadow-sm">
            <h5 class="card-title">Имя: <?php echo $el['name'] ?> <?php echo $el['surname'] ?></h5>
            <p class="card-text">Содержание заявки: <?php echo $el['body'] ?></p>
            <p class="card-text">Вид работы: <?php echo $el->services->title ?></p>
            <p class="rounded-2 <?php echo $el->getColor()?>">Статус заявки: <?php echo $el->getStatus()?></p>
        </div>
    </div>
<?php } ?>

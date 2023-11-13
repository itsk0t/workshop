<div class="d-flex justify-content-around mt-3">
    <?php foreach ($services as $el) { ?>
        <div class="card shadow-sm" style="width: 18rem;">
            <img src="image/<?php echo $el['image'] ?>" class="card-img-top" alt="<?php echo $el['title'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $el['title'] ?></h5>
                <a href="<?php echo \yii\helpers\Url::toRoute(['site/servicesinfo', 'id' => $el['id']]) ?>" class="btn btn-primary w-100">Подробнее</a>
            </div>
        </div>
    <?php } ?>
</div>

<hr style="width: 100%; color: grey; margin-top: 3%; margin-bottom: 3%">

<div>
    <h4 style="text-align: center">Время работы мастерской</h4>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Пн - Пт</th>
            <th scope="col">Сб - Вс</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        <?php foreach ($timetable as $el) { ?>
            <tr>
                <th scope="row"><?php echo $el['id'] ?></th>
                <td><?php echo $el['weekdays'] ?></td>
                <td><?php echo $el['weekend'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
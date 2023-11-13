<div>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="image/<?php echo $services['image'] ?>" class="card-img-top" alt="<?php echo $services['title'] ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <a class="link-opacity-25-hover" href="<?php echo \yii\helpers\Url::toRoute(['site/index']) ?>" style="text-decoration: none; color: black;">&#129044; Назад</a>
                    <h4 class="card-title mt-3"><?php echo $services['title'] ?></h4>
                    <p class="card-text"><b>Цена:</b> <?php echo $services['price'] ?> &#8381;</p>
                    <p class="card-text"><b>Сроки:</b> <?php echo $services['deadline'] ?></p>
                    <a class="btn btn-primary" href="<?php echo \yii\helpers\Url::toRoute(['site/applications']) ?>">Оставить заявку</a>
                </div>
            </div>
        </div>
    </div>
</div>

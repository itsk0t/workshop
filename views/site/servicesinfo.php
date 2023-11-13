<div>
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="image/<?php echo $category['image'] ?>" class="card-img-top"
                     alt="<?php echo $category['title'] ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <a class="link-opacity-25-hover" href="<?php echo \yii\helpers\Url::toRoute(['site/index']) ?>"
                       style="text-decoration: none; color: black;">&#129044; Назад</a>
                    <h4 class="card-title mt-3"> <?php echo $category['title'] ?></h4>
                    <p class="card-text"><?php echo $category['body'] ?></p>
                    <p><b>Услуги:</b></p>
                    <?php foreach ($services as $el) { ?>
                        <?php if ($el['category_id'] == $category['id']) { ?>
                            <a class="btn btn-primary mb-2" href="<?php echo \yii\helpers\Url::toRoute(['site/servicesdetail', 'id' => $el['id']]) ?>"><?php echo $el['title'] ?></a><br>
                        <?php } else { continue; }?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

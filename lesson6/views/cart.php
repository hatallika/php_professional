<h2>Корзина</h2>

<?php if(!empty($cart)):?>
    <?php foreach ($cart as $item):?>
        <div>
            <h3><a href="/?c=product&a=card&id=<?=$item['id']?>"><?=$item['name']?></a></h3>
            <img src="/images/<?=$item['image']?>" alt="<?=$item['name']?>" width="150">
            <p>price: <?=$item['price']?></p>
            <button>Удалить</button>
        </div>
    <?php endforeach;?>
<?php else: ?>
    Корзина пуста
<?php endif; ?>

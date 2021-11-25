<h2>Корзина</h2>

<?php if(!empty($cart)):?>
    <?php foreach ($cart as $item):?>
        <div id="<?=$item['cart_id']?>">
            <h3><?=$item['name']?></h3>
            <img src="/images/<?=$item['image']?>" alt="<?=$item['name']?>" width="120">
            <p>price: <?=$item['price']?></p>

            Количество товара:
            <button class="delqnt">-</button>
            <span id="qnt<?=$item['cart_id']?>"><?=$item['quantity']?></span>
            <button class="addqnt">+</button>
            <br>
            <button class="del" data-id="<?=$item['cart_id']?>">Удалить</button>
        </div>
    <?php endforeach;?>
<?php else: ?>
    Корзина пуста
<?php endif; ?>

<button class="addorder">Оформить заказ</button>



<script>
    let buttons = document.querySelectorAll('.del');
    buttons.forEach((elem) => {
        elem.addEventListener('click', ()=>{
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/cart/delete/?id=' + id);
                    const answer = await response.json();
                    document.getElementById(id).remove();
                    if (answer.count){
                        document.getElementById('count').innerText = answer.count;
                    } else
                    {
                        document.getElementById('count').innerText = "пустая";
                    }
                }
            )();
        });
    });

    let buttonAddQnt = document.querySelectorAll('.addqnt');
    buttonAddQnt.forEach((elem) => {
        elem.addEventListener('click', ()=>{
            let id = elem.parentElement.getAttribute('id');
            (
                async () => {
                    const response = await fetch('/cart/addqnt/?id=' + id);
                    const answer = await response.json();

                    document.getElementById('qnt'+id).innerText = answer.quantity;
                    document.getElementById('count').innerText = answer.count;
                }
            )();
        });
    });

    let buttonDelQnt = document.querySelectorAll('.delqnt');
    buttonDelQnt.forEach((elem) => {
        elem.addEventListener('click', ()=>{
            let id = elem.parentElement.getAttribute('id');
            (
                async () => {
                    const response = await fetch('/cart/delqnt/?id=' + id);
                    const answer = await response.json();
                    console.log(answer.quantity);

                    if (answer.quantity == null){
                        document.getElementById(id).remove();
                    } else {
                        document.getElementById('qnt'+id).innerText = answer.quantity;
                    }

                    if (answer.count){
                        document.getElementById('count').innerText = answer.count;
                    } else
                    {
                        document.getElementById('count').innerText = "пустая";
                    }
                }
            )();
        });
    });

</script>

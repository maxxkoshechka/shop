<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Заказ № <?=$order['id'];?>
        <?php if (!$order['status']):?>
            <a href="<?=ADMIN?>/order/change?id=<?=$order['id'];?>&status=1" class="btn btn-success btn-xs">Одобрить</a>
        <?php elseif ($order['status']): ?>
            <a href="<?=ADMIN?>/order/change?id=<?=$order['id'];?>" class="btn btn-default btn-xs">Вернуть на дороботку</a>
        <?php endif;?>
        <a href="<?=ADMIN?>/order/delete?id=<?=$order['id'];?>" class="btn btn-danger btn-xs delete">Удалить</a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/order">Список заказов</a></li>
        <li class="active">Заказ № <?=$order['id'];?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Номер заказа</th>
                                <th>Дата заказа</th>
                                <th>Дата изменения</th>
                                <th>Количество позиций в заказе</th>
                                <th>Сумма заказа</th>
                                <th>Валюта</th>
                                <th>Имя заказчика</th>
                                <th>Статус заказа</th>
                                <th>Комментарий</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$order['id'];?></td>
                                    <td><?=$order['date'];?></td>
                                    <td><?=$order['update_at'];?></td>
                                    <td><?=count($orderProducts);?></td>
                                    <td><?=$order['sum'];?></td>
                                    <td><?=$order['currency'];?></td>
                                    <td><?=$order['name'];?></td>
                                    <td><?=$order['status'];?></td>
                                    <td><?=$order['note'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h3>Детали заказа</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование</th>
                                <th>Количество</th>
                                <th>Цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $qty = 0; foreach ($orderProducts as $product): ?>
                                <tr>
                                    <td><?=$product->product_id;?></td>
                                    <td><?=$product->title;?></td>
                                    <td><?=$product->qty; $qty += $product->qty;?></td>
                                    <td><?=$product->price;?></td>
                                </tr>
                            <?php endforeach;?>
                                <tr class="active">
                                    <td colspan="2">
                                        <b>Итого:</b>
                                    </td>
                                    <td><b><?=$qty;?></b></td>
                                    <td><b><?=$order['sum'];?> <?=$order['currency'];?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование пользователея
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/user"><i class="fa fa-dashboard"></i> Список пользователей</a></li>
        <li class="active">Редактирование пользователея</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/user/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="login">Логин</label>
                            <input type="text" class="form-control" name="login" id="login" value="<?=getNoHtmlString($user->login);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль если хотите его изменить">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" value="<?=getNoHtmlString($user->name);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Введите Email" value="<?=getNoHtmlString($user->email);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Введите адрес" value="<?=getNoHtmlString($user->address);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="role">Роль</label>
                            <select name="role" id="role" class="form-control">
                                <option value="user" <?php if ($user->role == 'user') echo 'selected'?> >Пользователь</option>
                                <option value="admin" <?php if ($user->role == 'admin') echo 'selected'?> >Администратор</option>
                            </select>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" value="<?=$user->id;?>" name="id">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
            <h3>Заказы пользователя</h3>
            <div class="box">
                <div class="box-body">
                    <?php if ($orders): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Статус</th>
                                    <th>Сумма</th>
                                    <th>Дата создания</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order):?>
                                    <?php $class = $order['status'] ? 'success' : '';?>
                                    <tr class="<?=$class?>">
                                        <td><?=$order['id'];?></td>
                                        <td><?=$order['status'] ? 'Завершен' : 'Новый';?></td>
                                        <td><?=$order['sum'];?> <?=$order['currency'];?></td>
                                        <td><?=$order['date'];?></td>
                                        <td><?=$order['update_at'];?></td>
                                        <td><a href="<?=ADMIN;?>/order/view?id=<?=$order['id'];?>"><i class="fa fa-fw fa-eye"></i></a></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-danger">Заказов нет.</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
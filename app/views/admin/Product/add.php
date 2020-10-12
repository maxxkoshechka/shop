<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новый товар
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/product">Список товаров</a></li>
        <li class="active">Новый товар</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/product/add" method="post" data-toggle="validator" id="add">
                    <div class="box-body">
                        <!-------------------------------------Название товара-------------------------------------------------------->
                        <div class="form-group has-feedback">
                            <label for="title">Название товара</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Название товара" value="<?php isset($_SESSION['form_data']['title']) ? getNoHtmlString($_SESSION['form_data']['title']) : null;?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <!-------------------------------------Категория-------------------------------------------------------->
                        <div class="form-group">
                            <label for="parent_id">Категория</label>
                            <?php new app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/select.php',
                                'container' => 'select',
                                'cache' => 0,
                                'cacheKey' => 'admin_select',
                                'attrs' => [
                                    'name' => 'category_id',
                                    'id' => 'category_id,'
                                ],
                                'class' => 'form-control',
                                'prepend' => '<option>Выберите категорию</option>'
                            ])?>
                        </div>
                        <!---------------------------------------Ключевые слова------------------------------------------------------>
                        <div class="form-group has-feedback">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Ключевые слова"  value="<?php isset($_SESSION['form_data']['keywords']) ? getNoHtmlString($_SESSION['form_data']['keywords']) : null;?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <!---------------------------------------Описание------------------------------------------------------>
                        <div class="form-group has-feedback">
                            <label for="description">Описание</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Описание" value="<?php isset($_SESSION['form_data']['description']) ? getNoHtmlString($_SESSION['form_data']['description']) : null;?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <!---------------------------------------Цена------------------------------------------------------>
                        <div class="form-group has-feedback">
                            <label for="price">Цена</label>
                            <input type="text" name="price" class="form-control" id="price" pattern="^[0-9.]{1,}$" placeholder="Цена" value="<?php isset($_SESSION['form_data']['price']) ? getNoHtmlString($_SESSION['form_data']['price']) : null;?>" required data-error="Допускаются цыфры и точка">
                            <div class="help-block with-errors"></div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <!----------------------------------------Старая цена----------------------------------------------------->
                        <div class="form-group">
                            <label for="old_price">Старая цена</label>
                            <input type="text" name="old_price" class="form-control" id="old_price" pattern="^[0-9.]{1,}$" placeholder="Старая цена" value="<?php isset($_SESSION['form_data']['old_price']) ? getNoHtmlString($_SESSION['form_data']['old_price']) : null;?>"  data-error="Допускаются цыфры и точка">
                            <div class="help-block with-errors"></div>
                        </div>
                        <!-----------------------------------------Контент---------------------------------------------------->
                        <div class="form-group">
                            <label for="content">Контент</label>
                            <textarea name="content" id="editor1" cols="80" rows="10"><?php isset($_SESSION['form_data']['content']) ? getNoHtmlString($_SESSION['form_data']['content']) : null;?></textarea>
                        </div>
                        <!-----------------------------------------Статус---------------------------------------------------->
                        <div class="form-group ">
                            <label>
                                <input type="checkbox" name="status" checked> Статус
                            </label>
                        </div>
                        <!-----------------------------------------Хит---------------------------------------------------->
                        <div class="form-group ">
                            <label>
                                <input type="checkbox" name="hit"> Хит
                            </label>
                        </div>
                        <!-----------------------------------------Связанные товары---------------------------------------------------->
                        <div class="form-group ">
                            <label for="related">Связанные товары</label>
                            <select name="related[]" class="form-control select2" id="related" multiple></select>
                        </div>
                        <!-----------------------------------------filter---------------------------------------------------->
                        <?php new app\widgets\filter\Filter(null, WWW . '/filter/admin_filter_tpl.php')?>

                        <!-----------------------------------------Базовое изображение---------------------------------------------------->
                        <div class="form-group">
                            <div class="col-md-4">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Базовое изображение</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="single" class="btn btn-success" data-url="product/add-image" data-name="single">Выбрать файл</div>
                                        <p><small>Рекомендуемые размеры: 125х200</small></p>
                                        <div class="single"></div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        <!-----------------------------------------Картинки галереи---------------------------------------------------->
                            <div class="col-md-8">
                                <div class="box box-primary box-solid file-upload">
                                    <div class="box-header">
                                        <h3 class="box-title">Картинки галереи</h3>
                                    </div>
                                    <div class="box-body">
                                        <div id="multi" class="btn btn-success" data-url="product/add-image" data-name="multi">Выбрать файл</div>
                                        <p><small>Рекомендуемые размеры: 700х1000</small></p>
                                        <div class="multi"></div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-----------------------------------------Модификации---------------------------------------------------->
                        <div class="form-group">
                            <label for="modification_color">Цвет модификации</label>
                            <input type="text" name="modification_color[]" class="form-control" id="modification_color" placeholder="Цвет модификации">
                            <label for="modification_price">Цена модификации</label>
                            <input type="text" name="modification_price[]" class="form-control" id="modification_price" placeholder="Цена модификации" data-error="Допускаются цыфры и точка">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data'])?>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
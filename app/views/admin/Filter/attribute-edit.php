<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование фильтра <?=getNoHtmlString($attr->value);?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/filter/attribute"><i class="fa fa-dashboard"></i> Фильтры</a></li>
        <li class="active">Редактирование фильтра <?=getNoHtmlString($attr->value);?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/filter/attribute-edit" method="post" data-toggle="validator" id="add">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="value">Название фильтра</label>
                            <input type="text" name="value" class="form-control" id="value" placeholder="Название фильтра" value="<?=getNoHtmlString($attr->value);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="category_id">Название группы</label>
                            <select name="attr_group_id" id="category_id" class="form-control">
                                <option>Выберете группу</option>
                                <?php foreach ($group as $item): ?>
                                    <option value="<?=$item->id;?>" <?php if ($item->id == $attr->attr_group_id) echo 'selected'; ?>><?=$item->title;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$attr->id;?>">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</section>
<!-- /.content -->
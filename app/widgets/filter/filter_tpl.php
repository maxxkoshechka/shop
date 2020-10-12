<?php foreach ($this->groups as $group_id => $group_item): ?>
    <section class="sky-form">
        <h4><?= $group_item; ?></h4>
        <div class="row1 scroll-pane">
            <div class="col col-4">
                <?php if (isset($this->attributes[$group_id])): ?>
                <?php foreach ($this->attributes[$group_id] as $attribute_id => $attribute_value): ?>
                    <?php
                        if(!empty($filter) && in_array($attribute_id, $filter)){
                            $checked = ' checked';
                        }
                        else{
                            $checked = null;
                        }
                    ?>
                    <label class="checkbox">
                        <input type="checkbox" name="checkbox" <?=$checked?>
                               value="<?= $attribute_id; ?>"><i></i><?= $attribute_value ?>
                    </label>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endforeach; ?>

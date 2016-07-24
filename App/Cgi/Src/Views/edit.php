<?php if(isset($data['errors']) && !empty($data['errors'])) {
    foreach ($data['errors'] as $error) {
        if(!empty($error)) { ?>
        <div id="login-alert" class="alert alert-danger col-sm-12"><?=$error?></div>
            <?php } ?>
    <?php } ?>
<?php } ?>
<?php if(isset($data['success']) && !empty($data['success'])) { ?>

    <div id="login-alert" class="alert alert-success col-sm-12"><?=$data['success']?></div>

<?php } ?>
<h1>Edit product</h1>
<br>
<form method="post" action="<?=SCRIPT_ROOT . 'products/edit'?>">
    <div class="form-group row">
        <label for="inputName" class="col-sm-2 form-control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="<?=$data['product']->getName()?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputName" class="col-sm-2 form-control-label">Sku</label>
        <div class="col-sm-10">
            <input type="text" name="sku" class="form-control" id="inputSku" placeholder="Sku" value="<?=$data['product']->getSku()?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">Status</label>
        <div class="col-sm-10">
            <div class="checkbox">
                <label>
                    <select class="form-control" name="is_saleable">
                        <option <?php echo ($data['product']->getStatus() ? 'selected' : '')?> value="1">Enabled</option>
                        <option <?php echo (!$data['product']->getStatus() ? 'selected' : '')?> value="0">Disabled</option>
                    </select>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDescription" class="col-sm-2 form-control-label">Description</label>
        <div class="col-sm-10">
            <textarea rows="10" name="description" class="form-control" id="inputDescription" placeholder="Description" required><?=$data['product']->getDescription()?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPrice" class="col-sm-2 form-control-label">Price</label>
        <div class="col-sm-10">
            <input type="text" name="final_price_with_tax" class="form-control" id="inputPrice" placeholder="Price" value="<?=$data['product']->getPrice()?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputLastUpdated" class="col-sm-2 form-control-label">Last Updated</label>
        <div class="col-sm-10">
            <span><?=$data['product']->getUpdatedDate()?></span>
        </div>
    </div>
    <input type="hidden" name="product_id" value="<?=$data['product']->getId()?>">
    <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
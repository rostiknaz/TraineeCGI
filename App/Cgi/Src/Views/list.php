    <div class="row">
        <div class="col-md-6">
            <h2>Products List</h2>
        </div>
        <div class="col-md-6">
            <form class="form-inline">
            <div class="form-group">
                <ul class="pagination pagination-md">
                    <?php for($i=1;$i<=4;$i++):?>
                        <li><a href="<?=SCRIPT_ROOT . 'products/list?limit=' . ($i*10) . '&page=1'?>"><?=($i*10)?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product Id</th>
            <th><a href="<?=SCRIPT_ROOT . 'products/list?column=name&sort=' . (($data['products']['sort']  == 'ASC') ? 'DESC' : 'ASC')?>">Name <span class="<?='glyphicon glyphicon-arrow-' . (($data['products']['sort']  == 'ASC' && $data['products']['column'] == 'name') ? 'down' : 'up')?>"></span></a></th>
            <th><a href="<?=SCRIPT_ROOT . 'products/list?column=final_price_with_tax&sort=' . (($data['products']['sort']  == 'ASC') ? 'DESC' : 'ASC')?>">Price <span class="<?='glyphicon glyphicon-arrow-' . (($data['products']['sort']  == 'ASC' && $data['products']['column'] == 'final_price_with_tax') ? 'up' : 'down')?>"></span></a></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['products']['result']->data as $product) { ?>
        <tr>
            <td><?=$product['product_id']?></td>
            <td><?=$product['name']?></td>
            <td><?=$product['final_price_with_tax']?></td>
            <td><a href="<?=SCRIPT_ROOT . 'products/edit?id=' . $product['product_id']?>">Edit</a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="text-center">
        <?php echo $data['products']['paginator']->createLinks(1,'pagination pagination-md'); ?>
    </div>

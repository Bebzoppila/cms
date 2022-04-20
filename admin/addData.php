<?php
    include_once 'admin/header.php';
    include_once 'admin/Db/DataBase.php';

    $db = new DataBase();
    $allTables = $db->queryAll('SHOW TABLES;');
    unset ($allTables[0]);
?>
<div class="w-50">
    <?php foreach ($allTables as $key => $allTablesValue): ?>
        <?php
            $allKeys = $db->queryAll("DESCRIBE `$allTablesValue[Tables_in_admin1]`");
            $allValues = $db->queryAll("SELECT * FROM `$allTablesValue[Tables_in_admin1]`");
        ?>
        <h4 class="d-block">Название типа полей - <?= $allTablesValue['Tables_in_admin1'] ?></h4>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <?php foreach ($allKeys as $valueKey): ?>
                        <th scope="col"><?= $valueKey['Field'] ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allValues as $valueTable): ?>
                    <tr>
                        <?php foreach ($valueTable as $val): ?>
                            <td><?= $val ?></td>
                        <?php endforeach; ?>
                        <td>
                            <button
                                data-itemID="<?= $valueTable['id'] ?>"
                                data-tableName="<?= $allTablesValue['Tables_in_admin1'] ?>"
                                class="btn btn-danger btn-delete">Удалить</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <?php foreach ($allKeys as $key => $value): ?>
                        <td>
                            <input
                                data-tableName="<?= $allTablesValue['Tables_in_admin1'] ?>"
                                name="<?= $value['Field'] ?>"
                                type="<?= str_contains($value['Field'], 'img') ? 'file' : 'text'; ?>">
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
        <div>
            <button
                    data-tableName="<?= $allTablesValue['Tables_in_admin1'] ?>"
                    class="btn btn-primary mb-5 create">Добавить значение</button>

            <button class="btn btn-danger mb-5">Удалить Таблицу</button>
        </div>
    <?php endforeach; ?>
</div>

<script>
    const allButtonsCreate = document.querySelectorAll('.create');

    allButtonsCreate.forEach(btnCreate => {
        btnCreate.addEventListener('click', () => {
            const allInputs = document.querySelectorAll(`[data-tableName="${btnCreate.dataset.tablename}"]`)
            const allResData = new FormData();
            allInputs.forEach((input) => {
                if(input.name === 'img'){
                    allResData.append(input.name, input.files[0])
                }else{
                    allResData.append(input.name, input.value)
                }
            })
            allResData.append('tableName', btnCreate.dataset.tablename)
            // console.log(allResData)
            fetch('/admin/Api/index.php', {
                method: 'POST',
                body: allResData
            })
            console.log()
        })
    })

    const allButtonsDelete = document.querySelectorAll('.btn-delete');
    allButtonsDelete.forEach(btnDel => {
        btnDel.addEventListener('click', () => {
            fetch('/admin/Api/index.php', {
                method: 'DELETE',
                body: JSON.stringify({id: btnDel.dataset.itemid, tableName: btnDel.dataset.tablename})
            })
        })
    })


</script>

<?php
require_once 'admin/footer.php.php';
?>

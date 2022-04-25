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
            <tbody id="<?= $allTablesValue['Tables_in_admin1'] ?>">
                <?php foreach ($allValues as $valueTable): ?>
                    <tr id="id<?= $valueTable['id'] ?>">
                        <?php foreach ($valueTable as $tdKey => $val): ?>
                            <td data-tablename="<?= $allTablesValue['Tables_in_admin1'] ?>" data-id="<?= $valueTable['id'] ?>"
                                data-key="<?= $tdKey ?>"><?= $val ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <button data-itemid="<?= $valueTable['id'] ?>"
                                data-tableName="<?= $allTablesValue['Tables_in_admin1'] ?>"
                                class="btn btn-danger btn-delete">Удалить</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
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
            const tabel = document.querySelector(`#${btnCreate.dataset.tablename}`)
            console.log(tabel)
            fetch('http://adminka:81/admin/add-data/ ', {
                method: 'POST',
                body: allResData
            }).then(response => response.json()).then(data => {
                const line = createLine(allInputs, btnCreate.dataset.tablename, data.id)
                tabel.append(line)
            })
        })
    })

    document.addEventListener('click', (event) => {
        if(Array.from(event.target.classList).includes('btn-delete')){
            console.log(event.target.dataset.tablename)
            deleteRow(event.target.dataset.itemid, event.target.dataset.tablename)
            const element = document.querySelector(`#id${event.target.dataset.itemid}`)
            element.remove()
        }
    })

    function createLine(allInputs, tableName, id){
        const resItem = document.createElement('tr')
        resItem.id = `id${id}`
        allInputs.forEach(input => {
            resItem.append(createColumn(input.value))
        })
        const column = createColumn()
        const btn = document.createElement('button')
        btn.dataset.tablename = tableName
        btn.dataset['itemid'] = id
        btn.textContent = 'Удалить'
        btn.classList += ' btn btn-danger btn-delete'
        column.append(btn)
        resItem.append(column)
        return resItem
    }

    function createColumn(text = ''){
        const column = document.createElement('td')
        column.textContent = text
        return column
    }

    function deleteRow(id, tableName){
        fetch('/admin/Api/index.php', {
            method: 'DELETE',
            body: JSON.stringify({id: id, tableName: tableName})
        })
    }

    //<input
    //    data-tableName="<?//= $allTablesValue['Tables_in_admin1'] ?><!--"-->
    <!--    name="--><?//= $value['Field'] ?><!--"-->
    <!--    type="--><?//= str_contains($value['Field'], 'img') ? 'file' : 'text'; ?><!--">-->

    const allTd = document.querySelectorAll('td')
    allTd.forEach(td => {
        td.addEventListener('dblclick', () => {
            const key = td.dataset.key
            const id = td.dataset.id
            const tableName = td.dataset.tablename
            const input = document.createElement('textarea')
            input.value = td.textContent
            td.textContent = ''
            td.append(input)
            const button = document.createElement('button')
            button.className += 'btn btn-success'
            button.textContent = 'отправить'

            button.onclick = () => {
                td.innerHTML = ''
                td.textContent = input.value
                fetch('http://adminka:81/admin/update-data/', {
                    method: 'POST',
                    body: JSON.stringify({key: key, id: id, value: input.value, tableName: tableName})
                })
            }
            td.append(button)
        })
    })

</script>

<?php
require_once 'admin/footer.php.php';
?>

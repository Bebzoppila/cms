<?php
    include_once 'admin/header.php';
    include_once 'admin/Db/DataBase.php';

//        if($_SERVER['REQUEST_METHOD'] === 'POST'){
//            $sql = "CREATE TABLE `$_POST[tableName]`(";
//            unset($_POST['tableName']);
//            $sql .= "`id` INT(11) NOT NULL AUTO_INCREMENT,";
//            foreach ($_POST as $key => $value){
//                if($value[1] == 'IMG'){
//                    $sql .= "`$value[0]` VARCHAR(255) NOT NULL,";
//                    continue;
//                }
//                $sql .= "`$value[0]` $value[1] NOT NULL,";
//            }
//
//            $sql = $sql . ' PRIMARY KEY (`id`))  ENGINE = InnoDB;';
//            $db = new DataBase();
//            $db->sthExecute($sql);
//        }
?>


<?php
$allTypes = ['INT' => 'Целочисленное число',
    'VARCHAR(255)' => 'Строка длинной 255 char',
    'TEXT' => 'Текстовое поле', 'DATE' => 'Дата', 'IMG' => 'Картинка'];
?>
<div>
    <h3>Создание типа полей</h3>

    <form id="form" method="POST" class="">
        <div class="form-group w-25">
            <label for="">Название типа полей</label>
            <input class="mt-3 mb-3" name="tableName" type="text">
        </div>
        <div class="form-inner">
            <div class="form-group d-flex flex-column w-25">
                <label for="field1">Название поля</label>
                <input id="field1" name="field1[]" type="text">
                <label for="field1">Тип поля</label>
                <select name="field1[]" class="custom-select my-1 mr-sm-2 p-2" id="inlineFormCustomSelectPref">
                    <option hidden selected>Тип поля</option>
                    <?php foreach ($allTypes as $key => $value): ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="d-flex align-items-end gap-2">
            <button type="button" id="btn-create" class="btn btn-primary">Добавить поле</button>
            <button type="submit" class="btn btn-success mt-2">Создать</button>
        </div>
    </form>

</div>

<div class="form-group d-flex flex-column w-25">
    <label for="field1">Название поля</label>
    <input id="field1" name="field1[]" type="text">
    <label for="field1">Тип поля</label>
    <select name="field1[]" class="custom-select my-1 mr-sm-2 p-2" id="inlineFormCustomSelectPref">
        <option hidden="" selected="">Тип поля</option>
        <option value="INT">Целочисленное число</option>
        <option value="VARCHAR(255)">Строка длинной 255 char</option>
        <option value="TEXT">Текстовое поле</option>
        <option value="DATE">Дата</option>
    </select>
</div>


<script>
    const btnCreate = document.querySelector('#btn-create');

    btnCreate.addEventListener('click', () => {
        addNewField()
    })

    function addNewField(){
        const fieldId = Math.floor(Math.random() * Date.now())
        const form = document.querySelector('.form-inner');
        const innerDiv = document.createElement('div')
        innerDiv.className += 'form-group d-flex flex-column w-25'
        innerDiv.append(createLabel('Название поля'))
        innerDiv.append(createInput(fieldId))
        innerDiv.append(createLabel('Тип поля'))
        innerDiv.append(createSelect(fieldId))
        form.append(innerDiv)
    }

    function createLabel(text){
        const label = document.createElement('label');
        label.textContent = text
        return label
    }

    function createInput(idName){
        const input = document.createElement('input');
        input.name = `field${idName}[]`
        return input
    }

    function createSelect(idName){
        const select = document.createElement('select');
        select.name = `field${idName}[]`
        select.className += 'custom-select my-1 mr-sm-2 p-2'
        const allOptions = [
            {value: 'INT(11)', text: 'Целочисленное число'},
            {value: 'VARCHAR(255)', text: 'Строка длинной 255 char'},
            {value: 'TEXT', text: 'Текстовое поле'},
            {value: 'DATE', text: 'Дата'},
            {value: 'IMG', text: 'Картинка'}
        ]
        for (const option of allOptions) {
            select.append(createOption(option.value, option.text))
        }
        return select
    }

    function createOption(value, text){
        const option = document.createElement('option')
        option.value = value
        option.textContent = text
        return option
    }

    const form = document.querySelector('form')
    form.addEventListener('submit', (event) => {
        event.preventDefault()

        fetch('http://adminka:81/admin/create-field/',{
            method: 'POST',
            body: new FormData(form)
        })
    })

</script>
<?php
require_once 'admin/footer.php';
?>

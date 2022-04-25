<?php
    include_once ('admin/header.php');
    include_once 'admin/Db/DataBase.php';
    include_once 'admin/useful/Files.php';
    $db = new DataBase();
    $allInformation = $db->queryOne('SELECT * FROM `general-information`');
?>
        <div class="col py-3">
            <?php
//                echo '<pre>';
////            REQUEST_URI
//                    print_r($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//                echo '<pre>';
            ?>
            <h2>Общая информация</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputPhone">Телефон - <strong class="text-primary">phone</strong></label>
                    <input value="<?= $allInformation['phone'] ?>"
                           type="text" class="form-control"
                           id="exampleInputPhone"
                           aria-describedby="phoneHelp"
                           placeholder="Enter Phone"
                           name="phone"
                    >
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Почта - <strong class="text-primary">email</strong></label>
                    <input
                            value="<?= $allInformation['email'] ?>"
                            type="text"
                            class="form-control"
                            id="exampleInputPassword1"
                            placeholder="Пароль"
                            name="email"
                    >
                </div>
                <div class="form-group mt-3">
                    <label for="formFile" class="form-label">
                        Ваш логотип - <strong class="text-primary">logo</strong></label>
                    <input
                            accept="image/jpeg,image/png"
                            class="form-control" type="file"
                            id="formFile"
                            name="logo"
                            value=""
                    >
                </div>
                <button type="submit" class="btn btn-primary mt-2">Применить изменения</button>
            </form>
        </div>

    <script>
        const form = document.querySelector('form')
        form.addEventListener('submit', (event) => {
            event.preventDefault()
            fetch('http://adminka:81/admin/update-general-info/', {
                method: 'POST',
                body: new FormData(form)
            })
        })

    </script>
<?php
    require_once 'admin/footer.php';
?>
<?php
    include_once ('admin/header.php');
    include_once 'admin/Db/DataBase.php';
    include_once 'admin/useful/Files.php';
    $db = new DataBase();
    $allInformation = $db->queryOne('SELECT * FROM `general-information`');
    $uploadFile = 'images/logo.jpg';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(Files::loadFile('logo', 'logo.jpg')){
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $allInformation = array_merge($allInformation, $_POST);
            $db->sthExecute("UPDATE `general-information`
                    SET logo = 'images/logo.jpg',
                    phone = '$phone',
                    email = '$email'
                    WHERE `general-information`.id = 1");
        };
    }
?>
        <div class="col py-3">
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
<?php
    require_once 'admin/footer.php';
?>
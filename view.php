<?php $controller = new controller(); ?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <div id="header">
            <?php
            if (!empty($_SESSION['login'])) { ?>
            <div style="color: white; /*margin:5px;*/"> 
                <form name="unlogin" action="" method="post">
                    <button type="submit" name="unlogin" value="unlogin" 
                            class="btn btn-light" >
                        <?= $_SESSION['login']; ?>(Выйти)
                    </button>
                </form>
            </div>
            <?php
            }
            ?>
        </div>
        <?php if (empty($_SESSION['login'])) :?>
        <div class="container divForm" id="divformlogin" style="padding: 0;">
            <form name="login" action="" method="post">
            <div style="padding: 15px" >Введите логин</div>
            <hr class="hr" />
            <!--<div class="row" >-->
                <input class="field" name="login" placeholder="Логин" />
            <!--</div>-->
            <div class="row" style="margin-right:14px;" >
                <input type="submit" class="btn btn-primary col-6 offset-6 button" 
                       style="" name="loginsave"  value="Ok">
            </div>
            </form>
        </div>
        <?php else: ?>
        <div class="container divForm" id="divformContact" style="padding: 0;">
            <form name="addContact" action="" method="post">
            <div style="padding: 15px" >Добавить контакт</div>
            <hr class="hr" />
            <!--<div class="row" >-->
                <input class="field" name="name" placeholder="Имя" />
                <input class="field" name="phone" placeholder="Телефон" />
            <!--</div>-->
            <div class="row" style="margin-right:14px;" >
                <input type="submit" class="btn btn-primary col-6 offset-6 button" 
                       style="" name="ContactSave"  value="Ok">
            </div>
            </form>
        </div>
            <?php if (!empty($controller->contacts)): ?>
                <div class="container divForm" id="divformContact" style="overflow: auto; padding: 0;margin-top:140px">
                    <div style="padding: 15px" >Список контактов</div>
                    <hr class="hr" />
                    <?php foreach ($controller->contacts as $contact) :?>
                        <?php if ($contact["contactsuser"] != $_SESSION['login']) {continue;}?>
                        <div style="margin: 5px; margin-left: 15px;">
                        <?= $contact['contactsname'] . 
                            ' <form style="margin-bottom:-25px;" method="post">
                                <input type="hidden" name="id" value="'.$contact["idcontacts"].'" />
                                <input type="submit" 
                                class="btn btn-link button" 
                       style="margin-top:-30px;margin-left:180px" name="ContactDel"  value="x" /></form> '
                            . "<br />" . $contact['contactsphone'];?>
                        </div>
                    <hr style="margin:0;" />
                    <?php endforeach; ?>
                
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div style="background-color: black;position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 50px;">
        </div>
    </body>
</html>

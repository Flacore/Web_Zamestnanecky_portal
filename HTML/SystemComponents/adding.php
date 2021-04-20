<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'];
?>
<body>

<div class="container center" id="add_person">
    <h3>Vloženie osoby.</h3>
    <form action="" method="post">
        <div class="center">
            <label>Rodné číslo</label>
            <input type="text" pattern="[0-9]{6}/[0-9]{4}" name="rod_cislo">
        </div>
        <div class="center">
            <label>Meno</label>
            <input type="text" name="name">
        </div>
        <div class="center">
            <label>Priezvisko</label>
            <input type="text" name="sur_name">
        </div>
        <input type="submit" value="Odoslať">
    </form>
</div>

</body>
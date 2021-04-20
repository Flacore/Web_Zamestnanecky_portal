<?php include "../../PHP/config_DB.php";
$id=$_SESSION['session'];
?>
<body>

<div class="container center" id="import_persons">
    <h3>Vloženie osoby.</h3>
    <form action="" method="post">
        <label>Rodné číslo</label>
        <input type="text" pattern="[0-9]{6}/[0-9]{4}" name="rod_cislo">
        <label>Meno</label>
        <input type="text" name="name">
        <label>Priezvisko</label>
        <input type="text" name="sur_name">
    </form>
</div>

</body>
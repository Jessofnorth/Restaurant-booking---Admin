<?php
/* @author Jessica Ejelöv - jeej2100@student.miun.se */
$page_title = "Admin";
include('includes/header.php');
// check for login, if no send to loginpage
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?message=Du%20måste%20vara%20inloggad%20för%20att%20komma%20åt%20denna%20sidan.");
}
// message if dish is added ok
if (isset($_GET["posted"])) {
    $posted = "Maträtten tillaggd!";
}

$menu = new Menu();
// check input
if (isset($_POST['name'])) {
    // save input 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $info = $_POST['info'];
    // check if input is empty
    if (empty($name) || empty($price) || empty($category) || empty($info)) {
        $msg = "Alla fält måste fyllas i.";
    } else {
        // set methods for inputs and methods for adding to API
        if ($menu->setName($name) && $menu->setPrice($price) && $menu->setCategory($category) && $menu->setInfo($info)) {
            if ($menu->addDish()) {
                header("Location: admin.php?posted");
            } else {
                $msg = "Alla fält måste fyllas i korrekt.";
            }
        } else {
            $msg = "Alla fält måste fyllas i.";
        }
    }
}

?>
<div class="container">
    <h1>Admin - Meny</h1>
    <p>Använd formuläret nedan för att lägga till rätter på menyn.</p>
    <p>Längre ner på sidan hittar du Ändra och Radera alternativ. </p>
    <hr>
    <h2>Ny post på menyn</h2>
    <!-- fomr for adding dish -->
    <form method="POST" action="admin.php">
        <div class="forms">
            <label for="name">Namn:</label>
            <input type="text" name="name" id="name" value="<?= $name ?>">
            <label for="price">Pris:</label>
            <input type="number" name="price" id="price" value="<?= $price ?>">
            <label for="info">Info:</label>
            <textarea name="info" id="info" cols="30" rows="10"><?= $info ?></textarea>
            <label for="category">Kategori:</label>
            <select name="category" id="category" required>
                <option value="" disabled selected>Välj kategori</option>
                <option value="starter">Förrätt</option>
                <option value="main">Huvudrätt</option>
                <option value="dessert">Efterrätt</option>
            </select>
            <input type="submit" value="Lägg till">
            <!-- messages -->
            <p class="error"><?= $msg ?></p>
            <p class="posted"><?= $posted ?></p>
        </div>
    </form>
    <hr>
    <div>
        <h2>Meny - Ändra/Radera</h2>
        <p>Klicka på texten du vill ändra och sedan på spara för att ändra en maträtt. Tryck på radera för att radera maträtten.</p>
        <p>Du kan ändra namnet på maträtten, priset (endast heltal) samt informationen om maträtten.</p>
        <p>Om du valde fel kategori så radera maträtten och lägg till den igen med rätt kategori.</p>
        <h3>Förrätter</h3>
        <?php
        // get dishes based on category. for each print with JS functions/eventlisteners and id:s for JS to pick up for UPDATE/DELETE with contenteditable
        $starter = $menu->getMenuByCategory("starter");
        $main = $menu->getMenuByCategory("main");
        $dessert = $menu->getMenuByCategory("dessert");
        if (isset($starter['message'])) {
            echo "<p class='error'>Det finns ingen meny</p>";
        } else {
            foreach ($starter as $s) {
        ?>
                <div class="display-grid">
                    <h4 class="monotype" id="name-edit-<?= $s['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $s['menu_id'] ?>)"><?= $s['name'] ?></h4>
                    <p class="price" id="price-edit-<?= $s['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $s['menu_id'] ?>)"><?= $s['price'] ?></p>
                    <p class="full-width" id="info-edit-<?= $s['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $s['menu_id'] ?>)"><?= $s['info'] ?></p>
                    <button id="btn<?= $s['menu_id'] ?>" onclick="updateDish(<?= $s['menu_id'] ?>)" disabled>Spara</button>
                    <button onclick="deleteDish(<?= $s['menu_id'] ?>)">Radera</button>
                    <p class="error" id="updaterror-<?= $s['menu_id'] ?>"></p>
                </div>
        <?php
            }
        }
        ?>
        <hr>
        <h3>Huvudrätter</h3>
        <?php
        if ($main['message']) {
            echo "<p class='error'>Det finns ingen meny</p>";
        } else {
            foreach ($main as $m) {
        ?>
                <div class="display-grid">
                    <h4 class="monotype " id="name-edit-<?= $m['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $m['menu_id'] ?>)"><?= $m['name'] ?></h4>
                    <p class="price" id="price-edit-<?= $m['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $m['menu_id'] ?>)"><?= $m['price'] ?></p>
                    <p class="full-width" id="info-edit-<?= $m['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $m['menu_id'] ?>)"><?= $m['info'] ?></p>
                    <button id="btn<?= $m['menu_id'] ?>" onclick="updateDish(<?= $m['menu_id'] ?>)" disabled>Spara</button>
                    <button onclick="deleteDish(<?= $m['menu_id'] ?>)">Radera</button>
                    <p class="error" id="updaterror-<?= $m['menu_id'] ?>"></p>
                </div>
        <?php
            }
        }
        ?>

        <hr>
        <h3>Efterrätter</h3>
        <?php
        if ($dessert['message']) {
            echo "<p class='error'>Det finns ingen meny</p>";
        } else {
            foreach ($dessert as $d) {
        ?>
                <div class="display-grid">
                    <h4 class="monotype" id="name-edit-<?= $d['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $d['menu_id'] ?>)"><?= $d['name'] ?></h4>
                    <p class="price" id="price-edit-<?= $d['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $d['menu_id'] ?>)"><?= $d['price'] ?></p>
                    <p class="full-width" id="info-edit-<?= $d['menu_id'] ?>" contenteditable="true" oninput="activateUpdateBtn(<?= $d['menu_id'] ?>)"><?= $d['info'] ?></p>
                    <button id="btn<?= $d['menu_id'] ?>" onclick="updateDish(<?= $d['menu_id'] ?>)" disabled>Spara</button>
                    <button onclick="deleteDish(<?= $d['menu_id'] ?>)">Radera</button>
                    <p class="error" id="updaterror-<?= $d['menu_id'] ?>"></p>
                </div>
        <?php
            }
        }
        ?>
    </div>

</div>
<?php
include('includes/footer.php');
?>
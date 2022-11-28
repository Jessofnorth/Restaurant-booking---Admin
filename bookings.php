<?php
/* @author Jessica Ejelöv - jeej2100@student.miun.se */
$page_title = "Admin";
include('includes/header.php');
// check for login, if no send to loginpage
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?message=Du%20måste%20vara%20inloggad%20för%20att%20komma%20åt%20denna%20sidan.");
}
?>
<div class="container">
    <h1>Admin - Bokningar</h1>
    <hr>
    <article>
        <h2 class="monotype">Bokningar</h2>
        <p>Klicka på texten du vill ändra och sedan på spara för att ändra en bokning. Tryck på radera för att radera bokningen.</p>
        <p>Du kan ändra namn, epost, telefonnummer, meddelande samt antal gäster.</p>      
        <p>Bokningar visas från dagens datum och frammåt.</p>  
        <p class="error" id="error"></p>
    </article>
    <hr>
    <!-- print bookings with JS -->
    <article id="bookings">

    </article>
  

</div>
<?php
include('includes/footer.php');
?>
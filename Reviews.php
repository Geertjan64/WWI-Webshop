<?php
//Laadt database in
include 'Database.php';
?>

<?php
if (!empty($_GET['message'])) {
    $SuccesMelding = $_GET['message'];
    print("<h3>" . $SuccesMelding . "</h3>");
}
?>

<div class="review">
    <form action="Database.php" method="post">
        E-mail*: <br><input type="email" name="mail" placeholder="example@mail.com" required><small>Je email wordt niet openbaar gemaakt!</small><br>
        Naam*: <br><input type="text" name="naam" placeholder="Jan Voet" required><br>
        Score*: <br><input type="radio" name="star" value="1">1
                  <input type="radio" name="star" value="2">2
                  <input type="radio" name="star" value="3">3
                  <input type="radio" name="star" value="4">4
                  <input type="radio" name="star" value="5" checked>5<br>
        Beoordeling*: <br><textarea rows="2" cols="25"name="beoordeling" required></textarea><br>
        <input name="plaatsreview" type="submit" value="Plaats review"><br



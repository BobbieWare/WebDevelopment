<?php

session_start();
header('Content-Type: text/xml');
?>
<?php

$newitem = $_GET["book"];
$action = $_GET["action"];
$isbn = $_GET["isbn"];
//if ($_SESSION["Cart"] != "")
if (array_key_exists("Cart", $_SESSION)) {
    $cart1 = $_SESSION["Cart"];
    if ($action == "Add") {
        if ($cart1[$newitem] != "") {
            $value = $cart1[$newitem] + 1;
            $cart1[$newitem] = $value;
        } else {
            $cart1[$newitem] = "1";
        }
    } else {
        $value = $cart1[$newitem] - 1;
        $cart1[$newitem] = $value;
    }
} else {
    $c1art1[$newitem] = "1";
}
$_SESSION["Cart"] = $cart1;
ECHO (toXml($cart1));

function toXml($cart1) {
    $doc = new DomDocument('1.0');
    $cart = $doc->createElement('cart');
    $cart = $doc->appendChild($cart);

    foreach ($cart1 as $a => $b) {

        $book = $doc->createElement('book');
        $book = $cart->appendChild($book);

        $title = $doc->createElement('title');
        $title = $book->appendChild($title);
        $value = $doc->createTextNode($a);
        $value = $title->appendChild($value);

        $quantity = $doc->createElement('quantity');
        $quantity = $book->appendChild($quantity);
        $value2 = $doc->createTextNode($b);
        $value2 = $quantity->appendChild($value2);

        $isbn = $doc->createElement('isbn');
        $isbn = $book->appendChild($isbn);
        $value3 = $doc->createTextNode($a);
    }

    $strXml = $doc->saveXML();
    return $strXml;
}

?>

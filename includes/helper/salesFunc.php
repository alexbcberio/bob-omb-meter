<?php

define("SALES_XML_PATH", realpath(__DIR__ . "/../../xml/sales.xml"));
define("SALES_IMAGES_PATH", realpath(__DIR__ . "/../../storage/userSales"));

function initXML() {
  $xml = fopen(__DIR__ . "/../../xml/sales.xml", "w");
  fwrite($xml, "<?xml version=\"1.0\"?><sales lastId=\"0\"></sales>");
  fclose($xml);
}

function openXML() {
  if (!file_exists(SALES_XML_PATH)) {
    initXML();
  }
  return simplexml_load_file(SALES_XML_PATH);
}

function formatXml($simpleXMLElement) {
  $xmlDocument = new DOMDocument('1.0');
  $xmlDocument->preserveWhiteSpace = false;
  $xmlDocument->formatOutput = true;
  $xmlDocument->loadXML($simpleXMLElement->asXML());

  return $xmlDocument->saveXML();
}

function saveXML($xml) {
  $xmlFormatted = new SimpleXMLElement(formatXml($xml));
  $xmlFormatted->asXML(SALES_XML_PATH);
}

function addSale($name, $url, $tags, $description, $image) {
  $xml = openXML();

  $lastId = $xml["lastId"];
  $xml["lastId"] = $lastId + 1;

  $sale = $xml->addChild('sale');
  $sale->addAttribute('id', $lastId);
  $sale->addAttribute('date', time());

  $sale->addChild('name', $name);
  $sale->addChild('url', $url);

  if ($image) {
    $imageExtension = pathinfo($image["name"], PATHINFO_EXTENSION);
    $imageName = $lastId . "_" . $name . "." . $imageExtension;
    $savePath = move_uploaded_file($image["tmp_name"], SALES_IMAGES_PATH . "/" . $imageName);

    $sale->addChild('img', $imageName);
  }

  $categories = $sale->addChild('categories');

  for($i = 0; $i < count($tags); $i++) {
    $categories->addChild('category', $tags[$i]);
  }

  $sale->addChild('description', $description);
  saveXML($xml);
}

function showSales(){
  $sales = openXML();
  $salesArray = [];

  foreach($sales as $sale) {
    $tags = [];

    foreach($sale->categories->children() as $category){
        array_push($tags, $category);
    }

    array_push($salesArray, [
      "name" => $sale->name,
      "date" => intval($sale["date"]),
      "url" => $sale->url,
      "tags" => $tags,
      "description" => $sale->description,
      "img" => $sale->img
    ]);
    // showSale($sale->name, intval($sale["date"]), $sale->url, $tags, $sale->description, $sale->img);
  }

  foreach(array_reverse($salesArray) as $sale) {
    showSale($sale["name"], $sale["date"], $sale["url"], $sale["tags"], $sale["description"], $sale["img"]);
  }

}

function showSale($name, $date, $url, $tags, $description, $img) {
  require_once __DIR__ . "/time2str.php";
  ?>
  <div class="user-sale transition">
    <div class="product<?php echo empty($img) ? " default-image" : "" ?>"<?php if (!empty($img)) { ?> style="background-image: url('/storage/userSales/<?php echo $img ?>')"<?php } ?>>
      <?php if (empty($img)) { ?>
      <span class="fa-stack fa-2x">
        <i class="far fa-image fa-stack-2x"></i>
        <i class="fas fa-slash fa-stack-1x fa-2x"></i>
      </span>
      <?php } ?>
    </div>
    <div class="sale-body">
      <div class="header">
        <h1 class="elipsis">
        <?php echo $name ?>
        </h1>
        <p class="sale-date">
          <i class="fas fa-calendar"></i>
          <?php echo time2str($date) ?>
        </p>
      </div>
      <div class="categories">
        <?php
        foreach ($tags as $tag) {
          ?>
          <a href="#" class="category"><?php echo $tag ?></a>
          <?php
        }
        ?>
      </div>
      <p>
        <?php echo $description ?>
      </p>
      <div class="footer">
        <a href="<?php echo $url ?>" target="_blank" class="transition-fast">
          <i class="fas fa-bomb"></i>
          Ver Oferta
        </a>
      </div>
    </div>
  </div>
  <?php
}

?>
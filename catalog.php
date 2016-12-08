<?php
include("inc/functions.php");


$pageTitle = "Full Catalog";
$section = null;
$items_per_page = 8;

if (isset($_GET["cat"])) {
    if ($_GET["cat"] == "books") {
        $pageTitle = "Books";
        $section = "books";
    } else if ($_GET["cat"] == "movies") {
        $pageTitle = "Movies";
        $section = "movies";
    } else if ($_GET["cat"] == "music") {
        $pageTitle = "Music";
        $section = "music";
    }
}

if (isset ($_GET["pg"])){
    $current_page = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
}
if(empty($current_page)){
    $current_page = 1;
}

$total_items = get_catalog_count($section);
$total_pages = ceil($total_items / $items_per_page);

//limit results in redirect
$limit_results = "";
if(!empty($section)){
    $limit_results = "cat=" . $section . "&";
}

//redirect page numbers that are too large to the last page
if($current_page > $total_pages) {
    header("location:catalog.php?" . $limit_results . "pg=" .$total_pages);
}
//redirect numbers tht are too small to the first page
if($current_page < 1) {
    header("location:catalog.php?" . $limit_results . "pg=1");
}
//to deterimine the offset or the number of lines to skip for the start of the current page
//so for page 3 with 8 otems per page offset would be 16
//offset IS zero based -- pge 1 starts with 0 and page 2 starts with 8
$offset = (($current_page - 1) * $items_per_page);

if (empty($section)) {
    $catalog = full_catalog_array($items_per_page, $offset);
} else {
    $catalog = category_catalog_array($section, $items_per_page, $offset);
}


include("inc/header.php"); ?>

<div class="section catalog page">

    <div class="wrapper">

        <h1><?php
        if ($section != null) {
            echo "<a href='catalog.php'>Full Catalog</a> &gt; ";
        }
        echo $pageTitle; ?></h1>
        <div class="pagination">
            Pages:
            <?php
            for($i = 1 ; $i <= $total_pages ; $i++){
                if($i == $current_page){
                    echo "<span>$i</span>";
                } else {
                    echo "<a href='catalog.php?";
                    if(!empty($section)){
                        echo "cat=". $section . "&";
                    }
                echo "pg=$i'>$i</a>";
                }
            }
            ?>
        </div>
        <ul class="items">
            <?php
            foreach ($catalog as $item) {
                echo get_item_html($item);
            }
            ?>
        </ul>

    </div>
</div>

<?php include("inc/footer.php"); ?>
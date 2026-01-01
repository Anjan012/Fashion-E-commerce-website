<?php

function getAllOrdersProducts($conn) {
    $orders = [];
    $sql = "SELECT id_order, id_pro FROM tbl_cart ORDER BY id_order";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[$row['id_order']][] = $row['id_pro'];
    }
    return $orders;
}

function buildCoMatrix($orders) {
    $matrix = [];
    foreach ($orders as $prods) {
        for ($i=0; $i<count($prods); $i++) {
            for ($j=0; $j<count($prods); $j++) {
                if ($i == $j) continue;
                $matrix[$prods[$i]][$prods[$j]]++;
            }
        }
    }
    return $matrix;
}

function recommendItems($productId, $matrix, $limit=5) {
    if (!isset($matrix[$productId])) return [];
    arsort($matrix[$productId]);
    return array_slice(array_keys($matrix[$productId]), 0, $limit);
}



?>
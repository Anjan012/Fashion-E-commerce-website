<?php

function getAllOrdersProducts(PDO $conn) {
    $orders = [];

    $sql = "SELECT id_order, id_pro FROM tbl_cart ORDER BY id_order";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orders[$row['id_order']][] = $row['id_pro'];
    }

    return $orders;
}

function buildCoMatrix($orders) {
    $matrix = [];

    foreach ($orders as $products) {
        $count = count($products);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count; $j++) {
                if ($i === $j) continue;

                $a = $products[$i];
                $b = $products[$j];

                if (!isset($matrix[$a][$b])) {
                    $matrix[$a][$b] = 0;
                }
                $matrix[$a][$b]++;
            }
        }
    }
    return $matrix;
}

function recommendItems($productId, $matrix, $limit = 4) {
    if (!isset($matrix[$productId])) return [];
    arsort($matrix[$productId]);
    return array_slice(array_keys($matrix[$productId]), 0, $limit);
}

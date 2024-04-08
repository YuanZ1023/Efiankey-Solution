<?php
// function roll_item($vip_rank) {

// $item_rarity = [1, 2, 3, 4, 5];
// $vip_rank = ['v1', 'v2', 'v3', 'v4', 'v5']; 

// $random_tier = mt_rand(1, $vip_rank);
// }
?>
<?php
// Define item rarity tiers (1 = common, 5 = legend)
$item_tier_rarity = [1, 2, 3, 4, 5];

// Define VIP ranks
$vip_rank = ['v1', 'v2', 'v3', 'v4', 'v5'];

function roll_item($vip_rank) {
    global $item_tier_rarity;
    
    $max_rarity = max($item_tier_rarity);
    $vip_level = array_search($vip_rank, $GLOBALS['vip_rank']) + 1;
    
    // Adjusting the rarity based on VIP rank
    $adjusted_max_rarity = ceil(($vip_level * $max_rarity) / count($GLOBALS['vip_rank']));
    
    // Rolling a random item with adjusted rarity
    do {
        $rolled_item = $item_tier_rarity[array_rand($item_tier_rarity)];
    } while ($rolled_item > $adjusted_max_rarity);
    
    return $rolled_item;
}

function simulate_rolls() {
    global $vip_rank;
    global $item_tier_rarity;
    
    foreach ($vip_rank as $rank) {
        $results[$rank] = array_fill_keys($item_tier_rarity, 0);
        
        for ($i = 0; $i < 100; $i++) {
            $rolled_item = roll_item($rank);
            $results[$rank][$rolled_item]++;
        }
        
        echo "$rank player's item distribution after 100 rolls: " . json_encode($results[$rank]) . "\n";
    }
}

// Running the simulation
simulate_rolls();
?>


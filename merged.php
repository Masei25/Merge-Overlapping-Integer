<?php

function dd($val) {
    var_dump($val);
    die();
}

function mergeOverlappingPairs($pairs) {

    $mergedPairs = [];
    $pairCount = count($pairs);
    
    // Check if the list is empty or contains only one pair
    if ($pairCount < 2) {
      return $pairs;
    }
    
    // Sort the pairs by their first element
    usort($pairs, function($a, $b) {
      return $a[0] <=> $b[0];
    });
    
    $mergedPairs[] = $pairs[0];  // Add the first pair to the merged list
    $mergedPairIndex = 0;
    
    // Iterate through the remaining pairs
    for ($i = 1; $i < $pairCount; $i++) {
      $currentPair = $pairs[$i];
      $previousMergedPair = $mergedPairs[$mergedPairIndex];
      
      // Check if the current pair overlaps with the previous merged pair
      if ($currentPair[0] <= $previousMergedPair[1]) {
        // Merge the overlapping pairs by updating the end element of the previous merged pair
        $mergedPairs[$mergedPairIndex][1] = max($previousMergedPair[1], $currentPair[1]);
      } else {
        // Add the current pair to the merged list as it doesn't overlap with the previous merged pair
        $mergedPairs[] = $currentPair;
        $mergedPairIndex++;
      }
    }
    
    return $mergedPairs;
}

$pairs = [[1,2], [2,4], [5,6]]; //
$mergedPairs = mergeOverlappingPairs($pairs);

// Output the merged pairs
foreach ($mergedPairs as $pair) {
  echo "[" . $pair[0] . ", " . $pair[1] . "] ";
}

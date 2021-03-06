<?php

/* @var array $files */
/* @var array $processed */
/* @var stdClass $processedBag */
/* @var string $hash */

/* dependencies resolution correctness */
foreach ($files as & $file1) {
    $file1 .= "?$hash";
}
foreach ($files as & $file2) {
    $file2 .= '?hash';
}
foreach ($files as & $file3) {
    $file3 = "$file3?$hash";
}

/* accumulating in external storage, e.g. bulk operations */
foreach ($files as & $file4) {
    if (count($processed) >= 10) {
        break;
    }
    if (count($processedBag->processed) >= 10) {
        break;
    }

    $processed []= 'Next file has been processed';
    $processed []= $file4;

    $processedBag->processed []= $file4;
}

/* increments/decrements, e.g. counters */
foreach ($files as & $file5) {
    ++$processed; $processed++;
    --$processed; $processed--;
}

/* preg_match|preg_match will introduce new variables in the loop */
foreach ($files as & $file6) {
    preg_match('pattern', $file6, $matched);
    preg_match_all('pattern', $file6, $matchedAll);
    unset($matched, $matchedAll);
}

/* list will introduce new variables in the loop */
foreach ($files as & $file7) {
    preg_match('pattern', $file7, $matched);
    list ($first, $second) = $matched;
    unset($first, $second, $matched);
}

/* different assignments: clone, reassigning variables with variables; control statements */
$tomorrow = new \DateTime();
foreach ($files as & $file8) {
    $tomorrowInstance = clone $tomorrow;
    $tomorrowBackup   = $tomorrow;
    $bool             = true;
    $array            = [];
    $const            = \DateTime::ATOM;

    break;
    continue 1;
    return;

    $file8->timestamp            = $tomorrowInstance;
    $tomorrowInstance->timestamp = $file8;
    $tomorrow->timestamp         = $file8;
}

/* nested dependencies resolution correctness */
$count = 0;
foreach ($files as & $file9) {
    if (++$count > 0) {
        $file9->save();
    }
}

/* loop with unpacking array into multiple variables */
foreach ([[], [], []] as list($a, $b, $c)) {
    if ($b === $count) {
        $c->save();
    }
}

/* false-positives: inner break, continue, throw, return statements */
foreach ($files as $file10) {
    if ($false1) { break; }
    if ($false2) { continue; }
    if ($false3) { return; }
    if ($false4) { throw $exception; }
}

/* false-positives: statement is not operating with any variable */
foreach ($links as $link) {
    echo '<li>';
    echo $link;
    echo '</li>';
}

/* false-positives: object modifications */
foreach ([] as $item) {
    $object1->method1($item);
    $object2->method2($object1);
    $object3->method3($object2);
}
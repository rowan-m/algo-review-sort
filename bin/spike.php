<?php
require __DIR__ . '/../vendor/autoload.php';

$total = 6;
$elements = array();

for ($index = 0; $index < $total; $index++) {
    $elements[$index] = mt_rand(0, 360);
}

//$elements = range(0, 300, 60);
//shuffle($elements);

$snaphots = new Sorting\IterationSnapshots();
$algorithm = new Sorting\QuickSort($elements);
//$algorithm = new Sorting\InsertionSort($elements);
$algorithm->addObserver($snaphots);
$algorithm->sort();
?>
<html>
    <body>
        <?php
        rewind($snapshots);
        $previous = current($snapshots);

        foreach ($snaphots as $iteration => $snapshot):
            $elements = $snapshot['elements'];
            $changedElements = array_diff_assoc($previous, $elements);
            $previous = $elements;
            ?>
            <div style="position: relative; display:inline-block; width:95px; padding: 3px; margin: 3px; border: 1px gray dotted; text-align: right;">
                <span style="position: absolute; bottom: 0; left: 0; padding: 1px; font-size: small; color: dimgrey; background: lightgray"><?= $iteration ?></span>
                <?php foreach ($elements as $index => $element): ?>
                    <div>
                        <span style="<?php if ($index == reset($snapshot['indices'])): ?>color: dimgray; font-weight: bold;<?php else: ?>color: gray; <?php endif; ?>"><?php if (in_array($index, $snapshot['indices'])): ?>&#x21aa;<?php endif; ?></span>
                        <div style="
                             display:inline-block;
                             margin-top: 3px;
                             margin-bottom: 3px;
                             text-align: center;
                             height: 20px;
                             width: 50px;
                             border: 4px groove hsl(<?= $element ?>, 100%, 75%);
                             border-radius: 5px;
                             background: hsl(<?= $element ?>, 50%, 75%);
                             color: hsl(<?= $element ?>, 80%, 30%);
                             ">
                             <?php echo $element; ?>
                        </div>
                        <span style="color: red; font-weight: bold;"><?php if (isset($changedElements[$index])): ?>&#x21f5<?php endif; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </body>
</html>
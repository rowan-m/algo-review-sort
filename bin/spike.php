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
$insertionSort = new Sorting\InsertionSort($elements);
$insertionSort->addObserver($snaphots);
$insertionSort->sort();
?>
<html>
    <body>
        <?php
        rewind($snapshots);
        $previous = current($snapshots);

        foreach ($snaphots as $snapshot):
            $elements = $snapshot['elements'];
            $changedElements = array_diff_assoc($previous, $elements);
            $previous = $elements;
            ?>
            <div style="display:inline-block; padding: 3px; border: 1px gray dotted;">
                <?php foreach ($elements as $index => $element): ?>
                    <div style = "
                         color: gray;
                         <?php if (isset($changedElements[$index])): ?>
                             border-right: 4px groove red;
                             padding-right: 2px;
                             margin-right: 2px;
                         <?php endif; ?>
                         ">
                        <?php if ($index == $snapshot['index']): ?>&#x21aa;<?php endif; ?>
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
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </body>
</html>
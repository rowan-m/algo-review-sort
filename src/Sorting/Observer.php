<?php

namespace Sorting;

interface Observer
{
    public function notify(array $elements, array $indices);
}
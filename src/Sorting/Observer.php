<?php

namespace Sorting;

interface Observer
{
    public function notify(Observable $sort);
}
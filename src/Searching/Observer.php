<?php

namespace Searching;

interface Observer
{
    public function notify(array $indices);
}

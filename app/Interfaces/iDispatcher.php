<?php

namespace SmartGeoGMap\Interfaces;

interface iDispatcher
{
    public static function getInstance(): iDispatcher;
    public function dispatch(): void;
}

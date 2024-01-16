<?php

namespace SmartGeoGMap\Interfaces;

interface iField
{
    public function addSettingsField(string $id, string $label, array $callback, string $page, string $section): void;
    public function registerSetting(string $optionGroup, string $optionName): void;
}

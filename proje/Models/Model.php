<?php

namespace Models;

interface Model
{
    public static function get($id);
    public function save(): void;
}
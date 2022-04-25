<?php

interface AbstractController
{
    public static function asView($getParams, $postParams, $files);
}
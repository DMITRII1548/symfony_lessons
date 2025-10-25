<?php

namespace App\Listener;

class PostListener
{
    public function preUpdate(): void
    {
        dd(222222);
    } 
}
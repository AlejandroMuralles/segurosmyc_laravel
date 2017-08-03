<?php

namespace App\App\Entities;

class Ramo extends \Eloquent {

	protected $table = 'ramo';

	protected $fillable = ['nombre','estado'];
}
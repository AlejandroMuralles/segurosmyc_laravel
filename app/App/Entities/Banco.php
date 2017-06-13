<?php

namespace App\App\Entities;

class Banco extends \Eloquent {
	protected $fillable = ['nombre','estado'];

	protected $table = 'banco';

}
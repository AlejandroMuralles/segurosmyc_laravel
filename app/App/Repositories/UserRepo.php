<?php

namespace App\App\Repositories;

use App\App\Entities\User;

class UserRepo extends BaseRepo{

	public function getModel()
	{
		return new User;
	}

	public function all($orderBy)
	{
		return User::with('colaborador')->with('perfil')->get();
	}

	public function getByUsername($username)
	{
		$user = User::where('username',$username)->get();
		if(count($user) > 0)
			return $user[0];
		return null;
	}

}
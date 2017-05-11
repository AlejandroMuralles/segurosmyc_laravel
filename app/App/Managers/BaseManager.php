<?php

namespace App\App\Managers;

abstract class BaseManager
{

	protected $entity;
	protected $data;

	public function __construct($entity, $data)
	{
		$this->entity = $entity;
        $this->data   = $data;
	}

	abstract public function getRules();

	public function isValid()
	{
		$rules = $this->getRules();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }
	}

	public function save()
	{
		$this->data = $this->prepareData($this->data);
		$this->isValid();		
		$this->entity->fill($this->data);
		$this->entity->save();
		return $this->entity;
	}

}

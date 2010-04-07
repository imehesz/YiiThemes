<?php

class ThemeTest extends WebTestCase
{
	public $fixtures=array(
		'themes'=>'Theme',
	);

	public function testShow()
	{
		$this->open('?r=theme/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=theme/create');
	}

	public function testUpdate()
	{
		$this->open('?r=theme/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=theme/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=theme/index');
	}

	public function testAdmin()
	{
		$this->open('?r=theme/admin');
	}
}

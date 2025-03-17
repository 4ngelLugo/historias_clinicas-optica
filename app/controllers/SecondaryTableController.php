<?php

require_once __DIR__ . '/../models/SecondaryTable.php';

class SecondaryTableController
{
  private $secondaryTables;

  public function __construct($db)
  {
    $this->secondaryTables = new SecondaryTables($db);
  }

  public function getAllRoles()
  {
    $roles = $this->secondaryTables->getAllRoles();

    if ($roles) return $roles;

    return null;
  }

  public function getAllGenders()
  {
    $genders = $this->secondaryTables->getAllGenders();

    if ($genders) return $genders;

    return null;
  }

  public function getAllStratums()
  {
    $stratums = $this->secondaryTables->getAllStratums();

    if ($stratums) return $stratums;

    return null;
  }

  public function getAllHobbies()
  {
    $hobbies = $this->secondaryTables->getAllHobbies();

    if ($hobbies) return $hobbies;

    return null;
  }
}

<?php

// c'est un objet qui a une seule valeur: la base de donnée
// la db est un tableau, array. La db = un objet
class MembersManager {
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

	// Création d'une ligne dans la base de donnée
	public function add(Member $member) {
    $q = $this->_db->prepare('INSERT INTO member(name, password, level) VALUES( :name, :password, :level)');
    $q->bindValue(':name', $member->name());
	$q->bindValue(':password', $member->password());
	$q->bindValue(':level', $member->level());
    $q->execute();
    
    $member->hydrate([
      'id' => $this->_db->lastInsertId(),
      // 'degats' => 0,
    ]);
  }
  
  // On compte les inscrits
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM '.TABLE_MEMBER.'')->fetchColumn();
  }
  
  // Lecture de la base de donnée pour voir si tel id ($info) y est
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel membernnage ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM '.TABLE_MEMBER.' WHERE id = '.$info)->fetchColumn();
    }
    // Sinon, c'est qu'on veut vérifier que le name existe ou pas.
    $q = $this->_db->prepare('SELECT COUNT(*) FROM '.TABLE_MEMBER.' WHERE name = :name');
    $q->execute([':name' => $info]);
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT * FROM '.TABLE_MEMBER.' WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      return new Member($donnees);
    }
    else
    {
      $q = $this->_db->prepare('SELECT * FROM '.TABLE_MEMBER.' WHERE name = :name');
      $q->execute([':name' => $info]);
      return new Member($q->fetch(PDO::FETCH_ASSOC));
    }
  }
  
  public function getList($name)
  {
    $members = [];
    $q = $this->_db->prepare('SELECT * FROM '.TABLE_MEMBER.' WHERE name <> :name ORDER BY name');
    $q->execute([':name' => $name]);
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $members[] = new Member($donnees);
    }
    
    return $members;
  }
  
  public function update(Member $member)
  {
    $q = $this->_db->prepare('UPDATE member SET name = :name, password = :password, level = :level  WHERE id = :id');
    
    $q->bindValue(':id', $member->id(), PDO::PARAM_INT);
    $q->bindValue(':name', $member->name(), PDO::PARAM_STR);
	$q->bindValue(':password', $member->password(), PDO::PARAM_INT);
    $q->bindValue(':level', $member->level(), PDO::PARAM_INT);
    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
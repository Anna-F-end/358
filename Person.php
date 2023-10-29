<?php 
class Person{
    private $name;
    private $lastname;
    private $age;
    private $hp;
  	private $mother;
  	private $father;

    function __construct($name, $lastname, $age, $mother=null, $father=null)
    {
        $this->name=$name;
      	$this->lastname=$lastname;
      	$this->age=$age;
      	$this->hp = 100;
      	$this->mother = $mother;
     	$this->father = $father;
    }

    function sayHi($name) {
        return "Hi, $name! I'm " . $this->name;
    }
  	
  	function setHp($hp) 
    {
      if ($this->hp+$hp>100) $this->hp=100;
      else $this->hp = $this->hp+$hp;
    }
  
  	function getHp()
    {
      return $this->hp;
    }
  
  	function getName()
    {
    	return $this->name;
    }
  	
  	function getLastname()
    {
      return $this->lastname;
    }
  	function getMother()
    {
      return $this->mother;
    }
  
  	function getFather()
  	{
     	return $this->father; 
    } 
  
  	function getInfo() 
    {
      	$gmm=$this->getMother()->getMother()->getName()." ".$this->getMother()->getMother()->getLastname();
        $gfm=$this->getMother()->getFather()->getName()." ".$this->getMother()->getFather()->getLastname();
      	$gmf=$this->getFather()->getMother()->getName()." ".$this->getFather()->getMother()->getLastname();
        $gff=$this->getFather()->getFather()->getName()." ".$this->getFather()->getFather()->getLastname();
        $m=$this->getMother()->getName()." ".$this->getMother()->getLastname();
        $f=$this->getFather()->getName()." ".$this->getFather()->getLastname();
      	$anchestors = "По матери: ". $gmm.", ".$gfm."<br>По отцу: ".$gmf.", ".$gff."<br>Родители: ".$m.", ".$f;
    	return $anchestors;
    }
}
$igor = new Person("Igor", "Petrov", 68); //отец ольги
$matolgi = new Person("Irina","Petrova",70); //мать ольги
$matalexa = new Person("Alexandra","Ivanova",65); //мать алекса
$otchealex = new Person("Alexandr","Ivanov",66); //отец алекса


$alex=new Person("Alex", "Ivanov", 42, $matalexa, $otchealex);
$olga = new Person("Olga", "Ivanova", 41, $matolgi, $igor);
$valera = new Person("Valera", "Ivanov", 14, $olga, $alex);

//echo $valera->getMother()->getName();
//echo $valera->getFather()->getName();
echo $valera->getInfo();



//$medKit = 50;
//$alex->setHp(-30);
//echo $alex->getHp()."<br>";
//$alex->setHp($medKit);
//echo $alex->getHp();

//echo $alex->name;
//echo $alex->sayHi($igor->name);




?>

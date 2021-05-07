<?php

 class Utilisateur {
	private $id;
 	private $pseudo;
 	private $email;
 	private $pwd;
	private $sale;
	private $bidSale; 
	 
	
 	public function __construct($idUser, $usn, $em, $pass, $sld, $b_sld)
 	{
		$this->id = $idUser;
 		$this->pseudo = $usn;
 		$this->email = $em;
 		$this->pwd = $pass;
		$this->sale = $sld;
		$this->bidSale = $b_sld;
 	}
	public function id() {
		return $this->id;
	}
 	public function pseudo() {
 		return $this->pseudo;
  	}
  	public function email() {
  		return $this->email;
  	}
  	public function pwd() {
  		return $this->pwd;
  	}
  	public function sale() {
  		return $this->sale;
	}
	public function bidSale() {
		return $this->bidSale;
 	}
	  
	public function set_pwd($new_pwd) {
		$this->pwd = $new_pwd;
	}
	public function set_sale($new_sale) {
		$this->sale = $this->sale + $new_sale;
	}
	public function set_saleBd($new_sale) {
		$this->sale = $new_sale;
	}
	public function set_bidSale($new_bidSale) {
		$this->bidSale = $new_bidSale;
	}


	public function tobid($saleBidder, $art_price, $hight_price) {
		if(($this->sale - $this->bidSale) >= $saleBidder && $saleBidder >= ($hight_price + ($art_price/2))) {
			$this->bidSale = $this->bidSale + $saleBidder;
			return true;
		} else {
			return false;
		}
	}
 }


 class AnchRoot extends Utilisateur {

	private $special_word;
	private $access;

	public function __construct($idUser, $usn, $em, $pass, $sld, $b_sld, $spc, $acs)
	{
		parent::__construct($idUser, $usn, $em, $pass, $sld, $b_sld);
		$this->special_word = $spc;
		$this->access = $acs;
	}

 }


 class Article {
 	private $idArticle;
  	private $libel;
  	private $description = 'Pas de descriptin';
  	private $startPrice = 0;
  	private $hightPrice = 0;
	private $countBidder = 0;
	private $state = 0;
  	private $datePub;
	private $hightDate;
	private $endDate;
	private $chimage;
	private $owner;

  	public function __construct($idArt, $lbl, $descr, $sPrice, $endD, $chImg, $own) {
  		$this->idArticle = $idArt;
	  	$this->libel = $lbl;
	  	$this->description = $descr;
	  	$this->startPrice = $sPrice;
	  	$this->hightPrice = $this->startPrice;
	  	$this->countBidder = 0;
		$this->datePub = date("d-m-y H:i:s");
		$this->hightDate = $this->datePub; 
		$this->endDate = $endD;
		$this->chImage = $chImg;
	  	$this->owner = $own;
  	}

  	public function idArticle() {
  		return $this->idArticle;
  	}
  	public function libel() {
  		return $this->libel;
  	}
  	public function description() {
  		return $this->description;
  	}
  	public function startPrice() {
  		return $this->startPrice;
  	}
  	public function hightPrice() {
  		return $this->hightPrice;
  	}
  	public function countBidder() {
  		return $this->countBidder;
  	}
	public function state() {
		return $this->state;
	}
  	public function datePub() {
  		return $this->datePub;
	}
	public function hightDate() {
		return $this->hightDate;
	}
	public function endDate() {
		return $this->endDate;
	}
	public function chImage() {
		return $this->chImage;
	}
  	public function owner() {
  		return $this->owner;
	}
	  

	public function set_idArticle($n_id) {
		$this->idArticle = $n_id;
	}
 }

?>
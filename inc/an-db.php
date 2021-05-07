<?php

/*

Ce fichier comporte les scripts de connexion de la base ainsi les differentes operations.

*/

class Ancherize_DB extends PDO {
	private $db_url = 'mysql:host=localhost;dbname=ancherize-db';
	private $db_user = 'root';
	private $db_mdp = '';
	private $passAncherize = 'ancherize$khaled@paul';

	public function __construct($spw) {
		if($spw==$this->passAncherize) {
			parent::__construct($this->db_url, $this->db_user, $this->db_mdp);
		}
	}

	public function addUser($user) {
		$sql = $this->prepare("INSERT INTO users VALUES(?, ?, ?, ?)");
		$sql->execute(array($user->pseudo(), $user->email(), $user->mdp(), $user->sale()));
	}

	public function updatePwd($user, $new_pwd)
	{
		$sql = $this->prepare("UPDATE users SET pwd = :new_pwd WHERE id = :usr_id");
        $sql->execute(['new_pwd' => $new_pwd, 'usr_id' => $user->id()]);
	}

	public function updateSaleUser($val, $user) {
		$sql = $this->prepare("UPDATE users SET sale=sale+? WHERE pseudo=?");
		$sql->execute(array($val, $user->pseudo()));
	}

	public function addArticle($article) {

		// ADD ARTICLE

		$sql = $this->prepare("INSERT INTO article(libel, `description`, startPrice, hightPrice, countBidder, endDate, chImage, `owner`) VALUES(?, ?, ?, ?, 0, ?, ?, ?)");
		$sql->execute(array($article->libel(), $article->description(), $article->startPrice(), $article->startPrice(), $article->endDate(), $article->chImage(), $article->owner()));
	}

	public function searchPseudo($pseudo)
	{
		$sql = $this->prepare("SELECT id FROM users WHERE pseudo = ?");
        $sql->execute([$pseudo]);
        return $sql->fetch();
	}
	public function searchEmail($email)
	{
		$sql = $this->prepare("SELECT id FROM users WHERE email = ?");
        $sql->execute([$email]);
        return $sql->fetch();
	}

	public function loadEmailConfirmed($email)
	{
		$sql = $this->prepare("SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL");
        $sql->execute([$email]);
        return $sql->fetch();
	}
	public function saveForgetRequest($user, $rec_token)
	{
        $sql = $this->prepare("UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?");
        $sql->execute([$rec_token, $user['id']]);
	}
	public function doReset($new_pwd, $user_exist)
	{
		$sql = $this->prepare("UPDATE users SET pwd = ?, reset_token = NULL WHERE id = ?");
        $sql->execute([$new_pwd, $user_exist['id']]);
	}

	public function addUser_with_token($pseudo, $email, $pwd, $token)
	{
		$sql = $this->prepare("INSERT INTO users (pseudo,pwd,email,confirm_token) VALUES (?,?,?,?)");
        $sql->execute([$pseudo,$pwd,$email,$token]);
	}
	public function confirm_user($user_id)
	{
		$sql = $this->prepare('UPDATE users SET confirm_token = NULL, confirmed_at = NOW() WHERE id = ?');
        $sql->execute([$user_id]);
	}

	public function tobid($user, $idArt, $price) {
		$sql = $this->prepare("INSERT INTO tobid(idArticle, bidder, priceBid) VALUES(?, ?, ?); UPDATE article SET hightPrice=? , hightDate=CURRENT_TIMESTAMP+'500', countBidder=countBidder+1 WHERE idArticle=?; UPDATE users SET bidSale=bidSale+? WHERE pseudo=?;");
		$sql->execute(array($idArt, $user->pseudo(), $price, $price, $idArt, $price, $user->pseudo()));
	}

	public function loadUser($pseudo)
	{
		$sql = $this->prepare("SELECT * FROM users WHERE pseudo = :user_in OR email = :user_in");
        $sql->execute(['user_in' => $pseudo]);
        return $sql->fetch();
	}
	public function loadUserId($user_id)
	{
		$sql = $this->prepare("SELECT * FROM users WHERE id = ?");
        $sql->execute([$user_id]);
        return $sql->fetch();
	}


	public function loadAllArticles() {
		try {

			$articles = array();
			// ALL ARTICLES

			$sql = $this->query("SELECT * FROM article WHERE `state`=0 ORDER BY hightDate DESC");

			while($result = $sql->fetch()) {
				array_push($articles, $result);
			}
			if (count($articles) > 0) {
				return $articles;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}


	public function loadAllArticlesSolded() {
		try {

			$articles = array();
			// ALL ARTICLES

			$sql = $this->query("SELECT * FROM article WHERE `state`=1 ORDER BY hightDate DESC");

			while($result = $sql->fetch()) {
				array_push($articles, $result);
			}
			if (count($articles) > 0) {
				return $articles;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}


	public function loadArticle($idArt) {
		try {

			// ONE ARTICLE

			$sql = $this->prepare("SELECT * FROM article WHERE idArticle=?");
			$sql->execute(array($idArt));

			if($result = $sql->fetch()) {
				return $result;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}
	public function loadArticles($owner) {
		try {

			$articles = array();
			//ARTICLES OF USER

			$sql = $this->prepare("SELECT * FROM article WHERE owner=? ORDER BY hightDate DESC");
			$sql->execute(array($owner));

			while($result = $sql->fetch()) {
				array_push($articles, $result);
			}
			if (count($articles) > 0) {
				return $articles;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}
	public function loadAnchArticles($owner) {
		try {

			$articles = array();
			//ARTICLES OF USER

			$sql = $this->prepare("SELECT libel, hightPrice, article.idArticle as idArticle, bidder, MAX(priceBid) AS priceBidder FROM tobid INNER JOIN article ON article.idArticle=tobid.idArticle WHERE bidder=? GROUP BY tobid.idArticle");
			$sql->execute(array($owner));

			while($result = $sql->fetch()) {
				array_push($articles, $result);
			}
			if (count($articles) > 0) {
				return $articles;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}

	public function deleteUser($ps) {
		try {

			// DELETE ARTICLES AND USER

			$sql = $this->prepare("SELECT * FROM article WHERE owner=? AND `state`=0");
			$sql->execute(array($ps));
			if($result = $sql->fetch()) {
				return false;
			} else {
				$sql1 = $this->prepare("DELETE FROM users WHERE pseudo=?");
				$sql1->execute(array($ps));
				return true;
			}

		} catch(PDOException $e) {
			return false;
		}
	}


	public function autoPub() {
		$sql = $this->query("UPDATE article SET hightDate=CURRENT_TIMESTAMP+'500' WHERE hightPrice=startPrice AND hightDate<=CURRENT_TIMESTAMP AND endDate>CURRENT_TIMESTAMP AND `state`=0");
	}
	public function autoState() {
		$sql2 = $this->query("SELECT idArticle, hightPrice FROM article WHERE hightPrice!=startPrice AND hightDate<=CURRENT_TIMESTAMP-'500' AND endDate>CURRENT_TIMESTAMP AND `state`=0");

		$sql = $this->query("UPDATE article SET `state`=1 WHERE hightPrice!=startPrice AND hightDate<=CURRENT_TIMESTAMP-'500' AND endDate>CURRENT_TIMESTAMP AND `state`=0");


		while ($result = $sql2->fetch()) {
			$sql = $this->prepare("UPDATE users SET sale=sale-?, bidSale=bidSale-? WHERE pseudo=(SELECT bidder FROM tobid WHERE priceBid=? AND idArticle=?)");
			$sql->execute(array($result['hightPrice'], $result['hightPrice'], $result['hightPrice'], $result['idArticle']));
			$sql1 = $this->prepare("DELETE FROM tobid WHERE idArticle=?");
			$sql1->execute(array($result['idArticle']));
		}
	}
	public function autoUpdateSales() {
		if(isset($_SESSION['auth'])) {
			$sql = $this->prepare("SELECT sale, bidSale FROM users WHERE pseudo=?");
			$sql->execute(array($_SESSION['auth']->pseudo()));
			if($result = $sql->fetch()) {
				$_SESSION['auth']->set_saleBd($result['sale']);
				$_SESSION['auth']->set_bidSale($result['bidSale']);
			}
		}
	}
	public function autoDeletes() {
		$sql = $this->query("DELETE FROM article WHERE hightPrice=startPrice AND endDate<=CURRENT_TIMESTAMP AND `state`=0");
	}




	//ROOT


	public function checkSpecialWord($spw) {
		$sql = $this->prepare("SELECT id FROM `root` WHERE special_word=?");
		$sql->execute(array($spw));
		if($result = $sql->fetch()) {
			return true;
		} else {
			return false;
		}
	}

	public function connectAdmin($ps, $pwd) {
		$sql = $this->prepare("SELECT * FROM `root` WHERE pseudo=? AND pwd=?");
		$sql->execute(array($ps, $pwd));
		if($result = $sql->fetch()) {
			return $result;
		} else {
			return false;
		}
	}
	public function getAllUsers($glimit, $dlimit) {
		if(!is_int($glimit) || !is_int($dlimit)) {
			$glimit = (int)$glimit;
			$dlimit = (int)$dlimit;
		}
		try {
			$users = array();
			$sql = $this->prepare("SELECT * FROM users WHERE confirm_token IS NULL ORDER BY pseudo ASC LIMIT " . $glimit . ", " . $dlimit);
			$sql->execute(array($glimit, $dlimit));
			while($result = $sql->fetch()) {
				array_push($users, $result);
			}
			if (count($users) > 0) {
				return $users;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}
	public function getAllArticles($owner ,$glimit, $dlimit) {
		if(!is_int($glimit) || !is_int($dlimit)) {
			$glimit = (int)$glimit;
			$dlimit = (int)$dlimit;
		}
		try {
			$articles = array();
			$sql = $this->prepare("SELECT * FROM article WHERE owner=? ORDER BY idArticle ASC LIMIT " . $glimit . ", " . $dlimit);
			$sql->execute(array($owner));
			while($result = $sql->fetch()) {
				array_push($articles, $result);
			}
			if (count($articles) > 0) {
				return $articles;
			} else {
				return false;
			}
		} catch(PDOException $e) {
			return false;
		}
	}

	public function root_del_article($idArt) {
		try {
			$sql = $this->prepare("DELETE FROM tobid WHERE idArticle=?; DELETE FROM article WHERE idArticle=?;");
			$sql->execute(array($idArt, $idArt));
			return true;
		} catch(PDOException $e) {
			return false;
		}
	}
	public function root_del_user($ps) {
		try {
			$sql = $this->prepare("SELECT idArticle FROM article WHERE owner=?");
			$sql->execute(array($ps));
			while($result = $sql->fetch()) {
				$this->root_del_article($result['idArticle']);
			}
			$sql1 = $this->prepare("DELETE FROM users WHERE pseudo=?");
			$sql1->execute(array($ps));
			return true;
		} catch(PDOException $e) {
			return false;
		}
	}
}

?>
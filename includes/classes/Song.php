<?php
	class Song {

		private $con;
		private $id;
		private $mysqliData;
		private $title;
		private $artistId;
		private $cover;
		private $genre;
		private $duration;
		private $path;
		private $language;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");
			$this->mysqliData = mysqli_fetch_array($query);
			$this->title = $this->mysqliData['title'];
			$this->artistId = $this->mysqliData['artistId'];
			$this->cover = $this->mysqliData['cover'];
			$this->genre = $this->mysqliData['genre'];
			$this->duration = $this->mysqliData['duration'];
			$this->path = $this->mysqliData['path'];
			$this->language = $this->mysqliData['language'];
			$this->plays=$this->mysqliData['plays'];
		}

		public function getTitle() {
			return $this->title;
		}

		public function getPlays(){
			return $this->plays;
		}

		public function getId() {
			return $this->id;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

		public function getCover() {
			return $this->cover;
		}

		public function getPath() {
			return $this->path;
		}

		public function getDuration() {
			return $this->duration;
		}

		public function getMysqliData() {
			return $this->mysqliData;
		}

		public function getGenre() {
			$query = mysqli_query($this->con, "SELECT `name` FROM genres WHERE id='$this->genre'");
			$data = mysqli_fetch_array($query);
			$lan=$data['name'];
			return $lan;
		}

		public function getLanguage() {
			$query = mysqli_query($this->con, "SELECT `name` FROM languages WHERE id='$this->language'");
			$data = mysqli_fetch_array($query);
			$lan=$data['name'];
			return $lan;
		}

	}
?>
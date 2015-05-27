<?php

class Word {

	private $text = "";
	private $words = array();
	private $n = 0;
	
	public function setText($file, $sep = " ") {
		foreach (file($file) as $line) {
			$this->text .= htmlspecialchars($line) . " ";
		}
		$this->words = explode($sep, $this->text);
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function current() {
		return $this->words[$this->n];
	}
	public function next() {
		$this->words[$this->n] ? $this->n++ : $this->n = 0;
	}
	public function reset() {
		$this->n = 0;
	}
	public function ifNext() {
		return $this->words[$this->n] ? true : false;
	}
	
}
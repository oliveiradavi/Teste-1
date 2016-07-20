<?php 

require_once 'Crud.php';

class Produto extends Crud{
	
	protected $table = 'produto';
	private $nome;
	private $descricao;
	private $preco;
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	
	public function setPreco($preco) {
		$this->preco = $preco;
	}
	
	public function insert() {
		$sql = "INSERT INTO $this->table (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome',$this->nome);
		$stmt->bindParam(':descricao',$this->descricao);
		$stmt->bindParam(':preco',$this->preco);
		return $stmt->execute();
	}
	
	public function update($id) {
		$sql = "UPDATE $this->table SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':descricao',$this->descricao);
		$stmt->bindParam(':preco',$this->preco);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
	
}
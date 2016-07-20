<?php

require_once 'Crud.php';

class Pedido extends Crud{
	
	protected $table = 'pedido';
	private $id_produto;
	private $id_cliente;
	
	public function setIdProduto($id_produto) {
		$this->id_produto = $id_produto;
	}
	
	public function setIdCliente($id_cliente) {
		$this->id_cliente = $id_cliente;
	}
	
	public function insert() {
		$sql = "INSERT INTO $this->table (id_produto,id_cliente) VALUES (:id_produto,:id_cliente)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_produto',$this->id_produto);
		$stmt->bindParam(':id_cliente',$this->id_cliente);
		return $stmt->execute();
	}
	
	public function update($id) {
		return;
	}
	
	public function deletePedido($id_produto,$id_cliente) {
		$sql = "DELETE FROM $this->table WHERE id_produto = :id_produto AND id_cliente = :id_cliente";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
		$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
		return $stmt->execute();
	}
	
	
	
	
	
}
<style>
		table {
			border-spacing: 70px 10px;
		}
</style>

<?php include "menu.php"; ?>

<?php
	function __autoload($class_name){
		require_once 'php/' . $class_name . '.php';
	}	
?>

<?php 
	$pedido = new Pedido();

	if(isset($_POST['cadastrar'])){
		
		$id_produto = $_POST['id_produto'];
		$id_cliente = $_POST['id_cliente'];
		
		$pedido->setIdProduto($id_produto);
		$pedido->setIdCliente($id_cliente);	
		$pedido->insert();	
	}
?>

<?php 
	if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){	
		
		$id_produto = (int)$_GET['id_produto'];
		$id_cliente = (int)$_GET['id_cliente'];
		
		if($pedido->deletePedido($id_produto,$id_cliente)) {
			header("Location: pedidos.php");
		}
	}
?>

<div align=center>

 	 <form method="post" action="">	 
		<h3>Adicionar Pedido:</h3>
		<div>
			<input type="text" name="id_produto" placeholder="Produto:" />
		</div>
		<div>
			<input type="text" name="id_cliente" placeholder="Cliente:" />
		</div>
		<input type="submit" name="cadastrar" class="btn btn-primary" value="Adicionar Pedido">					
	</form>
 
	<br><br>
 
	<h3>Lista de Pedidos:</h3>
	
	<table>
	  <tr>
		<th>Produto</th>
		<th>Cliente</th>
	  </tr>
	  <?php foreach($pedido->findAll() as $key => $value): ?>
		<tr>
			<td><?php echo $value->id_produto; ?></td>
			<td><?php echo $value->id_cliente; ?></td>
			<td>
				<?php echo "<a href='pedidos.php?acao=deletar&id_produto=" . $value->id_produto . "&id_cliente=" . $value->id_cliente . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table> 
</div>
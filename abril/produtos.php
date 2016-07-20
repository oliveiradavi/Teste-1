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
	$produto = new Produto();

	if(isset($_POST['cadastrar'])){
		
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$preco = $_POST['preco'];
		
		$produto->setNome($nome);
		$produto->setDescricao($descricao);
		$produto->setPreco($preco);
		
		$produto->insert();
	}
?>

<?php 
	if(isset($_POST['atualizar'])){
	
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$preco = $_POST['preco'];
			
		$produto->setNome($nome);
		$produto->setDescricao($descricao);
		$produto->setPreco($preco);
		
		if($produto->update($id)) {		
			header("Location: produtos.php");
		}		
	}
?>

<?php 
	if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){	
		$id = (int)$_GET['id'];
		
		if($produto->delete($id)) {
			header("Location: produtos.php");
		}
	}
?>

	
<?php 
	if(isset($_GET['acao']) && $_GET['acao'] == 'editar') {	
		$id = (int)$_GET['id'];
		$resultado = $produto->find($id);
?>

<div align=center>
	<form method="post" action="">
		<div class="input-prepend">
			<input type="text" name="nome" value="<?php echo $resultado->nome; ?>"  placeholder="Nome:" />
		</div>
		<div class="input-prepend">
			<input type="text" name="descricao" value="<?php echo $resultado->descricao; ?>" placeholder="Descricao:" />
		</div>
		<div class="input-prepend">
			<input type="text" name="preco" value="<?php echo $resultado->preco; ?>" placeholder="Preco:" />
		</div>
		<input type="hidden" name="id" value="<?php echo $resultado->id; ?>"
		<br />
		<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
	</form>

<?php }else{?>

<div align=center>

 	 <form method="post" action="">	 
		<h3>Cadastro de Produtos:</h3>
		<div>
			<input type="text" name="nome" placeholder="Nome:" />
		</div>
		<div>
			<input type="text" name="descricao" placeholder="Descricao:" />
		</div>
		<div>
			<input type="text" name="preco" placeholder="Preco:" />
		</div>
		<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar Produto">					
	</form>
	
	<br><br>
 
	<h3>Lista de Produtos:</h3>
	
	<table>
	  <tr>
		<th>#</th>
		<th>Nome</th>
		<th>Descricao</th>
		<th>Preco</th>
	  </tr>
	  
	<?php foreach($produto->findAll() as $key => $value): ?>
		<tr>
			<td><?php echo $value->id; ?></td>
			<td><?php echo $value->nome; ?></td>
			<td><?php echo $value->descricao; ?></td>
			<td><?php echo $value->preco; ?></td>
			<td>
				<?php echo "<a href='produtos.php?acao=editar&id=" . $value->id ."'>Editar</a>"; ?>
				<?php echo "<a href='produtos.php?acao=deletar&id=" . $value->id ."' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
			</td>
		</tr>			
	  <?php endforeach; ?>
	</table> 
	<?php }?>	
</div>
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
	$cliente = new Cliente();

	if(isset($_POST['cadastrar'])){
		
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		
		$cliente->setNome($nome);
		$cliente->setEmail($email);
		$cliente->setTelefone($telefone);
		
		$cliente->insert();
	}
?>

<?php 
	if(isset($_POST['atualizar'])){
		
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
			
		$cliente->setNome($nome);
		$cliente->setEmail($email);
		$cliente->setTelefone($telefone);
		
		if($cliente->update($id)) {		
			header("Location: clientes.php");
		}		
	}
?>

<?php 
	if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){	
		$id = (int)$_GET['id'];
		
		if($cliente->delete($id)) {
			header("Location: clientes.php");
		}
	}
?>

<?php 
	if(isset($_GET['acao']) && $_GET['acao'] == 'editar') {	
		$id = (int)$_GET['id'];
		$resultado = $cliente->find($id);
?>



<div align=center>
 	<form method="post" action="">
		<div class="input-prepend">
			<input type="text" name="nome" value="<?php echo $resultado->nome; ?>"  placeholder="Nome:" />
		</div>
		<div class="input-prepend">
			<input type="text" name="email" value="<?php echo $resultado->email; ?>" placeholder="E-mail:" />
		</div>
		<div class="input-prepend">
			<input type="text" name="telefone" value="<?php echo $resultado->telefone; ?>" placeholder="Telefone:" />
		</div>
		<input type="hidden" name="id" value="<?php echo $resultado->id; ?>"
		<br />
		<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
	</form>
	
<?php }else{?>


<div align=center>

 	 <form method="post" action="">	 
		<h3>Cadastro de Clientes:</h3>
		<div>
			<input type="text" name="nome" placeholder="Nome:" />
		</div>
		<div>
			<input type="text" name="email" placeholder="E-mail:" />
		</div>
		<div>
			<input type="text" name="telefone" placeholder="Telefone:" />
		</div>
		<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar Cliente">					
	</form>
	
	<br><br>
 
	<h3>Lista de Clientes:</h3>
	
	<table>
	  <tr>
		<th>#</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Telefone</th>
	  </tr>
	  
	<?php foreach($cliente->findAll() as $key => $value): ?>
		<tr>
			<td><?php echo $value->id; ?></td>
			<td><?php echo $value->nome; ?></td>
			<td><?php echo $value->email; ?></td>
			<td><?php echo $value->telefone; ?></td>
			<td>
				<?php echo "<a href='clientes.php?acao=editar&id=" . $value->id ."'>Editar</a>"; ?>
				<?php echo "<a href='clientes.php?acao=deletar&id=" . $value->id ."' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
			</td>
		</tr>	
	  <?php endforeach; ?>
	 </table>
	<?php }?>	
</div>
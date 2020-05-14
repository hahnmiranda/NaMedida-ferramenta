<?php 
// sessão
if(isset($_SESSION['mensagem'])): ?>
	
<script>
	// exibindo a mensagem misturando javascript com php
	window.onload = function() {
		M.toast({html: '<?php echo $_SESSION['mensagem']; ?>'})
	};
</script>

<?php
endif;
session_unset(); // limpa os dados da sessão
?>
<h2 class='button button-'>teste</h2>
<?php foreach($clientes as $cliente){?>
<br>
<a href='<?php echo base_url("login/testar2/{$cliente->id}")?>'><?php echo $cliente->nome?></a>
<?php } ?>

<?php echo "<pre>"; print_r($clientes)?>


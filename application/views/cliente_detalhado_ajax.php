<table class=" table table-condensed">
    <tbody>
        <tr>
            <td><b>Cliente</b></td>
            <td><?php echo $cliente->get_nome() ?></td>

        </tr>
            
        <tr>
            <td><b>Endereço</b></td>
            <td><?php echo $cliente->get_endereco() ?></td>
        </tr>
        <tr>
            <td><b>Telefone</b></td>
            <td><?php echo $cliente->get_telefone() ?></td>
        </tr>
        <tr>
            <td><b>Responsável</b></td>
            <td><?php echo $cliente->get_responsavel() ?></td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td><?php echo $cliente->get_email() ?></td>
        </tr>
        <tr>
            <td><b>CNPJ</b></td>
            <td><?php echo $cliente->get_cnpj() ?></td>
        </tr>
    </tbody>
</table>
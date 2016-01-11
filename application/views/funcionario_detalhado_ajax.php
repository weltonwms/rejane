<table class=" table table-condensed">
    <tbody>
        <tr>
            <td><b>Funcionário(a):</b></td>
            <td><?php echo $funcionario->get_nome() ?></td>

        </tr>
            
       
        <tr>
            <td><b>Telefone:</b></td>
            <td><?php echo $funcionario->get_telefone() ?></td>
        </tr>
       
       
        <tr>
            <td><b>CPF:</b></td>
            <td><?php echo $funcionario->get_cpf() ?></td>
        </tr>
        <tr>
            <td><b>Retirar Porcentagem:</b></td>
            <td><?php echo $funcionario->get_nome_del_porcentagem() ?></td>
        </tr>
         <tr>
            <td><b>Especialidade(s):</b></td>
            <td>
                <?php 
                foreach($funcionario->get_especialidades() as $id=>$esp):
                    echo $esp." ";
                endforeach; 
                     
                 ?>
             </td>
        </tr>
    </tbody>
</table>
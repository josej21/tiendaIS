    <body>
        <?php
        $direc = array('name'=>'direnvio','id'=>'direnvio','value'=>$direccion,'readonly'=>'');
        $bacepta=array('name'=>'baceptar','id'=>'baceptar','value'=>'Aceptar');
        ?>
        <?=form_open('caltaUsuario/terminar')?>
            <table  cellspacing="5" align="center">
                <caption><h2>Datos de envio</h2></caption>
                <tr>
                    <th><?=form_label('Numero de compra*:','numcomp')?></th>
                    <td></td>
                    <td><?=form_label($numcompra)?></td>
                </tr>
                <?php
                foreach ($_SESSION['carrito'] as $clave) {
                ?>
                    <tr>
                        <th><?=form_label('Producto: ')?></th>
                        <td></td>
                        <td><?=form_label($clave['nombre'])?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <th><?=form_label('Direccion de envio:','direcc')?></th>
                    <td></td>
                    <td><?=form_textarea($direc)?></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr align="center">
                    <td colspan="3"><?=form_submit($bacepta)?></td>
                </tr>
            </table>
        <?=form_close()?>
    </body>
</html>
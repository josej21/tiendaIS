<?php
$beliminar = array('id'=>'btneliminar','name'=>'eliminar','value'=>'Eliminar registro(s)');
$terminarc = array('id'=>'btneliminar','name'=>'eliminar','value'=>'Terminar compra');
$bregresar = array('id'=>'btneliminar','name'=>'eliminar','value'=>'Regresar');
?>
<?= form_open("ctienda/actualizaCarrito")?>
    <table id='tablacarrito'>
        <tr>
            <th><?=form_label('Eliminar producto', 'elimproduc')?></th>
            <th><?=form_label('Nombre', 'nomproduc')?></th>
            <th><?=form_label('Precio','precproduc')?></th>
            <th><?=form_label('Cantidad', 'cantproduc')?></th>
            <th><?=form_label('Subtotal', 'subtotproduc')?></th>
        </tr>
        
        <?php 
        $total = 0;
        if(isset($_SESSION['carrito'])){
            foreach ($_SESSION['carrito'] as $producto ) { 
                $atributos = array('name'=>'baja[]','id'=>'checkid','value'=>$producto['id']);
        ?>
                <?=form_hidden('longcarrito',count($_SESSION['carrito']))?>
                <tr>
                    <td align="center"><?=form_checkbox($atributos)?></td>
                    <td><?=form_label($producto['nombre'], 'nomprod') ?></td> 
                    <td><?=form_label('$ '.$producto['precio'],'precprod')?></td> 
                    <td><?=form_label($producto['cantidad'],'cantprod')?></td> 
                    <?php $subtotal = (float)$producto['precio'] * $producto['cantidad']?>
                    <td><?=  form_label($subtotal,'subprod')?></td> 
                </tr>
        <?php
                $total+=$subtotal;			
                }
        }
        ?>
        <tr>
            <th colspan="4" align="right"><?=form_label('Total:','totprodu')?></th>
            <td><?=$total?></td>
        </tr>
    </table>
    <h1></h1>
    <table align="center" cellspacing="5" cellpadding="8">
        <tr>
            <td colspan="2"><?=form_submit($beliminar)?></td>
            <td colspan="2">
                 <td colspan="2"><?=  form_submit($bregresar)?></td>
            </td>
            <td><?=form_submit($terminarc)?></td>
        </tr>
    </table>

<?= form_close()?>
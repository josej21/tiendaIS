    <body>
        <h1 align="center">Termino de compra</h1>
        <?=$this->form_validation->error_string();?>
        <?= form_open("caltaUsuario/recibirDatos")?>
            <?php 
            //Arreglo de municipio
            $municipios= array('Municipio'=>"--Municipio--",'Alvaro Obregon'=> "Alvaro Obregon",'Azcapotzalco'=>"Azcapotzalco",
                               'Benito Juarez'=>"Benito Juarez",'Coyoacan'=>"Coyoacan",
                               'Cuajimalpa de Morelos'=>"Cuajimalpa de Morelos",'Cuauhtemoc'=>"Cuauhtemoc",
                               'Gustavo A. Madero'=> "Gustavo A. Madero",'Iztacalco'=>"Iztacalco",
                               'Iztapalapa'=>"Iztapalapa",'Magdalena Contreras'=>"Magdalena Contreras",
                               'Miguel Hidalgo'=>"Miguel Hidalgo",'Milpa Alta'=>"Milpa Alta",'Tlahuac'=> "Tlahuac",
                               'Tlalpan'=>"Tlalpan",'Venustiano Carranza'=>"Venustiano Carranza",'Xochimilco'=>"Xochimilco");
            //Arreglo para la caja de texto nombre,apellido paterno,materno,direccion,boton de aceptar,cancelar
            $nombre=array( 'name' => 'nmpersonal','id'=> 'nmpersonal','placeholder' => 'Nombre. . .','size'=>'20' );
            $ape_paterno=array('name' => 'apepatpersonal','id'=>'apepatpersonal','placeholder' =>'Apellido paterno. . .','size'=>'20');
            $ape_materno=array('name' => 'apematpersonal','id'=>'apematpersonal','placeholder' =>'Apellido materno. . .','size'=>'20');
            $direccion=array('name' => 'direcpersonal','id'=>'direcpersonal','placeholder' =>'Direccion. . .','size'=>'20');
            $numtarjeta=array('name' => 'numtarjeta','id'=>'numtarjeta','placeholder' =>'Numero de tarjeta. . .','size'=>'20');
            $tipotarje=array('Tipo de tarjeta' => '---Tipo de tarjeta--','Tarjeta de credito'=>'Tarjeta de credito','Tarjeta de debito' =>'Tarjeta de debito');
            $baceptar=array('name'=>'cobrar','value'=>'Cobro');
            $bregresar=array('name'=>'cobrar','value'=>'Regresar');
            $bcancelar=array('name'=>'cancelar','value'=>'Cancelar');
            ?>
            <table cellspacing="5" cellpadding="8" align="center" bordercolor="#8533ff" border="2">
                <tr>
                    <th><?= form_label('Nombre*: ','nom')?></th>
                    <td></td>
                    <td><?= form_input($nombre)?></td>
                </tr>
                <tr>
                    <th><?=form_label('Apellido Paterno*: ','apepaperso')?></th>
                    <td></td>
                    <td><?=form_input($ape_paterno)?></td>
                </tr>
                <tr>
                    <th><?=form_label('Apellido Materno: ','apemaperso')?></th>
                    <td></td>
                    <td><?=form_input($ape_materno)?></td>
                </tr>
                <tr>
                    <th><?=form_label('Correo Electronico*: ', 'emailperso')?></th>
                    <td></td>
                    <td><input type="email" name="emailpersonal" id="emailpersonal" placeholder="Correo electronico. . ." size="20"/></td>
                </tr>
                <tr>
                    <th><?=form_label('Dirección de envio*: ','direcperso')?></th>
                    <td></td>
                    <td><?=form_input($direccion)?></td>
                </tr>
                <tr>
                    <th><?=form_label('Telefono: ','telperso')?></th>
                    <td></td>
                    <td><input type="tel" name="telepersonal" id="telepersonal" placeholder="Telefono. . ." size="20"/> </td>
                </tr>
                <tr>
                    <th><?=form_label('Municipio*: ','muniperso')?></th>
                    <td></td>
                    <td><?=form_dropdown('municipio',$municipios,'Municipio')?></td>
                </tr>
                <tr>
                    <th><?=form_label('Fecha de compra*: ','fechcomp')?></th>
                    <td></td>
                    <td><input type="date" id="fechcompra" name="fechcompra"/> </td>
                </tr>
                <tr>
                    <th colspan="3">Pago</th>
                </tr>
                <tr>
                    <th><?=  form_label('Numero de tarjeta*:','numtarje')?></th>
                    <td></td>
                    <td><?=form_input($numtarjeta)?></td>
                </tr>
                <tr>
                    <th><?=form_label('Tipo de tarjeta*:','tiptarje')?></th>
                    <td></td>
                    <td><?=form_dropdown('tipotarjeta',$tipotarje,'Tipo de tarjeta')?></td>
                </tr>
                <tr align="center">
                    <td colspan="2">
                        <?=nbs(2)?>
                        <?=form_submit($baceptar)?>
                        <?=nbs(6)?>
                        <?=  form_submit($bregresar)?>
                    </td>
                    <td><?=form_reset($bcancelar)?></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Nota: Los campos con * son obligatorios</td>
                </tr>
            </table>
        <?= form_close()?>
    </body>
</html>
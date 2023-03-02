<?php
$emisor = DB::table('emisor')->where('is_active',1)->first();
?>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Propiedad display</title> 
    <style>
        .a { display: none; }
        .b { display: inline; width: 100px; height: 50px;}
        .c { display: block; }
        .d { display: inline-block; width: 349px;}
        p  { color: purple; border: dotted;}

        
    </style>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">  

<section>
    <div class="c" style="margin: 10px;">
        <br>
    </div>
</section>
<section>
    <br/>
    <div>
        <div class="d">
            <center>
            <img style="
            padding: 5px;
            width: 150px;
            height: 150px;" src="<?php echo e($emisor->logo); ?>" alt=""> 
            </center>
            <div style="border-style: solid; border-width: 1px; padding: 10px; border-radius: 25px;  margin-right: 10px;">
                <table>
                    <tr>
                        <td>
                            <?php echo e($infoTributaria->razonSocial); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Dir Matriz:</strong> <?php echo e($infoTributaria->dirMatriz); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Dir Establecimiento:</strong> <?php echo e($infoLiquidacionCompra->dirEstablecimiento); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Contribuyente especial: </strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>OBLIGADO CONTABILIDAD:</strong> <?php echo e($infoLiquidacionCompra->obligadoContabilidad); ?>

                        </td>
                    </tr>
                </table>
            </div>
        </div> 
        <div class="d">
            <div style="border-style: solid; border-width: 1px; padding: 10px; border-radius: 25px;">
                <table>
                    <tr>
                        <td>
                            <strong>RUC: </strong> <?php echo e($infoTributaria->ruc); ?>

                        </td>
                    </tr>
                </table>
                <div style="background-color:#0B3861; color:white; font-size: 18px;" >
                    <center> LIQUIDACIÓN DE COMPRA DE BIENES Y PRESTACIÓNDE SERVICIOS</center>
                </div>
                <table>
                    <tr>
                        <td>
                            N°: <?php echo e($infoTributaria->estab); ?>-<?php echo e($infoTributaria->ptoEmi); ?>-<?php echo e($infoTributaria->secuencial); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            NÚMERO DE AUTORIZACIÓN: 
                        </td>
                    </tr>
                    <tr>
                        <?php if($fechaAutorizacion!=null || $fechaAutorizacion!=""): ?>
                        <td><?php echo e($infoTributaria->claveAcceso); ?> </td>
                        <?php else: ?>
                        <td style="background-color: yellowgreen;">PENDIENTE</td>
                        <?php endif; ?>
                        
                    </tr>
                    <tr>
                        <td>
                            FECHA  AUTORIZACIÓN: 
                        </td>
                    </tr>
                    <tr>
                        
                            <?php if($fechaAutorizacion!=null || $fechaAutorizacion!=""): ?>
                            <td><?php echo e($fechaAutorizacion); ?> </td>
                            <?php else: ?>
                            <td style="background-color: yellowgreen;">PENDIENTE</td>
                            <?php endif; ?>
                            
                        
                    </tr>
                    <tr>
                        <td>
                            AMBIENTE: <?php if($infoTributaria->ambiente=="1") echo "PRUEBAS"; else echo "PRODUCCIÓN"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            EMISIÓN: <?php if($infoTributaria->tipoEmision=="1") echo "NORNMAL"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CLAVE DE ACCESO
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img style=" border: 1px solid #ddd;
                            border-radius: 4px;
                            padding: 5px;
                            width: 300px;" src="public/barcode/prueba.png" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo e($infoTributaria->claveAcceso); ?>

                        </td>
                    </tr>
                </table>
            </div>    
        </div> 
    </div>
</section>
    
<section>
    <div style="margin-top: -35px">
        <div class="c" style="border-style: solid; border-width: 1px; padding: 10px;">
            <div class="c">
                <table>
                    <tr>
                        <td>
                            Razón Social / Nombres y Apellidos: <?php echo e($infoLiquidacionCompra->razonSocialProveedor); ?>

                        </td>                       
                    </tr>
                </table>
            </div>
            <div class="d" style="margin-top: 10px;">
                <table>
                    
                    <tr>
                        <td>
                            Identificación:
                        </td>
                        <td>
                            <?php echo e($infoLiquidacionCompra->identificacionProveedor); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Fecha Emisión: 
                        </td>
                        <td>
                            <?php echo e($fechaEmision); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Dirección: 
                        </td>
                        <td>
                            <?php echo e($infoLiquidacionCompra->direccionProveedor); ?>

                        </td>
                    </tr>
                </table>
            </div>
           <div class="d">
                <table>
                    <tr>
                        <td>
                            
                        </td>
                        <td>

                        </td>
                    </tr>
                </table>
           </div>
        </div> 
    </div>
   
</section>
<section>
    <div class="c" style="margin-top: 20px;">
        <table style="border: 1px solid #0B3861; width: 100%;">
            <thead style="color:white; border: 1px solid #0B3861; background-color:#0B3861">
                <tr>
                    <th>
                        CódigoPrincipal
                    </th>
                    <th>
                        Código Auxiliar
                    </th>
                    <th>
                        Cantidad
                    </th>
                    <th>
                        Descripción
                    </th>
                    <th>
                        Precio Unitario
                    </th>
                    <th>
                        Descuento
                    </th>
                    <th>
                        Total SinImpuestos
                    </th>
                </tr>
            </thead>
            
            <tbody>
                <?php $__currentLoopData = $detalles->detalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
                <tr>
                    <td>
                        
                        <?php echo e($value->codigoPrincipal); ?>

                    </td>
                    <td>
                        <?php echo e($value->codigoAuxiliar); ?>

                    </td>
                    <td>
                        <?php echo e($value->cantidad); ?>

                    </td>
                    <td>
                        <?php echo e($value->descripcion); ?>

                    </td>
                    <td>
                        <?php echo e($value->precioUnitario); ?>

                    </td>
                    <td>
                        <?php echo e($value->descuento); ?>

                    </td>
                    <td>
                        <?php echo e($value->precioTotalSinImpuesto); ?>

                    </td>
    
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
            
        </table>
    </div>
    <div class="c">
        <div style="width: 500px; display: inline-block; margin-top: 30px;">
            <div style="padding-top: 10px;">
                <table style="border: 1px solid black;width: 100%;">
                    <tr style="background-color: #0B3861; color: white; ">
                        <th colspan="2">Informacion Adicional</th>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            <?php echo e($infoAdicional->email); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Teléfono:
                        </td>
                        <td>
                            <?php echo e($infoAdicional->phone_number); ?>

                        </td>
                    </tr>
                    
                </table>
            </div>
           
           <div style="padding-top: 10px;">
              
               <?php
               $pagos = $infoLiquidacionCompra->pagos;
               $pago = $pagos[0]->pago;
               $descripcionPago ="";
               foreach ($formaPagos as $item)
                {
                    if($pago->formaPago==$item->codigo){
                        $descripcionPago = $item->descripcion;
                    }
                }
               
               ?>
               
            <table style="border: 1px solid black;width: 100%;">
                <tr style="background-color: #0B3861; color: white; ">
                    <th>Forma de pago</th>
                    <th>Valor</th>
                    <th>Plazo</th>
                    <th>Tiempo</th>
                </tr>
                <tr>
                    <td>
                        <?php echo e($descripcionPago); ?>

                    </td>
                    <td>
                        <?php echo e($pago->total); ?>

                    </td>
                    <td>
                        <?php echo e($plazo); ?>

                    </td>
                    <td>
                        días
                    </td>
                </tr>
            </table>
           </div>
            
        </div>
        <div style="width: 280px; display: inline-block; margin-top: -16px;">
            <?php
                $totalImpuesto = $totalConImpuestos;
                $subtotal12=0;
                $subtital0=0;
                $impuesto="";
                $impuestoGenerado = 0;
                foreach ($totalImpuesto->totalImpuesto as $key => $item){

                   
                    if($item->codigo=="2" && $item->codigoPorcentaje=="2"){
                        $subtotal12 = $subtotal12 + $item->baseImponible;
                    }
                    if($item->codigo=="2" && $item->codigoPorcentaje=="0"){
                        $subtital0 = $subtital0 + $item->baseImponible;
                    }
                    $impuestoGenerado  = $impuestoGenerado + $item->valor;
                
                }
                $subTotalSinImpuesto = $subtotal12+$subtital0;
            ?>
            <table style="border: 1px solid black;">
                <tr>
                    <td>
                        SUBTOTAL 12%
                    </td>
                    <td>
                        <?php echo e(bcadd($subtotal12,'0',2)); ?>

                       
                    </td>
                </tr>
                <tr>
                    <td>
                        SUBTOTAL 0%
                    </td>
                    <td>
                        <?php echo e(bcadd($subtital0,'0',2)); ?>

                       
                    </td>
                </tr>
                <tr>
                    <td>
                        SUBTOTAL no objeto de IVA
                    </td>
                    <td>
                        00.00
                    </td>
                </tr>
                <tr>
                    <td>
                        SUBTOTAL exento de IVA
                    </td>
                    <td>
                        00.00
                    </td>
                </tr>
                <tr>
                    <td>
                        SUBTOTAL SIN IMPUESTOS
                    </td>
                    <td>
                        
                        <?php echo e(bcadd($infoLiquidacionCompra->totalSinImpuestos,'0',2)); ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        TOTAL Descuento
                    </td>
                    <td>
                      
                        <?php echo e(bcadd($infoLiquidacionCompra->totalDescuento,'0',2)); ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        ICE
                    </td>
                    <td>
                        0.00
                    </td>
                </tr>
                <tr>
                    <td>
                        IVA 12%
                    </td>
                    <td>
             
                        <?php echo e(bcadd($impuestoGenerado,'0',2)); ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        IMPORTE TOTAL
                    </td>
                    <td>
                   
                        <?php echo e(bcadd($infoLiquidacionCompra->importeTotal,'0',2)); ?>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</section>


 

   
</body>
</html>
<?php
ob_start();
error_reporting(0);
$V = new EnLetras();
$con_letra = strtoupper($V->ValorEnLetras($venta->Total, "Gs."));
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
$dia = date('d', strtotime($venta->Fecha));
$mes = date('m', strtotime($venta->Fecha));
$anio = date('Y', strtotime($venta->Fecha));
?>
<page backtop="0mm" backbottom="0mm" backleft="8mm" backright="0mm" style="font-size: 12px; font-family: Arial;">
  <table width="800" style="font-size: 10px; font-family: Arial;">
    <tr>
      <td width="190">&nbsp;</td>
      <td width="80" height="22"><?php echo $dia ?></td>
      <td width="140"><?php echo $mes ?></td>
      <td width="235"><?php echo $anio ?> </td>
      <td width="85"><?php if ($venta->CondicionVenta == 1) {
                        echo "X";
                      } ?></td>
      <td colspan="2"><?php if ($venta->CondicionVenta == 2) {
                        echo "X";
                      } ?></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td height="24">&nbsp;</td>
      <td colspan="2"><?php echo $venta->NroDocumento; ?></td>
      <!-- <td width="102"><?php echo $venta->SerieComprobante . " - " . $venta->NroComprobante ?></td> -->
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" height="24">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $venta->Cliente; ?></td>
      <!-- <td colspan="3"><?php echo $venta->Direccion; ?></td> -->
      <!-- <td colspan="2"><?php echo $venta->Telefono; ?></td> -->
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
    <tr>
      <td height="8">&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
  </table>
  <div style="height:135px; width:800px;">
    <table width="800" style="font-size: 10px; font-family: Arial;">
      <?php

      if (!empty($detalles)) : ?>

        <?php
        $sumadorIva10 = 0;
        $totalproductoIVa0 = 0;
        $totalproductoIVa5 = 0;
        $totalproductoIVa10 = 0;
        $sumadorIva0 = 0;
        $sumadorIva5 = 0;
        $total_iva10 = 0;
        $total_iva5 = 0;
        $suma_ivas = 0;

        ?>
        <?php foreach ($detalles as $detalle) : ?>
          <?php
          //formateamos el Impuesto
          $impuesto = $detalle->Impuesto;
          if ($impuesto == '10') {
            $calculariva10 = $detalle->Importe / 11;
            $sumadorIva10 = $sumadorIva10 + $calculariva10;
            $totalproductoIVa10 = $totalproductoIVa10 + $detalle->Importe;
          } elseif ($impuesto == '5') {
            $calculariva5 = $detalle->Importe / 21;
            $sumadorIva5 += $calculariva5;
            $totalproductoIVa5 = $totalproductoIVa5 + $detalle->Importe;
          } else {
            $totalproductoIVa0 = $totalproductoIVa0 + $detalle->Importe;
          }

          ?>

          <tr>
            <td width="55"></td>
            <!-- <td width="57" valign="right"><?php echo $detalle->Codigo ?></td> -->
            <td width="80">&nbsp;&nbsp;<?php echo number_format(($detalle->Cantidad), 0, ",", ".") ?></td>
            <td width="380">&nbsp;&nbsp;&nbsp;<?php echo $detalle->Producto; ?></td>
            <td width="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format(($detalle->Precio), 0, ",", ".") ?></td>
            <td width="130">&nbsp;&nbsp;<?php if ($impuesto == '0') {
                                          echo number_format(($detalle->Importe), 0, ",", ".");
                                        } else {
                                          echo "0";
                                        } ?></td>
            <td width="120"><?php if ($impuesto == '5') {
                              echo number_format(($detalle->Importe), 0, ",", ".");
                            } else {
                              echo "0";
                            } ?></td>
            <td width="120"><?php if ($impuesto == '10') {
                              echo number_format(($detalle->Importe), 0, ",", ".");
                            } else {
                              echo "0";
                            } ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php
      $total_iva10 += $sumadorIva10;
      $total_iva5 += $sumadorIva5;
      $suma_ivas = $total_iva5 + $total_iva10;
      ?>
    </table>
  </div>
  <table width="813" style="font-size: 10px; font-family: Arial;">
    <tr>
      <td width="32">&nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="185">&nbsp;</td>
      <td width="70"><?php echo number_format(($totalproductoIVa0), 0, ",", "."); ?></td>
      <td width="64"><?php echo number_format(($totalproductoIVa5), 0, ",", "."); ?></td>
      <td width="125"><?php echo number_format(($totalproductoIVa10), 0, ",", "."); ?></td>
    </tr>
    <tr>
      <td height="34">&nbsp;</td>
      <td width="121">&nbsp;</td>
      <td colspan="4" height="28" valign="bottom"><?php echo $con_letra; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td height="24"><?php echo number_format(($venta->Total), 0, ",", ".") ?></td>
    </tr>
    <tr>
      <td width="121">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="141" height="30"><?php echo number_format(($total_iva5), 0, ",", "."); ?></td>
      <td>&nbsp;</td>
      <td width="121" height="28">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format(($total_iva10), 0, ",", "."); ?></td>
      <td></td>
      <td width="64"><?php echo number_format(($suma_ivas), 0, ",", "."); ?></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <table width="800" style="font-size: 10px; font-family: Arial;">
    <tr>
      <td width="190">&nbsp;</td>
      <td width="80" height="22"><?php echo $dia ?></td>
      <td width="140"><?php echo $mes ?></td>
      <td width="235"><?php echo $anio ?> </td>
      <td width="85"><?php if ($venta->CondicionVenta == 1) {
                        echo "X";
                      } ?></td>
      <td colspan="2"><?php if ($venta->CondicionVenta == 2) {
                        echo "X";
                      } ?></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td height="24">&nbsp;</td>
      <td colspan="2"><?php echo $venta->NroDocumento; ?></td>
      <!-- <td width="102"><?php echo $venta->SerieComprobante . " - " . $venta->NroComprobante ?></td> -->
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" height="24">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $venta->Cliente; ?></td>
      <!-- <td colspan="3"><?php echo $venta->Direccion; ?></td> -->
      <!-- <td colspan="2"><?php echo $venta->Telefono; ?></td> -->
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
    <tr>
      <td height="8">&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
    <tr>
      <td height="8">&nbsp;</td>
      <td colspan="3" valign="baseline">&nbsp;</td>
      <td colspan="2" valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
  </table>
  <div style="height:130px; width:800px;">
    <table width="800" style="font-size: 10px; font-family: Arial;">
      <?php
      if (!empty($detalles)) : ?>
        <?php
        $sumadorIva10 = 0;
        $totalproductoIVa0 = 0;
        $totalproductoIVa5 = 0;
        $totalproductoIVa10 = 0;
        $sumadorIva0 = 0;
        $sumadorIva5 = 0;
        $total_iva10 = 0;
        $total_iva5 = 0;
        $suma_ivas = 0;
        ?>
        <?php foreach ($detalles as $detalle) : ?>
          <?php
          //formateamos el Impuesto
          $impuesto = $detalle->Impuesto;
          if ($impuesto == '10') {
            $calculariva10 = $detalle->Importe / 11;
            $sumadorIva10 = $sumadorIva10 + $calculariva10;
            $totalproductoIVa10 = $totalproductoIVa10 + $detalle->Importe;
          } elseif ($impuesto == '5') {
            $calculariva5 = $detalle->Importe / 21;
            $sumadorIva5 += $calculariva5;
            $totalproductoIVa5 = $totalproductoIVa5 + $detalle->Importe;
          } else {
            $totalproductoIVa0 = $totalproductoIVa0 + $detalle->Importe;
          }
          ?>
          <tr>
            <td width="55"></td>
            <!-- <td width="57" valign="right"><?php echo $detalle->Codigo ?></td> -->
            <td width="80">&nbsp;&nbsp;<?php echo number_format(($detalle->Cantidad), 0, ",", ".") ?></td>
            <td width="380">&nbsp;&nbsp;&nbsp;<?php echo $detalle->Producto; ?></td>
            <td width="130">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format(($detalle->Precio), 0, ",", ".") ?></td>
            <td width="130">&nbsp;&nbsp;<?php if ($impuesto == '0') {
                                          echo number_format(($detalle->Importe), 0, ",", ".");
                                        } else {
                                          echo "0";
                                        } ?></td>
            <td width="120"><?php if ($impuesto == '5') {
                              echo number_format(($detalle->Importe), 0, ",", ".");
                            } else {
                              echo "0";
                            } ?></td>
            <td width="120"><?php if ($impuesto == '10') {
                              echo number_format(($detalle->Importe), 0, ",", ".");
                            } else {
                              echo "0";
                            } ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php
      $total_iva10 += $sumadorIva10;
      $total_iva5 += $sumadorIva5;
      $suma_ivas = $total_iva5 + $total_iva10;
      ?>
    </table>
  </div>
  <table width="813" border="0" style="font-size: 10px; font-family: Arial;">
    <tr>
      <td width="32">&nbsp;</td>
      <td colspan="4">&nbsp;</td>
      <td width="185">&nbsp;</td>
      <td width="70"><?php echo number_format(($totalproductoIVa0), 0, ",", "."); ?></td>
      <td width="64"><?php echo number_format(($totalproductoIVa5), 0, ",", "."); ?></td>
      <td width="125"><?php echo number_format(($totalproductoIVa10), 0, ",", "."); ?></td>
    </tr>
    <tr>
      <td height="34">&nbsp;</td>
      <td width="121">&nbsp;</td>
      <td colspan="4" height="28" valign="bottom"><?php echo $con_letra; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td height="24"><?php echo number_format(($venta->Total), 0, ",", ".") ?></td>
    </tr>
    <tr>
      <td width="121" height="30">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="141"><?php echo number_format(($total_iva5), 0, ",", "."); ?></td>
      <td width="121">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format(($total_iva10), 0, ",", "."); ?></td>
      <td width=""><?php echo number_format(($suma_ivas), 0, ",", "."); ?></td>
    </tr>
  </table>
</page>
<?php ob_end_flush(); ?>
<div class="col-12">
    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-shopping-cart"></i> <?= $title ?>
                    <small class="float-right">Datos: <?= $fecha ?>/<?= $mes ?>/<?= $año ?></small>
                </h4>
            </div>
            <!-- /.col -->
        </div>


        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Orden</th>
                            <th>Item</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $total_general = 0;
                        foreach ($reporte as $key => $value) {
                            $total_precio = $value->qty * $value->precio;
                            $total_general = $total_general + $total_precio;
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->numero_orden ?></td>
                                <td><?= $value->nombre_producto ?></td>
                                <td>Precio. <?= number_format($value->precio, 0) ?></td>
                                <td><?= $value->qty ?></td>
                                <td>Precio. <?= number_format($total_precio, 0) ?></td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                <h3> Total General : Precio. <?= number_format($total_general, 0) ?></h3>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->



        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Imprimir</button>

            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->
</div><!-- /.row -->
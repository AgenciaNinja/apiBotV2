<div class="content p-0">
    <div class="content-body">
        <div class="container-fluid pd-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Bot Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DashBoard Resume</li>
                        </ol>
                    </nav>
                    <h2 class="mg-b-0 tx-spacing--1">DashBoard Resume</h2>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="post" action="<?php echo base_url("dashBoardResume/index") ?>" id="search">
                                <div class="row ">
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="balance" class="">balance 2Captcha</label>
                                        <div class="input-group">
                                            <input
                                                class="
                                                form-control
                                                <?php if ($balance <= 20) : ?>
                                                    text-danger
                                                <?php elseif (($balance > 20) && ($balance <= 30)) : ?>
                                                    text-warning
                                                <?php else: ?>
                                                text-success
                                                <?php endif ?>
                                                "
                                                name="balance" id="balance"
                                                type="text"
                                                value="<?php echo $balance ?>"
                                                readonly
                                            >
                                            <div class="input-group-append">
                                                <span class="input-group-text">$</span>
                                            </div>
                                        </div>
                                        <a
                                            href="https://2captcha.com/enterpage"
                                            class="text-primary text-right"
                                            target="_blank"
                                        >
                                            <i class="fa fa-money"></i>Recargar</strong>
                                        </a>
                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="database">Bases de Datos</label>
                                        <select id="dbName" name="dbName" class="form-control">
                                            <?php foreach ($databases as $database): ?>
                                                <option
                                                    value="<?php echo $database ?>"
                                                    <?php echo ($dbName === $database) ? 'selected' : '' ?>
                                                >
                                                    <?php echo $database; ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="database">Fecha</label>
                                        <select id="fecha" name="fecha" class="form-control">
                                            <?php foreach ($fechas as $f): ?>
                                                <option
                                                    value="<?php echo $f ?>"
                                                    <?php echo ($f === $fecha) ? 'selected' : '' ?>
                                                >
                                                    <?php echo $f; ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="server">Server</label>
                                        <select id="server" name="server" class="form-control">
                                            <option value="0" <?php echo ($server === '0') ? 'selected' : '' ?>>
                                                todos
                                            </option>
                                            <?php foreach ($servers as $s): ?>
                                                <option
                                                    value="<?php echo $s[0] ?>"
                                                    <?php echo ( $s[0] == $server) ? 'selected' : '' ?>
                                                >
                                                    <?php echo  $s[0]." ".$s[1]." ".$s[2];  ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                        <?php if ($server == 0) : ?>
                                            <span class="text-success mt-1">
                                                total urls Pendientes: <?= number_format($pendientes, 0, '', '.') ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-success mt-1">
                                                Urls pendientes, server #<?= $server ?>: <?= number_format($pendientes, 0, '', '.') ?>
                                            </span>
                                        <?php endif ?>

                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <div class="custom-control custom-checkbox checkbox-lg" style="margin-top: 34px;">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="showDetail"
                                                name="showDetail"
                                                value="1"
                                                <?php if ($showDetail) :?> checked <?php
                                                endif ?>
                                            >
                                            <label class="custom-control-label" for="showDetail">Mostrar Estado Detalle</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="submit" class="btn btn-sm btn-block btn-secondary"  style="margin-top: 34px;">
                                            <i class="fas fa-filter mr-1"></i>Consultar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="text-secondary">
                                <i class="fa fa-database" style="font-size: 60px;"></i>
                            </div>
                            <h4 class="text-info mt-2">"<?php echo $dbName; ?>"</h4>
                        </div>
                        <div class="card-footer text-center">
                            <a href="" class="text-secondary" id="mostrar-opts-reiniciar">
                                <i class="fa fa-bomb mr-1"></i>
                                <span id="mostrar-text" class="">Restaurar (Reiniciar tareas)</span>
                                <span id="ocultar-text" class="display-none">Ocultar Reiniciar BD</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="text-secondary">
                                <i class="fa fa-calendar" style="font-size: 60px;"></i>
                            </div>
                            <h4 class="text-info mt-2"><?php echo $fecha; ?></h4>
                        </div>
                        <div class="card-footer text-center" style="min-height: 46px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="text-secondary">
                                <i class="fa fa-server" style="font-size: 60px;"></i>
                            </div>
                            <h4 class="text-info mt-2">
                                <?php echo ($server == 0) ? "Todos los server" : " server núm # ".$server; ?>
                            </h4>
                        </div>
                        <div class="card-footer text-center" style="min-height: 46px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <?php if ($total <= 0) : ?>
                                <div class="text-danger">
                                    <i class="fa fa-exclamation" style="font-size: 60px;"></i>
                                </div>
                            <?php else: ?>
                                <h1 class="text-success">
                                    <?php echo number_format($total, 0, '', '.');?>
                                    <i class="fa fa-check" style="font-size: 60px !important;"></i>
                                </h1>
                            <?php endif; ?>
                            <h4 class="text-info mt-2">Urls procesadas </h4>
                        </div>
                        <div class="card-footer text-center" style="min-height: 46px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <?php if ($sended <= 0) : ?>
                                <div class="text-danger">
                                    <i class="fa fa-exclamation" style="font-size: 60px;"></i>
                                </div>
                            <?php else: ?>
                                <h1 class="text-success">
                                    <?php echo number_format($sended, 0, '', '.');?>
                                    <i class="fa fa-check" style="font-size: 60px !important;"></i>
                                </h1>

                            <?php endif; ?>
                            <h4 class="text-info mt-2">Forms enviados </h4>
                        </div>
                        <div class="card-footer text-center" style="min-height: 46px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <?php if ($porc <= 0) : ?>
                                <div class="text-danger">
                                    <i class="fa fa-exclamation" style="font-size: 60px;"></i>
                                </div>
                            <?php else: ?>
                                <h1 class="text-success text-center">
                                    <?php echo $porc;?> %
                                    <?php if ($porc <= 10) : ?>
                                        <i class="fa fa-check text-danger" style="font-size: 60px !important;"></i>
                                    <?php elseif (($porc > 10) && ($porc <= 30)) : ?>
                                        <i class="fa fa-check text-warning" style="font-size: 60px !important;"></i>
                                    <?php else: ?>
                                        <i class="fa fa-check text-success" style="font-size: 60px !important;"></i>
                                    <?php endif ?>
                                </h1>

                            <?php endif; ?>
                            <h4 class="text-info mt-2">Efectividad (%)</h4>
                        </div>
                        <div class="card-footer text-center" style="min-height: 46px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 display-none" id="card-reiniciar">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-info"><i class="fa fa-bomb mr-1"></i> Restaurar Base de datos: "<?php echo $dbName; ?>" (Reiniciar Tareas)</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="text-info my-0">Acciones</h4>
                            <form id="formReiniciar" method="POST">
                                <div class="row mt-2">
                                    <div class="col-md-2 form-group">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="dropLog"
                                                name="dropLog"
                                                value="yes"
                                                checked
                                            >
                                            <label class="custom-control-label text-success" for="dropLog">Vaciar tabla "log"</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input estados"
                                                id="omitir"
                                                name="omitir"
                                                value="omitir"
                                            >
                                            <label class="custom-control-label text-success" for="omitir">Tomar en cuenta urls con estado "omitir"</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="custom-control custom-checkbox checkbox-lg">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input estados"
                                                id="por_repasar"
                                                name="por_repasar"
                                                value="por_repasar"

                                            >
                                            <label class="custom-control-label text-success" for="por_repasar">Tomar en cuenta urls con estado "por_repasar"</label>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-info mt-2 mb-0 py-0">Distrubuir entre los Servidores:</h4>
                                <div class="row mt-2">
                                    <?php foreach ($servers as $s): ?>
                                        <div class="col-md-1 form-group">
                                            <div class="custom-control custom-checkbox checkbox-lg">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input servers"
                                                    id="server_<?php echo  $s[0]; ?>"
                                                    name="server[<?php echo  $s[0]; ?>]"
                                                    value="<?php echo  $s[0]; ?>"
                                                    checked
                                                >
                                                <label class="custom-control-label text-success" for="server_<?php echo  $s[0]; ?>"><?php echo  $s[0]." ".$s[1];  ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-danger">
                            <div class="row mt-0">
                                <div class="col-md-9">
                                    Esta acción debe ser ejecutada con cautela, si no esta seguro, cierre esta opción y consulte al administrador.
                                    <a href="" class="text-secondary" id="ocultar-opts-reiniciar">cerrar...</a>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-sm btn-block btn-danger" id="reiniciarBD" data-db="<?php echo $dbName; ?>">
                                        <i class="fa fa-bomb mr-1"></i>Proceder a reiniciar BD
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($showDetail) : ?>
                <div class="row" style="margin-top: 100px !important;">
                    <div class="col-sm-12">
                        <h4 class="text-success">Detalles por Estado</h4>
                    </div>
                </div>
                <div class="row mt-2">
                    <?php foreach ($estados as $estado): ?>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-center text-info">
                                        <?php echo str_replace("_", " ", strtoupper($estado["name"]));?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <small class="text-secondary">
                                                <?php echo $estado["fecha"];?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if ($estado["totalDia"] <= 0) : ?>
                                            <div class="col-sm-12 text-center text-secondary" style="font-size: 36px;">
                                                <i class="fa fa-ban"></i>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-sm-6 text-info" style="font-size: 36px;">
                                                <?php echo number_format($estado["totalDia"], 0, '', '.'); ?>
                                            </div>
                                            <div class="col-sm-6 text-right mt-4">
                                                <a
                                                    href=""
                                                    class="text-success cambiar"
                                                    data-estado="<?= $estado["name"]; ?>"
                                                    data-fecha="<?= $fecha; ?>"
                                                    data-server="<?= $server; ?>"
                                                    data-db="<?= $dbName; ?>"
                                                >
                                                    <i class="fa fa-check mr-1"></i>pasar a <strong>pendiente</strong>
                                                </a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php if ($estado["total"] > 0) : ?>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6 class="text-secondary">
                                                    <small>
                                                        Total General <?php echo number_format($estado["total"], 0, '', '.'); ?>
                                                    </small>
                                                </h6>
                                            </div>
                                            <div class="col-sm-7 text-right">
                                                <a
                                                    href="" class="cambiar"
                                                    data-estado="<?= $estado["name"]; ?>"
                                                    data-fecha=""
                                                    data-server="<?= $server; ?>"
                                                    data-db="<?= $dbName; ?>"
                                                >
                                                    <h6 class="text-secondary">
                                                        <small>
                                                            <i class="fa fa-check mr-1"></i>
                                                            pasar <?= number_format($estado["total"], 0, '', '.'); ?>
                                                            a
                                                            <strong>pendiente</strong>
                                                        </small>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<style>
    .display-none {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
            $(".cambiar").click(function(e) {
                e.preventDefault();

                let url    =  BASE_URL+"dashBoardResume/pasarPendienteAjax";
                let estado = $(this).data("estado");
                let fecha  = $(this).data("fecha");
                let server = $(this).data("server");
                let dbName = $(this).data("db");
                let msg    = '';
                if (fecha === '') {
                    msg = 'Pasar a "pendiente", "TODAS" las tareas con estado: '+estado;
                } else {
                    msg = 'Pasar a "pendiente", tareas con estado: '+estado;
                }
                Swal.fire({
                    title: 'Seguro quiere Proceder?',
                    text: msg,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, proceder',
                    cancelButtonText: 'No quiero'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            loading.show();
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: { fecha, server, estado, dbName },
                                success: function(data) {
                                    data = JSON.parse(data);
                                    loading.hide();
                                    if (data.action == "success") {
                                        Swal.fire({
                                            title: 'Genial !!!',
                                            text: 'Operación Satisfactoria',
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $("#search").submit();
                                            }
                                        });
                                    }
                                },
                                error: function(result) {
                                    loading.hide();
                                    alert('error');
                                }
                            });

                        }
                })
            });
            $("#mostrar-opts-reiniciar").click(function(e) {
                e.preventDefault();
                $("#card-reiniciar").toggleClass("display-none");
                $("#mostrar-text").toggleClass("display-none");
                $("#ocultar-text").toggleClass("display-none");
            });
            $("#ocultar-opts-reiniciar").click(function(e) {
                e.preventDefault();
                $("#card-reiniciar").toggleClass("display-none");
                $("#mostrar-text").toggleClass("display-none");
                $("#ocultar-text").toggleClass("display-none");
                //let url    =  BASE_URL+"dashBoardResume/reiniciarDBAjax";
                let dbName = $(this).data("db");
                //alert(dbName);
            });
            $("#reiniciarBD").click(function(e) {
                e.preventDefault();
                let url     =  BASE_URL+"dashBoardResume/reiniciarDBAjax";
                let dbName  = $(this).data("db");
                let dropLog = "no";
                let servers = [];
                let estados = [];
                $('.servers:checked').each(function(i, e) {
                    servers.push($(this).val());
                });
                $('.estados:checked').each(function(i, e) {
                    estados.push($(this).val());
                });
                if ($('#dropLog:checked').length > 0) {
                    dropLog = "yes";
                }
                Swal.fire({
                    title: 'Seguro quiere Proceder a Reiniciar la BD "'+dbName+'" ?',
                    text: 'Esta operación es irreversible, y se puede perder información',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, proceder',
                    cancelButtonText: 'No quiero'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            loading.show();
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: { dbName, servers, estados, dropLog },
                                success: function(data) {
                                    data = JSON.parse(data);
                                    console.log(data);
                                    loading.hide();
                                    if (data.action == "success" && data.update) {
                                        Swal.fire({
                                            title: 'Genial !!!',
                                            text: 'Operación Satisfactoria',
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $("#search").submit();
                                            }
                                        });
                                    }
                                },
                                error: function(result) {
                                    loading.hide();
                                    alert('error');
                                }
                            });

                        }
                })
            });
        });
</script>

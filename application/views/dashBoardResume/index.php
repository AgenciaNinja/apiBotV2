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
                            <form method="post" action="<?php echo base_url("dashBoardResume/index") ?>">
                                <div class="row ">
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="balance" class="text-primary">Balance 2Captcha</label>
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
                                                <span class="input-group-text">$$</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="database">Base Datos</label>
                                        <select id="dbName" name="dbName" class="form-control">
                                            <?php foreach ($databases as $database): ?>
                                                <option
                                                    value="<?= $database ?>"
                                                    <?php echo ($dbName === $database) ? 'selected' : '' ?>
                                                >
                                                    <?= $database; ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <label for="database">Fecha</label>
                                        <select id="fecha" name="fecha" class="form-control">
                                            <?php foreach ($fechas as $f): ?>
                                                <option
                                                    value="<?= $f ?>"
                                                    <?php echo ($f === $fecha) ? 'selected' : '' ?>
                                                >
                                                    <?= $f; ?>
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
                                                    value="<?= $s[0] ?>"
                                                    <?php echo ( $s[0] == $server) ? 'selected' : '' ?>
                                                >
                                                    <?=  $s[0]." ".$s[1]." ".$s[2];  ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-2 form-group">
                                        <div class="custom-control custom-checkbox checkbox-lg" style="margin-top: 34px;">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="showDetail"
                                                name="showDetail"
                                                value="1"
                                                <?php if ($showDetail) :?> checked <?php endif ?>
                                            >
                                            <label class="custom-control-label" for="showDetail">Mostrar Estado Detalle</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-block btn-secondary mt-2">
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
                        <div class="card-header">
                            <h5 class="text-secondary">BaseDatos </h5>
                            <h3 class="text-info text-center">"<?php echo $dbName; ?>"</h3>
                            <div class="text-center mt-2 text-secondary">
                                <i class="fa fa-database" style="font-size: 80px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-secondary">Fecha </h5>
                            <h3 class="text-info text-center"><?php echo $fecha; ?></h3>
                            <div class="text-center mt-2 text-secondary">
                                <i class="fa fa-calendar" style="font-size: 80px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-secondary">Server(s) </h5>
                            <h3 class="text-info text-center">
                                <?php echo ($server == 0) ? "Todos" : "núm # ".$server; ?>
                            </h3>
                            <div class="text-center mt-2 text-secondary">
                                <i class="fa fa-server" style="font-size: 80px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-secondary">Urls procesadas </h5>
                            <h3 class="text-info text-center">
                                <?php if ($total <= 0) : ?>
                                    <div class="text-center mt-2 text-danger">
                                        <i class="fa fa-exclamation" style="font-size: 110px;"></i>
                                    </div>
                                <?php else: ?>
                                    <h2 class="text-success text-center">
                                        <?= $total;?>
                                    </h2>
                                    <div class="text-center mt-2 text-success">
                                        <i class="fa fa-check" style="font-size: 75px;"></i>
                                    </div>
                                <?php endif; ?>
                            </h3>

                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-secondary">Forms enviados </h5>
                            <h3 class="text-info text-center">
                                <?php if ($sended <= 0) : ?>
                                    <div class="text-center mt-2 text-danger">
                                        <i class="fa fa-exclamation" style="font-size: 110px;"></i>
                                    </div>
                                <?php else: ?>
                                    <h2 class="text-success text-center">
                                        <?= $sended;?>
                                    </h2>
                                    <div class="text-center mt-2 text-success">
                                        <i class="fa fa-check" style="font-size: 75px;"></i>
                                    </div>
                                <?php endif; ?>
                            </h3>

                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-secondary">Efectividad (%)</h5>
                            <h3 class="text-info text-center">
                                <?php if ($porc <= 0) : ?>
                                    <div class="text-center mt-2 text-danger">
                                        <i class="fa fa-exclamation" style="font-size: 110px;"></i>
                                    </div>
                                <?php else: ?>
                                    <h2 class="text-success text-center">
                                        <?= $porc;?> %
                                    </h2>
                                    <div class="text-center mt-2 text-success">
                                        <?php if ($porc <= 10) : ?>
                                            <i class="fa fa-check text-danger" style="font-size: 75px;"></i>
                                        <?php elseif (($porc > 10) && ($porc <= 30)) : ?>
                                            <i class="fa fa-check text-warning" style="font-size: 75px;"></i>
                                        <?php else: ?>
                                            <i class="fa fa-check text-success" style="font-size: 75px;"></i>
                                        <?php endif ?>
                                    </div>
                                <?php endif; ?>
                            </h3>

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
                        <div class="col-sm-2">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-center text-info">
                                        <?= $estado["name"];?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span class="text-secondary">
                                                <?= $estado["fecha"];?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-center col-sm-6">
                                            <span class=" text-info" style="font-size: 60px;">
                                                <?= $estado["totalDia"];?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
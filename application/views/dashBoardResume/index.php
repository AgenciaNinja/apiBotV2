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
                            <form method="get" action="<?php echo base_url("dashBoardResume/index") ?>">
                                <div class="row ">
                                    <div class="col-md-3 mt-2 form-group">
                                        <label for="database">Base Datos</label>
                                            <select id="dbName" name="dbName" class="form-control">
                                                <option
                                                    value="default"
                                                    <?php echo ($dbName === 'default') ? 'selected' : '' ?>
                                                >
                                                    default
                                                </option>
                                                <option
                                                    value="apibot_latam"
                                                    <?php echo ($dbName === 'apibot_latam') ? 'selected' : '' ?>
                                                >
                                                    apibot_latam
                                                </option>
                                                <option
                                                    value="apibot_agencias_marketing"
                                                    <?php echo ($dbName === 'apibot_agencias_marketing') ? 'selected' : '' ?>
                                                >
                                                    apibot_agencias_marketing
                                                </option>

                                            </select>
                                    </div>
                                    <div class="col-md-3 mt-2 form-group">
                                        <label for="database">Fecha</label>
                                            <select id="fecha" name="fecha" class="form-control">
                                                <option
                                                    value="<?= $hoy ?>"
                                                    <?php echo ($fecha === $hoy) ? 'selected' : '' ?>
                                                >
                                                    <?= $hoy ?>
                                                </option>
                                                <option
                                                    value="<?= $ayer ?>"
                                                    <?php echo ($fecha === $ayer) ? 'selected' : '' ?>
                                                >
                                                    <?= $ayer ?>
                                                </option>
                                            </select>
                                    </div>
                                    <div class="col-md-3 mt-2 form-group">
                                        <label for="server">Server</label>
                                        <select id="server" name="server" class="form-control">
                                            <option
                                                value="<?= $server ?>"
                                                <?php echo ($server === 'todos') ? 'selected' : '' ?>
                                            >
                                                <?= $server ?>
                                            </option>
                                            <?php for ($i= 1; $i<= 12; $i++): ?>
                                                <option
                                                    value="<?= $i ?>"
                                                    <?php echo ($i === $server) ? 'selected' : '' ?>
                                                >
                                                    <?= $i  ?>
                                                </option>
                                            <?php endfor ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 pt-4">
                                        <button type="submit" class="btn btn-block btn-secondary">
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-info">
                                Base de Datos: <?php echo $dbName; ?>
                            </h4>
                            <h4 class="text-info">
                                Fercha: <?php echo $fecha; ?>
                            </h4>
                            <h4 class="text-info">
                                Urls Procesadas: <?php echo $total; ?>
                            </h4>
                            <h4 class="text-info">
                                Forms enviados: <?php echo $sended; ?>
                            </h4>
                            <h4 class="text-info">
                                % Efectividad: <?php echo $porc; ?>
                            </h4>

                            <!--h4 class="mt-2 text-success">

                            </h4-->

                        </div>
                    </div>
                    <!--div class="card mt-3">
                        <div class="card-header">

                        </div>
                        <div class="card-body">

                        </div>
                    </div-->
                </div>
            </div>
        </div>
    </div>
</div>
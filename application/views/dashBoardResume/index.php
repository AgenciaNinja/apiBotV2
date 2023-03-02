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
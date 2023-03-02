
<div class="content p-0">
    <div class="content-body">
        <div class="container-fluid pd-x-0 mt-5">
            <div class="row mt-5">
                <div class="col-md-12 text-center mt-5">
                    <h1 class="mg-b-0 tx-spacing--1">Acceder al DashBoard del Bot de Forms</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <div class="card mt-3">
                        <div class="card-body">
                            <?= form_open('login'); ?>
                                <span class="text-danger">
                                <?= validation_errors(); ?>
                                <span>

                                <input
                                    type="text"
                                    class="form-control my-3"
                                    placeholder="username"
                                    name="username"
                                    id="username"
                                    required
                                    autocomplete="off"
                                />

                                <input
                                    type="password"
                                    class="form-control my-3"
                                    placeholder="password"
                                    name="password"
                                    id="password"
                                    required
                                    autocomplete="off"
                                />

                                <input type="submit" class="btn btn-lg btn-primary btn-block mt-3"  value="Aceptar" name="submit" />

                                <p class="mt-5 mb-3 text-muted">&copy; <?= date("Y") ?></p>

                            <?= form_close();?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </div>
</div>

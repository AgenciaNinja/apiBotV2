<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="<?php echo base_url()?>" class="aside-logo">NINJA<!--span>Visitas</span--></a>
        <a href="" class="aside-menu-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </a>
    </div>
    <div class="aside-body">
        <ul class="nav nav-aside">
            <li class="nav-item">
                <a href="<?php echo base_url("/dashBoardResume/index"); ?>" class="nav-link">
                    <i class="icon-sidebar fa fa-bookmark"></i> <span>Resume</span>
                </a>
            </li>
            <!--li class="nav-item">
                <a href="<?php echo base_url("/frontend/trabajo"); ?>" class="nav-link">
                    <i class="icon-sidebar fa fa-briefcase"></i> <span>Trabajos</span>
                </a>
            </li-->
        </ul>

        <ul class="nav nav-aside mt-5">
            <li class="nav-item">
                <a href="<?php echo base_url("/login/logout"); ?>" class="nav-link">
                    <i class="mr-1 fa fa-power-off"></i> <span>Cerrar Sessión</span>
                </a>
            </li>
        </ul>
    </div>

</aside>

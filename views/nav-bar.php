<nav>
    <a href="<?= FRONT_ROOT ?>StatusController/typeSession">
      <i class="fas fa-video"> MyJob</i>
    </a>
    <div class="nav-center">
        <div class="nav-header">
            <button class="nav-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <ul class="links">
            <?php if(isset($_SESSION['cuenta'])){
                if($_SESSION['cuenta']->getPrivilegios() == 0){?>
                <li>
                    <a href="<?= FROTN_ROOT ?>cuentaController/showList">Administrar Estudiantes</a>
                </li>

                <?php
                }
                else{
                    ?>
                    <li>
                        <a href="<?= FROTN_ROOT ?>studentController/showList">Ver Datos</a>
                    </li>
                    <?php
                }
            } 
            ?>
        </ul>
    </div>
</nav>
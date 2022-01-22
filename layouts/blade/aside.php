<?php session_start(); ?>
   <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            

            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Administraci&oacute;n</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../models/depositos/"><i class="fa fa-circle-o"></i> Dep&oacute;sitos</a></li>
                <li><a href="../../models/usuarios/"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="../../models/trabajadores/"><i class="fa fa-circle-o"></i> Trabajadores</a></li>
                <li><a href="../../models/saldos/"><i class="fa fa-circle-o"></i> Saldos</a></li>
                <li><a href="../../admin/retro/"><i class="fa fa-circle-o"></i> Arriendo de Retroexcvadoras</a></li>
                <li><a href="../../models/entrega/"><i class="fa fa-circle-o"></i> Nota de Entrega</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Mantenedores</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../../admin/localidades/"><i class="fa fa-circle-o"></i> Localidades</a></li>
                <li><a href="../../admin/perfiles/"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li><a href="../../admin/brigadas/"><i class="fa fa-circle-o"></i> Brigadas</a></li>
                <li><a href="../../admin/itos/"><i class="fa fa-circle-o"></i> Ito</a></li>
                <li><a href="../../admin/cargos/"><i class="fa fa-circle-o"></i> Cargos</a></li>
                <li><a href="../../models/proveedores/"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
              </a>
            </li>

            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Gastos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../gastos/gastos/"><i class="fa fa-circle-o"></i> Lista de Gastos</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Personal</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../../models/horas_extras/"><i class="fa fa-circle-o"></i> Horas Extras</a></li>
              </ul>
              </a>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Inventario</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../../inventario/"><i class="fa fa-circle-o"></i> Toma de Inventario</a></li>
              </ul>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
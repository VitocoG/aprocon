
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
                <li><a href="../depositos/"><i class="fa fa-circle-o"></i> Dep&oacute;sitos</a></li>
                <li><a href="../usuarios/"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="../../admin/saldos/"><i class="fa fa-circle-o"></i> Saldos</a></li>
                <li><a href="../../gastos/gastos/"><i class="fa fa-circle-o"></i> Lista de Gastos</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Personal</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../horas_extras/"><i class="fa fa-circle-o"></i> Horas Extras</a></li>
                <li><a href="../trabajadores/"><i class="fa fa-circle-o"></i> Trabajadores</a></li>
              </ul>
              </a>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../proveedores/"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="../materialesDeProveedores/"><i class="fa fa-circle-o"></i> Materiales de Proveedores</a></li>
                <li><a href="../compras/"><i class="fa fa-circle-o"></i> Solicitud de Compra</a></li>
                <li><a href="../oc/"><i class="fa fa-circle-o"></i> &Oacute;rden de Compra</a></li>
                <li><a href="../entrega/"><i class="fa fa-circle-o"></i> Nota de Entrega</a></li>
              </ul>
              </a>
            </li>
            
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Bodega</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../inventario/"><i class="fa fa-circle-o"></i> Toma de Inventario</a></li>
                <li><a href="../ingresos/"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="../traspasos/"><i class="fa fa-circle-o"></i> Traspasos</a></li>
                <li><a href="../salidas/"><i class="fa fa-circle-o"></i> Salidas</a></li>
                <li><a href="../materiales/"><i class="fa fa-circle-o"></i>Materiales de Essbio</a></li>
              </ul>
              </a>
            </li> -->
            
            <?php if( $_SESSION['id'] == 11 ){?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Mantenedores</span>
                 <i class="fa fa-angle-left pull-right"></i>
                  <ul class="treeview-menu">
                <li><a href="../bodegas/"><i class="fa fa-circle-o"></i> Bodegas</a></li>
                <li><a href="../brigadas/"><i class="fa fa-circle-o"></i> Brigadas</a></li>
                <li><a href="../cargos/"><i class="fa fa-circle-o"></i> Cargos</a></li>
                <li><a href="../contratos/"><i class="fa fa-circle-o"></i> Contratos</a></li>
                <li><a href="../localidades/"><i class="fa fa-circle-o"></i> Localidades</a></li>
                <li><a href="../perfiles/"><i class="fa fa-circle-o"></i> Perfiles</a></li>
              </ul>
              </a>
            </li><?php } ?>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
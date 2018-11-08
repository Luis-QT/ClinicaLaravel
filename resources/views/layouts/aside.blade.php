<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/user3.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::User()->name }}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="Buscar" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENÚ DE NAVEGACIÓN</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="@if(URL::full() == url('/admin')) active @endif" ><a href="{{ url('/admin') }}"><i class="fa fa-home "></i> <span>Inicio</span></a></li>
      <li class="treeview @if(URL::full() == url('/admin/users') || URL::full() == url('/admin/profiles')) active @endif" >
        <a href="#"><i class="fa fa-sitemap"></i> <span>Administración</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/admin/users') }}"><i class="fa fa-male"></i><span>Usuarios</span></a></li>
          <li><a href="{{ url('/admin/profiles') }}"><i class="fa fa-unlock "></i><span>Perfiles</span></a></li>
        </ul>
      </li>
      <li class="@if(URL::full() == url('/admin/specialties')) active @endif" ><a href="{{ url('/admin/specialties') }}"><i class="fa fa-mortar-board "></i> <span>Especialidades</span></a></li>
      <li class="@if(URL::full() == url('/admin/offices')) active @endif" ><a href="{{ url('/admin/offices') }}"><i class="fa fa-hotel "></i> <span>Consultorios</span></a></li>
      <li class="@if(URL::full() == url('/admin/patients')) active @endif"  ><a href="{{ url('admin/patients') }}"><i class="fa fa-wheelchair"></i> <span>Pacientes</span></a></li>
      <li class="@if(URL::full() == url('/admin/doctors')) active @endif" ><a href="{{ url('/admin/doctors') }}"><i class="fa fa-user-md"></i> <span>Médicos</span></a></li>
      <li class="@if(URL::full() == url('/admin/meetings')) active @endif" ><a href="{{ url('/admin/meetings') }}"><i class="fa fa-medkit"></i> <span>Citas</span></a></li>
      <li class="@if(URL::full() == url('/admin/configurations')) active @endif" ><a href="{{ url('/admin/configurations') }}"><i class="fa fa-gear"></i> <span>Configuraciones</span></a></li>
      
      <li class="treeview" >
        <a href="#"><i class="glyphicon glyphicon-signal"></i> <span>Reportes</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/admin/reportsbyPatient') }}"><i class="fa fa-bar-chart"></i><span>Citas por paciente</span></a></li>
          <li><a href="{{ url('/admin/reportsbyDoctor') }}"><i class="fa fa-line-chart"></i><span>Citas por medicos</span></a></li>
          <li><a href="{{ url('/admin/reportsbyOffice') }}"><i class="fa fa-bar-chart"></i><span>Citas por consultorios</span></a></li>
          <li><a href="{{ url('/admin/reportsbyCalendar') }}"><i class="fa fa-line-chart"></i><span>Citas en calendario</span></a></li>
        </ul>
      </li>  
      <li><a href="#"><i class="fa fa-stethoscope"></i> <span>Another Link</span></a></li>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
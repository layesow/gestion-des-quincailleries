<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
      <img src="{{ asset('back/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Quincaillerie</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('avatar/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->prenom}}&nbsp;{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 mb-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">

              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('pos.index') ? 'menu-open' : '' }}">
            <a href="{{ route('pos.index') }}" class="nav-link {{ request()->routeIs('pos.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Point de Vente (POS)
                </p>
            </a>
        </li>

          <li class="nav-item">
            <a href="{{ route('admin.categories') }}" class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Catégories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.produit') }}" class="nav-link {{ request()->routeIs('admin.produit') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Produits</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.caisses') }}" class="nav-link {{ request()->routeIs('admin.caisses') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>Caisses</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.rapport') }}" class="nav-link {{ request()->routeIs('admin.rapport') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
              <p>Rapports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.stock') }}" class="nav-link {{ request()->routeIs('admin.stock') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
              <p>Stocks</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.depense') }}" class="nav-link {{ request()->routeIs('admin.depense') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
              <p>Dépenses</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('abonnements.pack') }}" class="nav-link {{ request()->routeIs('abonnements.pack') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
              <p>Packs d'abonnements</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('abonnements.index') }}" class="nav-link {{ request()->routeIs('abonnements.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
              <p>Abonnements</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('paiements.index') }}" class="nav-link {{ request()->routeIs('paiements.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
              <p>Paiements</p>
            </a>
          </li>

          <li class="nav-item has-treeview {{ request()->routeIs('admin.modePaiement') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.modePaiement') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Paiements
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.modePaiement') }}" class="nav-link {{ request()->routeIs('admin.modePaiement') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Modes de Paiement</p>
                    </a>
                </li>
            </ul>
        </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                abonnements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.plan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages d'abonnements</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

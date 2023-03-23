<nav class="main-sidebar ps-menu">
    <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div>
    <div class="sidebar-header">
        <div class="text">ADMIN</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ (request()->is('kost*')) ? 'active' : '' }}">
                <a href="{{ route('kost.index') }}" class="link">
                    <i class="ti-layout-grid2-alt"></i>
                    <span>Data Kost</span>
                </a>
            </li>
            <li class="{{ (request()->is('kriteria*')) ? 'active' : '' }}">
                <a href="{{ route('kriteria.index') }}" class="link">
                    <i class="ti-layout"></i>
                    <span>Data Kriteria</span>
                </a>
            </li>
            <li class="{{ (request()->is('cpi*')) ? 'active' : '' }}">
                <a href="{{ route('cpi.index') }}" class="link">
                    <i class=" ti-ruler"></i>
                    <span>Lihat CPI</span>
                </a>
            </li>
        </ul>
    </div>
</nav> 
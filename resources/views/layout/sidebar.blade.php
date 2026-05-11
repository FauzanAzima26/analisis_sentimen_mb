<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item {{request()->routeIs('dashboard.*') ? 'active' : ''}}">
            <a href="{{route('dashboard.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Page 1">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{request()->routeIs('dataset.*') ? 'active' : ''}}">
            <a href="{{route('dataset.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">Import Dataset</div>
            </a>
        </li>
        <li class="menu-item {{request()->routeIs('text-processing.*') ? 'active' : ''}}">
            <a href="{{route('text-processing.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">Text Processing</div>
            </a>
        </li>
        <li class="menu-item {{request()->routeIs('tfidf.*') ? 'active' : ''}}">
            <a href="{{route('tfidf.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">TF-IDF</div>
            </a>
        </li>
        <li class="menu-item {{request()->routeIs('hasil-prediksi.*') ? 'active' : ''}}">
            <a href="{{route('hasil-prediksi.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <div data-i18n="Page 2">Hasil Prediksi</div>
            </a>
        </li>
    </ul>
</aside>

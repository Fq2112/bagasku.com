@extends('layouts.mst_admin')
@section('title', 'Admin '.env('APP_NAME').': Dashboard | '.env('APP_TITLE'))

@push('styles')
    <style></style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Admins</h4>
                            </div>
                            <div class="card-body">
                                {{count($admins)}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Admins</h4>
                            </div>
                            <div class="card-body">
                                {{count($admins)}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Admins</h4>
                            </div>
                            <div class="card-body">
                                {{count($admins)}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Admins</h4>
                            </div>
                            <div class="card-body">
                                {{count($admins)}}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Budget vs Sales</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="158"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>Top 5 Products</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Select Period</li>
                                <li><a href="#" class="dropdown-item">Today</a></li>
                                <li><a href="#" class="dropdown-item">Week</a></li>
                                <li><a href="#" class="dropdown-item active">Month</a></li>
                                <li><a href="#" class="dropdown-item">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                                <div class="media-body">
                                    <div class="float-right"><div class="font-weight-600 text-muted text-small">86 Sales</div></div>
                                    <div class="media-title">oPhone S9 Limited</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="64%"></div>
                                            <div class="budget-price-label">$68,714</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="43%"></div>
                                            <div class="budget-price-label">$38,700</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="assets/img/products/product-4-50.png" alt="product">
                                <div class="media-body">
                                    <div class="float-right"><div class="font-weight-600 text-muted text-small">67 Sales</div></div>
                                    <div class="media-title">iBook Pro 2018</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="84%"></div>
                                            <div class="budget-price-label">$107,133</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="60%"></div>
                                            <div class="budget-price-label">$91,455</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="assets/img/products/product-1-50.png" alt="product">
                                <div class="media-body">
                                    <div class="float-right"><div class="font-weight-600 text-muted text-small">63 Sales</div></div>
                                    <div class="media-title">Headphone Blitz</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="34%"></div>
                                            <div class="budget-price-label">$3,717</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="28%"></div>
                                            <div class="budget-price-label">$2,835</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="assets/img/products/product-3-50.png" alt="product">
                                <div class="media-body">
                                    <div class="float-right"><div class="font-weight-600 text-muted text-small">28 Sales</div></div>
                                    <div class="media-title">oPhone X Lite</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="45%"></div>
                                            <div class="budget-price-label">$13,972</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="30%"></div>
                                            <div class="budget-price-label">$9,660</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <img class="mr-3 rounded" width="55" src="assets/img/products/product-5-50.png" alt="product">
                                <div class="media-body">
                                    <div class="float-right"><div class="font-weight-600 text-muted text-small">19 Sales</div></div>
                                    <div class="media-title">Old Camera</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-primary" data-width="35%"></div>
                                            <div class="budget-price-label">$7,391</div>
                                        </div>
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger" data-width="28%"></div>
                                            <div class="budget-price-label">$5,472</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer pt-3 d-flex justify-content-center">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-primary" data-width="20"></div>
                            <div class="budget-price-label">Selling Price</div>
                        </div>
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-danger" data-width="20"></div>
                            <div class="budget-price-label">Budget Price</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Best Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="owl-carousel owl-theme" id="products-carousel">
                            <div>
                                <div class="product-item pb-3">
                                    <div class="product-image">
                                        <img alt="image" src="assets/img/products/product-4-50.png" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">iBook Pro 2018</div>
                                        <div class="product-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="text-muted text-small">67 Sales</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="product-item">
                                    <div class="product-image">
                                        <img alt="image" src="assets/img/products/product-3-50.png" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">oPhone S9 Limited</div>
                                        <div class="product-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>
                                        <div class="text-muted text-small">86 Sales</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="product-item">
                                    <div class="product-image">
                                        <img alt="image" src="assets/img/products/product-1-50.png" class="img-fluid">
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name">Headphone Blitz</div>
                                        <div class="product-review">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <div class="text-muted text-small">63 Sales</div>
                                        <div class="product-cta">
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Countries</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-title mb-2">July</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="assets/modules/flag-icon-css/flags/4x3/id.svg" alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Indonesia</div>
                                            <div class="text-small text-muted">3,282 <i class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="assets/modules/flag-icon-css/flags/4x3/my.svg" alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Malaysia</div>
                                            <div class="text-small text-muted">2,976 <i class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="assets/modules/flag-icon-css/flags/4x3/us.svg" alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">United States</div>
                                            <div class="text-small text-muted">1,576 <i class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 mt-sm-0 mt-4">
                                <div class="text-title mb-2">August</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="assets/modules/flag-icon-css/flags/4x3/id.svg" alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Indonesia</div>
                                            <div class="text-small text-muted">3,486 <i class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="assets/modules/flag-icon-css/flags/4x3/ps.svg" alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Palestine</div>
                                            <div class="text-small text-muted">3,182 <i class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="assets/modules/flag-icon-css/flags/4x3/de.svg" alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Germany</div>
                                            <div class="text-small text-muted">2,317 <i class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script></script>
@endpush
@extends('admin.layouts.app')

@section('title', 'Backup & Restore')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title mb-0 fw-semibold">
                    <i class="bi bi-database me-2"></i>Backup & Restore
                </h3>
            </div>
            <div class="card-body">
                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Total Products</h6>
                                        <h3 class="mb-0">{{ number_format($productsCount) }}</h3>
                                    </div>
                                    <i class="bi bi-box fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Total Categories</h6>
                                        <h3 class="mb-0">{{ number_format($categoriesCount) }}</h3>
                                    </div>
                                    <i class="bi bi-diagram-3 fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">Last Backup</h6>
                                        <h6 class="mb-0">Not Available</h6>
                                    </div>
                                    <i class="bi bi-clock-history fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="card border mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-download me-2"></i>Export Backup
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="card border-success">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="bi bi-database me-2 text-success"></i>Export All Products
                                </h6>
                                <p class="text-muted small mb-3">Export all products in JSON or CSV format for complete backup.</p>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.backup.export-all') }}" method="GET" class="d-inline">
                                        <input type="hidden" name="format" value="json">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-filetype-json me-1"></i>Export JSON
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.backup.export-all') }}" method="GET" class="d-inline">
                                        <input type="hidden" name="format" value="csv">
                                        <button type="submit" class="btn btn-outline-success">
                                            <i class="bi bi-filetype-csv me-1"></i>Export CSV
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Import Section -->
                <div class="card border mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-upload me-2"></i>Import Backup
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Warning:</strong> Importing will modify your database. Make sure you have a backup before proceeding.
                        </div>
                        
                        <div class="row g-3">
                            <!-- Standard Import -->
                            <div class="col-md-4">
                                <div class="card border-primary h-100">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-file-earmark-arrow-up me-2 text-primary"></i>Standard Import
                                        </h6>
                                        <p class="text-muted small mb-3">Import from JSON or CSV backup files.</p>
                                        <a href="{{ route('admin.backup.import') }}" class="btn btn-primary w-100">
                                            <i class="bi bi-upload me-1"></i>Import JSON/CSV
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- WordPress Import -->
                            <div class="col-md-4">
                                <div class="card border-info h-100">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-file-earmark-code me-2 text-info"></i>WordPress Import
                                        </h6>
                                        <p class="text-muted small mb-3">Import products from WordPress WooCommerce export (XML/WXR format).</p>
                                        <a href="{{ route('admin.backup.import-wordpress') }}" class="btn btn-info w-100">
                                            <i class="bi bi-upload me-1"></i>Import WordPress
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Shopify Import -->
                            <div class="col-md-4">
                                <div class="card border-success h-100">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="bi bi-shop me-2 text-success"></i>Shopify Import
                                        </h6>
                                        <p class="text-muted small mb-3">Import products from Shopify export (CSV format).</p>
                                        <a href="{{ route('admin.backup.import-shopify') }}" class="btn btn-success w-100">
                                            <i class="bi bi-upload me-1"></i>Import Shopify
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


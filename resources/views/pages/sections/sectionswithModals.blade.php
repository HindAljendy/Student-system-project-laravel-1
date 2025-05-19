@extends('layouts.master')

@section('css')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('stages_trans.pages') }}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('sections_trans.title_page') }}</span>
        </div>
        <div class="my-3">
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addModal">{{ trans('sections_trans.add_section') }}</a>
        </div>
        
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<div class="row">
    <div class="card card-statistics  h-100"> 
        <div class="card-body">   

            <div class="accordion gray plus-icon round">
                <div class="acd-group acd-active">
                    <a href="#" class="acd-heading"> </a>
                    <div class="acd-des">
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>   
</div>

@endsection

@section('js')
@endsection
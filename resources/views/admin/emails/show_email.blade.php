@extends('admin.admin_app')
@section('title', 'View Email')
@section('content')
@push('styles')
@endpush
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>View Email</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/emails') }}" title="Emails">Dispatched Emails</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/emails/show/' . $email->id) }}" title="Show Email"><strong>View Email</strong></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/emails') }}" title="Back To Emails">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Emails
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Email Template</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-1 col-form-label">Title</strong>
                        <div class="col-sm-10">
                            <span>{{$email->title}}</span>
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-1 col-form-label">Body</strong>
                        <div class="col-sm-10">
                            {!! $email->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
    
</script>
@endpush
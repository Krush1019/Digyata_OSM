@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'Invoice')

@section('specific-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/invoice.css')) }}">
<link href="{{ asset('client_user/css/booking-sign_up.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')


@section('content')

<main class="bg_gray pattern">
    <div class="container margin_60_40">
        <div class="col justify-content-center">
            <section class="invoice-print mb-1">
                <div class="row">
                    <div class="col-12">
                        <button class="btn_1 btn-print float-right mb-1 mb-md-0 ml-1"> <i class="fa fa-print"></i>
                            Print</button>
                        <button class="btn btn-outline-secondary float-right ml-1 ml-md-1"> <i class="fa fa-download"></i>
                            Download</button>
                    </div>
                </div>
            </section>
            <!-- invoice functionality end -->
            <section class="card invoice-page">
                <div id="invoice-template" class="card-body">
                    <!-- Invoice Company Details -->
                    <div id="invoice-company-details" class="row">
                        <div class="col-md-6 col-sm-12 text-left pt-1">
                            <div class="media pt-1">
                                <img src="{{asset('client_user/img/logo.svg')}}" width="150" height="35" />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <h1>Invoice</h1>
                            <div class="invoice-details mt-2">
                                <h6>INVOICE NO.</h6>
                                <p>001/2019</p>
                                <h6 class="mt-2">INVOICE DATE</h6>
                                <p>10 Dec 2018</p>
                            </div>
                        </div>
                    </div>
                    <!--/ Invoice Company Details -->

                    <!-- Invoice Recipient Details -->
                    <div id="invoice-customer-details" class="row pt-2">
                        <div class="col-sm-6 col-12 text-left">
                            <h5>Recipient</h5>
                            <div class="recipient-info my-2">
                                <p>Patel Kanubhai</p>
                                <p>85 gokuldham Society, Kamana Road</p>
                                <p>Visnagar, Mahesana</p>
                                <p>Gujarat - 384315</p>
                            </div>
                            <div class="recipient-contact pb-2">
                                <p>
                                    <a href="mailto:kanubhai@gmail.com"><i class="fa fa-envelope"></i>
                                        kanubhai@gmail.com</a>
                                </p>
                                <p>
                                    <a href="tel:+919888888888"><i class="fa fa-phone-square"></i>
                                        +91 988 888 8888</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-right">
                            <h5>RM Cleaners</h5>
                            <div class="company-info my-2">
                                <p>9B Madhuvan Complex, Radhanpur Road</p>
                                <p>Mahesana, Mahesana</p>
                                <p>Gujarat - 94203</p>
                            </div>
                            <div class="company-contact">
                                <p>
                                    <a href="mailto:rmcleaners@gmail.com"><i class="fa fa-envelope"></i>
                                        rmcleaners@gmail.com</a>
                                </p>
                                <p>
                                    <a href="tel:+919888888888"><i class="fa fa-phone-square"></i>
                                        +91 988 888 8888</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/ Invoice Recipient Details -->

                    <!-- Invoice Items Details -->
                    <div id="invoice-items-details" class="pt-1 invoice-items-table">
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>TASK DESCRIPTION</th>
                                            <th>RATE</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 BHK Dusting</td>
                                            <td>599₹</td>
                                            <td>599₹</td>
                                        </tr>
                                        <tr>
                                            <td>10Sq. feet Garden</td>
                                            <td>100₹</td>
                                            <td>100₹</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="invoice-total-details" class="invoice-total-table">
                        <div class="row">
                            <div class="col-4 offset-6">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>SUBTOTAL:</th>
                                                <th>699₹</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Footer -->
                    {{-- <div id="invoice-footer" class="text-right pt-3">
                        <p>Transfer the amounts to the business amount below. Please include invoice number
                            on your check.
                            <p class="bank-details mb-0">
                                <span class="mr-4">BANK: <strong>FTSBUS33</strong></span>
                                <span>IBAN: <strong>G882-1111-2222-3333</strong></span>
                            </p>
                    </div> --}}
                    <!--/ Invoice Footer -->
                </div>
            </section>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/pages/invoice.js')) }}"></script>
@endsection
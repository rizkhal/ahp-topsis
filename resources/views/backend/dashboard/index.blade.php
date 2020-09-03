<x-app-layout title="Dashboard">
    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Dashboard"></x-breadcrumb>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Candidate</h4>
                            </div>
                            <div class="card-body">
                                {{$student}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Alternative</h4>
                            </div>
                            <div class="card-body">
                                {{$alternative}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Calculated</h4>
                            </div>
                            <div class="card-body">
                                {{$calculate}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @stop
</x-app-layout>

<x-app-layout title="Calculated">
    @section("app")
        <section class="section">
            {{-- breadcrumb --}}
            <x-breadcrumb title="Calculated Matrix"></x-breadcrumb>
            <div class="section-body">
                <h2 class="section-title">Daftar tabel</h2>
                <p class="section-lead">Data yang ditampilkan merupakan hasil perhitungan.</p>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Eigen</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Candidate</th>
                                            <th>Eigen Vector</th>
                                        </tr>
                                        @foreach ($eigen as $i => $row)
                                            <tr>
                                                <td>{{++$i}}.</td>
                                                <td>{{$row->candidate}}</td>
                                                <td>{{$row->eigenVector}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Normalisasi</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center">
                                        <tr>
                                            <th rowspan='2'>No</th>
                                            <th rowspan='2'>Alternatif</th>
                                            <th colspan='{{count($candidate)}}'>Candidate</th>
                                        </tr>
                                        <tr>
                                            @foreach($candidate as $value)
                                                <th>{{$value}}</th>
                                            @endforeach
                                        </tr>
                                        @foreach($alternative as $i => $value)
                                            <tr>
                                                <td align='center'>{{++$i}}.</td>
                                                <td>{{$value}}</td>
                                                @foreach($normalize as $v)
                                                    <td align='center'>{{$v[$i-1]}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Solusi Ideal</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center">
                                        <tr>
                                            <th rowspan='2' class="text-center">Solusi Ideal</th>
                                            <th colspan='{{count($candidate)}}'>Candidate</th>
                                        </tr>
                                        <tr>
                                            @foreach($candidate as $value)
                                                <th>{{$value}}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                          <th>A<sup>+</sup></th>
                                          @foreach($solution->plus as $plus)
                                            <th>{{$plus}}</th>
                                          @endforeach
                                        </tr>
                                        <tr>
                                          <th>A<sup>-</sup></th>
                                          @foreach($solution->minus as $minus)
                                            <th>{{$minus}}</th>
                                          @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Jarak Solusi Ideal</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Alternatif</th>
                                            <th>D<sup>+</sup></th>
                                            <th>D<sup>-</sup></th>
                                        </tr>
                                        @foreach($alternative as $i => $value)
                                            <tr>
                                                <td>{{++$i}}.</td>
                                                <td>{{$value}}</td>
                                                <td>{{$distance->plus[$i-1]}}</td>
                                                <td>{{$distance->minus[$i-1]}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Skor Akhir</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Candidate</th>
                                            <th>Skor Akhir</th>
                                        </tr>
                                        @foreach($candidate as $i => $value)
                                            <tr {{ max($result) == $result[$i] ? "class=table-danger" : "" }}>
                                                <td>{{++$i}}.</td>
                                                <td>{{$value}}</td>
                                                <td>{{$result[$i-1]}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tabel Perengkingan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Candidate</th>
                                            <th>Skor Akhir</th>
                                        </tr>
                                        @for ($i = 0; $i < count($ranks); $i++)
                                            <tr {{ $i == 0 ? "class=table-danger" : "" }}>
                                                <td>{{$i + 1}}</td>
                                                <td>{{$ranks[$i][0]}}</td>
                                                <td>{{$ranks[$i][1]}}</td>
                                            </tr>
                                        @endfor
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @stop
</x-app-layout>

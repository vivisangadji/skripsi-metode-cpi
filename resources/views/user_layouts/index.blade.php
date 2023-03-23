@extends('user_layouts.master')

@section('content')       
    <div class="container mt-100 mt-60">
        <div class="row">
            <div class="col-lg-12">
                <div class="features-absolute blog-search">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="text-center subcribe-form">
                                
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end div-->
            </div><!--end col-->
        </div><!--end row-->
        <div class="row align-items-center mb-5 pb-2">
            <div class="col-md-8">
                <div class="section-title text-center text-md-start">
                    <h4>Pilih Lihat Semua Kost</h4>
                </div>
            </div><!--end col-->
            <div class="col-md-8">
                <a href="{{ route('all.kost') }}" class="btn btn-info mt-2">Tidak Memilih Kriteria</a>
            </div><!--end col-->
        </div><!--end row-->
        <hr>
        <div class="row align-items-center mb-2 pb-2">
            <div class="col-md-8">
                <div class="section-title text-center text-md-start">
                    <h4>Pilih Kost berdasarkan Kriteria</h4>
                </div>
            </div><!--end col-->
            <div class="col-md-8">
                <form action="{{ route('kost.filter') }}" method="post">
                    @csrf
                    <span>Fasilitas :</span>
                    <input class="fasilitas" name="fasilitas" type="hidden" value="">
                    <input class="jenis_kost" name="jenis_kost" type="hidden" value="">
                    <input class="luas_kamar" name="luas_kamar" type="hidden" value="">
                    <input class="harga" name="harga" type="hidden" value="">
                    <input class="listrik" name="listrik" type="hidden" value="">
                    <select id="fasilitas" class="form-select" aria-label="Default select example">
                        <option value="">Pilih Fasilitas</option>
                        <option value="1" id="fasilitas1">1 - 2 Fasilitas <span class="text-muted">(1)</span></option>
                        <option value="2" id="fasilitas2">3 - 4 Fasilitas <span class="text-muted">(2)</span></option>
                        <option value="3" id="fasilitas3">5 - 6 Fasilitas <span class="text-muted">(3)</span></option>
                        <option value="4" id="fasilitas4"> > 6 Fasilitas <span class="text-muted">(4)</span></option>                       
                    </select>
                    <span>Jenis Kost :</span>
                    <select id="jenis_kost" name="jenis_kost" class="form-select" aria-label="Default select example">
                        <option value="">Pilih Jenis Kost</option>
                        <option value="1">Kost Campur <span class="text-muted">(1)</span></option>
                        <option value="2">Khusus Pria / Putri <span class="text-muted">(2)</span></option>                      
                    </select>
                    <span>Luas Kamar :</span>
                    <select id="luas_kamar" name="luas_kamar" class="form-select" aria-label="Default select example">
                        <option value="">Pilih Luas Kamar</option>
                        <option value="1">3 x 3 m <span class="text-muted">(1)</span></option>
                        <option value="2">3 x 4 m <span class="text-muted">(2)</span></option>
                        <option value="3">4 x 4 m <span class="text-muted">(3)</span></option>
                        <option value="4">4 x 5 m <span class="text-muted">(4)</span></option>                      
                    </select>
                    <span>Harga :</span>
                    <select id="harga" name="harga" class="form-select" aria-label="Default select example">
                        <option value="">Pilih Harga</option>
                        <option value="1">1.600.000 - 2.000.000 <span class="text-muted">(1)</span></option>
                        <option value="2">1.000.000 - 1.500.000 <span class="text-muted">(2)</span></option>
                        <option value="3">750.000 - 950.000 <span class="text-muted">(3)</span></option>
                        <option value="4">550.000 - 700.000 <span class="text-muted">(4)</span></option>
                        <option value="5">450.000 - 500.000 <span class="text-muted">(5)</span></option>                      
                    </select>
                    <span>Listrik(meteran) :</span>
                    <select id="listrik" name="listrik" class="form-select" aria-label="Default select example">
                        <option value="">Pilih Listrik</option>
                        <option value="1">Gabung <span class="text-muted">(1)</span></option>
                        <option value="2">Sendiri / Pribadi <span class="text-muted">(2)</span></option>                  
                    </select>
                    <button type="submit" class="btn btn-primary mt-2">Cari Kriteria</button>
                </form>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
@endsection

@push('js')
<script>
    $(document).ready(function(){
        function addURLParam(key, value){
            const searchParams = new URLSearchParams(window.location.search)
            searchParams.set(key, value)
    
            const newRelativePathQuery = window.location.pathname + "?" + searchParams.toString()
            history.pushState(null, "", newRelativePathQuery)
        }

        function addInputValue(atribut, value){
            console.log(atribut);
            $('.'+atribut).val(value)
        }

        $('select').change(function(){
            let atribut = $(this).attr('id')
            let value = $(this).val()
            // addURLParam(nameVal, selectedVal)
            addInputValue(atribut, value)
        })

        $("#fasilitas1").prop('title', 'Contoh: AC, WiFi')
        $("#fasilitas2").prop('title', 'Contoh: Kamar mandi dalam, AC, WiFi, Springbed')
        $("#fasilitas3").prop('title', 'Contoh: Kamar mandi dalam, AC, WiFi, Springbed, Lemari, Dapur Umum')
        $("#fasilitas4").prop('title', 'Contoh: AC, WiFi, Springbed, Lemari, Dapur Pribadi, Kamar mandi dalam')
    })
</script>
@endpush
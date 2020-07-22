<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">

            <li>
                <a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/mastergudang') }}">Data Gudang </a></li>
                    <li><a href="{{ url('/masterklasifikasi') }}">Data Klasifikasi</a></li>
                    <li><a href="{{ url('/mastersatuan') }}">Data Satuan</a></li>
                    <li><a href="{{ url('/masteritem') }}">Data Item</a></li>
                    <li><a href="{{ url('/mastermatauang')}}">Data Mata Uang</a></li>
                    <li><a href="{{ url('/masterpelanggan') }}">Data Pelanggan</a></li>
                    <li><a href="{{ url('/mastersupplier') }}">Data Supplier</a></li>
                    <li><a href="{{ url('/masterkaryawan')}}">Data Karyawan</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fa fa-dollar"> </i> Penjualan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Pemesanan Penjualan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/sopenjualan')}}">S.O</a></li>
                            <li><a href="{{ url('/konfirmasiPenjualan') }}">S.O Konfirmasi</a></li>
                            <li><a href="{{ url('/dikirimPenjualan') }}">S.O Selesai</a></li>
                            <!-- <li><a href="{{ url('/batalPenjualan') }}">S.O Batal</a></li> -->
                        </ul>
                    </li>
                    <li><a>Surat Jalan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/suratJalan/create') }}">Buat Surat Jalan </a></li>
                            <li><a href="{{ url('/suratJalan') }}">Surat Jalan </a></li>
                            <li><a href="{{ url('/konfirmasiSuratJalan') }}">Surat Jalan Konfirmasi</a></li>
                        </ul>
                    </li>
                    <li><a>Return Surat Jalan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/returnSuratJalan/add/0') }}">Buat Return Surat Jalan </a></li>
                            <li><a href="{{ url('/returnSuratJalan') }}">Return Surat Jalan </a></li>
                            <li><a href="{{ url('/konfirmasiReturnSuratJalan') }}">Return Surat Jalan Konfirmasi</a></li>
                        </ul>
                    </li>
                    <!-- <li><a>Penjualan Langsung<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/penjualanLangsung') }}">Penjualan Langsung (Kasir)</a></li>
                            <li><a href="{{ url('/returnPenjualanLangsung/0') }}">Return Penjualan Langsung</a></li>
                        </ul>
                    </li> -->
                    <li><a>Piutang<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/invoicepiutang') }}">Invoice</a></li>
                            <li><a href="{{ url('/pelunasanpiutang') }}">Pelunasan</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a><i class="fa fa-shopping-cart"></i> Pembelian<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Pemesanan Pembelian<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/popembelian') }}">P.O</a></li>
                            <li><a href="{{ url('/pokonfirmasi') }}">P.O Konfirmasi</a></li>
                            <li><a href="{{ url('/poditerima') }}">P.O Diterima</a></li>
                            <li><a href="{{ url('/pobatal') }}">P.O Batal</a></li>
                        </ul>
                    </li>
                    <li><a>Penerimaan Barang<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/penerimaanBarang') }}">Penerimaan Barang</a></li>
                            <li><a href="{{ url('/konfirmasiPenerimaanBarang') }}">Penerimaan Konfirmasi</a></li>
                            <li><a href="{{ url('/batalPenerimaanBarang') }}">Penerimaan Batal</a></li>
                        </ul>
                    </li>
                    <li><a>Return Penerimaan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/returnPenerimaanBarang') }}">Return Penerimaan Barang</a></li>
                            <li><a href="{{ url('/konfirmasiReturnPenerimaanBarang') }}">Return Penerimaan Konfirmasi</a></li>
                            <li><a href="{{ url('/batalReturnPenerimaanBarang') }}">Return Penerimaan Batal</a></li>
                        </ul>
                    </li>
                    <li><a>Hutang<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/invoicehutang') }}">Invoice</a></li>
                            <li><a href="{{ url('/pelunasanhutang') }}">Pelunasan</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a><i class="fa fa-list"></i> Stok <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/kartustok') }}">Kartu Stok</a></li>
                    <li><a href="{{ url('/stokmasuk') }}">Stok Masuk</a></li>
                    <li><a href="{{ url('/stokkeluar') }}">Stok Keluar</a></li>
                    <li><a href="{{ url('/pengeluarantambahan') }}">Pengeluaran Tambahan</a></li>
                </ul>
            </li>

            <li><a href="/eventlog"><i class="fa fa-edit"></i> Eventlog </a>
            </li>

            <li>
                <a><i class="fa fa-users"></i>User Control <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li>
                        <a href="{{ url('/user/change/' . Auth::user()->name )}}">Ubah Password</a>
                    </li>
                    @if (Auth::user() && Auth::user()->name == 'admin')
                    <li>
                        <a href="{{ url('/user')}}">Manajemen User</a>
                    </li>
                    <li>
                        <a href="{{ url('roles')}}">Manajemen Roles</a>
                    </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>
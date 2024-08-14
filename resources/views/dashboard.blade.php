@extends('user.main_master')

@section('content')

<div class="body-content min-vh-100 mt-5">
    <div class="container">
        <h2 class="text-center">
                User Dashboard 
            </h2>
        <div class="row mt-4">
            
            
            {{-- <div class="col-md-2">
                <li class="list-group">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block my-3">Home</a>
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block my-3">Profile Update</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block my-3">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block my-3">Logout</a>
                </li>
            </div> --}}
            <div class="col-md-2 col-sm-12 px-0">
                <div
                  id="sidebar"
                  class="collapse collapse-horizontal show border-end me-3"
                >
                  <div
                    id="sidebar-nav"
                    class="list-group border-0 rounded-0 text-sm-start me-3"
                  >

                    <a
                      href="{{ route('dashboard') }}"
                      class="btn btn-dark fw-bold btn-sm btn-block my-3"
                      >Dashboard</a
                    >
                    <a
                      href="{{ route('user.profile.edit') }}"
                      class="btn btn-dark fw-bold btn-sm btn-block my-3"
                      >Profile Update</a
                    >
                    <a
                      href="{{ route('change.password') }}"
                      class="btn btn-dark fw-bold btn-sm btn-block my-3"
                      >Change Password</a
                    >
                    <a
                      href="{{ route('user.logout') }}"
                      class="btn btn-danger fw-bold btn-sm btn-block my-3"
                      >Logout</a
                    >
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                    <div class="card border border-3 ">
                      <div class="card-body">
                        <div
                          class="d-flex flex-column align-items-center text-center"
                        >
                          <div class="mt-3">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-secondary mb-1 mt-2">
                              {{ Auth::user()->email }}
                            </p>
                            <p class="text-secondary mb-1 mt-2">
                              {{ Auth::user()->address }}
                            </p>
                          </div>
                          <div class="row">
                          <div class="col-sm-12 mt-3">
                            <a
                              class="btn btn-dark"
                              href="{{ route('user.profile.edit') }}"
                              >Edit</a
                            >
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <li class="list-group"></li>
                    </div>
                  </div>
            <div class="col-md-6 border border-3 p-3 rounded">
                <h4 class="mb-4">Riwayat Transaksi</h4>
                
                @if($transactions->isEmpty())
                    <p>Tidak ada transaksi.</p>
                @else
                    @php
                        $invoiceCount = 1;
                    @endphp
                    @foreach($transactions as $invoiceNumber => $invoiceTransactions)
                        <div class="mb-4">
                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#invoice-{{ $invoiceCount }}" aria-expanded="false" aria-controls="invoice-{{ $invoiceCount }}">
                                Invoice: {{ $invoiceCount }}
                            </button>
                            <div class="collapse mt-3" id="invoice-{{ $invoiceCount }}">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoiceTransactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transaction->product->name }}</td>
                                                <td>{{ $transaction->quantity }}</td>
                                                <td>Rp{{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($transaction->quantity * $transaction->product->price, 0, ',', '.') }}</td>
                                                <td>{{ $transaction->updated_at->format('d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php
                            $invoiceCount++;
                        @endphp
                    @endforeach
                @endif
            </div>
        </div>

        
    </div>


</div>

@endsection

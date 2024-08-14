@extends('admin.admin_master')

@section('content')

    <div class="container m-2">
        <div class="row">
            <h2 class="mb-4 ml-3">All User Transactions</h2>
            @foreach($users as $user)
                <div class="col-12 mb-5 ml-4">
                    <h4 class="mb-4">{{ $user->name }} Transactions</h4>
                    @if($user->orders->isEmpty())
                        <p>No transactions for this user.</p>
                    @else
                        @foreach($user->orders->groupBy('invoice_number') as $invoiceNumber => $invoiceTransactions)
                        @php
                        $isOnCart = $invoiceTransactions->every(function($transaction) {
                            return $transaction->status === 'on cart';
                        });
                        @endphp

                        @if($isOnCart)
                                <div class="mb-4">
                                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#on-cart-{{ $user->id }}" aria-expanded="false" aria-controls="on-cart-{{ $user->id }}">
                                        Still On Cart
                                    </button>
                                    <div class="collapse mt-3" id="on-cart-{{ $user->id }}">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Alamat</th>
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
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->updated_at->format('d-m-Y') }}</td>
                                                        <td>{{ $user->address }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#invoice-{{ $user->id }}-{{ $invoiceNumber }}" aria-expanded="false" aria-controls="invoice-{{ $user->id }}-{{ $invoiceNumber }}">
                                        Invoice: {{ $invoiceNumber }}
                                    </button>
                                    <div class="collapse mt-3" id="invoice-{{ $user->id }}-{{ $invoiceNumber }}">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
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
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->updated_at->format('d-m-Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@endsection

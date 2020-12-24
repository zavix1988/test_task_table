@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Table</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Collection</th>
                    <th scope="col">Count</th>
                    <th scope="col">Gross Margin</th>
                    <th scope="col">Total income</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->collection_name }}</td>
                    <td>{{ $row->count }}</td>
                    <td>{{ $row->gross_margin/100 }}&nbsp;&dollar;</td>
                    <td>{{ $row->total_income/100 }}&nbsp;&dollar;</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>

    </div>
@endsection

@extends('admin.app.app')
@section('main-content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    @endpush
    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div class="container">
                        <table id="myTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011-04-25</td>
                                    <td>$320,800</td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal to add new record -->

        </div>


    </div>
    @push('js')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
            let table = new DataTable('#myTable');
        </script>
    @endpush
@endsection

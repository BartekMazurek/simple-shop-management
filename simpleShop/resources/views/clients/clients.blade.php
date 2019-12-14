@extends('index')

@section('content')
    <div class="container">
        <div class="row title-row">
            <div class="col-12">
                <h3>Clients summary</h3>
            </div>
        </div>
        <div class="row clients-filter-row">
            <div class="col-12">
                <form>
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <input class="form-control" type="date" id="dateFrom">
                            <small class="form-text text-muted">Date from</small>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" id="dateTo">
                            <small class="form-text text-muted">Date to</small>
                        </div>
                        <div class="col-auto">
                            <select class="form-control" id="clientType">
                                <option value="0" selected>All</option>
                                <option value="1">Corporate</option>
                                <option value="2">Business</option>
                                <option value="3">Individual</option>
                            </select>
                            <small class="form-text text-muted">Client type</small>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2" id="submitFilter">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered text-center" id="clientsReportTable">
                    <thead>
                    <tr>
                        <th scope="col">Client id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Orders count</th>
                        <th scope="col">Orders summary value</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="reportType" value="clients">
@endsection

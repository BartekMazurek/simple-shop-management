@extends('index')

@section('content')
    <div class="container"><div class="row title-row">
            <div class="col-12">
                <h3>Overall summary</h3>
            </div>
        </div>
        <div class="row overall-filter-row">
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
                            <button type="submit" class="btn btn-primary mb-2" id="submitFilter">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered text-center" id="overallReportTable">
                    <thead>
                    <tr>
                        <th scope="col">Orders amount</th>
                        <th scope="col">Client group</th>
                        <th scope="col">Orders value</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="reportType" value="overall">
@endsection

<div class="report py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_date">From Date</label>
                            <input id="from_date" name="from_date" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_date">To Date</label>
                            <input id="to_date" name="to_date" class="form-control" type="date"><br />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex align-items-center justify-content-end">
                <button class="btn btn-primary-rounded">Generate Report
                    <span><i class="fa fa-save"></i></span>
                </button>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h5>QUOTES</h5>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="text-dark">30 Jan 2023 - 09 Feb 2023</h5>
                    </div>
                </div>

                <div class="row chart-stats">
                    <div class="col-md-8 col-lg-9">
                        <div id="daily-data-chart"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="stat">
                            <h2>1</h2>
                            <h6>Total Quotes</h6>
                        </div>
                        <div class="stat">
                            <h2>£76,404.00</h2>
                            <h6>Highest Quote</h6>
                        </div>
                        <div class="stat">
                            <h2>£157.865</h2>
                            <h6>Average Quote</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered nowrap no-footer w-100" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Phone Number</th>
                    <th>Postal Code</th>
                    <th>Added On</th>
                    <th>Quote Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MCG-00001494</td>
                    <td>Paul Fernandes</td>
                    <td>03432156540</td>
                    <td>W1W 6YQ</td>
                    <td>2-12-2022</td>
                    <td>1578.65</td>
                    <td>draft</td>
                    <td>
                        <div>
                            <a href="" data-toggle="tooltip" title="View Quote">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

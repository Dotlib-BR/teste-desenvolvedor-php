@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Tickets</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Assignee </th>
                                    <th> Subject </th>
                                    <th> Status </th>
                                    <th> Last Update </th>
                                    <th> Tracking ID </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="assets/images/faces/face1.jpg" class="me-2" alt="image"> David
                                        Grey
                                    </td>
                                    <td> Fund is not recieved </td>
                                    <td>
                                        <label class="badge badge-gradient-success">DONE</label>
                                    </td>
                                    <td> Dec 5, 2017 </td>
                                    <td> WD-12345 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/faces/face2.jpg" class="me-2" alt="image"> Stella
                                        Johnson
                                    </td>
                                    <td> High loading time </td>
                                    <td>
                                        <label class="badge badge-gradient-warning">PROGRESS</label>
                                    </td>
                                    <td> Dec 12, 2017 </td>
                                    <td> WD-12346 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/faces/face3.jpg" class="me-2" alt="image"> Marina
                                        Michel
                                    </td>
                                    <td> Website down for one week </td>
                                    <td>
                                        <label class="badge badge-gradient-info">ON HOLD</label>
                                    </td>
                                    <td> Dec 16, 2017 </td>
                                    <td> WD-12347 </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="assets/images/faces/face4.jpg" class="me-2" alt="image"> John
                                        Doe
                                    </td>
                                    <td> Loosing control on server </td>
                                    <td>
                                        <label class="badge badge-gradient-danger">REJECTED</label>
                                    </td>
                                    <td> Dec 3, 2017 </td>
                                    <td> WD-12348 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

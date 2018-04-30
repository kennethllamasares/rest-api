@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Account Settings</h3>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>General</h4>
                    <hr/>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3"><label>Email</label></div>
                                <div class="col-sm-6">{{ Auth::user()->email }}</div>
                                <!-- <div class="col-sm-3"><a href="" class="badge pull-right">Change email</a></div> -->
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3"><label>Name</label></div>
                                <div class="col-sm-6">{{ Auth::user()->name }}</div>
                                <div class="col-sm-3">
                                    <button type="button" class="pull-right btn btn-info btn-sm" data-toggle="modal" data-target="#changeNameModal">Change name</button>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div id="changeNameModal" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change name</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/action_page.php">
                                        <div class="form-group">
                                            <!-- <label for="email">Key</label> -->
                                            <input type="email" placeholder="Name" class="form-control" id="email" value="{{ Auth::user()->name }}">
                                        </div>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Update</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3"><label>Password</label></div>
                                <div class="col-sm-6">***********</div>
                                <div class="col-sm-3">
                                    <button type="button" class="pull-right btn btn-info btn-sm">Change password</button>
                                </div>
                            </div>
                            <br/>
                            <form action="/action_page.php">
                                <div class="form-group">
                                    <input type="email" placeholder="Your current password" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Your new password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Type your new password again" class="form-control" id="pwd">
                                </div>
                                <button type="submit" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Confirm change password</button>
                            </form>
                            <!-- </div> -->
                            <!-- </div> -->
                        </li>
                    </ul>
                    <h4>API Access</h4>
                    <hr/>
                    <form action="/action_page.php">
                        <div class="form-group">
                            <!-- <label for="email">Key</label> -->
                            <input type="text" placeholder="Key" class="form-control" id="apiKey" value="4pinG2rdAi5JDxayOHYjaYA431HEJLhdE2rn9YF3">
                        </div>
                        <div class="form-group">
                            <!-- <label for="pwd">Secret</label> -->
                            <input type="text" placeholder="Secret" class="form-control" id="apiSecret" value="NokWmCjr1ALWf408YoFLceqhU441lcC6tqqi3o2XwxaNtR9lKP">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

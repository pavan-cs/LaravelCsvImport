@extends('layouts.main')

@section('title', 'test')


@section('content')

<style type="text/css">
	
	.border{
		border: 1 px solid lightgray; 
		padding: 10px !important ;
	}
</style>
<div class="row">
	    <!-- Side widgets-->
    <div class="col-lg-3">
        <!-- Search widget-->
        <div class="card mb-4">
            <div class="card-header">Search</div>
            <div class="card-body">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                </div>
            </div>
        </div>
        <!-- Categories widget-->
        <div class="card mb-4">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#!">Web Design</a></li>
                            <li><a href="#!">HTML</a></li>
                            <li><a href="#!">Freebies</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#!">JavaScript</a></li>
                            <li><a href="#!">CSS</a></li>
                            <li><a href="#!">Tutorials</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Side widget-->
        <div class="card mb-4">
            <div class="card-header">Side Widget</div>
            <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
        </div>
    </div>



    <!-- Blog entries-->
    <div class="col-lg-9">


<!-- Side widget-->
        <div class="card">
            <div class="card-header">Side Widget</div>
            <div class="card-body">
                <form action="/users/import" method="post" class="form" enctype= multipart/form-data>
                    @csrf

                    <div class="mb-3">
                        <label for="upload-file" class="form-label">Upload File</label>
                        <input type="file" name="users" class="form-control" id="upload-file" >
                        
                    </div>
                     <div class="mb-3">
                        <!-- <label for="upload-btn" class="form-label">Upload File</label> -->
                        <input type="submit" class="form-control btn-primary" id="upload-btn" >
                        
                    </div>
                </form>
                
                
            </div>
        </div>


       
    </div>


</div>

@endsection
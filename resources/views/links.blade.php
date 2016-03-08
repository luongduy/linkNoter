
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class = "col-lg-4">
            <div class = "input-group">
               <input id="searchTextbox" type = "text" class = "form-control" placeholder="Search">
               
               <span class = "input-group-btn">
                  <button class = "btn btn-default" type = "button">
                     <span class="glyphicon glyphicon-search"></span>
                  </button>
               </span>
            </div>
        </div>
        <div class = "col-lg-6">    
            <button class = "btn btn-default" type = "button">
                     <span class="glyphicon glyphicon-plus"></span>
                     New
            </button>
        </div>
     </div>
</div>
<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1">
            <div>
                <button style="border-width: 0px;padding:0px;" class = "btn btn-default center-block" type = "button">
                         <span class="glyphicon glyphicon-chevron-up"></span>
                </button> 
            </div>
            <div  align="center">
                <label style="display:inline;text-align: center;"> 1234 </label> <br />
            </div>
            <div>
                <button style="border-width: 0px;padding:0px;"class = "btn btn-default center-block" type = "button">
                         <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
            </div>
        </div>
        <div class="col-lg-11">
            <br />
            <a href="http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp">http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp</a>
            <br />
            <button style="border-width: 0px;padding:2px 3px;"class = "btn btn-info">
                    css
            </button>
        </div>
    </div>
    <hr style="margin:0px;">
    <div class="row">
        <div class="col-lg-1">
            <div>
                <button style="border-width: 0px;padding:0px;" class = "btn btn-default center-block" type = "button">
                         <span class="glyphicon glyphicon-chevron-up"></span>
                </button> 
            </div>
            <div  align="center">
                <label style="display:inline;text-align: center;"> 1234 </label> <br />
            </div>
            <div>
                <button style="border-width: 0px;padding:0px;"class = "btn btn-default center-block" type = "button">
                         <span class="glyphicon glyphicon-chevron-down"></span>
                </button>
            </div>
        </div>
        <div class="col-lg-11">
            <br />
            <a href="http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp">http://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp</a>
            <br />
        </div>
    </div>


</div>

@endsection
